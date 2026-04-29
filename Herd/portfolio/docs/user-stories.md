# User stories — personal portfolio website

## Overview

This document contains user stories for a personal portfolio and freelance lead-generation website built with Laravel, Livewire, Alpine.js, Tailwind CSS, and Filament PHP.

**User types:**
- **Visitor** — any unauthenticated person browsing the site (potential client, recruiter, or developer)
- **Owner / Admin** — the site owner, operating exclusively through the Filament admin panel

---

## 1. Navigation & general experience

### US-1.1: SPA-style navigation
**As a** Visitor
**I want to** navigate between pages without full page reloads
**So that** the site feels fast and modern

**Acceptance criteria:**
- [ ] Livewire handles page transitions without full reloads
- [ ] Active nav link is visually highlighted based on current page
- [ ] Browser back/forward buttons work correctly
- [ ] Page title updates in the browser tab on each navigation
- [ ] Scroll position resets to top on page change

**Expected result:** Visitor experiences smooth, app-like navigation across all pages.

---

### US-1.2: Responsive layout
**As a** Visitor on any device
**I want to** use the site comfortably on mobile, tablet, and desktop
**So that** I can browse from any device without layout issues

**Acceptance criteria:**
- [ ] Layout is mobile-first, single column on small screens
- [ ] Two-column layout activates at `md` breakpoint
- [ ] Three-column grid activates at `lg` breakpoint (portfolio cards)
- [ ] Navigation collapses to a hamburger menu on mobile
- [ ] All tap targets are at least 44×44px on mobile
- [ ] No horizontal scrolling on any screen size

**Expected result:** Site is fully usable on all common screen sizes.

---

### US-1.3: Dark mode toggle
**As a** Visitor
**I want to** switch between light and dark mode
**So that** I can read comfortably in my preferred environment

**Acceptance criteria:**
- [ ] Toggle button visible in the nav bar
- [ ] Preference persisted in `localStorage`
- [ ] On first visit, respects system `prefers-color-scheme`
- [ ] Transition between modes is instant, no flash
- [ ] All pages and components render correctly in both modes

**Expected result:** Visitor's mode preference is applied immediately and remembered across visits.

---

### US-1.4: SEO meta tags per page
**As a** Visitor arriving from a search engine or shared link
**I want to** see accurate page titles and descriptions
**So that** I know what the page is about before clicking

**Acceptance criteria:**
- [ ] Each page has a unique `<title>` tag
- [ ] Each page has a unique `<meta name="description">`
- [ ] Open Graph tags present: `og:title`, `og:description`, `og:type`, `og:url`
- [ ] `sitemap.xml` is generated and accessible at `/sitemap.xml`
- [ ] All pages use semantic HTML: `<header>`, `<main>`, `<section>`, `<article>`, `<footer>`
- [ ] One `<h1>` per page; card titles use `<h2>`

**Expected result:** Pages rank and preview correctly in search engines and when shared on social media.

---

## 2. Home page

### US-2.1: View hero section
**As a** Visitor
**I want to** immediately understand who this developer is and what they offer
**So that** I can decide in seconds whether to explore further

**Acceptance criteria:**
- [ ] Hero displays: name, one-line role description, 2–3 sentence positioning statement
- [ ] Two CTA buttons visible: "View my work" (links to Portfolio) and "Request a website" (links to Services)
- [ ] Hero is the first visible section with no scrolling required
- [ ] Copy is specific — no generic phrases like "passionate developer"

**Expected result:** Visitor understands the developer's identity and has a clear next action within 10 seconds.

---

### US-2.2: View tech stack strip
**As a** Visitor (especially a recruiter or technical client)
**I want to** quickly scan the technologies the developer works with
**So that** I can assess fit before reading further

**Acceptance criteria:**
- [ ] Tech pills displayed in a single horizontal row: PHP, Laravel, Livewire, Alpine.js, Tailwind CSS, Filament PHP
- [ ] Pills are read-only display elements, not interactive filters
- [ ] Section appears immediately below the hero
- [ ] Renders cleanly on mobile (wraps to two rows if needed)

**Expected result:** Visitor identifies the tech stack at a glance within the first scroll.

---

### US-2.3: View featured projects
**As a** Visitor
**I want to** see a selection of the developer's best work on the home page
**So that** I can quickly evaluate quality without going to the full portfolio

**Acceptance criteria:**
- [ ] Shows 2–3 projects flagged as `featured` in the database
- [ ] Each project card shows: title, one-line summary, tech tags, and a link
- [ ] "See full portfolio" link leads to the Portfolio page
- [ ] If no projects are featured, section is hidden (not broken)

