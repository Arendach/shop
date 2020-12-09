<template>
  <div>
    <div class="form-group">
      <label> <i class="text-danger">*</i> {{ translate('Місто') }}</label>
      <input class="form-control form-control-sm" name="city" v-model="city" @blur="$v.city.$touch()">
      <div class="help-block">{{ translate('Київ або київська обл.') }}</div>
      <div class="feedback"></div>
    </div>

    <div v-if="(city=='Киев' || city=='Київ')">
      <div class="form-group">
        <label id="sending_streets">{{ translate('Вулиця') }}</label>
        <v-select :clear-search-on-select="true" :options="streets" v-model="selectedStreets" @search="getStreets"
                  ></v-select>
        <div class="feedback"></div>
        <input type="hidden" name="street" :value="selectedStreets.label">
      </div>


    </div>


    <div v-else class="form-group">
      <label> <i class="text-danger">*</i> {{ translate('Вулиця') }}</label>
      <input class="form-control form-control-sm" name="street">
      <div class="feedback"></div>
    </div>

    <div class="form-group">
      <label>{{ translate('Адреса') }}</label>
      <input class="form-control form-control-sm" name="address" value="">
      <div class="feedback"></div>
    </div>

    <div class="form-group">
      <label>{{ translate('Бажана дата доставки') }}</label>
      <input class="form-control form-control-sm" name="date_delivery" type="date">
      <div class="feedback"></div>
    </div>

    <div class="form-group">
      <label><i class="text-danger">*</i> {{ translate('Час доставки') }}</label>
      <select class="form-control form-control-sm" name="time" @change="setTimeDelivery">
        <option v-for="time in times" :value="time" :selected="time === timeDelivery">
          {{ `${time}:00` }}
        </option>
      </select>
      <div class="help-block">{{ translate('Градація в межах години') }}</div>
    </div>



  </div>
</template>


<script>
const sendingStreet = document.getElementById('sending_street')

import {mapActions, mapGetters} from 'vuex'
import vSelect from 'vue-select'
import Api from "../../../helpers/api";
import {required} from 'vuelidate/lib/validators'

export default {
  name: "delivery-form",

  components: {vSelect},
  props: {
    'prices': Array
 },
  data() {
    return {
      form:'delivery-form',
      streets: [],
      street_type: [],
      selectedStreets: {
        label: null,
        id: null,
        district: null,
        street_type: null
      },
      timeDelivery: '12',
      times: [
        '00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11',
        '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23'
      ],
      city: translate('Київ'),
    }
  },

  mounted() {
    this.calculateDeliveryPrice()

    this.getStreets('А')

  },
  methods: {


    ...mapActions(['changeDeliveryPrice']),
    ...mapGetters(['orderSum']),

    getStreets(search) {
      if (!search.length) {
        return
      }

      Api.post('/api/new_post/search_streets', {search}).then((response) => {
        this.streets = []
        this.street_type = []
        response.data.map(item => {
          this.streets.push({label: item.street_type + ' ' + item.name + ' (' + item.district + ')', id: item.id, district: item.district, street_type: item.street_type})
          this.street_type.push({label: item.treet_type})
        })
      })
    },
    setTimeDelivery(event) {
      this.timeDelivery = event.target.value

      this.calculateDeliveryPrice()
    },

    calculateDeliveryPrice() {
      let day = ['11', '12', '13', '14', '15', '16', '17', '18', '19', '20']
      let night = ['23', '00', '01', '02', '03', '04', '05', '06', '07', '08']
      let morning = ['09', '10']
      let evening = ['21', '22']


      if (day.includes(this.timeDelivery)) {
        if (this.orderSum() < 1000) {
          this.changeDeliveryPrice(this.prices.day_no_one)
        } else {
          this.changeDeliveryPrice(this.prices.day_one)
        }
      }

      if (night.includes(this.timeDelivery)) {
        if (this.orderSum() < 1000) {
          this.changeDeliveryPrice(this.prices.night_no_one)
        } else {
          this.changeDeliveryPrice(this.prices.night_one)
        }
      }

      if (morning.includes(this.timeDelivery) || evening.includes(this.timeDelivery)) {
        if (this.orderSum() < 1000) {
          this.changeDeliveryPrice(this.prices.morning_no_one)
        } else {
          this.changeDeliveryPrice(this.prices.morning_one)
        }
      }
    }
  },

  validations: {
    city: {required}
  }
}
</script>

<style>
.help-block {
  font-size: 14px;
  color: #9999
}
</style>