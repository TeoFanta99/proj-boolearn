<script >

import AppFooter from './components/AppFooter.vue';


import AppHeader from './components/AppHeader.vue';

export default {
    data(){
        return{
            AppHeader,
            AppFooter
        }
    }
}
</script>

<template>
 <AppHeader />
 main belo
 <AppFooter />
</template>

<style lang="scss">
    @use "./styles/general.scss";

</style>
