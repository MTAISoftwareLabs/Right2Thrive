/**
 * Collective Careers Hub — learner/tutor chat (poll + send).
 * Expects #career-chat-app with data-api, data-role, data-learner-id (tutor), data-csrf.
 */
(function () {
  'use strict';

  var root = document.getElementById('career-chat-app');
  if (!root) {
    return;
  }

  var apiUrl = root.getAttribute('data-api') || '';
  var role = root.getAttribute('data-role') || 'learner';
  var learnerId = parseInt(root.getAttribute('data-learner-id') || '0', 10);
  var csrf = root.getAttribute('data-csrf') || '';
  var lastId = parseInt(root.getAttribute('data-last-id') || '0', 10);
  var pollMs = parseInt(root.getAttribute('data-poll-ms') || '5000', 10);
  if (pollMs < 3000) {
    pollMs = 3000;
  }

  var threadEl = document.getElementById('cch-thread');
  var formEl = document.getElementById('cch-form');
  var inputEl = document.getElementById('cch-input');
  var sendBtn = document.getElementById('cch-send');
  var statusEl = document.getElementById('cch-status');
  var pollTimer = null;
  var sending = false;

  function setStatus(text, isError) {
    if (!statusEl) {
      return;
    }
    statusEl.textContent = text || '';
    statusEl.className = 'cch-status small mt-1' + (isError ? ' text-danger' : ' text-muted');
  }

  function escapeHtml(s) {
    var d = document.createElement('div');
    d.textContent = s;
    return d.innerHTML;
  }

  function formatTime(iso) {
    if (!iso) {
      return '';
    }
    var d = new Date(iso.replace(' ', 'T'));
    if (isNaN(d.getTime())) {
      return iso;
    }
    return d.toLocaleString(undefined, { day: 'numeric', month: 'short', hour: '2-digit', minute: '2-digit' });
  }

  function renderMessage(m) {
    var wrap = document.createElement('div');
    wrap.className = 'cch-bubble ' + (m.mine ? 'cch-bubble--mine' : 'cch-bubble--theirs');
    wrap.setAttribute('data-id', String(m.id));
    var body = document.createElement('div');
    body.className = 'cch-body';
    body.innerHTML = escapeHtml(m.body || '').replace(/\n/g, '<br>');
    var meta = document.createElement('div');
    meta.className = 'cch-meta';
    meta.textContent = formatTime(m.created_at);
    wrap.appendChild(body);
    wrap.appendChild(meta);
    return wrap;
  }

  function appendMessages(messages) {
    if (!threadEl || !messages || !messages.length) {
      return;
    }
    var empty = threadEl.querySelector('.cch-empty');
    if (empty) {
      empty.remove();
    }
    var scroll = false;
    var nearBottom = threadEl.scrollHeight - threadEl.scrollTop - threadEl.clientHeight < 80;
    messages.forEach(function (m) {
      if (!m.id || threadEl.querySelector('[data-id="' + m.id + '"]')) {
        return;
      }
      threadEl.appendChild(renderMessage(m));
      if (m.id > lastId) {
        lastId = m.id;
      }
      scroll = true;
    });
    if (scroll && (nearBottom || messages.some(function (x) { return x.mine; }))) {
      threadEl.scrollTop = threadEl.scrollHeight;
    }
  }

  function apiQuery(params) {
    var q = new URLSearchParams(params);
    if (role === 'tutor' && learnerId > 0) {
      q.set('learner_id', String(learnerId));
    }
    return apiUrl + (apiUrl.indexOf('?') >= 0 ? '&' : '?') + q.toString();
  }

  function poll(markRead) {
    if (!apiUrl) {
      return;
    }
    var url = apiQuery({
      action: 'poll',
      after_id: String(lastId),
      mark_read: markRead === false ? '0' : '1',
      _: String(Date.now()),
    });
    fetch(url, { credentials: 'same-origin', headers: { Accept: 'application/json' } })
      .then(function (r) {
        return r.json();
      })
      .then(function (data) {
        if (!data || !data.ok) {
          setStatus((data && data.error) || 'Could not refresh messages.', true);
          return;
        }
        if (data.csrf) {
          csrf = data.csrf;
          root.setAttribute('data-csrf', csrf);
        }
        if (typeof data.last_id === 'number') {
          lastId = Math.max(lastId, data.last_id);
        }
        appendMessages(data.messages || []);
        updateUnreadBadges(data.unread_by_learner || null, data.unread);
        setStatus('');
      })
      .catch(function () {
        setStatus('Connection issue — retrying…', true);
      });
  }

  function updateUnreadBadges(byLearner, selfUnread) {
    if (byLearner && typeof byLearner === 'object') {
      document.querySelectorAll('[data-chat-learner-id]').forEach(function (el) {
        var lid = parseInt(el.getAttribute('data-chat-learner-id') || '0', 10);
        var n = byLearner[lid] || byLearner[String(lid)] || 0;
        var badge = el.querySelector('.cch-unread-badge');
        if (n > 0) {
          if (!badge) {
            badge = document.createElement('span');
            badge.className = 'badge rounded-pill text-bg-danger cch-unread-badge ms-2';
            el.appendChild(badge);
          }
          badge.textContent = n > 99 ? '99+' : String(n);
        } else if (badge) {
          badge.remove();
        }
      });
    }
    var titleBadge = document.getElementById('cch-title-unread');
    if (titleBadge && role === 'learner' && typeof selfUnread === 'number') {
      if (selfUnread > 0) {
        titleBadge.textContent = selfUnread > 99 ? '99+' : String(selfUnread);
        titleBadge.classList.remove('d-none');
      } else {
        titleBadge.classList.add('d-none');
      }
    }
  }

  function sendMessage(ev) {
    if (ev) {
      ev.preventDefault();
    }
    if (!formEl || !inputEl || sending) {
      return;
    }
    var body = (inputEl.value || '').trim();
    if (!body) {
      return;
    }
    sending = true;
    if (sendBtn) {
      sendBtn.disabled = true;
    }
    setStatus('Sending…');
    var fd = new FormData();
    fd.append('action', 'send');
    fd.append('csrf', csrf);
    fd.append('message_body', body);
    if (role === 'tutor' && learnerId > 0) {
      fd.append('learner_id', String(learnerId));
    }
    fetch(apiUrl, { method: 'POST', body: fd, credentials: 'same-origin', headers: { Accept: 'application/json' } })
      .then(function (r) {
        return r.json();
      })
      .then(function (data) {
        sending = false;
        if (sendBtn) {
          sendBtn.disabled = false;
        }
        if (!data || !data.ok) {
          setStatus((data && data.error) || 'Could not send message.', true);
          return;
        }
        inputEl.value = '';
        if (data.csrf) {
          csrf = data.csrf;
        }
        if (data.message) {
          appendMessages([data.message]);
          if (data.message.id > lastId) {
            lastId = data.message.id;
          }
        }
        setStatus('');
        inputEl.focus();
      })
      .catch(function () {
        sending = false;
        if (sendBtn) {
          sendBtn.disabled = false;
        }
        setStatus('Could not send. Check your connection.', true);
      });
  }

  if (formEl) {
    formEl.addEventListener('submit', sendMessage);
  }
  if (inputEl) {
    inputEl.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        sendMessage(e);
      }
    });
  }

  function startPoll() {
    if (pollTimer) {
      clearInterval(pollTimer);
    }
    poll(true);
    pollTimer = setInterval(function () {
      poll(true);
    }, pollMs);
  }

  document.addEventListener('visibilitychange', function () {
    if (document.hidden) {
      if (pollTimer) {
        clearInterval(pollTimer);
        pollTimer = null;
      }
    } else {
      poll(false);
      startPoll();
    }
  });

  if (threadEl) {
    threadEl.scrollTop = threadEl.scrollHeight;
  }
  startPoll();
})();
