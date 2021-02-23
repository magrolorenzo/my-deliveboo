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
            /* se la categoria è stata selezionata la togli dall'array */
            if (this.selectedCategories.includes(category_id)) {
                this.selectedCategories = this.selectedCategories.filter(item => item !== category_id);
                this.restaurants = this.restaurants.filter(item => item.pivot.category_id !== category_id);
                if (this.restaurants.length == 0) {
                    axios.get("http://localhost:8000/api/restaurants").then(restaurants => {
                        let restaurant = restaurants.data.results;
                        this.restaurants = restaurant;
                    });
                }

            } else {
                /* se è la prima categoria selezionata svuoto array e richiamo dati con chiamata all'api */
                if (this.selectedCategories.length == 0) {
                    this.restaurants = [];
                    axios.get("http://localhost:8000/api/filtered-restaurants/" + category_id).then(response => {
                        let restaurant = response.data.results;
                        this.restaurants = restaurant;
                    });

                } else {
                    /* se seleziono una categoria non presente aggiungo i risultati ai dati precedenti */
                    axios.get("http://localhost:8000/api/filtered-restaurants/" + category_id).then(response => {
                        let restaurant = response.data.results;
                        for (let index = 0; index < this.restaurants.length; index++) {
                            restaurant = restaurant.filter(item => item.id !== this.restaurants[index].id);

                        }
                        this.restaurants = this.restaurants.concat(restaurant);

                    });
                }
                this.selectedCategories.push(category_id);
            }
        },
        rightClick() {
            document.getElementById('cat').scrollLeft += 700;
        },
        leftClick() {
            document.getElementById('cat').scrollLeft -= 700;
        }
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
