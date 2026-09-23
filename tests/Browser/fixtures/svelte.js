import * as components from '../../../resources/js/svelte/index.js'
import Page from './Page.svelte'
window.componentNames = Object.keys(components)
new Page({ target: document.getElementById('app') })
