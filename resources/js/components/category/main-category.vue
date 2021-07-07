<template>
  <div>
    <category-description :datas="data.description" />
  </div>
</template>

<script>
import categoryDescription from './category-description-head'

export default {
  name: "main-category",

  data() {
    return {}
  },
  props: ['data'],
  components: {
    categoryDescription,
  }

}
</script>

<style>

</style>