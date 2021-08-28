<template>
    <card :title="'hallo_alexa_'" :cardClass="'w-80'">
        <template v-for="link in links">
            <a :href="link.target" target="_blank" class="btn" :class="'btn-'+link.id" rel="noopener" @click="count(link.id)">
                <i class="fw-fw" :class="link.icon"></i>
                {{ link.name }}
            </a>
        </template>
    </card>
</template>

<script>
import Default from '../Layout/Default'
import Card from '../Components/Card'

export default {
    layout: Default,
    name: "Index",
    props: {
        links: Object,
    },
    components: {
        Card
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
