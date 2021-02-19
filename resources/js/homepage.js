// import Vue from "vue";
// window.onload = function(){

var app = new Vue({
    el: "#app",
    data: {
        dishes: [],
        categories: [],
        url_base: "http://localhost:8000/storage/"
    },
    methods: {
        selectedCategory() {
                console.log('provaaaa');
        },

    },
    mounted() {
        axios.get("http://localhost:8000/api/dishes").then(dishes => {
            let dish = dishes.data.results;
            this.dishes = dish;
            console.log("************************************");
        });

        axios.get("http://localhost:8000/api/categories").then(categories => {
            let category = categories.data.results;
            this.categories = category;
        });
    }
});

// }
