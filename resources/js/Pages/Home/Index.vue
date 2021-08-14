<template>
    <div id="container">
        <h1>hallo_alexa_</h1>
        <div id="links">
        <template v-for="link in links">
            <a :href="link.redirect_route" target="_blank" class="btn" :class="'btn-'+link.id">
                <i class="fw-fw" :class="link.icon"></i>
                {{ link.name }}
            </a>
        </template>
        </div>
    </div>
</template>

<script>
export default {
    name: "Index",
    props: {
        links: Object,
    },
}
</script>
