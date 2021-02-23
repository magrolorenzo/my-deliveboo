var app = new Vue({
    el: "#app",

    data: {
        contents: [],
        // restaurant: {{!!json_encode($restaurant->toArray())!!}}
        // nome: "{{ $restaurant->name }}"
        currentRestaurantName: "",
        dishes: [],
    },

    methods: {
        getRestaurantName() {
            this.currentRestaurantName = document.getElementById("restaurant-name").innerHTML;
        }
    },

    // ***************** Mounted
    mounted() {
        let self = this;
        // prendo nome di questo ristorante
        self.getRestaurantName();

        // prendo tutti i piatti del ristorante
        axios.get("http://localhost:8000/api/dishes").then(response => {
            let thisRestaurantDishes = response.data.results;

            self.dishes = thisRestaurantDishes;
            console.log(self.dishes);
        });
    }
});

// var nome = document.getElementsById("prova").innerHTML();
// // var restaurant = {!! json_encode($restaurant) !!};
// // var restaurant = @json($restaurant->toArray());
// // var restaurant = {{$restaurant->toJson()}}
//
// // var nome = "{{ $restaurant->name }}";
// // localStorage.setItem('myCat', 'Tom');
// // console.log(localStorage.getItem("myCat"));
// console.log(nome);
