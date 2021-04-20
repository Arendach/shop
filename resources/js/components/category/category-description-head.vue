<template>
  <div>
    <div v-html="datas"></div>
  </div>
</template>

<script>
export default {
  name: "category-description-head",
  data() {
    return {
    }
  },
  props:[
      'datas'
  ]
}
</script>

<style>

</style>