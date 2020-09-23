<template>
  <div class="col-lg-4 col-md-6">
    <div class="step first payments">
      <h3>{{ translate('1. Контактні дані') }}</h3>

      <h6 class="pb-2">{{ translate('Контакти') }}</h6>

      <div class="form-group">
        <label>* {{ translate('Імя') }}</label>
        <input required class="form-control" name="first_name" :value="getCustomer('first_name')">
      </div>

      <div class="form-group">
        <label>* {{ translate('Прізвище') }}</label>
        <input required class="form-control" :value="getCustomer('last_name')" name="last_name">
      </div>

      <div class="form-group">
        <label>{{ translate('Електронна пошта') }}</label>
        <input required type="email" class="form-control" :value="getCustomer('email')" name="email">
      </div>

      <div class="form-group">
        <label>* {{ translate('Номер телефону') }}</label>
        <input required class="form-control" :value="getCustomer('phone')" name="phone" data-mask="phone">
      </div>

      <div v-if="customer == null">
        <div class="form-group">
          <label>* {{ translate('Пароль') }}</label>
          <input type="password" required class="form-control" name="password">
        </div>

        <div class="form-group">
          <label>* {{ translate('Повторіть пароль') }}</label>
          <input type="password" required class="form-control" name="password_confirmation">
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: "contacts",

  data() {
    return {
      first_name: null,
      last_name: null,
      email: null
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