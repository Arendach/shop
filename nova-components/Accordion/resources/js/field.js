Nova.booting((Vue, router, store) => {
  Vue.component('index-accordion', require('./components/IndexField'))
  Vue.component('detail-accordion', require('./components/DetailField'))
  Vue.component('form-accordion', require('./components/FormField'))
})
