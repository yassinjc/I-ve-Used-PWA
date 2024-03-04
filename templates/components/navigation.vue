<template>
    <nav class="navigation">
        <div class="container">
            <a
                class="navigation__icon" 
                v-for="(page, index) in navPages" :key="index"
                :href="'./' + index"
                v-html="page.navIcon"
                :class="{ 'navigation__icon--active': page.active }"
            ></a>
        </div>
    </nav>
</template>

<script>
    export default {
        data () {
            return {
                navPages: JSON.parse(this.pages)
            }
        },
        props: {
            pages: String
        }
    }
</script>