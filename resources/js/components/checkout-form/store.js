import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        form: 'delivery',
        deliveryPrice: 1,
        selfPrice: 2,
        sendingPrice: 3,
        orderSum: 0,
        isValidForm: true,
        orderId: 0
    },
    getters: {
        deliveryPrice: (state) => {
            return state[`${state.form}Price`]
        },

        selectedForm(state) {
            return state.form
        },

        orderSum(state) {
            return state.orderSum
        },

        isValidForm(state) {
            return state.isValidForm
        },

        orderId(state) {
            return state.orderId
        }
    },
    mutations: {
        changeForm(state, form) {
            state.form = form
        },

        changeDeliveryPrice(state, price) {
            state.deliveryPrice = price
        },

        changeSelfPrice(state, price) {
            state.selfPrice = price
        },

        changeSendingPrice(state, price) {
            state.sendingPrice = price
        },

        changeOrderSum(state, sum) {
            state.orderSum = sum
        },

        changeIsValidForm(state, flag) {
            state.isValidForm = flag
        },

        changeOrderId(state, id) {
            state.orderId = id
        }
    },
    actions: {
        changeForm({commit}, form) {
            commit('changeForm', form)
        },

        changeDeliveryPrice(ctx, price) {
            ctx.commit('changeDeliveryPrice', price)
        },

        changeSelfPrice(ctx, price) {
            ctx.commit('changeSelfPrice', price)
        },

        changeSendingPrice(ctx, price) {
            ctx.commit('changeSendingPrice', price)
        },

        changeOrderSum(ctx, sum) {
            ctx.commit('changeOrderPrice', sum)
        },

        changeIsValidForm(ctx, flag) {
            ctx.commit('changeIsValidForm', flag)
        },

        changeOrderId(ctx, id) {
            ctx.commit('changeOrderId', id)
        }
    }
})

export default store