**Expected result:** Visitor gets a meaningful preview of the developer's work from the home page.

---

### US-2.4: View services snapshot
**As a** Visitor
**I want to** understand what services are offered before visiting the Services page
**So that** I can quickly tell whether this developer can help me

**Acceptance criteria:**
- [ ] Three service categories displayed: Website design & development, Custom web applications, Maintenance & support
- [ ] Each category has a title and one-sentence description
- [ ] "Learn more" link on each card leads to the Services page
- [ ] Layout is a 1→2→3 column responsive grid

**Expected result:** Visitor understands the range of services offered without leaving the home page.

---

### US-2.5: View bottom CTA strip
**As a** Visitor who has scrolled to the end of the home page
**I want to** see a final call to action before the footer
**So that** I have one last prompt to get in touch if I'm ready

**Acceptance criteria:**
- [ ] Strip shows headline "Have a project in mind?" and sub-text
- [ ] "Get in touch" button links to the Contact page
- [ ] Visible on all screen sizes above the footer

**Expected result:** Visitor who reaches the bottom of the page has a clear path to contact.

---

## 3. Portfolio page

### US-3.1: Browse all projects
**As a** Visitor
**I want to** view all the developer's projects in a grid
**So that** I can get a full picture of their experience and range

**Acceptance criteria:**
- [ ] All projects displayed in a responsive grid: 1 col mobile, 2 col tablet, 3 col desktop
- [ ] Each card shows: thumbnail (or placeholder), title, one-line summary, tech tags
- [ ] Cards sorted by `sort_order` ascending
- [ ] Pagination: 9 projects per page with Livewire pagination links
- [ ] Page renders correctly with 0 projects (empty state message shown)

**Expected result:** Visitor sees the complete portfolio in a clean, browsable grid.

---

### US-3.2: Filter projects by technology
**As a** Visitor
**I want to** filter projects by technology tag
**So that** I can find work relevant to my specific needs

**Acceptance criteria:**
- [ ] All unique tech tags from the database rendered as pill buttons above the grid
- [ ] Clicking a tag filters the grid to matching projects (Livewire, no page reload)
- [ ] Multiple tags can be active simultaneously — results show projects matching any selected tag
- [ ] Active tag pills are visually distinct from inactive ones
- [ ] "Clear filters" link appears when at least one tag is active
- [ ] Pagination resets to page 1 when filters change

**Expected result:** Visitor sees only projects that use their technology of interest.

---

### US-3.3: Search projects by keyword
**As a** Visitor
**I want to** search projects by name
**So that** I can find a specific project I've heard about

**Acceptance criteria:**
- [ ] Search input visible in the filter bar
- [ ] Uses `wire:model.live` — results update as visitor types
- [ ] Searches against project `title` field (case-insensitive)
- [ ] Can be combined with active tag filters
- [ ] Shows "No projects found" message when no results match

**Expected result:** Visitor can locate a specific project by typing its name.

---

### US-3.4: View project detail in modal
**As a** Visitor
**I want to** view full project details without leaving the portfolio page
**So that** I can learn more about a project while keeping my place in the grid

**Acceptance criteria:**
- [ ] Clicking a project card opens an Alpine.js modal
- [ ] Modal displays: full title, full description, large thumbnail, tech tags, live URL link (if set), repo link (if set)
- [ ] Modal closes on backdrop click and Escape key
- [ ] Focus is trapped inside the open modal
- [ ] Focus returns to the triggering card on close
- [ ] Modal has `role="dialog"`, `aria-modal="true"`, and `aria-labelledby` pointing to the project title

**Expected result:** Visitor reads full project details in context without navigating away.

---

## 4. About page

### US-4.1: Read developer bio
**As a** Visitor
**I want to** learn about the developer's background and personality
**So that** I can decide whether I want to work with them

**Acceptance criteria:**
- [ ] Bio section with 2–4 paragraphs of personal and professional background
- [ ] Headshot or avatar displayed alongside the bio
- [ ] Copy is written in first person and feels human, not corporate

**Expected result:** Visitor gains a personal sense of who the developer is beyond their tech skills.

---

### US-4.2: View skills and experience
**As a** Visitor (especially a recruiter)
**I want to** see a structured overview of the developer's skills and experience
**So that** I can quickly assess suitability without reading a wall of text

