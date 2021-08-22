require('./bootstrap');

/*
|----------------------------------------------------------------
| Vue 3
|----------------------------------------------------------------
*/

import { createApp, h } from 'vue'
import { App, plugin } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'

// import { library } from "@fortawesome/fontawesome-svg-core";
// import { faBars, faTimes } from "@fortawesome/free-solid-svg-icons";

// library.add(faBars, faTimes);

// import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

InertiaProgress.init()

const el = document.getElementById('app')

createApp({
    render: () => h(App, {
        initialPage: JSON.parse(el.dataset.page),
        resolveComponent: name => import(`./Pages/${name}`).then(module => module.default),
    })
})
    .mixin({
        props: {
            _token: String
        },
        methods: {
            route: (name, params, absolute) => route(name, params, absolute, Ziggy),
        },
    })
    .use(plugin)
    // .component("font-awesome-icon", FontAwesomeIcon)
    .mount(el)
