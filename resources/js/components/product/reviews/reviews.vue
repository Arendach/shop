<template>
  <div class="card-body">
    <review-list></review-list>

    <hr>

    <review-form :links="reviewsData.links" :product-id="reviewsData.productId"></review-form>
  </div>
</template>

<script>
import {mapActions} from 'vuex'
import ReviewForm from './review-form'
import ReviewList from './review-list'

export default {
  name: "reviews",

  components: {ReviewForm, ReviewList},

  props: {
    reviewsData: {
      type: Object,
      required: true
    }
  },

  methods: mapActions(['setReviews', 'setCustomerReview', 'setCustomer']),

  beforeMount() {
    this.setCustomer(this.reviewsData.customer)
    this.setReviews(this.reviewsData.reviews)
  }
}
</script>