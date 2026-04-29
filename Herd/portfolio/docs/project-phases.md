# Project Phases & Task List

This plan is derived from `docs/user-stories.md` and `docs/project-description.md`, and audited against the current codebase.

## Status legend

- **Completed**: already present in codebase
- **Pending**: not implemented yet

## Current audit snapshot

- **Completed**
  - Laravel 13 starter app exists with default route and default tests.
  - Required packages from the project description are installed in `composer.json`.
  - Package migrations for `media`, `tags`/`taggables`, `seo`, and `settings` already exist.
  - Default Laravel tables (`users`, `cache`, `jobs`) exist.
- **Pending**
  - All product-specific models, migrations, factories, seeders, pages, Livewire components, Filament resources, mailables, and feature tests.

---

## Phase 1: Database Structure

> Build all application data structures first (models, migrations, factories, seeders) using Laravel conventions compatible with Laravel 12/13.

### Phase 1.1: Package-backed DB foundations

#### Task 1.1.1 — Keep package migration baseline aligned (**Completed**)
- Ensure package tables are present and treated as source of truth:
  - `media` (Spatie Media Library)
  - `tags`, `taggables` (Spatie Tags)
  - `seo` (RalphJSmit SEO)
  - `settings` (Spatie Settings)

Automated feature tests (acceptance criteria):
- `tests/Feature/Database/PackageTablesExistTest.php`
  - Assert each expected table exists.
  - Assert core columns exist for each table.

### Phase 1.2: Core domain tables and migrations

#### Task 1.2.1 — Create `projects` table + migration (**Pending**)
- Columns:
  - `id`, `title`, `slug` (unique), `summary`, `description` (longText), `live_url` nullable, `repo_url` nullable
  - `featured` boolean default false
  - `sort_order` unsigned integer indexed
  - timestamps
- Add DB indexes: `slug`, `featured`, `sort_order`.

Automated feature tests (acceptance criteria):
- `tests/Feature/Database/ProjectsSchemaTest.php`
  - Assert table and expected columns exist.
  - Assert unique index for `slug`.
  - Assert default for `featured` is false.

#### Task 1.2.2 — Create `service_requests` table + migration (**Pending**)
- Columns:
  - `id`, `name`, `email`, `company` nullable
  - `project_type` string (comment with initial values: website-design-development, custom-web-app, maintenance-support)
  - `budget_range` string (comment with initial values: under-2k, 2k-5k, 5k-10k, 10k-plus)
  - `description` text
  - `status` string default `new` (comment initial values: new, in_review, replied, closed)
  - `ip_address` nullable
  - timestamps
- Do not use DB enum; keep status/project type as strings per guideline.

Automated feature tests (acceptance criteria):
- `tests/Feature/Database/ServiceRequestsSchemaTest.php`
  - Assert expected columns and defaults exist.
  - Assert `status` default is `new`.

#### Task 1.2.3 — Create `contact_requests` table + migration (**Pending**)
- Columns:
  - `id`, `name`, `email`, `phone` nullable, `message` text
  - `status` string default `new` (comment initial values: new, read, replied)
  - `ip_address` nullable
  - timestamps
- Keep `status` string (not enum) per guideline.

Automated feature tests (acceptance criteria):
- `tests/Feature/Database/ContactRequestsSchemaTest.php`
  - Assert expected columns exist.
  - Assert `status` default is `new`.

#### Task 1.2.4 — Create optional lookup tables only if values become dynamic (**Pending, conditional**)
- If owner needs editable lists in admin:
  - `service_types`
  - `budget_ranges`
- Otherwise keep values in PHP enums/config and string DB storage.

Automated feature tests (acceptance criteria):
- `tests/Feature/Database/ServiceLookupsSchemaTest.php`
  - Assert lookup tables exist only when enabled.
  - Assert foreign keys are constrained if used.

### Phase 1.3: Eloquent models and casts

#### Task 1.3.1 — Create models: `Project`, `ServiceRequest`, `ContactRequest` (**Pending**)
- Add fillable/guarded policy-safe defaults.
- Add casts:
  - booleans for `featured`
  - string-based status casts if enum-backed cast objects are used.

Automated feature tests (acceptance criteria):
- `tests/Feature/Models/ProjectModelTest.php`
  - Assert default ordering scope uses `sort_order`.
  - Assert slug uniqueness behavior is enforced at DB layer.
