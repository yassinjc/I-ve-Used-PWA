<template>
    <div class="popup__wrapper" :class="{ 'popup__wrapper--active': active }">
        <div class="popup__overlay"></div>
        <div class="popup">
            <div class="popup--inner">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['active']
    }
</script>