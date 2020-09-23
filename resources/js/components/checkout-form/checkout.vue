<template>
  <form :action="data.url" id="checkout" @submit.prevent="sendForm" novalidate>
    <div class="row">
      <contacts :customer="data.customer"></contacts>

      <delivery :pay-methods="data.payMethods" :shops="data.shops" :products="data.products"></delivery>

      <cart :products="data.products"></cart>
    </div>
  </form>
</template>

<script>
import Contacts from './contacts'
import Delivery from './delivery'
import Cart from './cart'
import ShowErrors from "../../helpers/ShowErrors"
import Api from "../../helpers/api"
import {mapActions} from 'vuex'

export default {
  name: "checkout",
  components: {Contacts, Delivery, Cart},
  props: {
    data: Object
  },

  methods: {
    ...mapActions(['changeIsValidForm']),

    sendForm() {
      let form = document.getElementById('checkout')
      let data = new FormData(form).toObject()

      if (form.querySelector('.is-invalid')) {
        return this.changeIsValidForm(false)
      } else {
        this.changeIsValidForm(true)
      }

      Api.post(this.data.url, data).then((response) => {
        console.log(response)
      }).catch((response) => {
        this.changeIsValidForm(false)

        ShowErrors(form, response.body.errors)
      })
    }
  }
}
</script>