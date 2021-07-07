import Vue from 'vue';
import translate from "../../mixins/translate"
import mainCategory from './main-category'
Vue.mixin(translate)

new Vue({
    el: '#main-category',
    components: {mainCategory}
})
