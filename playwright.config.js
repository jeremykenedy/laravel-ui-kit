import { defineConfig, devices } from '@playwright/test'

export default defineConfig({
  testDir: './tests/Browser',
  testMatch: '**/*.spec.js',
  fullyParallel: true,
  forbidOnly: !!process.env.CI,
  retries: process.env.CI ? 1 : 0,
  workers: process.env.CI ? 2 : undefined,
  reporter: process.env.CI ? 'github' : 'list',
  use: { baseURL: 'http://127.0.0.1:8179', trace: 'retain-on-failure', screenshot: 'only-on-failure' },
  projects: [
    { name: 'chromium', use: { ...devices['Desktop Chrome'] } },
    { name: 'mobile', use: { ...devices['iPhone 13'], defaultBrowserType: 'chromium' } },
  ],
  webServer: { command: 'php -S 127.0.0.1:8179 -t tests/Browser/dist', url: 'http://127.0.0.1:8179/tailwind.html', reuseExistingServer: !process.env.CI, stderr: 'ignore' },
})
