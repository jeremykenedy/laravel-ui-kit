import { build } from 'esbuild'
import { readFile, mkdir, copyFile, writeFile } from 'node:fs/promises'
import { dirname } from 'node:path'
import { execFileSync } from 'node:child_process'
import { parse, compileScript } from 'vue/compiler-sfc'
import { compile, VERSION } from 'svelte/compiler'

const output = 'tests/Browser/dist'
await mkdir(output, { recursive: true })

await build({
  entryPoints: {
    react: 'tests/Browser/fixtures/react.jsx',
    vue: 'tests/Browser/fixtures/vue.js',
    svelte: 'tests/Browser/fixtures/svelte.js',
    tailwind: 'tests/Browser/fixtures/alpine.js',
    bootstrap5: 'tests/Browser/fixtures/bootstrap5.js',
    bootstrap4: 'tests/Browser/fixtures/bootstrap4.js',
  },
  outdir: output,
  bundle: true,
  format: 'esm',
  define: { 'process.env.NODE_ENV': '"production"', __VUE_OPTIONS_API__: 'true', __VUE_PROD_DEVTOOLS__: 'false', __VUE_PROD_HYDRATION_MISMATCH_DETAILS__: 'false' },
  plugins: [{
    name: 'components',
    setup(builder) {
      builder.onLoad({ filter: /\.(vue|svelte)$/ }, async ({ path }) => {
        const source = await readFile(path, 'utf8')
        const contents = path.endsWith('.vue')
          ? compileScript(parse(source, { filename: path }).descriptor, { id: path, inlineTemplate: true }).content
          : compile(source, { filename: path, css: 'injected', ...(VERSION.startsWith('5.') ? { compatibility: { componentApi: 4 } } : {}) }).js.code
        return { contents, resolveDir: dirname(path) }
      })
    },
  }],
})

execFileSync(process.execPath, ['node_modules/@tailwindcss/cli/dist/index.mjs', '-i', 'tests/Browser/fixtures/tailwind.css', '-o', `${output}/tailwind.css`, '--minify'], { stdio: 'inherit' })
for (const framework of ['bootstrap5', 'bootstrap4']) {
  const directory = framework === 'bootstrap5' ? 'bootstrap' : 'bootstrap4'
  await copyFile(`node_modules/${directory}/dist/css/bootstrap.min.css`, `${output}/${framework}.css`)
}
await copyFile('tests/Browser/fixtures/page.css', `${output}/page.css`)
await copyFile('art/banner-light.svg', `${output}/banner-light.svg`)
await copyFile('art/banner-dark.svg', `${output}/banner-dark.svg`)
execFileSync('php', ['vendor/bin/pest', 'tests/Feature/BrowserFixtureTest.php', '--colors=never'], { stdio: 'inherit' })

for (const frontend of ['vue', 'react', 'svelte']) {
  await writeFile(`${output}/${frontend}.html`, `<!doctype html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>UI Kit ${frontend}</title><link rel="stylesheet" href="tailwind.css"><link rel="stylesheet" href="page.css"></head>
<body><main id="app"></main><script type="module" src="${frontend}.js"></script></body></html>`)
}
