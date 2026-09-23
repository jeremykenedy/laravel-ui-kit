import { createApp } from 'vue'
import * as components from '../../../resources/js/vue/index.js'
import Page from './Page.vue'
window.componentNames = Object.keys(components)
createApp(Page).mount('#app')
