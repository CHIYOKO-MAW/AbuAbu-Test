# Abu-Abu Agent Handoff

This document is the handoff context for another coding agent working on Abu-Abu. It explains the current product direction, frontend state, backend roadmap, and the safest implementation order to turn the project into a fullstack Laravel web app that is ready to be hosted later.

## 1. Project Identity

Abu-Abu is an archive/catalog web app with a mysterious, quiet, curated, slightly absurd atmosphere. It should feel like entering an archive that does not explain everything at once, while still keeping navigation clear and comfortable for users.

Important tone rules:

- Public copy should feel natural, short, atmospheric, and not defensive.
- Do not use self-aware UI copy such as "this site is absurd" or "theme-first".
- Do not surface explicit defensive labels like "legal/authorized" in public UI copy.
- Keep paths and categories clear even when the mood is strange or dark.
- The web should feel unusual, but not confusing.

## 2. Theme Direction

Each mini-site must feel like a different destination. Do not collapse the pages into one generic layout. The unique themes are part of Abu-Abu's identity.

### Home: Surreal Archive

- Main entry point.
- Dark, mysterious, poetic, and calmer than a startup dashboard.
- Shows the four main paths: Reading, Audio, Tools, Request.
- Should feel like a door into the archive, not a product explainer.

### Audio: Audio Storefront

- Dedicated music mini-site.
- Dark storefront, cover-first, compact, release-focused.
- Supports album grid, featured/recommended rows, album detail, tracklist, and album download.
- Should feel different from Home, closer to a structured music catalog.

### Reading: Editorial Library

- Bright, warm-neutral, calm, and easy to read.
- Focuses on ebooks, journals, authors, topics, metadata, preview, and download state.
- Must not imitate Audio. It should feel like a reading room or editorial archive.

### Tools: Workshop Console

- Industrial, technical, modular, dense.
- Focuses on utilities, game archive, package metadata, recovery notes, and help articles.
- Should feel like a technical workbench, not a storefront or library.

### Request: Control Desk

- Intake/queue-oriented page.
- Focuses on process, queue state, form fields, and request handoff.
- Should feel like an internal system that is alive but controlled.

## 3. Current Stack

- Laravel 12
- Blade
- Tailwind CSS 4
- Vite
- PHP 8.2+
- Current data source: config files and support classes
- Current backend database state: only Laravel default user/cache/jobs migrations

Current important directories:

- `resources/views/home`
- `resources/views/audio`
- `resources/views/reading`
- `resources/views/tools`
- `resources/views/request`
- `resources/views/layouts`
- `resources/views/components`
- `app/Support`
- `app/Http/Controllers`
- `config`
- `docs`

## 4. Current Public Routes

Keep these routes stable during backend migration:

- `/`
- `/browse`
- `/browse/audio`
- `/browse/audio/{artist}/{album}`
- `/browse/audio/{artist}/{album}/download`
- `/browse/reading`
- `/browse/reading/{type}/{slug}`
- `/browse/reading/{type}/{slug}/download`
- `/browse/tools`
- `/browse/tools/{slug}`
- `/browse/tools/{slug}/download`
- `/browse/tools/help/{slug}`
- `/request`

Do not rename route names or change URL shapes during Phase 1 unless there is a clear bug.

## 5. Important Existing Classes

- `App\Support\AbuAbu`
  - Language and text helper.
- `App\Support\HomeStore`
  - Homepage view-model helper.
- `App\Support\AudioStore`
  - Current audio catalog source and filtering logic.
- `App\Support\ReadingStore`
  - Current reading catalog source and filtering logic.
- `App\Support\ToolsStore`
  - Current tools catalog source and filtering logic.
- `AudioStoreController`
- `ReadingStoreController`
- `ToolsStoreController`

The Store classes currently make config data look like backend data. During backend migration, keep their public output shape stable so Blade views do not need a major rewrite.

## 6. Current Data Source

Current catalog data still lives mostly in:

- `config/abuabu.php`
- `config/reading.php`
- `config/tools.php`
- `config/request.php`

Long-term split:

- Config should keep brand, language, static copy, navigation, and UI settings.
- Database should own catalog data, detail data, download metadata, request entries, and admin-managed content.

## 7. Backend Phase 1: Audio Catalog Database

Start backend work with Audio. Audio is the most mature flow and should become the pattern for Reading and Tools later.

### Goals

- Move Audio catalog data from config to database.
- Keep existing Audio UI and routes working.
- Keep filter/search/detail/download behavior intact.
- Seed the current dummy data into database.

### Tables

Create migrations for:

- `artists`
- `albums`
- `tracks`
- `album_formats`
- `album_downloads`

Optional later:

- `genres`

### Suggested fields

`artists`

- `id`
- `name`
- `slug`
- timestamps

`albums`

- `id`
- `artist_id`
- `title`
- `slug`
- `type`
- `genre`
- `release_date`
- `originated`
- `label`
- `duration`
- `cover_image`
- `cover_alt`
- `cover_palette`
- `cover_accent`
- `featured`
- `recommended`
- `editor_notes`
- `spec_audio`
- `spec_note`
- `bit_depth`
- `sample_rate`
- timestamps

`tracks`

- `id`
- `album_id`
- `disc_number`
- `track_number`
- `display_number`
- `title`
- `artist_name`
- `duration`
- `sort_order`
- timestamps

`album_formats`

- `id`
- `album_id`
- `format`
- timestamps

