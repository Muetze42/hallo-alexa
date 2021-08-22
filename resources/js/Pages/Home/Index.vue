<template>
        <h1>hallo_alexa_</h1>
        <div id="links">
        <template v-for="link in links">
            <a :href="link.target" target="_blank" class="btn" :class="'btn-'+link.id" rel="noopener" @click="count(link.id)">
                <i class="fw-fw" :class="link.icon"></i>
                {{ link.name }}
            </a>
        </template>
        </div>
</template>

<script>
import Default from '../Layout/Default'

export default {
    layout: Default,
    name: "Index",
    props: {
        links: Object,
    },
    methods: {
        count(id) {
            axios.post('/api/link/'+id, {
                api: true,
            });
        }
    },
}
</script>