- `tests/Feature/Models/RequestModelsTest.php`
  - Assert status defaults for both request models.

#### Task 1.3.2 — Integrate package traits on models (**Pending**)
- `Project`:
  - `InteractsWithMedia` for thumbnails
  - `HasTags` for tech stack tags
  - SEO trait/interface from `ralphjsmit/laravel-seo`
  - sortable behavior for `sort_order`

Automated feature tests (acceptance criteria):
- `tests/Feature/Models/ProjectIntegrationsTest.php`
  - Can attach media to `projects`.
  - Can assign tech tags to `projects`.
  - Sort ordering updates correctly with sortable package.

### Phase 1.4: Factories and seeders

#### Task 1.4.1 — Create factories for all domain models (**Pending**)
- `ProjectFactory`, `ServiceRequestFactory`, `ContactRequestFactory`.
- Add factory states for important statuses.

Automated feature tests (acceptance criteria):
- `tests/Feature/Factories/DomainFactoriesTest.php`
  - Each factory creates valid persisted record.
  - Status states produce expected values.

#### Task 1.4.2 — Create seeders for realistic starter content (**Pending**)
- `ProjectSeeder` with featured + non-featured sample projects.
- Optional `DemoLeadSeeder` for local/testing only.

Automated feature tests (acceptance criteria):
- `tests/Feature/Seeders/ProjectSeederTest.php`
  - Running seeder creates records.
  - At least 2 featured projects are created for home preview.

---

## Phase 2: App Foundation & Navigation

### Phase 2.1: Frontend shell and routing

#### Task 2.1.1 — Build global layout, nav, footer, semantic wrappers (**Pending**)
- Implement semantic `<header>`, `<main>`, `<footer>` shell.

Automated feature tests (acceptance criteria):
- `tests/Feature/Pages/LayoutShellTest.php`
  - Public pages return success.
  - Response contains semantic wrapper elements.

#### Task 2.1.2 — Register all public routes and names (**Pending**)
- Routes: home, portfolio, about, resume, services, contact, resume download.

Automated feature tests (acceptance criteria):
- `tests/Feature/Routing/PublicRoutesTest.php`
  - All expected named routes exist.
  - Each route responds successfully.

### Phase 2.2: SPA-like navigation (US-1.1)

#### Task 2.2.1 — Implement Livewire-driven navigation behavior (**Pending**)
- Active nav link, browser history, page title updates, scroll reset.

Automated feature tests (acceptance criteria):
- `tests/Feature/Navigation/SpaNavigationTest.php`
  - Assert pages render expected `<title>`.
  - Assert active link marker appears per route.
- `tests/Browser/NavigationSpaBehaviorTest.php` (recommended)
  - Back/forward behavior works.
  - No full page flash between transitions.

### Phase 2.3: Responsive + dark mode baseline (US-1.2, US-1.3)

#### Task 2.3.1 — Mobile-first responsive foundation (**Pending**)

Automated feature tests (acceptance criteria):
- `tests/Browser/ResponsiveLayoutSmokeTest.php`
  - Core pages render without JS errors.
  - No horizontal overflow at common mobile viewport.

#### Task 2.3.2 — Dark mode toggle with persisted preference (**Pending**)

Automated feature tests (acceptance criteria):
- `tests/Browser/DarkModePreferenceTest.php`
  - Toggle stores preference.
  - Revisiting page applies stored mode.

---

## Phase 3: Core Public Pages

### Phase 3.1: Home page (US-2.1 to US-2.5)

#### Task 3.1.1 — Hero, stack strip, featured projects, services snapshot, bottom CTA (**Pending**)

Automated feature tests (acceptance criteria):
- `tests/Feature/Pages/HomePageTest.php`
  - Hero content and CTA links render.
  - Featured section hides when no featured projects.
  - Services snapshot cards render with correct links.
  - Bottom CTA is present.

### Phase 3.2: About page (US-4.1, US-4.2)

#### Task 3.2.1 — Bio, avatar, skills grouping, experience timeline (**Pending**)

Automated feature tests (acceptance criteria):
- `tests/Feature/Pages/AboutPageTest.php`
  - Page has expected headings/sections.
  - Skills and timeline data render.

### Phase 3.3: Resume page (US-5.1, US-5.2)

