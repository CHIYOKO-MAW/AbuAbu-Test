# Abu-Abu Frontend Notes

## Direction

Abu-Abu is a production-minded frontend shell with separate mini-sites that should feel related by craft, not by identical layouts.

- Home: surreal archive, quiet, dark, suggestive.
- Audio: storefront, compact catalog, release-first browsing.
- Reading: bright editorial library, calm metadata, clear discovery.
- Tools: workshop console, dense technical index, recovery/help rail.
- Request: control desk, queue language, process-first layout.

Public copy should feel natural and atmospheric. Avoid self-aware slogans, design-process labels, or defensive explanations in the main UI.

## Routes

- `/`
- `/browse/audio`
- `/browse/audio/{artist}/{album}`
- `/browse/reading`
- `/browse/reading/{type}/{slug}`
- `/browse/tools`
- `/browse/tools/{slug}`
- `/browse/tools/help/{slug}`
- `/request`

## View Structure

- `resources/views/home/*` for homepage surfaces.
- `resources/views/audio/*` for the audio mini-site.
- `resources/views/reading/*` for the reading mini-site.
- `resources/views/tools/*` for the tools mini-site.
- `resources/views/request/*` for the request surface.
- `resources/views/components/{domain}/*` for domain-specific components.

Keep presentational mapping out of large Blade files when it starts to behave like page state. Prefer config or small support classes such as `App\Support\HomeStore`.

## Component Baseline

Core UI should consistently provide:

- readable spacing and hierarchy;
- visible hover states;
- keyboard focus via `aa-focus`;
- clear disabled or unavailable states;
- empty states for search/filter results;
- download state language that distinguishes preview/info from full archive download.

## Data Contracts Before Backend

Dummy config data should stay close to future backend shape:

- stable slugs;
- title/name;
- category/type;
- metadata fields shown in the UI;
- download config with `enabled`, `disk`, `path`, `filename`, and `label`;
- related item hints when the page has a detail view.

Backend work should follow these contracts instead of forcing the frontend to redesign its information architecture later.
