<template>
  <div>
    <div class="form-group">
      <label> <i class="text-danger">*</i> {{ translate('Місто') }}</label>
      <v-select :clear-search-on-select="true" :options="cities" v-model="selectedCity" @search="getCities"
                @input="getWarehouses"></v-select>
      <div class="feedback"></div>
    </div>

    <div class="form-group">
      <label> <i class="text-danger">*</i> {{ translate('Відділення') }}</label>
      <select class="form-control form-control-sm"
              name="warehouse_id"
              :disabled="!warehouses.length"
              v-model="selectedWarehouse"
              @change="validateWarehouse"
      >
        <option v-for="warehouse in warehouses" :value="warehouse.id">
          {{ warehouse.name }}
        </option>
      </select>
      <div class="feedback text-danger" v-if="!isValidWarehouse">
        {{ notValidWarehouseMessage }}
      </div>
    </div>
  </div>
</template>

<script>

const sendingCity = document.getElementById('sending_city')

import {mapActions} from 'vuex'
import vSelect from 'vue-select'
import Api from "../../../helpers/api";

export default {
  name: "sending-form",

  components: {vSelect},

  props: {
    products: {
      type: Array
    }
  },

  data() {
    return {
      cities: [],
      selectedCity: {
        label: null,
        id: null
      },

      warehouses: [],
      selectedWarehouse: {},
      isValidWarehouse: true,
      notValidWarehouseMessage: ''
    }
  },

  mounted() {
    this.changeSendingPrice(300)

    this.getCities('А')
  },

  methods: {
    ...mapActions(['changeSendingPrice']),

    getCities(search) {
      if (!search.length) {
        return
      }

      Api.post('/api/new_post/search_cities', {search}).then((response) => {
        this.cities = []
        this.warehouses = []

        response.data.map(item => {
          this.cities.push({label: item.name, id: item.id, ref: item.ref})
        })
      })
    },

    getWarehouses(city) {
      if (!city) {
        return this.warehouses = []
      }

      Api.post('/api/new_post/get_warehouses', {city: city.id}).then(response => {
        this.warehouses = response.data
      }).then(() => {
        this.getPriceDelivery()
      })
    },

    getPriceDelivery() {
      let price = this.products.map(item => item.price).reduce((a, b) => parseFloat(a) + parseFloat(b), 0)
      let weight = this.products.map(item => item.weight).reduce((a, b) => parseFloat(a) + parseFloat(b), 0)

      Api.post('/catalog/order/new_post_price', {
        city: this.selectedCity.ref,
        price, weight
      }).then(response => {
        this.changeSendingPrice(response.price)
      })
    },

    validateWarehouse() {
      let weight = this.products.map(item => item.weight).reduce((a, b) => parseFloat(a) + parseFloat(b), 0)
      let maxAllowed = this.warehouses.filter(warehouse => warehouse.id == this.selectedWarehouse).shift().max_weight_all

      weight = 20

      if (maxAllowed !== 0 && weight >= maxAllowed) {
        this.isValidWarehouse = false
        this.notValidWarehouseMessage = `Маса посилки: ${weight} кг, Максимум: ${maxAllowed} кг`
      } else {
        this.isValidWarehouse = true
      }
    }
  }
}
</script>