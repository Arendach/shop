import Vue from 'vue';
import Vuelidate from "vuelidate";
import store from "./store";
import Checkout from "./checkout";
import translate from "../../mixins/translate"

Vue.mixin(translate)
Vue.use(Vuelidate)

new Vue({
    el: '#checkout-form-wrapper',
    components: {Checkout},
    store: store
})
