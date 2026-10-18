#!/usr/bin/env python3
"""Deploy Careers Hub code to live VPS /var/www/careers-hub/app21."""
from __future__ import annotations

import io
import os
import sys
import tarfile
import time
from pathlib import Path

import paramiko

HOST = "217.154.63.180"
USER = "root"
REMOTE = "/var/www/careers-hub/app21"
LOCAL = Path(__file__).resolve().parents[1]

EXCLUDE_DIRS = {
    ".git",
    "vendor",
    "test",
    "tutorapp",
    "tms",
    "tpm",
    "storage",
    "node_modules",
    "__MACOSX",
    ".cursor",
    "canva",
    "canva_2",
    "uploads",
}

CODE_EXTS = {
    ".php",
    ".css",
    ".js",
    ".json",
    ".lock",
    ".htaccess",
    ".example",
    ".svg",
    ".png",
    ".jpg",
    ".jpeg",
    ".ico",
    ".woff",
    ".woff2",
    ".ttf",
    ".map",
    ".txt",
    ".md",
}

EXCLUDE_FILES = {
    ".env",
    "debug.log",
    "plan.md",
    "router.php",
    "deploy_live.py",
}


def include_file(rel: Path) -> bool:
    if any(p in EXCLUDE_DIRS for p in rel.parts):
        return False
    if rel.name in EXCLUDE_FILES:
        return False
    if rel.name.startswith("~$"):
        return False
    if ".bak" in rel.name or rel.suffix == ".zip" or rel.suffix == ".log":
        return False
    if rel.name == ".htaccess" or rel.name == ".gitignore":
        return True
    if rel.suffix.lower() not in CODE_EXTS:
        return False
    if rel.suffix.lower() == ".md":
        return False
    return True


def main() -> int:
    password = os.environ.get("R2T_SSH_PASS")
    if not password:
        print("Set R2T_SSH_PASS", file=sys.stderr)
        return 1

    ts = time.strftime("%Y%m%d%H%M%S")
    print("Building code archive...", flush=True)
    buf = io.BytesIO()
    count = 0
    with tarfile.open(fileobj=buf, mode="w:gz") as tar:
        for root, dirs, files in os.walk(LOCAL):
            dirs[:] = [d for d in dirs if d not in EXCLUDE_DIRS]
            for f in files:
                full = Path(root) / f
                try:
                    rel = full.relative_to(LOCAL)
                except ValueError:
                    continue
                if not include_file(rel):
                    continue
                arc = rel.as_posix()
                tar.add(str(full), arcname=arc)
                count += 1
    size_mb = buf.tell() / (1024 * 1024)
    print(f"Archived {count} files, {size_mb:.1f} MB", flush=True)

    client = paramiko.SSHClient()
    client.set_missing_host_key_policy(paramiko.AutoAddPolicy())
    print("Connecting...", flush=True)
    client.connect(
        HOST,
        username=USER,
        password=password,
        timeout=60,
        allow_agent=False,
        look_for_keys=False,
    )

    def run(cmd: str, timeout: int = 300) -> str:
        print(">>", cmd, flush=True)
        _stdin, stdout, stderr = client.exec_command(cmd, timeout=timeout)
        out = stdout.read().decode("utf-8", "replace")
        err = stderr.read().decode("utf-8", "replace")
        code = stdout.channel.recv_exit_status()
        if out.strip():
            print(out[-3000:], flush=True)
        if err.strip():
            print("ERR:", err[-1500:], flush=True)
        if code != 0:
            raise RuntimeError(f"Command failed ({code}): {cmd}")
        return out

    run(
        f"mkdir -p /var/www/careers-hub/backups && "
        f"tar -czf /var/www/careers-hub/backups/app21-code-{ts}.tgz "
        f"-C {REMOTE} --exclude=app21_backup.zip --exclude=Archive.zip "
        f"--exclude=__MACOSX --exclude=lms/canva --exclude=lms/canva_2 "
        f"--exclude=lms/uploads --exclude=vendor --exclude=test "
        f"--exclude='*.zip' ."
    )
    run(f"cp -a {REMOTE}/dbConnection.php {REMOTE}/dbConnection.php.bak-before-deploy-{ts}")

    remote_tar = f"/tmp/app21-deploy-{ts}.tgz"
    print("Uploading...", flush=True)
    sftp = client.open_sftp()
    buf.seek(0)
    sftp.putfo(buf, remote_tar)
    sftp.close()
    print("Upload done", flush=True)

    run(f"tar -xzf {remote_tar} -C {REMOTE}")
    run(f"rm -f {remote_tar}")

    db_user = os.environ.get("R2T_DB_USER", "careers_user")
    db_pass = os.environ.get("R2T_DB_PASS")
    db_name = os.environ.get("R2T_DB_NAME", "eafbbabd_app21_new")
    if not db_pass:
        raise RuntimeError("Set R2T_DB_PASS for production .env")
    env_content = f"""APP_ENV=production
APP_TIMEZONE=Europe/London
APP_DISPLAY_ERRORS=off

SITE_NAME=" - Right2Thrive UK Collective Careers Hub "
SITE_WELLBEING_HUB_URL=https://www.right2thriveuk.com/
PAGE_SIZE=10
ADMIN_EMAIL=hello@right2thriveuk.com

DB_HOST=localhost
DB_USERNAME={db_user}
DB_PASSWORD="{db_pass}"
DB_DATABASE={db_name}

TUTORAPP_DB_HOST=
TUTORAPP_DB_USERNAME=
TUTORAPP_DB_PASSWORD=
TUTORAPP_DB_DATABASE=

MAIL_HOST=mail.21kdigitalmedia.com
MAIL_USERNAME=hello@21kdigitalmedia.com
MAIL_PASSWORD=
MAIL_PORT=465
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=hello@right2thriveuk.com
MAIL_FROM_NAME="Right2Thrive UK Collective Careers Hub"

TUTORAPP_LOGIN_PATH=tutorapp/user_login.php
TUTORAPP_TMS_DASHBOARD=tutorapp/tmsnew/index.php
TUTORAPP_TPM_DASHBOARD=tutorapp/tpm/index.php
TUTORAPP_LOCAL_TMS_INDEX=tmsnew/index.php
TUTORAPP_LOCAL_LMS_INDEX=lms/index.php
TUTORAPP_LOCAL_TPM_INDEX=tpm/index.php
"""
    sftp = client.open_sftp()
    with sftp.file(f"{REMOTE}/.env", "w") as fh:
        fh.write(env_content)
    sftp.close()
    print("Wrote production .env", flush=True)

    run(f"cd {REMOTE} && composer install --no-dev --optimize-autoloader 2>&1")
    run(f"chown -R www-data:www-data {REMOTE}")

    code = run(
        'curl -sk -o /tmp/login_out.html -w "%{http_code}" '
        '-H "Host: www.right2thriveuk.com" '
        "https://127.0.0.1/app21/user_login.php"
    )
    run("head -c 500 /tmp/login_out.html; echo")
    run(f"test -f {REMOTE}/config/config.php && echo HAS_CONFIG")
    run(f"test -d {REMOTE}/vendor/vlucas && echo HAS_DOTENV")
    print("HTTP status:", code.strip(), flush=True)

    client.close()
    print("DEPLOY COMPLETE", flush=True)
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
