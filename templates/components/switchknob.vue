<template>
    <a @click.prevent="()=>{active = !active}" class="switch" :class={active:active}>
        <p>Nee</p>
            <div class="switch__button">
                <div class="switch__button__hole"></div>

                <div class="switch__button__ball"></div>
            </div>
        <p>Ja</p>
    </a>
</template>

<script>
    export default{
        data(){
            return {
                active: false
            }
        },
        watch: {
            'active' (newValue) {
                this.$emit('darkModeToggle', this.active)
            }
        }
    }

    
</script>