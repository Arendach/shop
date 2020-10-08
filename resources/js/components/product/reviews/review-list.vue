<template>
  <div>
    <div v-if="reviews.length">
      <div class="row justify-content-between" v-for="review in reviews">
        <div class="col-12">
          <div class="review_content">
            <div class="clearfix add_bottom_10">
              <span class="rating" v-html="review.stars"></span>
              <em>{{ translate('Опубліковано') }} {{ review.date }}</em>
            </div>
            <h4><i class="ti ti-user"></i> {{ review.customer.name }}</h4>
            <p>{{ review.comment }}</p>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-center" v-else>
      <div class="col-12">
        <h3 style="text-align: center" class="mt-5 mb-5">
          {{ translate('Для даного товару немає відгуків') }}
        </h3>
      </div>
    </div>
  </div>
</template>

<script>
import {mapGetters} from 'vuex'

export default {
  name: "review-list",

  computed: mapGetters(['reviews'])
}
</script>