**Acceptance criteria:**
- [ ] Skills listed with visual grouping (e.g., Backend, Frontend, Tools)
- [ ] Experience timeline or list showing past roles/projects with dates
- [ ] Each entry shows: role/title, context (company or project type), date range, one-line description
- [ ] Section uses semantic `<section aria-labelledby>` and `<h2>` headings

**Expected result:** Recruiter or client can scan technical depth and experience at a glance.

---

## 5. Resume page

### US-5.1: View resume inline
**As a** Visitor
**I want to** read the developer's resume directly in the browser
**So that** I can review it without downloading a file

**Acceptance criteria:**
- [ ] PDF rendered inline using the browser-native PDF viewer via `<iframe>` or `<embed>`
- [ ] PDF is publicly accessible — no login required
- [ ] Viewer fills the page width responsively
- [ ] Page has a clear `<h1>Resume</h1>` heading above the viewer
- [ ] If PDF fails to load, a fallback message with download link is shown

**Expected result:** Visitor reads the resume without leaving the site or downloading anything.

---

### US-5.2: Download resume as PDF
**As a** Visitor
**I want to** download the resume as a PDF file
**So that** I can save it, print it, or share it with a colleague

**Acceptance criteria:**
- [ ] "Download CV" button is prominently placed above the PDF viewer
- [ ] Button triggers `GET /resume/download` route
- [ ] Response sets `Content-Disposition: attachment` so the browser downloads rather than opens
- [ ] Downloaded filename is human-readable: e.g. `firstname-lastname-cv.pdf`
- [ ] File is served from Laravel storage — not a public directory direct link

**Expected result:** Visitor downloads a clean, correctly named PDF file in one click.

---

## 6. Services page

### US-6.1: View service offerings
**As a** Visitor
**I want to** understand exactly what services the developer offers and at what scope
**So that** I can determine whether to submit a project request

**Acceptance criteria:**
- [ ] Three service cards displayed: Website design & development, Custom web applications, Maintenance & support
- [ ] Each card includes: title, detailed description (3–5 sentences), what's included list
- [ ] Optional: indicative pricing or "starting from" range per service
- [ ] CTA below each card links down to the request form
- [ ] Section uses semantic `<article>` per service card

**Expected result:** Visitor fully understands the scope and value of each service before submitting a request.

---

### US-6.2: Submit a website design request
**As a** Visitor with a project in mind
**I want to** submit a detailed project request
**So that** the developer has enough information to respond with a quote

**Acceptance criteria:**
- [ ] Request form collects: name, email, company (optional), project type (select), budget range (select), project description (textarea)
- [ ] All required fields validated server-side via Livewire form object with `#[Validate]`
- [ ] Honeypot hidden field `name="website"` — if filled, submission is silently discarded
- [ ] Rate limited: max 3 submissions per hour per IP address
- [ ] On valid submission:
  - Record saved to `service_requests` table with IP address and timestamp
  - Queued email notification sent to owner with all field values
  - Form replaced with a thank-you message: "Thanks — I'll be in touch within 2 business days."
- [ ] Form resets if visitor navigates away and returns (no partial state persisted)
- [ ] Inline validation errors appear per field without full page reload

**Expected result:** Visitor submits a project request; owner receives an email and sees the record in Filament.

---

### US-6.3: Prevent spam submissions
**As the** Owner
**I want to** receive only genuine project requests
**So that** I don't waste time filtering spam

**Acceptance criteria:**
- [ ] Honeypot field renders in DOM but is hidden via CSS — bots fill it, humans don't
- [ ] Any submission with the honeypot field filled is discarded silently (no error shown to bot)
- [ ] Rate limiter blocks the same IP after 3 submissions per hour
- [ ] Rate limit exceeded returns a friendly message: "Too many requests. Please try again later."

**Expected result:** Spam and bot submissions do not reach the owner's inbox or database.

---

## 7. Contact page

### US-7.1: Submit a contact message
**As a** Visitor
**I want to** send a short message to the developer
**So that** I can ask a question or introduce myself without filling in a full project brief

**Acceptance criteria:**
- [ ] Contact form collects: name (required), email (required), message (required, max 2000 characters)
- [ ] All fields validated server-side — name min 2 chars, email valid format, message min 10 chars
- [ ] Honeypot and rate limiting identical to service request form (US-6.3)
- [ ] On valid submission:
  - Record saved to `contact_requests` table with IP address and timestamp
  - Queued email notification sent to owner
  - Form replaced with thank-you message
- [ ] Character counter shown below message textarea
- [ ] Inline validation errors per field, no page reload

**Expected result:** Visitor sends a message; owner receives an email and sees it in Filament.

---

