var app = new Vue({
    el: "#app",

    data: {
        contents: [],
        // restaurant: {{!!json_encode($restaurant->toArray())!!}}
        // nome: "{{ $restaurant->name }}"
        currentRestaurantId: "",
        dishes: [],
    },

    methods: {
        getRestaurantId() {
            this.currentRestaurantId = document.getElementById("restaurant-id").innerHTML;
        }
    },

    // ***************** Mounted
    mounted() {
        let self = this;

        // prendo l'id del ristorante
        self.getRestaurantId();

        // prendo tutti i piatti del ristorante
        axios.get("http://localhost:8000/api/dishes/" + self.currentRestaurantId).then(response => {
            let thisRestaurantDishes = response.data.results;


            self.dishes = thisRestaurantDishes;
            console.log(self.dishes);
        });
    }
});
