var app = new Vue({
    el: "#app",
    data: {
        restaurants: [],
        selectedRestaurantId: 0,
        orders: []
    },
    methods: {
        getUserId() {
            let userId = document.getElementById("user-id").value;

            return userId;
        },
        getAllOrders() {
            this.orders = [];
            let allRestaurant = this.restaurants;
            // console.log(allRestaurant);
            let allOrders = [];

            allRestaurant.forEach((currentRest) => {
                let thisRestaurantOrders = currentRest.orders;
                if (thisRestaurantOrders.length != 0) {
                    allOrders = allOrders.concat(thisRestaurantOrders);
                }
            });

            this.orders = allOrders;
        },
        filterOrders(event) {
            // console.log(event.target.value);
            this.selectedRestaurantId = event.target.value;
        }
    },
    mounted() {
        let self = this;

        let userId = self.getUserId();
        // console.log(userId);

        axios.get('http://localhost:8000/api/user-orders/' + userId).then((response) => {
            let userRestaurants = response.data.results.userRestaurant;
            // console.log(userRestaurants);
            self.restaurants = userRestaurants;
            self.getAllOrders();
            // console.log(self.orders);
        })


    }
});
