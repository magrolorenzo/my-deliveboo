var app = new Vue({
    el: "#app",
    data: {
        dishes: [],
        url_base: "http://localhost:8000/storage/"
    },
    methods: {
        
    },
    mounted() {
        axios.get("http://localhost:8000/api/dishes").then(dishes => {
            let dish = dishes.data.results;
            this.dishes = dish;
        });
    }
});
