import Vue from 'vue'
import VueToast from 'vue-notification'
import vuetify from '@/plugins/vuetify'
import { createInertiaApp, Link, Head } from '@inertiajs/inertia-vue'
import { InertiaProgress } from '@inertiajs/progress'
import VLink from '@/components/VLink'

import '@/assets/tailwind.css'

Vue.config.productionTip = false

Vue.use(VueToast)

Vue.component('Head', Head)
Vue.component('Link', Link)
Vue.component('VLink', VLink)

/**
 * Register routes to be available in the client side
 * @see https://github.com/tighten/ziggy
*/
Vue.mixin({
  methods: {
    route: window.route
  }
})

InertiaProgress.init()

createInertiaApp({
  resolve: name => import('./pages/' + name),
  setup ({ el, App, props, plugin }) {
    Vue.use(plugin)

    new Vue({
      vuetify,
      render: h => h(App, props)
    }).$mount(el)
  }
})
