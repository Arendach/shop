<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div id="confirm">
          <div class="icon icon--order-success svg add_bottom_15">
            <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72">
              <g fill="none" stroke="#8EC343" stroke-width="2">
                <circle cx="36" cy="36" r="35"
                        style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
                <path d="M17.417,37.778l9.93,9.909l25.444-25.393"
                      style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0"></path>
              </g>
            </svg>
          </div>
          <h2>{{ translate("Замовлення №id оформлено", {id: orderId}) }}!</h2>
          <p>
            {{translate('Вам було відправлено СМС повідомлення') }}
            <br>
            {{ translate('Найближчим часом з вами звяжеться менеджер!') }}
            <br>
            {{ translate('Дякуємо що вибрали нас!') }}
            <br>

          </p>
          <div v-if="PayMethod == 'online'">
            {{ translate('Вы выбрали онлайн оплату. Нажмите на кнопку чтобы оплатить') }}
            <br>
            <a class="btn btn-success" :href="'create.pay?order_id=' + orderId">{{ translate('Оплатити') }}</a>
          </div>
          <p>
            <a class="btn btn-info m-3" href="/">
              {{ translate('На головну') }}
            </a>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {mapGetters} from 'vuex'

export default {
  name: "success-page",
  computed: mapGetters(['orderId','PayMethod']),
}
</script>