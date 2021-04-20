<template>
  <div>Описание:
    {{ category.description }}
<!--    <category-description :data="categoryDescription"/>-->
  </div>
</template>

<script>
import categoryDescription from './category-description-head'

export default {
  name: "main-category",

  data() {
    return {
      category: JSON.parse(this.data)
    }
  },
  props: ['data'],
  components: {
    categoryDescription,
  },
  methods: {
    categoryDescription() {
      return this.category.description
    }
  }

}
</script>

<style>

</style>