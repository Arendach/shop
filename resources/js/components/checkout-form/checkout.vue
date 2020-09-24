<template>
  <div>
    <form :action="data.url" id="checkout" @submit.prevent="sendForm" novalidate v-if="orderId == 0">
      <div class="row">
        <contacts :customer="data.customer"></contacts>

        <delivery :pay-methods="data.payMethods" :shops="data.shops" :products="data.products"></delivery>

        <cart :products="data.products"></cart>
      </div>
    </form>

    <success-page v-if="orderId != 0"></success-page>
  </div>
</template>

<script>
import Contacts from './contacts'
import Delivery from './delivery'
import Cart from './cart'
import SuccessPage from './success-page'
import ShowErrors from "../../helpers/ShowErrors"
import Api from "../../helpers/api"
import {mapActions, mapGetters} from 'vuex'

export default {
  name: "checkout",
  components: {Contacts, Delivery, Cart, SuccessPage},
  props: {
    data: Object
  },

  computed: {
    ...mapGetters(['orderId'])
  },

  methods: {
    ...mapActions(['changeIsValidForm', 'changeOrderId']),

    sendForm() {
      let form = document.getElementById('checkout')
      let data = new FormData(form).toObject()

      Api.post(this.data.url, data).then((response) => {
        this.changeOrderId(response.orderId)
      }).catch((response) => {
        this.changeIsValidForm(false)

        ShowErrors(form, response.body.errors)
      })
    }
  }
}
</script>