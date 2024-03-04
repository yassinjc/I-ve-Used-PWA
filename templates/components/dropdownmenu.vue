<template>
<div @click.prevent="()=>{active = !active}" class="dropdownBackground" :class={active:active}></div>
<a @click.prevent="()=>{active = !active}" class="dropdown-container" :class={active:active} >
    <a class="optionbutton">
        <p class="optionbutton__text">{{value}}</p>
        <svg class="optionbutton__arrow" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
        <path id="Icon_awesome-arrow-right" data-name="Icon awesome-arrow-right" d="M5.1,3.451l.595-.61a.629.629,0,0,1,.908,0L11.811,8.18a.669.669,0,0,1,0,.932L6.6,14.454a.629.629,0,0,1-.908,0l-.595-.61a.672.672,0,0,1,.011-.943L8.34,9.746H.643A.65.65,0,0,1,0,9.087V8.208a.65.65,0,0,1,.643-.659h7.7L5.113,4.394A.667.667,0,0,1,5.1,3.451Z" transform="translate(14.647) rotate(90)" fill="#49bcf9"/>
        </svg>
    </a>
    <ul class="menulist">
        <li v-for="i in 3" @click.prevent="()=>{value='test' + i}">
            <a>test {{i}}</a>
        </li>
    </ul>
</a>
</template>

<script>
    export default {
        data(){
            return {active: false, value:"Nederlands"}
        },
    }
</script>