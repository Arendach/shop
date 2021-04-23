import Vue from 'vue';
import categoryFilter from "./category-filter";

new Vue({
    el: '#filter-wrapper',
    components: {
        categoryFilter
    }
})
let minPrice =  document.getElementById("min_price").value
let maxPrice =  document.getElementById("max_price").value
$(".js-range-slider").ionRangeSlider({
    type: "double",
    grid: true,
    min: minPrice,
    max: maxPrice,
    from: minPrice,
    to: maxPrice,
    step: 20,
    onChange: function (data) {
        console.log(data.from)
        document.getElementById("min_price").value = data.from
        document.getElementById("max_price").value = data.to
    }
});
