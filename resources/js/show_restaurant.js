var app = new Vue({
    el: "#app",

    data: {
        currentRestaurantId: "",
        dishes: [],
        cart: {
            KEY: 'bkasjbdfkjasdkfjhaksdfjskd',
            contents: []
        }
    },

    methods: {
        getRestaurantId() {
            this.currentRestaurantId = document.getElementById("restaurant-id").innerHTML;
        },
        add(dishObj) {
            let id = dishObj.id;
            let name = dishObj.name;
            let unit_price = dishObj.unit_price;

            let newCartItem = {
                id,
                name,
                unit_price,
                quantity: 1
            }

            let itemExists = false;
            for (var i = 0; i < this.cart.contents.length; i++) {

                if (this.cart.contents[i].id == newCartItem.id) {
                    this.cart.contents[i].quantity++;
                    itemExists = true;
                }
            }

            if (!itemExists) {
                this.cart.contents.push(newCartItem);
            }

            
            console.log(newCartItem);
            console.log(this.cart.contents);
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
