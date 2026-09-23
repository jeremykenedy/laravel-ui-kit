<script>
  import { UiButton, UiCard, UiCheckbox, UiSelect, UiTextarea, UiDropdown, UiThemeToggle, UiInput, UiPasswordInput } from '../../../resources/js/svelte/index.js'
  let password = ''
  let count = 1
  let role = 'reader'
  let bio = 'Hello'
  let checked = true
</script>
<h1>Account settings</h1>
<UiCard title="Profile">
  <form>
    <UiInput name="count" id="count" label="Count" type="number" bind:value={count} />
    <output data-testid="count">{count}</output>
    <UiPasswordInput name="password" label="Password" bind:value={password} />
    <UiSelect name="role" label="Role" options={{ reader: 'Reader', editor: 'Editor' }} bind:value={role} />
    <UiTextarea name="bio" label="Bio" bind:value={bio} />
    <UiCheckbox name="notifications" label="Notifications" bind:checked />
    <div class="fixture-actions">
      <UiButton href="/reports" disabled>Disabled link</UiButton>
      <UiButton loading>Saving</UiButton>
      <UiButton>Save profile</UiButton>
    </div>
  </form>
</UiCard>
<section><UiDropdown label="Actions"><a href="#profile">Edit profile</a></UiDropdown></section>
<section><UiThemeToggle /></section>
