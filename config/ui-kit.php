<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | CSS Framework
    |--------------------------------------------------------------------------
    |
    | The CSS framework to use for rendering components. Exactly one is active
    | at runtime. An unknown value falls back to "tailwind".
    |
    | Supported: "tailwind", "bootstrap5", "bootstrap4"
    |
    */

    'css_framework' => env('UI_KIT_CSS', 'tailwind'),

    /*
    |--------------------------------------------------------------------------
    | Frontend Framework
    |--------------------------------------------------------------------------
    |
    | The frontend framework used for interactive components.
    |
    | Supported: "blade", "livewire", "vue", "react", "svelte"
    |
    */

    'frontend' => env('UI_KIT_FRONTEND', 'blade'),

    /*
    |--------------------------------------------------------------------------
    | Component Prefix
    |--------------------------------------------------------------------------
    |
    | The prefix used for Blade components. With the default "ui" prefix,
    | components render as <x-ui::button>, <x-ui::card>, and so on. A custom
    | prefix is registered in addition to "ui", never instead of it, so any
    | existing markup keeps working.
    |
    */

    'prefix' => env('UI_KIT_PREFIX', 'ui'),

    /*
    |--------------------------------------------------------------------------
    | Icon Set
    |--------------------------------------------------------------------------
    |
    | The icon set used by the icon component and by icon references.
    |
    | Supported: "lucide", "heroicons", "fontawesome"
    |
    */

    'icons' => env('UI_KIT_ICONS', 'lucide'),

    /*
    |--------------------------------------------------------------------------
    | Dark Mode
    |--------------------------------------------------------------------------
    |
    | Dark mode is class based: the theme toggle adds or removes the "dark"
    | class on <html>. The chosen theme is stored in localStorage.
    |
    | persist_route / persist_url are optional. When either resolves, the theme
    | toggle also sends the selected mode to that endpoint for signed in users.
    | Leave both empty to keep the toggle entirely client side. An unregistered
    | route name is ignored rather than throwing.
    |
    */

    'dark_mode' => [
        'enabled'        => env('UI_KIT_DARK_MODE', true),
        'default'        => env('UI_KIT_DARK_MODE_DEFAULT', 'system'),
        'toggle'         => true,
        'storage_key'    => env('UI_KIT_DARK_MODE_STORAGE_KEY', 'theme'),
        'persist_route'  => env('UI_KIT_DARK_MODE_ROUTE'),
        'persist_url'    => env('UI_KIT_DARK_MODE_URL'),
        'persist_method' => env('UI_KIT_DARK_MODE_METHOD', 'PUT'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Confirmation Modals
    |--------------------------------------------------------------------------
    */

    'confirm' => [
        'default_title'   => 'Confirm Action',
        'default_message' => 'Are you sure you want to proceed?',
        'cancel_text'     => 'Cancel',
        'confirm_text'    => 'Confirm',
        'modal_id'        => 'confirmModal',
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Input
    |--------------------------------------------------------------------------
    */

    'password' => [
        'strength_meter' => true,
        'show_hide'      => true,
        'min_length'     => 8,
        'messages'       => [
            'short'  => 'Too short',
            'weak'   => 'Weak',
            'medium' => 'Medium',
            'strong' => 'Strong',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | DataTable Defaults
    |--------------------------------------------------------------------------
    */

    'datatable' => [
        'per_page'   => 25,
        'searchable' => true,
        'sortable'   => true,
        'exportable' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Breadcrumbs
    |--------------------------------------------------------------------------
    |
    | home_url is the target of the leading home crumb. Set it to null or pass
    | :show-home="false" to the component to drop the crumb entirely.
    |
    */

    'breadcrumbs' => [
        'home_url' => env('UI_KIT_BREADCRUMBS_HOME', '/home'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Toast Defaults
    |--------------------------------------------------------------------------
    */

    'toast' => [
        'position'    => 'top-right',
        'duration'    => 5000,
        'max_visible' => 5,
    ],

];
