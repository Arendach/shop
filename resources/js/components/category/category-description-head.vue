<template>
  <div>
    <h1>Category Description</h1>
    <h2>{{ description }}</h2>
  </div>
</template>

<script>
export default {
  name: "category-description-head",
  props:{
    data: {
      type: String,
      default: translate("Описание отсутствует")
    }
  }
}
</script>

<style>

</style>