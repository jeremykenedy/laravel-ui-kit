<p align="center">
    <picture>
        <source media="(prefers-color-scheme: dark)" srcset="art/banner-dark.svg">
        <source media="(prefers-color-scheme: light)" srcset="art/banner-light.svg">
        <img src="art/banner-light.svg" alt="Laravel UI Kit" width="800">
    </picture>
</p>

<p align="center">
Laravel UI components for Blade, Livewire, Vue, React, and Svelte.
</p>

<p align="center">
    <a href="https://github.com/jeremykenedy"><img src="https://img.shields.io/github/followers/jeremykenedy?label=Follow&amp;style=social" alt="Follow @jeremykenedy"></a>
    <a href="https://github.com/jeremykenedy/laravel-ui-kit/stargazers"><img src="https://img.shields.io/github/stars/jeremykenedy/laravel-ui-kit?style=social" alt="Star laravel-ui-kit on GitHub"></a>
    <a href="https://github.com/sponsors/jeremykenedy"><img src="https://img.shields.io/static/v1?label=Sponsor&amp;message=%E2%9D%A4&amp;logo=GitHub&amp;color=%23fe8e86" alt="Sponsor me on GitHub"></a>
    <a href="https://packagist.org/packages/jeremykenedy/laravel-ui-kit"><img src="https://poser.pugx.org/jeremykenedy/laravel-ui-kit/d/total.svg" alt="Total Downloads"></a>
    <a href="https://packagist.org/packages/jeremykenedy/laravel-ui-kit"><img src="https://poser.pugx.org/jeremykenedy/laravel-ui-kit/v/stable.svg" alt="Latest Stable Version"></a>
    <a href="https://github.com/jeremykenedy/laravel-ui-kit/actions/workflows/tests.yml"><img src="https://github.com/jeremykenedy/laravel-ui-kit/actions/workflows/tests.yml/badge.svg" alt="Tests"></a>
    <a href="https://github.styleci.io/repos/1198564615?branch=main"><img src="https://github.styleci.io/repos/1198564615/shield?branch=main" alt="StyleCI"></a>
    <a href="https://opensource.org/licenses/MIT"><img src="https://img.shields.io/badge/License-MIT-yellow.svg" alt="License: MIT"></a>
</p>

## Table of Contents

