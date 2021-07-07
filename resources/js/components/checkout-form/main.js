import Vue from 'vue';
import store from "./store";
import Checkout from "./checkout";
import translate from "../../mixins/translate"

Vue.mixin(translate)

new Vue({
    el: '#checkout-form-wrapper',
    components: {Checkout},
    store: store
})
