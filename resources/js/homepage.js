// import Vue from "vue";
// window.onload = function(){

var app = new Vue({
    el: "#app",
    data: {
        dishes: [],
        categories: [],
        restaurants: [],
        selectedRestaurants: [],
        selectedCategories: [],
        url_base: "http://localhost:8000/storage/"
    },
    methods: {
        selectedCategory(category_id) {
            this.selectedCategories.push(category_id);
            this.restaurants = [];
            axios.get("http://localhost:8000/api/filtered-restaurants/" + category_id).then(restaurants => {
                let restaurant = restaurants.data.results;
                this.restaurants = restaurant;
                // console.log(this.restaurants);
                console.log(this.selectedCategories);
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
