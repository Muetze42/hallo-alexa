<template>
    <inertia-head>
        <meta head-key="description" name="description" :content="metaDesc">
    </inertia-head>
    <div id="sidebar" :class="{ 'z-40': open}">
        <div id="sidebar-draw">
            <button
                @click.prevent="toggle()"
                id="sidebar-button"
                class="transition-color"
            >
                <span v-if="open">
                    <i class="fas fa-times menu-switch"></i>
                </span>
                <span v-else>
                    <i class="fas fa-bars menu-switch"></i>
                </span>
                <span class="sr-only">Menü</span>
            </button>

            <div id="sidebar-content" :class="[open ? 'max-w-lg' : 'max-w-0']">
                <nav role="navigation">
                    <ul>
                        <li v-for="(item, index) in this.menuItems" :key="index">
                            <inertia-link v-if="route().current(item.route)" :href="route(item.route)" aria-current="page">{{ item.text }}</inertia-link>
                            <inertia-link v-else :href="route(item.route)">{{ item.text }}</inertia-link>
                        </li>
                        <li v-if="this.authed">
                            <a href="/admin">Administration</a>
                        </li>
                    </ul>
                </nav>
                <div id="copyright">
                    <a href="https://huth.it" target="_blank">
                        Website <i class="far fa-copyright"></i> 2021
                        <span><u>Norman Huth</u><i class="fa-fw fas fa-external-link"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <transition name="fade">
            <div
                v-if="dimmer && open"
                @click="toggle()"
                id="sidebar-fade"
                class="active:outline-none"
            />
        </transition>
    </div>
    <main>
        <slot />
    </main>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';

export default {
    props: {
        metaTitle: String,
        metaDesc: String,
    },
    data() {
        return {
            open: false,
            dimmer: true,
        };
    },
    methods: {
        toggle() {
            this.open = !this.open;
        }
    },
    updated() {
        document.title = this.metaTitle
    },
    mounted() {
        Inertia.on("navigate", (event) => {
            this.toggle()
        });
    }
};
</script>
