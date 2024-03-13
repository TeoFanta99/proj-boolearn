<script >

import AppFooter from './components/AppFooter.vue';
import AppHeader from './components/AppHeader.vue';


export default {
    components:{
        AppHeader,
        AppFooter
},  
    data(){
              
        return{
            
        }
    }
}
</script>

<template>
 <AppHeader/>
 main belo
 <AppFooter/>
</template>

<style lang="scss">
    @use "./styles/general.scss";

</style>
