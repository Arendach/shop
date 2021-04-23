<template>
  <div>
    <div class="form-group">
      <label> <i class="text-danger">*</i> {{ translate('Магазин') }}</label>
      <select class="form-control form-control-sm" name="shop_id" v-model="shop_maps" required>
        <option hidden value="">{{ translate('Вибрати') }}</option>
        <option v-for="shop in shops" :value="shop.id">{{ `${shop.name} (${shop.address})` }}</option>
      </select>
      <div class="feedback"></div>
    </div>

    <div v-if="shop_maps == 1" class="alert alert-success">
      <a href="https://g.page/PayoneerUkraine?share">{{ translate('Подивитися на мапі') }}</a>
    </div>

    <div v-else-if="shop_maps == 2" class="alert alert-success">
      <a href="#">{{ translate('Подивитися на мапі') }}</a>
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
    shops: Array,
    shop_maps: ''
  },

  mounted() {
    this.changeSelfPrice(0)
  },

  methods: {
    ...mapActions(['changeSelfPrice']),
  }
}
</script>