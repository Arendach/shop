<template>
  <div class="col-lg-4 col-md-6">
    <div class="step last">
      <h3>3. {{ translate('Товари') }}</h3>
      <div class="box_general summary">
        <ul>
          <li class="clearfix" v-for="product in products">
            <em>{{ product.amount }}x {{ product.name }}</em>
            <span>{{ product.amount * product.price }}</span>
          </li>
        </ul>
        <ul>
          <li class="clearfix">
            <em><strong>{{ translate('Вартість товарів') }}</strong></em>
            <span>{{ sum }}</span>
          </li>
          <li class="clearfix">
            <em><strong>{{ translate('Вартість доставки') }}</strong></em>
            
            <span>{{ deliveryPrice }}</span>
          </li>
        </ul>
        <div class="total clearfix">
          {{ translate('Сума') }}
          <span>{{ deliveryPrice + sum}}</span>
        </div>
        <button class="btn_1 full-width">
          {{ translate('Підтвердити') }}
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import {mapGetters} from 'vuex'

export default {
  name: "cart",

  props: {
    products: Array
  },

  data() {
    return {
      sum: 0
    }
  },

  computed: mapGetters(['deliveryPrice', 'isValidForm']),

  mounted() {
    this.products.map((product) => {
      this.sum += product.amount * product.price
    })
  },

  validations: {}
}
</script>