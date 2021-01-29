<template>
  <div class="filter_type version_2">
    <h4>
      <a href="#price" data-toggle="collapse" class="opened collapsed">
        {{ translate('Ціна') }}
      </a>
    </h4>
    <div class="collapse show" id="price">
      <ul>
        <li>
            <input type="hidden" class="form-control form-control-sm" id="min_price_def" name="min_price_def" :value="minPrice_def ? minPrice_def : 0">
            <input type="hidden" class="form-control form-control-sm" id="max_price_def" name="max_price_def" :value="maxPrice_def ? maxPrice_def : 0">
              <input type="hidden" class="form-control form-control-sm" id="min_price" name="min_price" :value="minPrice">
              <input type="hidden" class="form-control form-control-sm" id="max_price" name="max_price" :value="maxPrice">
          <div v-if="valueView == 2" class="row">
            <div class="col-12">
              <input type="text" class="js-range-slider" name="my_range" value="" />
            </div>
          </div>
          <div v-if="valueView == 1" class="row">
            <div class="col-6">
              <label>{{ translate('Від') }}:</label>
              <input type="text" class="form-control form-control-sm" name="min_price" :value="minPrice">
            </div>
            <div class="col-6">
              <label>{{ translate('До') }}:</label>
              <input type="text" class="form-control form-control-sm" name="max_price" :value="maxPrice">
            </div>

          </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>

export default {
  name: "price",
  props: ['minPrice', 'maxPrice','valueView'],

  methods: {
    translate(text) {
      return text
    }
  }
}

</script>