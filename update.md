# Ynovee Frontend — Update Log

**Date:** April 14, 2026  
**Branch:** main

---

## 1. Calendar / DateRangePicker — Full Rework

**Files:** `src/components/DateRangePicker.jsx`, `src/index.css`

### Problems fixed
- Calendar was invisible on the hero (only the background rendered) — caused by `calendarClassName` putting the CSS class on the wrong element; all styles used `.drp-hero .react-datepicker` (parent → child) so nothing matched.
- Calendar appeared at the top-left corner of the screen (`0, 0`) — caused by `portalId` rendering the calendar at body level while Popper.js lost its anchor reference.
- Calendar was not responsive on mobile — it filled the full screen instead of behaving as a compact dropdown.
- Calendar was opening above the input on booking/single pages instead of below.

### What was done
- Switched from `calendarClassName` → `popperClassName` so the CSS class sits on the Popper wrapper (the correct parent), making all `.drp-hero .react-datepicker` selectors match.
- Removed `portalId` entirely — it broke Popper.js position calculation.
- Moved all calendar styles out of inline `<style>` tags into `src/index.css` (global stylesheet) so they apply regardless of where the calendar renders in the DOM.
- Set `popperPlacement="bottom-start"` for light variant (booking/single pages) — calendar opens directly below the input.
- Set `popperPlacement="top-start"` for hero variant — the search bar is pinned to the bottom of the screen so the only available space is upward.
- Added `max-width: calc(100vw - 24px)` on `.drp-light .react-datepicker` and `.drp-hero .react-datepicker` — calendar never overflows the viewport width on mobile.
- Added `@media (max-width: 640px)` breakpoint that shrinks day cell sizes and padding — calendar behaves as a compact dropdown on small screens.
- Removed all custom `popperModifiers` that were disabling `preventOverflow` — this was causing Popper.js to fall back to position `(0, 0)`.
- Reduced `monthsShown` from `2` → `1` on the hero and booking page sticky bar — two months side-by-side is too wide for a compact bar.

---

## 2. Hero Section — Stacking Context Fix

**File:** `src/components/landing/Hero.jsx`

### Problems fixed
- `overflow: hidden` on the root hero div was clipping the calendar dropdown.
- `backdrop-blur-xl` on the search `<form>` was creating a CSS stacking context that trapped the calendar popper inside the form, preventing it from visually escaping.

### What was done
- Moved `overflow-hidden` from the root hero div down to a dedicated inner wrapper that wraps only the slider `<section>`. The outer div (which contains the form) is now overflow-free.
- Split the search bar glass effect: moved `backdrop-blur-xl`, `bg-white/20`, `border`, `shadow` onto a separate inert `<div>` (with `pointer-events-none`) placed behind the form. The `<form>` itself has no blur or opacity, so it no longer creates a stacking context. The calendar popper can now float freely above everything.

---

## 3. Hero Button Link — Validation

**File:** `src/components/landing/Hero.jsx`

### Problem fixed
- The "Explore More" button used `navigate(slide.cta_link)` directly. The `cta_link` stored in the database was `/room` — a route that does not exist — causing a broken navigation.

### What was done
- Added a `VALID_ROUTES` whitelist: `/booking`, `/tours`, `/about`, `/experience`, `/gallery`, `/contact`, `/blog`.
- Button now checks `cta_link` against this list before navigating. Any unrecognised or invalid path (including `/room`, external URLs, empty strings) falls back to `/booking`.

---

## 4. Booking Page — Stacking Context Fix

**File:** `src/pages/BookingPage.jsx`

### Problem fixed
- The sticky search bar had `z-30`, which created a CSS stacking context. Any child element (including the calendar with `z-9999`) was confined within this context and could not visually appear above sibling elements on the page.

### What was done
- Changed the sticky bar from `z-30` to `z-[100]` with `style={{ isolation: 'auto' }}`. `isolation: auto` prevents the element from forming a new stacking context, so the calendar popper participates in the root stacking context and its `z-9999` applies globally.
- Reduced `monthsShown` from `2` → `1` on the sticky bar date picker for better layout on all screen sizes.

---

## 5. Why Choose Us — Mobile Responsiveness

**File:** `src/components/landing/WhyChooseUs.jsx`

### Problems fixed
- Section was not visible on mobile — the container had a fixed `h-[60vh]` height that clipped the service items below.
- `w-screen` on the outer container was causing horizontal overflow and scroll on mobile.
- Illustration images used hardcoded `absolute` positioning with pixel values (`ml-[324px]`, `mb-64`) that broke layout on all screen sizes except the exact desktop width they were designed for.

### What was done
- Replaced `w-screen` with `w-full max-w-6xl` — no more horizontal overflow.
- Removed all fixed heights (`h-[60vh]`, `md:h-screen`) — section now sizes naturally to its content on all screens.
- Service items now use `flex flex-col gap-3` with no height constraint — all items are visible on mobile.
- Illustration section uses a `relative h-[480px]` container on desktop with plane and dots positioned inside it — no more viewport-dependent pixel offsets.
- Added `if (loading) return null` guard to prevent empty layout flash while API data loads.

---

## 6. API Response Caching

**File:** `src/services/api.js`

### Problem fixed
- Every time a user navigated away from a page and returned, all API calls re-fired and images/data reloaded from scratch, causing visible loading states on every visit.

### What was done
- Added a module-level `Map` (`_cache`) in `api.js`. JavaScript modules are singletons — this map persists for the entire browser session, surviving all React Router navigations.
- All `GET` requests now check the cache first. If a fresh entry exists, the cached data is returned instantly with no network request.
- Successful `GET` responses are stored in the cache with a **5-minute TTL**. After expiry, the next request fetches fresh data.
- Any `POST`, `PUT`, or `DELETE` mutation automatically calls `cacheBust()` which clears all cache entries matching that API path — ensuring stale data is never shown after an admin update.
- No third-party library added — pure JS, zero bundle size impact.

---

## Files Changed Summary

| File | Change |
|------|--------|
| `src/components/DateRangePicker.jsx` | Full rewrite — clean Popper config, no portalId, no inline styles |
| `src/index.css` | Added all `.drp-hero` and `.drp-light` calendar styles globally + mobile breakpoints |
| `src/components/landing/Hero.jsx` | Scoped overflow-hidden to slider only; separated backdrop-blur from form; fixed button link validation |
| `src/components/landing/WhyChooseUs.jsx` | Full mobile responsive rewrite |
| `src/pages/BookingPage.jsx` | Fixed stacking context on sticky bar; reduced monthsShown to 1 |
| `src/services/api.js` | Added in-memory GET cache with 5-min TTL and automatic mutation busting |
