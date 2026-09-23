<script setup>
import { ref } from 'vue'
import { UiButton, UiCard, UiCheckbox, UiSelect, UiTextarea, UiDropdown, UiThemeToggle, UiInput, UiPasswordInput } from '../../../resources/js/vue/index.js'
const password = ref('')
const count = ref(1)
const role = ref('reader')
const bio = ref('Hello')
const checked = ref(true)
</script>
<template>
  <h1>Account settings</h1>
  <UiCard title="Profile">
    <form>
      <UiInput name="count" id="count" label="Count" type="number" v-model="count" />
      <output data-testid="count">{{ count }}</output>
      <UiPasswordInput name="password" label="Password" v-model="password" />
      <UiSelect name="role" label="Role" :options="{ reader: 'Reader', editor: 'Editor' }" v-model="role" />
      <UiTextarea name="bio" label="Bio" v-model="bio" />
      <UiCheckbox name="notifications" label="Notifications" v-model:checked="checked" />
      <div class="fixture-actions">
        <UiButton href="/reports" disabled>Disabled link</UiButton>
        <UiButton loading>Saving</UiButton>
        <UiButton>Save profile</UiButton>
      </div>
    </form>
  </UiCard>
  <section><UiDropdown label="Actions"><a href="#profile">Edit profile</a></UiDropdown></section>
  <section><UiThemeToggle /></section>
</template>
