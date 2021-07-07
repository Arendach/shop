import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        reviews: [],
        customer: null,
        customerReview: null,
    },

    mutations: {
        addReview(state, review) {
            state.reviews.push(review)
        },

        setCustomerReview(state, customerReview) {
            state.customerReview = customerReview

            state.reviews = state.reviews.map(review => {
                return (review.customer.id == customerReview.customer.id) ? customerReview : review
            })
        },

        setCustomer(state, customer) {
            state.customer = customer
        }
    },

    getters: {
        reviews(state) {
            return state.reviews
        },

        customerReview(state) {
            return state.customerReview
        },

        customer(state) {
            return state.customer
        }
    },

    actions: {
        setReviews(ctx, reviews) {
            reviews.map(review => {
                ctx.commit('addReview', review)

                if (ctx.state.customer && review.customer.id == ctx.state.customer.id) {
                    ctx.commit('setCustomerReview', review)
                }
            })
        },

        addReview({commit}, review) {
            commit('addReview', review)
        },

        setCustomerReview({commit}, review) {
            commit('setCustomerReview', review)
        },

        setCustomer({commit}, customer) {
            commit('setCustomer', customer)
        }
    }
})

export default store