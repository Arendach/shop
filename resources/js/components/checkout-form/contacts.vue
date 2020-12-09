<template>
  <div class="col-lg-4 col-md-6">
    <div class="step first payments">
      <h3>{{ translate('1. Контактні дані') }}</h3>

      <h6 class="pb-2">{{ translate('Контакти') }}</h6>

      <div class="form-group">
        <label><i class="text-danger">*</i> {{ translate('Імя') }}</label>
        <input required class="form-control" name="first_name" :value="getCustomer('first_name')">
      </div>

      <div class="form-group">
        <label> {{ translate('Прізвище') }}</label>
        <input class="form-control" :value="getCustomer('last_name')" name="last_name">
      </div>

      <div class="form-group">
        <label><i class="text-danger">*</i> {{ translate('Номер телефону') }}</label>
        <input required class="form-control" :value="getCustomer('phone')" name="phone" data-mask="phone">
      </div>

      <div class="form-group">
        <label>{{ translate('Електронна пошта') }}</label>
        <input required type="email" class="form-control" :value="getCustomer('email')" name="email">
      </div>
      

      <div v-if="customer == null">

        <label class="container_radio">
            {{ translate('Створити новий аккаунт') }}
            <a href="#" data-toggle="modal" class="info"></a> <input type="radio" name="create_account" value="1" v-model="create_account" checked> <span class="checkmark"></span>
        </label>
        <label class="container_radio">
            {{ translate('Не створювати новий аккаунт') }}
            <a href="#" data-toggle="modal" class="info"></a> <input type="radio" name="create_account" value="0" v-model="create_account">
            <span class="checkmark"></span>
        </label>


        <div class="create_account" v-if="create_account == 1">
          <div class="form-group">
            <label><i class="text-danger">*</i> {{ translate('Пароль') }}</label>
            <input type="password" required class="form-control" name="password">
          </div>
          <div class="form-group">
            <label><i class="text-danger">*</i> {{ translate('Повторіть пароль') }}</label>
            <input type="password" required class="form-control" name="password_confirmation">
          </div>
        </div>

      </div>


    </div>
  </div>
</template>

<script>
import {mapGetters, mapActions} from 'vuex'


export default {
  name: "contacts",

  data() {
    return {
      first_name: null,
      last_name: null,
      email: null,
      create_account:1
    }
  },

  props: {
    customer: Object | null
  },

  methods: {
    getCustomer(field) {
      if (typeof this.customer !== 'object' || this.customer ==  null) {
        return null
      }

      return this.customer[field]
    }
  }
}
</script>