#### Task 3.3.1 — Inline PDF viewer with fallback (**Pending**)

Automated feature tests (acceptance criteria):
- `tests/Feature/Pages/ResumePageTest.php`
  - Includes `<h1>Resume</h1>`.
  - Contains iframe/embed with storage-backed resume URL.
  - Shows fallback message when resume missing.

#### Task 3.3.2 — Resume download endpoint (**Pending**)

Automated feature tests (acceptance criteria):
- `tests/Feature/Resume/DownloadResumeTest.php`
  - `GET /resume/download` returns attachment response.
  - `Content-Disposition` filename is human readable.
  - Returns expected not-found behavior when file missing.

---

## Phase 4: Portfolio Experience

### Phase 4.1: Portfolio listing (US-3.1)

#### Task 4.1.1 — Project grid, sorting, pagination, empty state (**Pending**)

Automated feature tests (acceptance criteria):
- `tests/Feature/Portfolio/PortfolioListTest.php`
  - Projects sorted by `sort_order` ascending.
  - Pagination count per page is correct.
  - Empty state appears when no projects.

### Phase 4.2: Filtering & search (US-3.2, US-3.3)

#### Task 4.2.1 — Tag-pill filtering with multi-select (**Pending**)

Automated feature tests (acceptance criteria):
- `tests/Feature/Portfolio/PortfolioFilterTest.php`
  - Filtering by one or multiple tags returns matching projects.
  - Clear filters resets set.
  - Pagination resets to first page after filter change.

#### Task 4.2.2 — Live title search (**Pending**)

Automated feature tests (acceptance criteria):
- `tests/Feature/Portfolio/PortfolioSearchTest.php`
  - Case-insensitive title search works.
  - Search combines with active tags.
  - No-results message appears.

### Phase 4.3: Project modal accessibility (US-3.4)

#### Task 4.3.1 — Alpine modal with a11y requirements (**Pending**)

Automated feature tests (acceptance criteria):
- `tests/Browser/PortfolioModalAccessibilityTest.php`
  - Modal opens/closes on click, Escape, backdrop.
  - Focus trap and focus return behavior.
  - Dialog ARIA attributes exist.

---

## Phase 5: Lead Generation Flows

### Phase 5.1: Services page and request form (US-6.1, US-6.2, US-6.3)

#### Task 5.1.1 — Services content section with semantic cards (**Pending**)

Automated feature tests (acceptance criteria):
- `tests/Feature/Pages/ServicesPageTest.php`
  - All three service offerings render with expected structure.

#### Task 5.1.2 — Livewire service request form with validation (**Pending**)

Automated feature tests (acceptance criteria):
- `tests/Feature/Forms/ServiceRequestFormTest.php`
  - Valid submission persists record with IP.
  - Invalid input shows field-level errors.
  - Success state message replaces form.

#### Task 5.1.3 — Honeypot and per-IP rate limiting for service form (**Pending**)

Automated feature tests (acceptance criteria):
- `tests/Feature/Forms/ServiceRequestSpamProtectionTest.php`
  - Honeypot-filled requests are discarded silently.
  - Fourth request in one hour is blocked with friendly message.

### Phase 5.2: Contact page and form (US-7.1)

#### Task 5.2.1 — Contact form + character counter + validation (**Pending**)

Automated feature tests (acceptance criteria):
- `tests/Feature/Forms/ContactFormTest.php`
  - Valid submission persists record with IP.
  - Min/max validation works (name/message/email).
  - Thank-you state renders after success.

#### Task 5.2.2 — Honeypot and per-IP rate limiting for contact form (**Pending**)

Automated feature tests (acceptance criteria):
- `tests/Feature/Forms/ContactSpamProtectionTest.php`
  - Honeypot-filled requests are discarded.
  - Rate limit response and message are correct.

### Phase 5.3: Queued owner notifications (US-8.4)

#### Task 5.3.1 — Queue and send `NewServiceRequest` + `NewContactRequest` mailables (**Pending**)

Automated feature tests (acceptance criteria):
- `tests/Feature/Mail/NewLeadNotificationsTest.php`
  - Valid service request queues `NewServiceRequest`.
  - Valid contact request queues `NewContactRequest`.
  - Subjects include visitor name and type.

---

## Phase 6: Filament Admin Panel

### Phase 6.1: Projects resource (US-8.1)