`album_downloads`

- `id`
- `album_id`
- `enabled`
- `disk`
- `path`
- `filename`
- `label`
- `size`
- timestamps

### Models and relations

- `Artist hasMany Album`
- `Album belongsTo Artist`
- `Album hasMany Track`
- `Album hasMany AlbumFormat`
- `Album hasOne AlbumDownload`

### Seeder

Move current dummy albums into seeders:

- Ado
- Sakurazaka46
- Nogizaka46

Keep their current slugs stable:

- `ado`
- `sakurazaka46`
- `nogizaka46`

Keep album slugs stable so existing links do not break.

### Refactor rule

Refactor `AudioStore` to query database but return arrays compatible with current Blade usage:

- `artist`
- `artist_slug`
- `title`
- `slug`
- `type`
- `genre`
- `formats`
- `cover`
- `download`
- `specs`
- `tracks`
- `editor_notes`

This lets the backend change without forcing a visual rewrite.

## 8. Backend Phase 2: Reading Catalog Database

Start only after Audio database behavior is stable.

### Tables

- `reading_items`
- `reading_downloads`
- optional `reading_topics`

### Required behavior

- Keep `/browse/reading`.
- Keep `/browse/reading/{type}/{slug}`.
- Keep `/browse/reading/{type}/{slug}/download`.
- Keep search by title, author, topic, and summary.
- Keep filters by type and topic.
- Keep latest/updated/title sort.
- Keep preview placeholder until real PDF reader exists.

## 9. Backend Phase 3: Tools Catalog Database

Start after Audio and Reading are stable.

### Tables

- `tools`
- `tool_downloads`
- `tool_help_articles`
- optional `tool_tags`

### Required behavior

- Keep `/browse/tools`.
- Keep `/browse/tools/{slug}`.
- Keep `/browse/tools/{slug}/download`.
- Keep `/browse/tools/help/{slug}`.
- Preserve the workshop console theme.
- Keep package metadata dense and readable.
- Keep help articles separate from package detail pages.

## 10. Backend Phase 4: Request Intake

Turn `/request` from a static shell into a real database-backed intake form.

### Tables

- `requests`
- optional `request_notes`

### Fields

- `title`
- `category`
- `source_context`
- `priority`
- `notes`
- `status`

### Statuses

- `pending`
- `reviewing`
- `ready`
- `archived`

Do not build a complex admin workflow yet. First goal is simply that requests can be submitted, stored, validated, and tested.

## 11. Backend Phase 5: Admin Foundation

Only start after catalog database and request intake are stable.

### Goals

- Add simple admin auth.
- Add internal Blade dashboard.
- Add CRUD for:
  - artists
  - albums
  - tracks
  - reading items
  - tools
  - request queue
- Protect admin routes with middleware/policies.
- Add file/metadata upload only after CRUD is stable.

Do not introduce a heavy admin framework unless the project explicitly needs it later.

## 12. Fullstack Readiness Checklist

Abu-Abu can be called fullstack-ready when:

- Config only stores brand, static copy, language, navigation, and UI settings.
- Main catalog data lives in database.
- Seeders can rebuild demo data from zero.
- Fresh migration works.
- Public routes remain stable.
- Every main page has states for:
  - data available
  - empty data
  - filter/search no results
  - detail not found
  - download available
  - download unavailable
- Each mini-site keeps its unique theme.
- Feature tests cover main route behavior.
- Frontend build passes.
- There are no dead view folders or unused legacy pages.
- Public copy does not feel meta or like a design explanation.

## 13. Public Interface Rules

- Do not change public route URLs during backend Phase 1.
- Do not make Blade views depend on raw Eloquent models directly.
- Controllers or Store/Service classes should prepare stable view-model arrays.
- Do not add a public API unless a later requirement needs it.
- Do not merge mini-site layouts into one generic layout.

## 14. Architecture Defaults

Use a modular monolith:

- Controller: request handling.
- Store/Service: query, filtering, download availability, view-model shaping.
- Model: Eloquent relations.
- Seeder: demo data.
- Request classes: validation when forms arrive.
- Policy/Middleware: admin protection when admin starts.

Prefer simple Laravel patterns first. Avoid overengineering before the catalog is database-backed.

## 15. Test Plan

### Audio database tests

- Audio index renders from database.
- Search filters by artist/title/genre.
- Genre/type/format filters work.
- Album detail renders from database.
- Missing album returns 404.
- Available download returns file response.
- Missing download returns 404.

### Migration and seed tests

- Fresh migration succeeds.
- Audio seeder creates artists, albums, tracks, formats, and downloads.
- Artist slug and album slug combinations are stable.

### Regression tests

- Home still renders.
- Reading still renders while it is config-backed.
- Tools still renders while it is config-backed.
- Request still renders while it is static/config-backed.
- Theme identity copy for each mini-site remains visible.

### Quality gate

Run before considering a phase complete:

```bash
php artisan test
npm run build
```

## 16. First Task For The Next Agent

Start with Backend Phase 1 only.

Recommended implementation order:

1. Add Audio models and migrations.
2. Add audio seeders using current config data as source material.
3. Refactor `AudioStore` to read database and return the same view-model shape.
4. Keep config fallback temporarily only if useful during migration.
5. Update tests so Audio is proven database-backed.
6. Run `php artisan test` and `npm run build`.

Do not start Reading, Tools, Request backend, admin, or upload manager until Audio is stable.
