<template>
    <div class="container">
        <header-component></header-component>
        <router-view></router-view>
    </div>
</template>

<script>
import HeaderComponent from '../components/HeaderComponent.vue';

export default {
    name: 'App',
    components: {
        HeaderComponent,
    }
}
</script>

<style>

</style>
