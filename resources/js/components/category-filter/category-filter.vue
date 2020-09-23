<template>
  <div class="filter_col">
    <form id="filter">
      <div class="inner_bt">
        <a href="#" class="open_filters">
          <i class="ti-close"></i>
        </a>
      </div>

      <price :max-price="data.maxPrice" :min-price="data.minPrice"></price>

      <manufacturer :manufacturers="data.manufacturers"></manufacturer>

      <characteristics :characteristics="data.characteristics"></characteristics>

      <div class="buttons">
        <a href="#" class="btn_1" rel="nofollow" @click="filter">
          {{ translate('Фільтр') }}
        </a>
        <a href="#" class="btn_1 gray" @click="reset">
          {{ translate('Скинути') }}
        </a>
      </div>
    </form>
  </div>

</template>

<script>
import Price from './price'
import Manufacturer from './manufacturer'
import Characteristics from './characteristics'
import Url from "../../helpers/url";

export default {
  name: "categoryFilter",
  props: {
    data: Object
  },
  components: {
    Price,
    Manufacturer,
    Characteristics
  },
  data() {
    return {}
  },
  methods: {
    translate(text) {
      return text
    },

    filter(event) {
      event.preventDefault()

      let form = document.getElementById('filter')

      let url = new Url()

      let params = url.paramsFromFormData(form)

      url.changeQueryString(params)


      console.log(params)
    },

    reset(event) {
      document.getElementById('filter').reset()

      this.filter(event)
    }
  }
}
</script>