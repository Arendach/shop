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
          <div class="row">
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
  props: ['minPrice', 'maxPrice'],

  methods: {
    translate(text) {
      return text
    }
  }
}
</script>