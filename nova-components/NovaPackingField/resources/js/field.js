Nova.booting((Vue, router, store) => {
  Vue.component('index-nova-packing-field', require('./components/IndexField'))
  Vue.component('detail-nova-packing-field', require('./components/DetailField'))
  Vue.component('form-nova-packing-field', require('./components/FormField'))
})
