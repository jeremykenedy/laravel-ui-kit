<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UI Kit {{ $framework }}</title>
    <link rel="stylesheet" href="{{ $framework }}.css">
    <link rel="stylesheet" href="page.css">
</head>
<body>
    <main>
        <h1>Account settings</h1>
        <section><x-ui::card title="Profile" subtitle="Manage your details">
            <form>
                <x-ui::input name="email" label="Email" type="email" value="jeremy@example.com" />
                <x-ui::select name="role" label="Role" :options="['reader' => 'Reader', 'editor' => 'Editor']" />
                <x-ui::textarea name="bio" label="Bio">Hello</x-ui::textarea>
                <x-ui::checkbox name="notifications" label="Notifications" checked />
                <x-ui::password-input name="password" label="Password" />
                <div class="fixture-actions">
                    <x-ui::button href="/reports" disabled>Disabled link</x-ui::button>
                    <x-ui::button loading>Saving</x-ui::button>
                    <x-ui::button>Save profile</x-ui::button>
                </div>
            </form>
        </x-ui::card></section>
        <section><x-ui::alert variant="success" dismissible>Profile saved</x-ui::alert></section>
        <section><x-ui::dropdown label="Actions"><a href="#profile">Edit profile</a></x-ui::dropdown></section>
        <section><x-ui::theme-toggle id="theme" /></section>
        <picture>
            <source media="(prefers-color-scheme: dark)" srcset="banner-dark.svg">
            <img src="banner-light.svg" alt="Laravel UI Kit" width="800">
        </picture>
    </main>
    <script type="module" src="{{ $framework }}.js"></script>
</body>
</html>
