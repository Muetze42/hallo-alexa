<template>
    <div class="card">
        <div class="header">
            <h1>{{ title }}</h1>
        </div>
        <div class="body">
            <slot></slot>
        </div>
        <div class="footer" v-if="$slots.footer">
            <slot name="footer"></slot>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        title: String
    },
    name: "Card",
    methods: {
        dd(item) {
            console.log(item);
        },
    }
}
</script>

<style scoped>

</style>
