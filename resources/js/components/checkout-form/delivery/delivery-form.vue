<template>
  <div>
    <div class="form-group">
      <label> <i class="text-danger">*</i> {{ translate('Місто') }}</label>
      <input class="form-control form-control-sm" name="city" v-model="city" @blur="$v.city.$touch()">
      <div class="help-block">{{ translate('Київ або київська обл.') }}</div>
      <div class="feedback"></div>
    </div>

    <div class="form-group">
      <label> <i class="text-danger">*</i> {{ translate('Вулиця') }}</label>
      <input class="form-control form-control-sm" name="street" value="">
      <div class="feedback"></div>
    </div>

    <div class="form-group">
      <label>{{ translate('Адреса') }}</label>
      <input class="form-control form-control-sm" name="address" value="">
      <div class="feedback"></div>
    </div>

    <div class="form-group">
      <label>{{ translate('Бажана дата доставки') }}</label>
      <input class="form-control form-control-sm" name="date_delivery" type="date" value="">
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
import {mapActions, mapGetters} from 'vuex'
import {required} from 'vuelidate/lib/validators'

export default {
  name: "delivery-form",

  data() {
    return {
      timeDelivery: '12',
      times: [
        '00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11',
        '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23'
      ],
      city: null
    }
  },

  mounted() {
    this.calculateDeliveryPrice()
  },

  methods: {
    ...mapActions(['changeDeliveryPrice']),

    ...mapGetters(['orderSum']),

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
          this.changeDeliveryPrice(80)
        } else {
          this.changeDeliveryPrice(0)
        }
      }

      if (night.includes(this.timeDelivery)) {
        if (this.orderSum() < 1000) {
          this.changeDeliveryPrice(200)
        } else {
          this.changeDeliveryPrice(100)
        }
      }

      if (morning.includes(this.timeDelivery) || evening.includes(this.timeDelivery)) {
        if (this.orderSum() < 1000) {
          this.changeDeliveryPrice(100)
        } else {
          this.changeDeliveryPrice(70)
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