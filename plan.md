# Website UI redesign plan — 21K Creative Hub / Right2Thrive LMS

This document is a practical roadmap to modernize the **public** pages (login, register) and the **LMS** (`lms/`) so the experience feels cohesive, smooth, and easier to use—without rewriting PHP business logic in phase one.

---

## 1. Goals and principles

| Goal | What “done” looks like |
|------|-------------------------|
| **Modern** | Clear hierarchy, consistent spacing, restrained color, up-to-date components (not “2010 admin template” defaults). |
| **Smooth** | Short, purposeful motion; no layout jump; fast perceived load (skeleton or stable heights where needed). |
| **User-friendly** | Obvious next steps, readable forms, mobile-first navigation, accessible focus and contrast. |
| **Maintainable** | One design language: shared tokens (colors, radius, shadows) and shared components, minimal inline `style=""`. |

**Non-goals for v1:** Full framework migration, redesigning embedded tools (e.g. Canva exports) unless they break layout.

---

## 2. Current state (baseline)

- **Public area:** `user_login.php`, `register.php` → `css/reset.css`, `css/style.css`, mixed Google Fonts, some inline CSS.
- **LMS:** Pages wrap `#app` → `sidebar.php` + `header.php` → content; assets from `lms/assets/css/app.css`, Bootstrap, Nunito, Bootstrap Icons (`lms/metadata.php`).
- **Brand:** Header shows “Right2Thrive UK HUB” with inline colors; sitename in `dbConnection.php` is `21K Creative Hub`.

**Main gap:** Two different stacks and aesthetics; lots of one-off styling in PHP templates.

---

## 3. Design system (do this first)

### 3.1 Brand and tokens

1. **Lock a small palette** (primary, secondary, success/warning/danger neutrals, surface + border). Map “Right2Thrive” accent to **one** primary hue; retire rainbow inline spans in `lms/header.php` in favor of a logo or a single gradient/wordmark class.
2. **Typography:** Prefer **one** sans family sitewide (e.g. keep Nunito for LMS + public, or Inter / Source Sans 3). Define: page title, section title, body, small/caption.
3. **Spacing scale:** Use 4px or 8px base (4, 8, 12, 16, 24, 32, 48).
4. **Radius & elevation:** 2 radius values (e.g. 8px cards, full pill buttons) and 2 shadow levels max.
5. **Document tokens** in a single source:
   - **Option A (recommended):** `lms/assets/css/tokens.css` (CSS custom properties) + import from `app.css` and public `css/style.css`.
   - **Option B:** SCSS variables if you introduce a build step later.

### 3.2 Components to standardize

- Primary / secondary / ghost buttons  
- Form fields: label, hint, error state  
- Cards (dashboard tiles)  
- Alerts / banners (e.g. Teams notice on `dashboard.php`)  
- Modals (logout in `lms/header.php`)  
- Sidebar link active state (`lms/sidebar.php` + `active()`)

---

## 4. Information architecture and UX

1. **Rename / group nav** for clarity where labels are confusing (e.g. “My Wellbeing” vs “Virtual Classroom” history in comments).
2. **Dashboard:** Turn the three stacked links into **action cards** with short descriptions and one primary CTA; reduce fixed `height:200px` hacks—use min-height + padding.
3. **Global:** Breadcrumb or page subtitle pattern on inner pages so users know where they are after deep links.
4. **Empty and error states:** Same layout pattern (icon + message + action) across list/upload pages.

---

## 5. Technical implementation phases

### Phase A — Foundation (low risk)

1. Add **`tokens.css`** (or equivalent) and link it **before** `app.css` / public styles.
2. Replace the worst **inline styles** in `lms/header.php`, `lms/dashboard.php`, and key forms with classes.
3. **Unify focus rings** and link colors for keyboard users (`:focus-visible`).
4. Ensure **viewport** and **tap targets** ≥ 44px on mobile for header burger and sidebar close.

### Phase B — Shell polish (sidebar + header)

1. Refine **sidebar**: clearer section titles, optional collapse on desktop, smoother open/close on mobile (respect `prefers-reduced-motion`).
2. Refine **top bar**: align title hierarchy; move “Sign out” to a consistent placement; consider user menu (avatar + name from session).
3. **Logout modal:** Bootstrap 5–style markup if you upgrade; ensure one clear primary destructive action.

### Phase C — Public pages (login / register)

1. Rebuild layout as a **single centered column** or split hero + form; reuse LMS tokens so login → app feels like one product.
2. **Forms:** floating labels or clear label-above-field; show validation next to fields; loading state on submit.
3. Remove duplicate font loads; **preload** only critical font weights.

### Phase D — Page-by-page LMS rollout

Priority order (adjust to your traffic):

1. `lms/dashboard.php`  
2. High-traffic portfolio / upload / download flows  
3. Wellbeing / assessment pages (`phq9.php`, `gad7.php`, etc.) — ensure form controls and scales are large and readable  
4. Long-tail admin-style tables → consistent table component + paginationFor each page: markup cleanup → component classes → quick mobile pass.

### Phase E — Quality bar

1. **Contrast:** WCAG AA for text and interactive elements (check primary on white).  
2. **Keyboard:** Tab order through sidebar, modals trap focus.  
3. **Performance:** Audit image sizes in `assets/images/` and `uploads/`; lazy-load non-critical images.  
4. **Cross-browser:** Safari iOS + Chrome Android + desktop Edge.

---

## 6. Bootstrap and dependencies

- **Today:** LMS uses local `lms/assets/css/bootstrap.css` + `app.css` (Mazer-style).  
- **Decision point:** Either stay on current Bootstrap major version and **theme via tokens**, or plan a **controlled upgrade** (test every modal, dropdown, grid). Do not upgrade mid-redesign without a checklist page per component.
- **jQuery:** Still loaded in `lms/metadata.php`; for “smooth” UX prefer progressive enhancement—only add new JS where CSS cannot solve it.

---

## 7. File map (primary touch points)

| Area | Files / folders |
|------|------------------|
| LMS shell | `lms/sidebar.php`, `lms/header.php`, `lms/metadata.php`, `lms/assets/css/app.css` |
| New tokens | `lms/assets/css/tokens.css` (new), imported from `app.css` or `metadata.php` |
| Public | `user_login.php`, `register.php`, `css/style.css`, root `metadata.php` if used |
| Dashboard | `lms/dashboard.php` |
| Config / naming | `dbConnection.php` (`sitename`) — align wording with visible brand |

---

## 8. Milestones and timeboxing (example)

| Week | Deliverable |
|------|-------------|
| 1 | Tokens + header/sidebar pass + dashboard cards |
| 2 | Public login/register aligned + form UX |
| 3 | Top 5 LMS pages restyled; table pattern |
| 4 | A11y + performance pass; fix regressions |

---

## 9. Definition of done (checklist)

- [ ] No critical color contrast failures on primary flows  
- [ ] Mobile: sidebar usable; no horizontal scroll on common pages  
- [ ] Public + LMS share core colors, type, and button styles  
- [ ] Inline `style=""` reduced to exceptions only  
- [ ] Key modals and forms tested keyboard-only  
- [ ] Stakeholder sign-off on brand (logo/wordmark in header)

---

## 10. Optional next steps after v1

- Dark mode (token-driven `data-theme`)  
- User preference for reduced motion (already respect system setting)  
- Component partials in PHP (`lms/partials/card.php`, etc.) to reduce duplication

---

*Generated for the `app21` codebase structure (PHP + LMS under `lms/`). Update milestones if you add a CSS build pipeline or switch hosting/CDN strategy.*
