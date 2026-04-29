# Personal portfolio website

## Overview

A personal portfolio and freelance lead-generation website for a full-stack web developer specializing in the Laravel ecosystem. The site must be minimal, clean, and modern — neutral whites and grays, no unnecessary decoration — while feeling warm and professional. It serves three audiences simultaneously: potential freelance clients, recruiters hiring full-time, and developers evaluating technical credibility.

---

## Goals

- Present the developer's work and technical identity clearly within 10 seconds of landing
- Convert visitors into leads via a website design request form and a contact form
- Make the resume immediately accessible — both readable inline and downloadable as PDF
- Demonstrate mastery of the Laravel stack by being built with it

---

## Deliverables

| Page | Description |
|---|---|
| Home | Hero, tech stack strip, featured projects, services snapshot, CTA |
| Portfolio | Filterable project grid with tech tag filters |
| About | Bio, experience timeline, skills |
| Resume | Inline PDF viewer with download button |
| Services | Service offerings and website design request form |
| Contact | Simple contact form |

---

## Tech stack

| Layer | Technology |
|---|---|
| Backend | Laravel 13 |
| Reactive UI | Livewire 4 |
| JS layer | Alpine.js 3+ |
| Styling | Tailwind CSS 4+ |
| Admin panel | Filament PHP 5 |
| Build tool | Vite |
| Database | MySQL (production) |
| Mail | SMTP (queued) |
| Deployment | Laravel Forge / Ploi / Railway |

### Additional packages

| Package | Purpose |
|---|---|
| `spatie/laravel-medialibrary` + `filament/spatie-laravel-media-library-plugin` | Project thumbnails and resume PDF storage with conversions and Filament upload field |
| `spatie/laravel-tags` + `filament/spatie-laravel-tags-plugin` | `tech_stack` tags on the `Project` model with autocomplete in Filament |
| `spatie/laravel-honeypot` | Honeypot + timestamp spam protection for the service request and contact forms |
| `spatie/laravel-sitemap` | Generate `sitemap.xml` |
| `ralphjsmit/laravel-seo` + `ralphjsmit/laravel-filament-seo` | Per-page meta tags, Open Graph, and JSON-LD, editable from Filament |
| `spatie/laravel-settings` + `filament/spatie-laravel-settings-plugin` | Strongly typed site settings (bio, social links, current resume PDF, contact email) editable from Filament |
| `spatie/eloquent-sortable` | Backs Filament's drag-and-drop reordering of projects via `sort_order` |
| `spatie/laravel-image-optimizer` | Automatic lossless compression of uploaded thumbnails |
| `spatie/laravel-og-image` | Dynamic Open Graph preview images for shared project links |
| `spatie/laravel-backup` | Scheduled database and storage backups in production |

---

## Design direction

- Color palette: neutral whites and grays — `gray-50` to `gray-900`
- No gradients, no drop shadows (max `shadow-sm` on cards), no glow effects
- Typography: Inter or system sans-serif, two weights only — 400 regular and 500 medium
- Spacing generous — sections breathe, content is never crowded
- Dark mode supported via Tailwind `dark:` classes, toggled with Alpine + `localStorage`
- Fully responsive — mobile first, single column → two column → three column grid

---

## Functional requirements

### Portfolio
- Projects stored in database, managed via Filament admin
- Filter by tech tag (Laravel, Livewire, Alpine.js, Tailwind, Filament, PHP, MySQL)
- Keyword search
- Project detail modal with full description, links, and image
- Pagination — 3 projects per page

### Resume
- PDF rendered inline via browser-native PDF viewer
- One-click download button
- PDF file managed via Laravel storage

### Website design request form (Services page)
- Fields: name, email, company, project type, budget range, description
- Server-side validation via Livewire form object
- Honeypot spam protection
- Rate limited: max 3 submissions per hour per IP
- Submission stored to database + email notification to owner (queued)

### Contact form
- Fields: name, email, message, phone number
- Same spam protection and rate limiting as service request form
- Submission stored to database + email notification to owner (queued)

---

## SEO requirements

- Semantic HTML throughout: `<header>`, `<main>`, `<section>`, `<article>`, `<footer>`
- Unique `<title>` and `<meta name="description">` per page
- Open Graph tags: `og:title`, `og:description`, `og:type`, `og:url`
- Descriptive `alt` text on all images
- Heading hierarchy: one `<h1>` per page, `<h2>` for cards, `<h3>` for sub-sections
- `sitemap.xml` generated via `spatie/laravel-sitemap`

---

## Admin panel (Filament)

- Path: `/admin`
- Manage projects: create, edit, delete, reorder via drag-and-drop
- View contact requests and service requests (read-only table, no public create)
- Toggle `featured` flag on projects (controls home page display)

---

## Phases

### Phase 1 — Foundation
Set up Laravel project, install Livewire, Filament, Tailwind, and Alpine.js. Create the global layout with nav and footer. Run all migrations.

### Phase 2 — Core pages
Build portfolio page with Livewire filtering, resume page with PDF viewer, and static About page. Seed sample projects.

### Phase 3 — Lead generation
Build Services page with request form and Contact page with contact form. Wire up queued email notifications. Add honeypot and rate limiting.

### Phase 4 — Polish & launch
Add dark mode toggle, complete SEO meta tags, generate sitemap, optimize for production, and deploy.

---

## Out of scope

- Blog or articles section
- E-commerce or payment processing
- Multi-language support
- User authentication beyond the Filament admin user
- Third-party booking or scheduling integrations
