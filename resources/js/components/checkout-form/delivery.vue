<template>
  <div class="col-lg-4 col-md-6">
    <div class="step middle payments">
      <h3>{{ translate('2. Доставка і оплата') }}</h3>

      <h6 class="pb-2">{{ translate('Спосіб отримання') }}</h6>

      <ul>
        <li>
          <label class="container_radio">
            {{ translate('Доставка по місту') }}
            <a href="#0" class="info" data-toggle="modal" data-target="#payments_method"></a>
            <input type="radio" name="delivery" value="delivery" @change="changeForm('delivery')" checked>
            <span class="checkmark"></span>
          </label>
        </li>

        <li>
          <label class="container_radio">
            {{ translate('Самовивіз з магазину') }}
            <a href="#0" class="info" data-toggle="modal" data-target="#payments_method"></a>
            <input type="radio" name="delivery" value="self" @change="changeForm('self')">
            <span class="checkmark"></span>
          </label>
        </li>

        <li>
          <label class="container_radio">
            {{ translate('Відправка Новою Поштою') }}
            <a href="#0" class="info" data-toggle="modal" data-target="#payments_method"></a>
            <input type="radio" name="delivery" value="sending" @change="changeForm('sending')">
            <span class="checkmark"></span>
          </label>
        </li>

      </ul>

      <div id="delivery-container">
        <div class="delivery-form" v-if="selectedForm == 'delivery'">
          <delivery-form :prices="prices" ref="deliveryRef"></delivery-form>
        </div>

        <div class="delivery-form" v-if="selectedForm == 'self'">
          <self-form :prices="prices" ref="selfRef" :shops="shops"></self-form>
        </div>

        <div class="delivery-form" v-if="selectedForm == 'sending'">
          <sending-form :prices="prices" :products="products" ref="sendingRef"></sending-form>
        </div>
      </div>

      <hr>

      <h6 class="pb-2">{{ translate('Оплата') }}</h6>

      <ul>
        <li v-for="(payMethod, index) in payMethods" v-model="pay_method">
          <label class="container_radio">
            {{ translate(payMethod.name) }}
            <input type="radio" :value="payMethod.key" name="pay_method"  :checked="index == 0">
            <br><i class="text-sm" style="font-size: 12px;">{{ translate(payMethod.description) }}</i>
            <span class="checkmark"></span>
          </label>
        </li>
      </ul>
    </div>


  </div>
</template>

<script>

import DeliveryForm from './delivery/delivery-form'
import SelfForm from './delivery/self-form'
import SendingForm from './delivery/sending-form'
import {mapGetters, mapActions} from 'vuex'

export default {
  name: "delivery",

  components: {DeliveryForm, SelfForm, SendingForm},

  props: {
    payMethods: Array,
    shops: Array,
    products: Array,
    prices: Array
  },

  data() {
    return {
      form: 'delivery'
    }
  },

  computed: mapGetters(['selectedForm']),

  mounted() {

  },

  methods: mapActions(['changeForm'])
}
</script>