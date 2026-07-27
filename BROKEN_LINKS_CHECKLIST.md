# Move Smooth — Broken Links Fix Checklist

Based on `movesmoth_broken_links_report.xlsx`. URL structure **same** rahegi: `/movers/{state-slug}`, `/movers/{code}/{city-slug}`, `/{category}/{article-slug}`.

---

## A. Code (deploy ke baad verify)

- [x] `/cookies` → 301 → `/cookie-policy`
- [x] Privacy page link → `route('front.cookies')`
- [x] Legacy blog/article 301 redirects in `routes/frontend.php`
- [x] Missing/unpublished city URL → 301 → parent **state** page (no 404 chain after old redirects)
- [ ] Production deploy + cache clear: `php artisan route:clear && php artisan config:clear`
- [ ] Re-crawl ya spot-check URLs neeche “Verify” column se

---

## B. Blog / article content (Admin → Blogs)

Har post ke HTML mein internal links update karo (TinyMCE / source).

| Post (source) | Galat link | Sahi target |
|---------------|------------|-------------|
| Moving on a tight budget | `/blog/how-much-does-it-cost-to-move-2026` | `/moving-costs/how-much-does-it-cost-to-move` |
| Moving cost calculator article | `/blog/how-to-get-accurate-moving-quotes-2026` | `/moving-tips/how-to-get-accurate-moving-quotes-and-avoid-being-overcharged` |
| How to get accurate quotes | `/how-to-avoid-moving-scams` | Dedicated post publish karo **ya** related live post ka URL |
| Same post | `/how-to-choose-a-mover` | Dedicated post publish karo **ya** `/blogs?category=moving-tips` |
| Moving on a tight budget | `/movers/tx/austin` | City page publish (Section C) **ya** link hatao |

- [ ] Tight budget post links updated
- [ ] Cost calculator post links updated
- [ ] Quotes/scams post links updated
- [ ] Optional: naye articles publish karo:
  - [ ] `/moving-tips/how-to-avoid-moving-scams` (phir redirect update karo `routes/frontend.php` se)
  - [ ] `/moving-tips/how-to-choose-a-mover` (phir redirect update)

---

## C. State pages (Admin → States)

State **active**, **content** filled, slug sahi. Neighboring links `/movers/ct` jaisi URLs tab kaam karengi jab state live ho.

| Code | State | Report issue | Action |
|------|-------|--------------|--------|
| CT | Connecticut | Linked from MA, NJ | Activate + content |
| DC | Washington D.C. | Linked from VA, MD | Activate + content (slug/code confirm) |
| IA | Iowa | Linked from MN | Activate + content |
| IN | Indiana | Linked from OH, MI | Activate + content |
| KY | Kentucky | Linked from TN | Activate + content |
| NH | New Hampshire | Linked from MA | Activate + content |
| UT | Utah | Linked from CO | Activate + content |
| WI | Wisconsin | Linked from MN | Activate + content |

- [ ] CT live
- [ ] DC live
- [ ] IA live
- [ ] IN live
- [ ] KY live
- [ ] NH live
- [ ] UT live
- [ ] WI live
- [ ] State `content` / `content_below` HTML: galat `/movers/xx` links hatao ya upar wale states publish karo

---

## D. City pages (Admin → Cities)

City content: **slug exact**, **is_active**, **content** body filled.

| URL path | City slug (city_contents) | Referenced from |
|----------|----------------------------|-----------------|
| `/movers/ca/oakland` | `oakland` | California |
| `/movers/fl/fort-lauderdale` | `fort-lauderdale` | Florida |
| `/movers/fl/naples` | `naples` | Florida |
| `/movers/fl/st-petersburg` | `st-petersburg` | Florida |
| `/movers/ga/athens` | `athens` | GA redirect chain |
| `/movers/ga/columbus` | `columbus` | GA redirect chain |
| `/movers/ga/macon` | `macon` | GA redirect chain |
| `/movers/ny/movers-in-new-york-city` | `movers-in-new-york-city` | NYC redirects |
| `/movers/tx/arlington` | `arlington` | Texas |
| `/movers/tx/austin` | `austin` | Texas + blog |
| `/movers/tx/dallas` | `dallas` | Texas |
| `/movers/tx/el-paso` | `el-paso` | Texas |
| `/movers/tx/fort-worth` | `fort-worth` | Texas |
| `/movers/tx/houston` | `houston` | Texas |
| `/movers/tx/san-antonio` | `san-antonio` | Texas |
| `/movers/wa/bellevue` | `bellevue` | WA redirect chain |
| `/movers/wa/redmond` | `redmond` | WA redirect chain |

- [ ] CA — Oakland
- [ ] FL — Fort Lauderdale, Naples, St. Petersburg
- [ ] GA — Athens, Columbus, Macon
- [ ] NY — movers-in-new-york-city
- [ ] TX — all 7 cities
- [ ] WA — Bellevue, Redmond

**Note:** Jab tak city publish na ho, code ab user ko **state page** par bhej dega (301). Best fix = city page complete karo.

---

## E. Redirect chains (automatic — verify only)

Old full state name → `{code}/{city}` already `SiteController@cityMovers` mein hai.

| Old URL | New URL | Verify |
|---------|---------|--------|
| `/movers/georgia/athens` | `/movers/ga/athens` | [ ] 200 ya state fallback |
| `/movers/georgia/columbus` | `/movers/ga/columbus` | [ ] |
| `/movers/georgia/macon` | `/movers/ga/macon` | [ ] |
| `/movers/ny/new-york-city` | `/movers/ny/movers-in-new-york-city` | [ ] |
| `/movers/ny/new-york` | `/movers/ny/movers-in-new-york-city` | [ ] |
| `/movers/washington/bellevue` | `/movers/wa/bellevue` | [ ] |
| `/movers/washington/redmond` | `/movers/wa/redmond` | [ ] |

---

## F. No action (false positives)

| Item | Reason |
|------|--------|
| `/cdn-cgi/l/email-protection` on About, Terms, Privacy, Cookie | Cloudflare email obfuscation — crawlers ko 404 dikhta hai, browser mein theek |
| Visible email | `contact@movesmooth.com` — confirm current |

- [ ] Team ko bataya: email links ignore in audit tools

---

## G. Quick verify commands (local/staging)

```bash
curl -I https://movesmoth.com/cookies
curl -I https://movesmoth.com/blog/how-much-does-it-cost-to-move-2026
curl -I https://movesmoth.com/movers/georgia/athens
curl -I https://movesmoth.com/movers/tx/austin
```

Expect: `301`/`302` with `Location` header, final response **200** (ya state page jab city abhi draft ho).

---

## Priority order

1. **High** — Deploy code (Section A) + blog link edits (Section B)
2. **High** — NYC + Georgia cities (Section D)
3. **Medium** — Texas + Florida + Oakland + WA cities
4. **Medium** — Missing neighbor states (Section C)
5. **Low** — Cloudflare email (Section F)
