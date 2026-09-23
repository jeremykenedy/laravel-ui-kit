import { test, expect } from '@playwright/test'

const pages = ['tailwind', 'bootstrap5', 'bootstrap4', 'vue', 'react', 'svelte']

for (const frontend of pages) {
  test.describe(frontend, () => {
    test.beforeEach(async ({ page }) => {
      page.on('pageerror', error => { throw error })
      await page.goto(`/${frontend}.html`)
      await expect(page.getByRole('heading', { name: 'Account settings' })).toBeVisible()
    })

    test('submits named controls with their current values', async ({ page }) => {
      await page.getByLabel('Role', { exact: true }).selectOption('editor')
      await page.getByLabel('Bio', { exact: true }).fill('Updated profile')
      await page.locator('input[name=password]').fill('Correct-Horse-42')
      const values = await page.locator('form').evaluate(form => Object.fromEntries(new FormData(form)))
      expect(values.password).toBe('Correct-Horse-42')
      expect(values.role).toBe('editor')
      expect(values.bio).toBe('Updated profile')
      expect(values.notifications).toBeTruthy()
      await page.getByLabel('Notifications', { exact: true }).uncheck()
      expect(await page.locator('form').evaluate(form => new FormData(form).has('notifications'))).toBe(false)
    })

    test('keeps disabled links and loading buttons inactive', async ({ page }) => {
      const link = page.getByText('Disabled link', { exact: true })
      await expect(link).not.toHaveAttribute('href')
      await expect(link).toHaveAttribute('aria-disabled', 'true')
      await expect(page.getByRole('button', { name: 'Saving' })).toBeDisabled()
    })

    test('opens and closes a dropdown without a page error', async ({ page }) => {
      const trigger = page.getByRole('button', { name: /Actions|Toggle menu/ }).first()
      await trigger.click()
      await expect(page.getByRole('link', { name: 'Edit profile' })).toBeVisible()
      await page.getByRole('heading', { name: 'Account settings' }).click()
      await expect(page.getByRole('link', { name: 'Edit profile' })).toBeHidden()
    })
  })
}

for (const framework of ['tailwind', 'bootstrap5', 'bootstrap4']) {
  test(`${framework} persists dark mode and follows system changes`, async ({ page }) => {
    page.on('pageerror', error => { throw error })
    await page.emulateMedia({ colorScheme: 'light' })
    await page.goto(`/${framework}.html`)
    const toggle = page.locator('[aria-controls="theme-menu"]')
    await toggle.click()
    await page.getByRole('menuitemradio', { name: 'Dark', exact: true }).click()
    await expect(page.locator('html')).toHaveClass(/dark/)
    if (framework === 'bootstrap5') await expect(page.locator('html')).toHaveAttribute('data-bs-theme', 'dark')
    await page.reload()
    await expect(page.locator('html')).toHaveClass(/dark/)
    await toggle.click()
    await page.getByRole('menuitemradio', { name: 'System', exact: true }).click()
    await expect(page.locator('html')).not.toHaveClass(/dark/)
    await page.emulateMedia({ colorScheme: 'dark' })
    await expect(page.locator('html')).toHaveClass(/dark/)
  })
}

for (const frontend of ['vue', 'react', 'svelte']) {
  test(`${frontend} keeps input bindings when values and password visibility change`, async ({ page }) => {
    page.on('pageerror', error => { throw error })
    await page.goto(`/${frontend}.html`)
    await page.getByLabel('Count', { exact: true }).fill('42')
    await expect(page.getByTestId('count')).toHaveText('42')
    const password = page.getByLabel('Password', { exact: true })
    await password.fill('Correct-Horse-42')
    await password.locator('..').getByRole('button').click()
    await expect(password).toHaveAttribute('type', 'text')
    await expect(password).toHaveValue('Correct-Horse-42')
  })
}

test('selects the matching banner for each color scheme', async ({ page }, testInfo) => {
  for (const mode of ['light', 'dark']) {
    await page.emulateMedia({ colorScheme: mode })
    await page.goto('/tailwind.html')
    const banner = page.getByRole('img', { name: 'Laravel UI Kit', exact: true })
    await expect.poll(() => banner.evaluate(image => image.currentSrc)).toContain(`banner-${mode}.svg`)
    await expect.poll(() => banner.evaluate(image => image.naturalWidth)).toBeGreaterThan(0)
    if (mode === 'dark') await expect(page.locator('html')).toHaveClass(/dark/)
    await page.screenshot({ path: testInfo.outputPath(`${mode}.png`), fullPage: true, animations: 'disabled' })
  }
})
