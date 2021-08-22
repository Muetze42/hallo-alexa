<template>
    <inertia-head>
        <title>{{ title }}</title>
        <meta head-key="description" name="description" :content="desc">
    </inertia-head>
    <div id="sidebar" :class="{ 'z-40': open}">
        <div id="sidebar-draw">
            <button
                @click.prevent="toggle()"
                id="sidebar-button"
                class="transition-color"
            >
            <!--<font-awesome-icon :icon="['fas', open ? 'times' : 'bars']" />-->
                <span v-if="open">
                    <i class="fas fa-times menu-switch"></i>
                </span>
                <span v-else>
                    <i class="fas fa-bars menu-switch"></i>
                </span>
                <span class="sr-only">Open Menu</span>
            </button>

            <div id="sidebar-content" :class="[open ? 'max-w-lg' : 'max-w-0']">
                <nav role="navigation">
                    <ul>
                        <li v-for="(item, index) in menuItems" :key="index">
                            <inertia-link v-if="route().current(item.route)" :href="route(item.route)" aria-current="page">{{ item.name }}</inertia-link>
                            <inertia-link v-else :href="route(item.route)">{{ item.name }}</inertia-link>
                        </li>
                    </ul>
<!--                    <div id="copyright">-->
<!--                        <a href="https://huth.it" target="_blank">-->
<!--                            Website <i class="far fa-copyright"></i> 2021-->
<!--                            <span>Norman Huth</span>-->
<!--                        </a>-->
<!--                    </div>-->
                </nav>
<!--                <div id="copyright">-->
<!--                    <a href="https://huth.it" target="_blank">-->
<!--                        Website <i class="far fa-copyright"></i> 2021-->
<!--                        <span>Norman Huth</span>-->
<!--                    </a>-->
<!--                </div>-->
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
    <main :class="{ 'z-40': !open}">
        <div id="container">
            <slot />
        </div>
    </main>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';

export default {
    props: {
        title: String,
        desc: String,
    },
    data() {
        return {
            open: false,
            dimmer: true,
            menuItems: [
                {
                    name: "Links",
                    route: "home",
                },
                {
                    name: "Kontakt",
                    route: "contact.index",
                },
            ]
        };
    },
    methods: {
        toggle() {
            this.open = !this.open;
        },
        dd() {
            alert(this.route("home"))
        },
    },
    mounted() {
        Inertia.on("navigate", (event) => {
            this.toggle()
        });
    },
};
</script>
