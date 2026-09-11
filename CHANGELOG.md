# Changelog

All notable changes to `jeremykenedy/laravel-ui-kit` are documented here.

## Unreleased

No breaking changes. Every component class, method, prop default, Blade tag and Artisan command
that existed before still exists and behaves the same way.

### Fixed

- The 24 Livewire wrappers never rendered. `view('ui-kit::livewire.button')` resolved against
  `resources/views/{css_framework}` instead of the package root, so the view was never found.
  The `ui-kit` namespace now covers both paths.
- Livewire components were registered during `boot()`, which could run before Livewire's own
  service provider. Registration is deferred until the application has booted.
- Icons rendered as empty boxes under Bootstrap 4 and Bootstrap 5. Those templates referenced an
  SVG sprite (`<use href="#icon-...">`) that the package does not ship. All three frameworks now
  render the same inline geometry.
- `<x-ui::theme-toggle>` called `route('profile.dark-mode')`, which threw a
  `RouteNotFoundException` for signed in users in any application without that route. The
  persistence endpoint is now configuration driven and is skipped when it does not resolve.
- The 42 shipped translation files were never loaded. Package translations are now registered
  under the `ui-kit` namespace and used by the components.
- `UI_KIT_PREFIX` had no effect because the Blade component namespace was hardcoded to `ui`.
  A custom prefix is now registered alongside `ui`.
- An unknown `ui-kit.css_framework` value caused a view resolution failure. It now falls back to
  Tailwind.
- A `multiple` select submitted only its last value because the name lacked `[]`.
- `stat-card` and `status-panel` applied Tailwind colour classes inside the Bootstrap templates,
  where they do nothing. Both now use the Bootstrap colour utilities.
- The Bootstrap 5 password strength meter had no scoring function, so the meter never moved.
- Bootstrap 5 inputs were missing `aria-invalid` when in an error state.
- `UiModal.vue` referenced an undefined `props` variable when computing its size class.
- `UiDropdown.vue` and `UiThemeToggle.vue` used Alpine's `@click.away`, which Vue does not
  understand, so the menus never closed on an outside click. Svelte's dropdown had the same gap.
- `UiThemeToggle.vue` rendered its icons through `<component :is="'SunIcon'">` against components
  that were never registered.
- Tailwind v4 removed `flex-shrink-*` and the `*-opacity-*` utilities. Templates and frontend
  components that still used them have been updated.

### Added

- PHP 8.4 and 8.5 support. The previous `^8.2|^8.3` constraint blocked installation on PHP 8.4
  even though CI tested it.
- CI now covers PHP 8.2 through 8.5 against Laravel 12 and 13, plus a lowest-dependency run, a
  composer validate and audit job, and template and frontend parity checks. Laravel 10 and 11
  stay in the constraint for existing applications but cannot be covered by CI: Composer blocks
  every release of both by default because of published security advisories.
- `ui-kit-lang` and `ui-kit-js` publish tags, plus a `ui-kit` tag that publishes everything.
- 27 additional icons, including the chevrons the dropdown and button components already
  referenced, plus `sun`, `moon` and `monitor` for the theme toggle.
- Breadcrumbs take a `home-url`, `home-label` and `show-home` attribute, and read
  `ui-kit.breadcrumbs.home_url` instead of hardcoding `/home`.
- The theme toggle takes `default`, `endpoint`, `align` and `id` attributes.
- Buttons take a `confirm-target` attribute for the dialog they open.
- Components implement the `ComponentContract` interface that the package already shipped.
- A test suite covering component rendering in all three CSS frameworks, all 15 install, update
  and switch combinations, every Livewire component and interaction, translation completeness
  across all 42 locales, frontend asset parity, accessibility attributes, Blade compilation of
  every shipped template, and the public API surface.

### Changed

- Focus rings use `focus-visible` rather than `focus`, so they appear for keyboard users without
  showing on mouse clicks.
- Transitions are suppressed under `prefers-reduced-motion`.
- Components carry the ARIA wiring described in the readme: `aria-invalid`, `aria-describedby`,
  `aria-expanded`, `aria-haspopup`, `aria-modal`, `aria-current`, `aria-sort`, `role="switch"`,
  and `aria-hidden` on decorative icons.
- Modal and confirm own their transition on the root element instead of on each child.
- The modal locks body scroll while open and moves focus to the dialog.
- Livewire wrappers delegate to the matching Blade component, so they follow the active CSS
  framework instead of always rendering Tailwind markup.
- Livewire wrappers accept their content through a `content` property, since Livewire has no
  slots. The previous templates referenced an undefined `$slot`.
- User facing strings come from the translation files rather than being hardcoded in English.
- `Avatar::computedInitials()` uses multibyte string functions.

### Removed

- Dead null coalescing in `DataTable` and `PasswordInput` constructors that could never run
  because the promoted properties are non-nullable booleans.