## 8. Admin panel (Filament)

### US-8.1: Manage projects
**As the** Owner
**I want to** create, edit, delete, and reorder portfolio projects via the admin panel
**So that** the portfolio stays current without touching code

**Acceptance criteria:**
- [ ] Filament resource with fields: title, slug (auto-generated), summary, description (rich text), thumbnail (file upload), tech_stack (tags input), URL, repo URL, featured (toggle), sort_order
- [ ] Table view shows: thumbnail, title, featured badge, tech tags, sort order
- [ ] Drag-and-drop reorder via `sort_order` column in Filament table
- [ ] `featured` toggle controls visibility on home page featured section
- [ ] Deleting a project removes it from all public views immediately
- [ ] Thumbnail stored in `storage/app/public/thumbnails` — publicly accessible via `storage:link`

**Expected result:** Owner can fully manage the portfolio from the admin panel with no code changes.

---

### US-8.2: View and manage service requests
**As the** Owner
**I want to** view all submitted service requests and mark them as handled
**So that** I can track my leads and follow-up status

**Acceptance criteria:**
- [ ] Filament resource table shows: name, email, project type, budget, submitted date, status
- [ ] Status options: `new`, `in review`, `replied`, `closed`
- [ ] Owner can change status via a select field in the edit view
- [ ] Full request details readable in edit/view panel: all form fields + IP + timestamp
- [ ] Table sortable by submitted date (newest first by default)
- [ ] Create action disabled — records only come from the public form
- [ ] Delete action available for spam/junk entries

**Expected result:** Owner has a clear CRM-like view of all incoming service requests and their follow-up status.

---

### US-8.3: View and manage contact requests
**As the** Owner
**I want to** view all contact messages in the admin panel
**So that** I have a record of every enquiry even after replying by email

**Acceptance criteria:**
- [ ] Filament resource table shows: name, email, message preview, submitted date, status
- [ ] Status options: `new`, `read`, `replied`
- [ ] Full message readable in view panel
- [ ] Table sorted by submitted date (newest first by default)
- [ ] Create action disabled — records only come from the public form
- [ ] Delete action available

**Expected result:** Owner can review all contact messages and track which ones have been actioned.

---

### US-8.4: Receive email notification on new submission
**As the** Owner
**I want to** receive an email immediately when a visitor submits a request or contact message
**So that** I can respond promptly without checking the admin panel constantly

**Acceptance criteria:**
- [ ] `NewServiceRequest` mailable queued on every valid service request submission
- [ ] `NewContactRequest` mailable queued on every valid contact form submission
- [ ] Email to owner includes all submitted field values
- [ ] Email subject clearly identifies submission type: "New service request from [Name]" / "New contact message from [Name]"
- [ ] Emails sent via configured SMTP — `MAIL_MAILER=smtp` in production
- [ ] Emails use `ShouldQueue` — never sent synchronously during a web request

**Expected result:** Owner is notified within seconds of a new submission without needing to log into the admin panel.

---

## Appendix: user story status

| ID | Story | Priority | Status |
|---|---|---|---|
| US-1.1 | SPA-style navigation | High | Pending |
| US-1.2 | Responsive layout | High | Pending |
| US-1.3 | Dark mode toggle | Medium | Pending |
| US-1.4 | SEO meta tags per page | High | Pending |
| US-2.1 | View hero section | High | Pending |
| US-2.2 | View tech stack strip | Medium | Pending |
| US-2.3 | View featured projects | High | Pending |
| US-2.4 | View services snapshot | Medium | Pending |
| US-2.5 | View bottom CTA strip | Low | Pending |
| US-3.1 | Browse all projects | High | Pending |
| US-3.2 | Filter projects by technology | High | Pending |
| US-3.3 | Search projects by keyword | Medium | Pending |
| US-3.4 | View project detail in modal | Medium | Pending |
| US-4.1 | Read developer bio | Medium | Pending |
| US-4.2 | View skills and experience | Medium | Pending |
| US-5.1 | View resume inline | High | Pending |
| US-5.2 | Download resume as PDF | High | Pending |
| US-6.1 | View service offerings | High | Pending |
| US-6.2 | Submit a website design request | High | Pending |
| US-6.3 | Prevent spam submissions | High | Pending |
| US-7.1 | Submit a contact message | High | Pending |
| US-8.1 | Manage projects | High | Pending |
| US-8.2 | View and manage service requests | High | Pending |
| US-8.3 | View and manage contact requests | Medium | Pending |
| US-8.4 | Email notification on new submission | High | Pending |
