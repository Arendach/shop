<template>
  <div>
    <div class="form-group">
      <label> <i class="text-danger">*</i> {{ translate('Магазин') }}</label>
      <select class="form-control form-control-sm" name="shop_id" required>
        <option hidden value="">{{ translate('Вибрати') }}</option>
        <option v-for="shop in shops" :value="shop.id">{{ `${shop.name} (${shop.address})` }}</option>
      </select>
      <div class="feedback"></div>
    </div>

    <div class="form-group">
      <label>{{ translate('Бажана дата отримання товару') }}</label>
      <input class="form-control form-control-sm" name="date_delivery" type="date">
      <div class="feedback"></div>
    </div>
  </div>
</template>

<script>

import {mapActions} from 'vuex'

export default {
  name: "self-form",

  props: {
    shops: Array
  },

  mounted() {
    this.changeSelfPrice(0)
  },

  methods: {
    ...mapActions(['changeSelfPrice']),
  }
}
</script>