- [Framework Support](#framework-support)
- [Requirements](#requirements)
- [Installation](#installation)
- [Quick Start](#quick-start)
  - [Blade Components](#blade-components)
  - [Modals](#modals)
  - [Dropdowns](#dropdowns)
  - [Confirmations](#confirmations)
  - [Livewire Components](#livewire-components)
  - [Vue / React / Svelte](#vue--react--svelte)
- [Features](#features)
- [Screenshots](#screenshots)
- [Configuration](#configuration)
- [Changing Frameworks](#changing-frameworks)
  - [Update (Interactive)](#update-interactive)
  - [Switch (Quick)](#switch-quick)
- [Artisan Commands](#artisan-commands)
  - [Install Options](#install-options)
- [Components](#components)
- [Dark Mode](#dark-mode)
- [Icons](#icons)
- [Translations](#translations)
- [Accessibility](#accessibility)
- [Publishing Assets](#publishing-assets)
- [File Tree](#file-tree)
- [Testing](#testing)
- [Changelog](#changelog)
- [License](#license)

## Framework Support

The default remains Tailwind with Blade. Composer updates do not publish files or change your
framework selection. Bootstrap 5 and Bootstrap 4 are available through the setup commands.
The CSS setting selects Blade templates; it does not rewrite imported JavaScript components.

|  | Blade | Livewire 3/4 | Vue 3.4+ | React 18 | Svelte 4/5 |
|---|:---:|:---:|:---:|:---:|:---:|
| **Tailwind v4** | Yes | Yes | Yes | Yes | Yes |
| **Bootstrap 5** | Yes | Partial | No | No | No |
| **Bootstrap 4** | Yes | Partial | No | No | No |

Vue, React, and Svelte components ship Tailwind classes. Stateful Livewire wrappers also use
Tailwind; see [Livewire Components](#livewire-components) for the exact limits. Use Bootstrap
Blade components when you need complete Bootstrap coverage.

## Requirements

- PHP 8.2, 8.3, 8.4 or 8.5
- Laravel 12 or 13 (tested in CI). Laravel 10 and 11 remain in the constraint so existing
  applications can keep installing, but they are no longer covered by CI: Composer blocks every
  Laravel 10 and 11 release by default because of published security advisories.
- One of: Tailwind v4, Bootstrap 5, Bootstrap 4
- One of: Alpine.js (Blade), Livewire 3 or 4, Vue 3.4+, React 18, Svelte 4 or 5

Livewire is optional. The Livewire wrappers register only when Livewire is installed. Bootstrap
Blade dropdowns and modals need the matching Bootstrap JavaScript bundle. Bootstrap 4 also
needs jQuery. Other interactive Blade controls use Alpine.js.

Svelte 4 is retained for compatibility testing. New applications should use a patched Svelte 5
release; Svelte 4 has known upstream security advisories.

## Installation

```bash
composer require jeremykenedy/laravel-ui-kit
php artisan ui-kit:install
```

The install command asks which CSS and frontend framework to use, publishes the config, and
writes `UI_KIT_CSS` and `UI_KIT_FRONTEND` to your `.env`. Pass both options to skip the prompts:

```bash
php artisan ui-kit:install --css=bootstrap5 --frontend=blade
```

An existing `config/ui-kit.php` triggers reinstall detection. Use `ui-kit:update` to keep your
config and published views. `ui-kit:install --force` replaces the published config; it does not
replace views. No additional packages are installed by these commands.

Keep Alpine's hidden elements from flashing before initialization by adding `[x-cloak] { display:
none !important; }` to your application stylesheet. Tailwind v4 projects must scan this package:

```css
@import "tailwindcss";
@source "../../vendor/jeremykenedy/laravel-ui-kit";
@custom-variant dark (&:where(.dark, .dark *));
```

The source path above assumes `resources/css/app.css`. If you publish the JavaScript components,
include their destination in your Tailwind sources too.

## Quick Start

### Blade Components

```blade
<x-ui::card title="Dashboard">
    <x-ui::stat-card label="Users" value="1,234" icon="users" />
    <x-ui::button variant="primary">Save</x-ui::button>
    <x-ui::alert variant="success" dismissible>Settings saved.</x-ui::alert>
</x-ui::card>

<x-ui::input name="email" label="Email" type="email" required />
<x-ui::select name="role" label="Role" :options="$roles" />
<x-ui::toggle name="active" label="Active" />
```

### Modals

A Tailwind Blade modal listens for a window event named after its id. The element that opens it needs an Alpine
scope, which is what `x-data` provides:

```blade
<div x-data>
    <x-ui::button x-on:click="$dispatch('open-modal-edit-user')">Edit</x-ui::button>
</div>

<x-ui::modal id="edit-user" title="Edit user">
    <p>Body content.</p>

    <x-slot:footer>
        <x-ui::button variant="secondary" x-on:click="$dispatch('close-modal-edit-user')">Cancel</x-ui::button>
        <x-ui::button variant="primary">Save</x-ui::button>
    </x-slot:footer>
</x-ui::modal>
```

Bootstrap modals use their native triggers: `data-bs-toggle="modal" data-bs-target="#edit-user"`
for Bootstrap 5, or `data-toggle="modal" data-target="#edit-user"` for Bootstrap 4. Close them with
`data-bs-dismiss="modal"` or `data-dismiss="modal"`, respectively.

### Dropdowns

With no trigger supplied the component renders its own button, which is focusable and keyboard
operable out of the box:

```blade
<x-ui::dropdown label="Actions">
    <a href="/edit">Edit</a>
</x-ui::dropdown>
```

A supplied trigger is rendered as you wrote it, with no button semantics imposed on top, so
passing a button or a link does not produce nested interactive elements. Make the trigger
something focusable, since it is what keyboard users will reach:

```blade
<x-ui::dropdown>
    <x-slot:trigger>
        <x-ui::button variant="secondary">Actions</x-ui::button>
    </x-slot:trigger>

    <a href="/edit">Edit</a>
</x-ui::dropdown>
```

### Confirmations

Place one `<x-ui::confirm />` in your layout. Any button with a `confirm` attribute opens it:

```blade
<x-ui::button variant="danger" confirm="This cannot be undone." confirm-title="Delete user?" confirm-action="delete-user-form" confirm-target="confirmModal">
    Delete
</x-ui::button>

<x-ui::confirm />
```

`confirm-action` is the id of the form to submit when the dialog is accepted. When it does not
name a form, a `confirmed` event is dispatched instead. Set `confirm-target` explicitly when the
form id differs from the dialog id; older Bootstrap integrations use `confirm-action` as the
dialog target when no explicit target is supplied.

### Livewire Components

The Livewire wrappers mirror the Blade components. Livewire has no slots, so content is passed as
a property:

```blade
<livewire:ui-alert variant="success" content="Settings saved." />
<livewire:ui-data-table :headers="['name', 'email']" :rows="$users->toArray()" />
<livewire:ui-theme-toggle />
<livewire:ui-confirm />
```

Presentational wrappers (alert, badge, card, checkbox, form group, icon, input, select, stat
card, status panel, textarea) delegate to the matching Blade component, so they follow the
configured CSS framework. The wrappers that hold their own open, selected or revealed state
(confirm, data table, dropdown, modal, nav, pagination, password input, search input, tabs, theme
toggle, toggle) render Tailwind markup regardless of the configured framework, because that state
cannot be driven through the stateless Blade component. Under Bootstrap, prefer the Blade
components with Alpine for those, or publish the views and restyle them.

### Vue / React / Svelte

These components use Tailwind. The examples assume `@` resolves to `resources/js`.

```bash
php artisan vendor:publish --tag=ui-kit-js
```

Vue:

```vue
<script setup>
import UiButton from '@/ui-kit/vue/UiButton.vue'
import UiCard from '@/ui-kit/vue/UiCard.vue'
</script>

<template>
    <UiCard title="Profile">
        <UiButton variant="primary" @click="save">Save</UiButton>
    </UiCard>
</template>
```

React:

```jsx
import UiButton from '@/ui-kit/react/UiButton.jsx'
import UiCard from '@/ui-kit/react/UiCard.jsx'

export default function Profile({ save }) {
    return (
        <UiCard title="Profile">
            <UiButton variant="primary" onClick={save}>Save</UiButton>
        </UiCard>
    )
}
```

Svelte:

```svelte
<script>
  import UiButton from '@/ui-kit/svelte/UiButton.svelte'
  import UiCard from '@/ui-kit/svelte/UiCard.svelte'

  export let save
</script>

<UiCard title="Profile">
  <UiButton variant="primary" on:click={save}>Save</UiButton>
</UiCard>
```

## Features

- 25 components that render natively in Tailwind v4, Bootstrap 5 and Bootstrap 4
- Five frontends: Blade with Alpine.js, Livewire, Vue 3.4+, React 18 and Svelte 4/5
- Blade CSS framework selection through config or Artisan commands
- Class based dark mode with a theme toggle that persists the choice
- 46 inline icons that render identically in every CSS framework
- Translations in 42 locales, following the application locale
- ARIA wiring, `focus-visible` rings and reduced motion support built in
- Interactive install, update and switch commands that also run fully from flags

## Screenshots

The account settings example uses the default Tailwind and Blade components. These screenshots
come from the browser tests and show the same form in light and dark mode.

| Light mode | Dark mode |
|------------|-----------|
| [![Account settings in light mode](art/screenshot-desktop-light.png)](art/screenshot-desktop-light.png) | [![Account settings in dark mode](art/screenshot-desktop-dark.png)](art/screenshot-desktop-dark.png) |

<details>
<summary>Mobile screenshots</summary>

<p align="center">
    <a href="art/screenshot-mobile-light.png"><img src="art/screenshot-mobile-light.png" alt="Mobile account settings in light mode" width="260"></a>
    <a href="art/screenshot-mobile-dark.png"><img src="art/screenshot-mobile-dark.png" alt="Mobile account settings in dark mode" width="260"></a>
</p>

</details>

## Configuration

```bash
php artisan vendor:publish --tag=ui-kit-config
```

```env
UI_KIT_CSS=tailwind             # tailwind, bootstrap5, bootstrap4
UI_KIT_FRONTEND=blade           # blade, livewire, vue, react, svelte
UI_KIT_PREFIX=ui                # component prefix: <x-ui::button>
UI_KIT_ICONS=lucide             # lucide, heroicons, fontawesome
UI_KIT_DARK_MODE=true
UI_KIT_DARK_MODE_DEFAULT=system # system, light, dark
UI_KIT_BREADCRUMBS_HOME=/home   # target of the leading breadcrumb
```

| Option | Env | Values | Default |
|--------|-----|--------|---------|
| `css_framework` | `UI_KIT_CSS` | `tailwind`, `bootstrap5`, `bootstrap4` | `tailwind` |
| `frontend` | `UI_KIT_FRONTEND` | `blade`, `livewire`, `vue`, `react`, `svelte` | `blade` |
| `prefix` | `UI_KIT_PREFIX` | any tag prefix | `ui` |
| `icons` | `UI_KIT_ICONS` | `lucide`, `heroicons`, `fontawesome` | `lucide` |
| `dark_mode.enabled` | `UI_KIT_DARK_MODE` | `true`, `false` | `true` |
| `dark_mode.default` | `UI_KIT_DARK_MODE_DEFAULT` | `system`, `light`, `dark` | `system` |
| `dark_mode.storage_key` | `UI_KIT_DARK_MODE_STORAGE_KEY` | localStorage key | `theme` |
| `dark_mode.persist_route` | `UI_KIT_DARK_MODE_ROUTE` | route name | none |
| `dark_mode.persist_url` | `UI_KIT_DARK_MODE_URL` | URL | none |
| `breadcrumbs.home_url` | `UI_KIT_BREADCRUMBS_HOME` | path | `/home` |
| `confirm.modal_id` | - | DOM id of the confirm dialog | `confirmModal` |
| `password.min_length` | - | integer | `8` |
| `datatable.per_page` | - | integer | `25` |

An unknown `UI_KIT_CSS` value falls back to Tailwind rather than failing to render. A custom
`UI_KIT_PREFIX` is registered in addition to `ui`, so `<x-ui::button>` keeps working either way.

## Changing Frameworks

After installation, use **update** or **switch** to change frameworks without losing configuration.

### Update (Interactive)

```bash
php artisan ui-kit:update
```

Or pass options directly:

```bash
php artisan ui-kit:update --css=bootstrap5 --frontend=blade
```

| Option | Values | Description |
|--------|--------|-------------|
| `--css` | `tailwind`, `bootstrap5`, `bootstrap4` | Change CSS framework |
| `--frontend` | `blade`, `livewire`, `vue`, `react`, `svelte` | Change frontend framework |

### Switch (Quick)

```bash
php artisan ui-kit:switch --css=bootstrap5
php artisan ui-kit:switch --frontend=livewire
php artisan ui-kit:switch --css=tailwind --frontend=vue
```

To switch every package that follows this convention:

```bash
php artisan ui:switch --css=bootstrap5 --frontend=blade
```

Both switch commands accept the same options:

| Option | Values | Description |
|--------|--------|-------------|
| `--css` | `tailwind`, `bootstrap5`, `bootstrap4` | Change CSS framework |
| `--frontend` | `blade`, `livewire`, `vue`, `react`, `svelte` | Record frontend selection |

Options are validated before changing either setting. The commands update Laravel's selected
environment file, including a custom file selected with `--env`, and clear config and view
caches. Other environment values and published views are preserved. The shared `ui:switch`
command writes `UI_KIT_CSS` and `UI_KIT_FRONTEND`; it affects packages that read those settings.

After switching, load the selected framework's assets and run `npm run build` in your application.
Imported Vue, React, and Svelte components continue to use Tailwind.

## Artisan Commands

| Command | Description | Flags |
|---------|-------------|-------|
| `ui-kit:install` | Interactive setup with existing installation detection. | `--css`, `--frontend`, `--force` |
| `ui-kit:update` | Change selections without overwriting config. | `--css`, `--frontend` |
| `ui-kit:switch` | Change selections from flags. | `--css`, `--frontend` |
| `ui:switch` | Change the shared UI Kit environment settings. | `--css`, `--frontend` |

### Install Options

| Flag | Description |
|------|-------------|
| `--css=` | CSS framework: `tailwind`, `bootstrap5`, `bootstrap4` |
| `--frontend=` | Frontend: `blade`, `livewire`, `vue`, `react`, `svelte` |
| `--force` | Replace an existing published config without confirmation |

## Components

| Component | Blade | Livewire | Vue | React | Svelte |
|---|:---:|:---:|:---:|:---:|:---:|
| Alert | `<x-ui::alert>` | `<livewire:ui-alert>` | `<UiAlert>` | `<UiAlert>` | `<UiAlert>` |
| Avatar | `<x-ui::avatar>` | `<livewire:ui-avatar>` | `<UiAvatar>` | `<UiAvatar>` | `<UiAvatar>` |
| Badge | `<x-ui::badge>` | `<livewire:ui-badge>` | `<UiBadge>` | `<UiBadge>` | `<UiBadge>` |
| Breadcrumbs | `<x-ui::breadcrumbs>` | - | - | - | - |
| Button | `<x-ui::button>` | `<livewire:ui-button>` | `<UiButton>` | `<UiButton>` | `<UiButton>` |
| Card | `<x-ui::card>` | `<livewire:ui-card>` | `<UiCard>` | `<UiCard>` | `<UiCard>` |
| Checkbox | `<x-ui::checkbox>` | `<livewire:ui-checkbox>` | `<UiCheckbox>` | `<UiCheckbox>` | `<UiCheckbox>` |
| Confirm | `<x-ui::confirm>` | `<livewire:ui-confirm>` | `<UiConfirm>` | `<UiConfirm>` | `<UiConfirm>` |
| Data Table | `<x-ui::data-table>` | `<livewire:ui-data-table>` | `<UiDataTable>` | `<UiDataTable>` | `<UiDataTable>` |
| Dropdown | `<x-ui::dropdown>` | `<livewire:ui-dropdown>` | `<UiDropdown>` | `<UiDropdown>` | `<UiDropdown>` |
| Form Group | `<x-ui::form-group>` | `<livewire:ui-form-group>` | `<UiFormGroup>` | `<UiFormGroup>` | `<UiFormGroup>` |
| Icon | `<x-ui::icon>` | `<livewire:ui-icon>` | `<UiIcon>` | `<UiIcon>` | `<UiIcon>` |
| Input | `<x-ui::input>` | `<livewire:ui-input>` | `<UiInput>` | `<UiInput>` | `<UiInput>` |
| Modal | `<x-ui::modal>` | `<livewire:ui-modal>` | `<UiModal>` | `<UiModal>` | `<UiModal>` |
| Nav | `<x-ui::nav>` | `<livewire:ui-nav>` | `<UiNav>` | `<UiNav>` | `<UiNav>` |
| Pagination | `<x-ui::pagination>` | `<livewire:ui-pagination>` | `<UiPagination>` | `<UiPagination>` | `<UiPagination>` |
| Password Input | `<x-ui::password-input>` | `<livewire:ui-password-input>` | `<UiPasswordInput>` | `<UiPasswordInput>` | `<UiPasswordInput>` |
| Search Input | `<x-ui::search-input>` | `<livewire:ui-search-input>` | `<UiSearchInput>` | `<UiSearchInput>` | `<UiSearchInput>` |
| Select | `<x-ui::select>` | `<livewire:ui-select>` | `<UiSelect>` | `<UiSelect>` | `<UiSelect>` |
| Stat Card | `<x-ui::stat-card>` | `<livewire:ui-stat-card>` | `<UiStatCard>` | `<UiStatCard>` | `<UiStatCard>` |
| Status Panel | `<x-ui::status-panel>` | `<livewire:ui-status-panel>` | `<UiStatusPanel>` | `<UiStatusPanel>` | `<UiStatusPanel>` |
| Tabs | `<x-ui::tabs>` | `<livewire:ui-tabs>` | `<UiTabs>` | `<UiTabs>` | `<UiTabs>` |
| Textarea | `<x-ui::textarea>` | `<livewire:ui-textarea>` | `<UiTextarea>` | `<UiTextarea>` | `<UiTextarea>` |
| Theme Toggle | `<x-ui::theme-toggle>` | `<livewire:ui-theme-toggle>` | `<UiThemeToggle>` | `<UiThemeToggle>` | `<UiThemeToggle>` |
| Toggle | `<x-ui::toggle>` | `<livewire:ui-toggle>` | `<UiToggle>` | `<UiToggle>` | `<UiToggle>` |

## Dark Mode

Tailwind dark mode is class based. Bootstrap 5.3 uses `data-bs-theme`, which its Blade theme
toggle also sets. Bootstrap 4 needs an application stylesheet that responds to the `dark` class;
Bootstrap 4 does not supply dark palettes itself. The theme toggle writes the chosen mode to `localStorage` and adds or
removes the `dark` class on `<html>`, so it works without a round trip to the server.

To also persist the choice for signed in users, point the toggle at an endpoint of your own:

```env
UI_KIT_DARK_MODE_ROUTE=profile.dark-mode
```

The endpoint receives `{"dark_mode": "light|dark|system"}`. When neither
`UI_KIT_DARK_MODE_ROUTE` nor `UI_KIT_DARK_MODE_URL` resolves, the toggle stays entirely client
side. A route name that is not registered is ignored rather than throwing.

## Icons

The icon component ships 46 inline outline icons and renders the same geometry in all three CSS
frameworks:

```blade
<x-ui::icon name="users" size="lg" />
<x-ui::button icon="trash" variant="danger">Delete</x-ui::button>
```

Set `UI_KIT_ICONS=fontawesome` to render `<i class="fa fa-{name}">` instead of inline SVG. An
unknown icon name renders a neutral placeholder rather than failing.

## Translations

Strings such as Previous, Next, Dismiss and Close come from the package translations, which ship
in 42 locales and follow the application locale. Override them by publishing:

```bash
php artisan vendor:publish --tag=ui-kit-lang
```

```blade
{{ __('ui-kit::ui-kit.pagination.next') }}
```

## Accessibility

Components ship the ARIA wiring you would otherwise have to add yourself: `aria-invalid` and
`aria-describedby` on fields with errors or hints, `aria-expanded` and `aria-haspopup` on
dropdowns, `role="dialog"` with `aria-modal` and a labelled title on modals, `role="switch"` on
toggles, `aria-current="page"` on the active breadcrumb and pagination link, `aria-sort` on
sortable columns, and `aria-hidden` on decorative icons. Focus rings use `focus-visible` so they
appear for keyboard users without showing on mouse clicks, and transitions are disabled under
`prefers-reduced-motion`.

## Publishing Assets

| Tag | Publishes to |
|-----|--------------|
| `ui-kit-config` | `config/ui-kit.php` |
| `ui-kit-views` | `resources/views/vendor/ui-kit` |
| `ui-kit-lang` | `lang/vendor/ui-kit` |
| `ui-kit-js` | `resources/js/ui-kit` |
| `ui-kit` | All of the above |

Published Blade overrides belong in `resources/views/vendor/ui-kit/{css_framework}/components`.
Only overrides for the selected framework are loaded. Existing flat overrides under
`resources/views/vendor/ui/components` or `resources/views/vendor/ui-kit/components` retain
priority. Publish without `--force` to preserve your changes.

## File Tree

```text
laravel-ui-kit/
├── .github/workflows/tests.yml    # PHP, frontend, browser and lint checks
├── art/                          # README banners and screenshots
├── config/ui-kit.php             # Framework, icon and theme settings
├── resources/
│   ├── js/
│   │   ├── react/                # React components
│   │   ├── svelte/               # Svelte components
│   │   └── vue/                  # Vue components
│   ├── lang/                     # Translations
│   └── views/
│       ├── bootstrap4/components/
│       ├── bootstrap5/components/
│       ├── livewire/             # Livewire wrapper views
│       └── tailwind/components/
├── src/
│   ├── Components/               # Blade component classes
│   ├── Console/                  # Install, update and switch commands
│   ├── Contracts/
│   ├── Facades/
│   ├── Livewire/                 # Livewire component classes
│   ├── Providers/                # Package registration and view resolution
│   └── Services/                 # Framework configuration access
├── tests/
│   ├── Browser/                  # Playwright tests, build and fixtures
│   ├── Feature/                  # Rendering and command tests
│   ├── Unit/                     # Component and service tests
│   ├── Pest.php
│   └── TestCase.php              # Isolated Testbench environment
├── CHANGELOG.md
├── LICENSE
├── README.md
├── composer.json
├── package.json
├── package-lock.json
├── phpunit.xml
├── pint.json
└── playwright.config.js
```

## Testing

```bash
composer test
composer lint:test
```

Or directly:

```bash
./vendor/bin/pest --ci
./vendor/bin/pint --test
```

Build and run the frontend tests:

```bash
npm ci
npx playwright install chromium
npm run build
npm run test:browser
```

The build compiles all Vue, React, and Svelte exports and renders Blade fixtures with Testbench.
Playwright tests native form submission, disabled controls, dropdowns, and theme persistence
at desktop and mobile sizes. CI tests Svelte 4 and 5 separately, runs the full PHP suite across
PHP 8.2 through 8.5 and Laravel 12/13, checks Livewire 3 and 4, runs Pint, and audits dependencies.

Tests use SQLite in memory and never seed or connect to an application database. This repository
is a package, so application commands such as `php artisan db:seed` do not apply.

## Changelog

See [CHANGELOG.md](CHANGELOG.md).

## License

This package is open-sourced software licensed under the [MIT license](LICENSE).
