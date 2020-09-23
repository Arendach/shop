<template>
  <div class="filter_type version_2">
    <h4>
      <a href="#manufacturers" data-toggle="collapse" class="opened collapsed">
        {{ translate('Виробник') }}
      </a>
    </h4>
    <div class="collapse show" id="manufacturers">
      <ul>
        <li v-for="manufacturer in manufacturers">
          <label class="container_check">
            {{ manufacturer.name }}
            <input type="checkbox" name="manufacturers[]" :value="manufacturer.id" :checked="checked(manufacturer.id)">
            <span class="checkmark"></span>
          </label>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import Url from "../../helpers/url";

export default {
  name: "manufacturer",
  props: ['manufacturers'],

  methods: {
    translate(text) {
      return text
    },

    checked(id) {
      let manufacturers = new Url().getParam('manufacturers')

      if (manufacturers === null){
        return false
      }

      return manufacturers.includes(id.toString())
    }
  }
}
</script>