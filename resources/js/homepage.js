// import Vue from "vue";
// window.onload = function(){

var app = new Vue({
    el: "#app",
    data: {
        dishes: [],
        categories: [],
        restaurants: [],
        url_base: "http://localhost:8000/storage/"
    },
    methods: {
        selectedCategory(category_id) {
            axios.get("http://localhost:8000/api/restaurants", {
                params: {
                    category_id: category_id
                }
            }).then(restaurants => {
                let restaurant = restaurants.data.results;
                this.restaurants = restaurant;
                console.log(this.restaurants);
            });
        },

    },
    mounted() {
        axios.get("http://localhost:8000/api/dishes").then(dishes => {
            let dish = dishes.data.results;
            this.dishes = dish;
        });

        axios.get("http://localhost:8000/api/categories").then(categories => {
            let category = categories.data.results;
            this.categories = category;
        });

        axios.get("http://localhost:8000/api/restaurants").then(restaurants => {
            let restaurant = restaurants.data.results;
            this.restaurants = restaurant;
        });
    }
});