#### Task 6.1.1 — Build Filament `ProjectResource` with separate schema/table classes (**Pending**)
- Use Filament v5 structure:
  - `Schemas/ProjectForm.php`
  - `Tables/ProjectsTable.php`
- Include media upload, tags input, featured toggle, sortable table.
- Generate Filament smoke tests.

Automated feature tests (acceptance criteria):
- `tests/Feature/Filament/ProjectResourceTest.php`
  - Resource list page loads for admin.
  - Admin can create/edit/delete project.
  - Reordering updates `sort_order`.
  - `featured` toggle persists.

### Phase 6.2: Service requests resource (US-8.2)

#### Task 6.2.1 — Build read-focused `ServiceRequestResource` with status updates (**Pending**)
- Disable create action.
- Keep delete for spam cleanup.

Automated feature tests (acceptance criteria):
- `tests/Feature/Filament/ServiceRequestResourceTest.php`
  - List page loads and sorts newest first.
  - Create action unavailable.
  - Admin can update status and delete record.

### Phase 6.3: Contact requests resource (US-8.3)

#### Task 6.3.1 — Build read-focused `ContactRequestResource` with status updates (**Pending**)
- Disable create action.
- Keep delete action.

Automated feature tests (acceptance criteria):
- `tests/Feature/Filament/ContactRequestResourceTest.php`
  - List page loads and sorts newest first.
  - Create action unavailable.
  - Admin can mark status and delete.

### Phase 6.4: Filament maintenance checks

#### Task 6.4.1 — Run Filament deprecation fixer after Filament code edits (**Pending, recurring**)
- Required because `laraveldaily/filacheck` is installed.

Automated feature tests (acceptance criteria):
- CI task passes after running `vendor/bin/filacheck --fix`.
- Filament resource tests pass.

---

## Phase 7: SEO, Metadata, and Discoverability

### Phase 7.1: Page-level metadata (US-1.4)

#### Task 7.1.1 — Unique title/description/OG per public page (**Pending**)

Automated feature tests (acceptance criteria):
- `tests/Feature/Seo/PublicPageMetaTest.php`
  - Each page includes unique `<title>`.
  - Each page includes meta description.
  - OG tags exist (`og:title`, `og:description`, `og:type`, `og:url`).

### Phase 7.2: Sitemap generation

#### Task 7.2.1 — Generate and expose `/sitemap.xml` (**Pending**)

Automated feature tests (acceptance criteria):
- `tests/Feature/Seo/SitemapTest.php`
  - `/sitemap.xml` responds successfully.
  - Includes core public URLs.

### Phase 7.3: OG image generation (optional enhancement)

#### Task 7.3.1 — Dynamic OG images for project/share links (**Pending, optional**)

Automated feature tests (acceptance criteria):
- `tests/Feature/Seo/OgImageGenerationTest.php`
  - OG image endpoint returns expected image response.

---

## Phase 8: Final QA, Performance, and Release Readiness

### Phase 8.1: End-to-end smoke and browser quality

#### Task 8.1.1 — Full public smoke suite (**Pending**)

Automated feature tests (acceptance criteria):
- `tests/Browser/PublicPagesSmokeTest.php`
  - Visit all public pages.
  - Assert no JavaScript console errors.

### Phase 8.2: Data and backup readiness

#### Task 8.2.1 — Configure and verify scheduled backups (**Pending**)

Automated feature tests (acceptance criteria):
- `tests/Feature/Operations/BackupCommandTest.php`
  - Backup command is invokable in test environment (faked disks/notifications).

### Phase 8.3: Pre-launch test gates

#### Task 8.3.1 — Required pre-merge checks (**Pending, recurring**)
- Run:
  - `vendor/bin/pint --dirty --format agent`
  - `vendor/bin/filacheck --fix` (if `app/Filament` changed)
  - `php artisan test --compact`

Automated feature tests (acceptance criteria):
- All Phase test files green in CI.
- No failing feature tests for US-1.1 through US-8.4.

---

## Suggested implementation order

1. Finish all **Phase 1** tasks first.
2. Then complete **Phase 6.1** (Project admin) before **Phase 4** (public portfolio), so content is manageable from admin early.
3. Implement **Phase 5** forms + mail before visual polish.
4. Complete **Phase 7** and **Phase 8** last as release gates.
