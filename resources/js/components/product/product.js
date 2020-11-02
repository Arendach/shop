import Vue from 'vue'
import Reviews from './reviews/reviews'
import translate from "../../mixins/translate"
import store from "./store";

Vue.mixin(translate)

new Vue({
    el: '#product-page',
    components: {Reviews},
    store: store
})