<template>
  <div>
    <div class="filter_type version_2" v-for="(characteristic, index) in characteristics">
      <h4>
        <a :href="`#ch_filter_${characteristic.id }`"
           data-toggle="collapse"
           :class="isOpened(index) ? `opened collapsed` : 'closed'"
        >
          {{ characteristic.name }}
        </a>
      </h4>
      <div :class="isOpened(index) ? 'collapse show' : 'collapse'" :id="`ch_filter_${characteristic.id }`">
        <ul>
          <li v-for="pc in characteristic.values">
            <label class="container_check">
              {{ `${characteristic.prefix} ${pc.value} ${characteristic.postfix}` }}
              <input
                  type="checkbox"
                  :name="`characteristics[${characteristic.id}][]`"
                  :value="pc.value"
                  :checked="checked(characteristic.id, pc.value)"
              >
              <span class="checkmark"></span>
            </label>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import Url from "../../helpers/url"

export default {
  name: "characteristics",
  props: ['characteristics'],

  methods: {
    translate(text) {
      return text
    },

    checked(id, value) {
      let characteristics = new Url().getParam('characteristics', id)

      if (characteristics === null) {
        return false
      }

      return characteristics.includes(value)
    },

    isOpened(index) {
      return index < 3;
    }
  }
}
</script>