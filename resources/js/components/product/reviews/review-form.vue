<template>
  <div>
    <form @submit.prevent="submitHandler" id="product-create-review" v-if="!published">
      <input v-if="customerReview" type="hidden" name="id" :value="customerReview.id">
      <input type="hidden" name="product_id" :value="productId">

      <div class="rating_submit">
        <div class="form-group">
          <label class="d-block">
            <i class="text-danger">*</i>
            {{ translate('Рейтинг') }}
          </label>
          <span class="rating mb-0">
          <input v-model="rating" type="radio" class="rating-input" id="5_star" name="rating" value="5">
          <label for="5_star" class="rating-star"></label>
          <input v-model="rating" type="radio" class="rating-input" id="4_star" name="rating" value="4">
          <label for="4_star" class="rating-star"></label>
          <input v-model="rating" type="radio" class="rating-input" id="3_star" name="rating" value="3">
          <label for="3_star" class="rating-star"></label>
          <input v-model="rating" type="radio" class="rating-input" id="2_star" name="rating" value="2">
          <label for="2_star" class="rating-star"></label>
          <input v-model="rating" type="radio" class="rating-input" id="1_star" name="rating" value="1">
          <label for="1_star" class="rating-star"></label>
        </span>
        </div>
      </div>

      <div class="form-group">
        <label>{{ translate('Ваш відгук') }}</label>
        <textarea class="form-control" v-model="comment" style="height: 180px;" name="comment" id="comment"></textarea>
      </div>

      <button v-if="customer" class="btn_1" :disabled="rating == 0">
        {{ translate(customerReview ? 'Редагувати відгук' : 'Залишити відгук') }}
      </button>

      <span class="text-info"
            v-else
            v-html="translate(`Для написання відгуків необхідно <a href='link'>авторизуватись</a>`, {link: links.login})"
      ></span>
    </form>

    <div class="confirm-review" v-else>
      <div class="icon icon--order-success svg add_bottom_15">
        <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72">
          <g fill="none" stroke="#8EC343" stroke-width="2">
            <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
            <path d="M17.417,37.778l9.93,9.909l25.444-25.393"
                  style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
          </g>
        </svg>
      </div>
      <h2>{{ translate('Відгук прийнято') }}</h2>
      <p>{{ translate('Ваш відгук стане доступним для інших після провірки модератором') }}</p>
    </div>
  </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex'
import Api from "../../../helpers/api"

export default {
  name: "review-form",

  props: {links: Object, productId: Number},

  data() {
    return {
      published: false,
      rating: 0,
      comment: ''
    }
  },

  mounted() {
    if (this.customerReview) {
      this.rating = this.customerReview.rating
      this.comment = this.customerReview.comment
    }
  },

  computed: mapGetters(['customerReview', 'customer']),

  methods: {
    ...mapActions(['addReview', 'setCustomerReview']),

    submitHandler() {
      let form = document.getElementById('product-create-review')
      let data = new FormData(form).toObject()
      let url = this.customerReview ? this.links.updateReview : this.links.createReview
      Api.post(url, data).then(response => {
        this.published = true
        setTimeout(() => {
          this.published = false
        }, 5000)

        if (this.customerReview) {
          this.setCustomerReview(response.data)
        } else {
          this.addReview(response.data)
        }
      })
    }
  }
}
</script>