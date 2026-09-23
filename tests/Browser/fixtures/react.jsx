import React, { useState } from 'react'
import { createRoot } from 'react-dom/client'
import * as components from '../../../resources/js/react/index.js'

window.componentNames = Object.keys(components)
const { UiButton, UiCard, UiCheckbox, UiSelect, UiTextarea, UiDropdown, UiThemeToggle, UiInput, UiPasswordInput } = components

function Page() {
  const [password, setPassword] = useState('')
  const [count, setCount] = useState(1)
  const [role, setRole] = useState('reader')
  const [bio, setBio] = useState('Hello')
  const [checked, setChecked] = useState(true)

  return <>
    <h1>Account settings</h1>
    <UiCard title="Profile">
      <form>
        <UiInput name="count" id="count" label="Count" type="number" value={count} onChange={event => setCount(event.target.value)} />
        <output data-testid="count">{count}</output>
        <UiPasswordInput name="password" label="Password" value={password} onChange={event => setPassword(event.target.value)} />
        <UiSelect name="role" label="Role" options={{ reader: 'Reader', editor: 'Editor' }} value={role} onChange={event => setRole(event.target.value)} />
        <UiTextarea name="bio" label="Bio" value={bio} onChange={event => setBio(event.target.value)} />
        <UiCheckbox name="notifications" label="Notifications" checked={checked} onChange={setChecked} />
        <div className="fixture-actions">
          <UiButton href="/reports" disabled onClick={() => { window.disabledClicks = (window.disabledClicks || 0) + 1 }}>Disabled link</UiButton>
          <UiButton loading>Saving</UiButton>
          <UiButton>Save profile</UiButton>
        </div>
      </form>
    </UiCard>
    <section><UiDropdown label="Actions"><a href="#profile">Edit profile</a></UiDropdown></section>
    <section><UiThemeToggle /></section>
  </>
}

createRoot(document.getElementById('app')).render(<Page />)
