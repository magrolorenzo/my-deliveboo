var app = new Vue({
    el: "#app",

    data: {
        currentRestaurantId: "",
        dishes: [],
        cart: {
            KEY: 'cartContent-',
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
                // se presente nel carrello
                if (this.cart.contents[i].id == newCartItem.id) {
                    // aggiungo la quantità
                    this.cart.contents[i].quantity++;
                    itemExists = true;
                }
            }

            // se non è nel carrello -> push
            if (!itemExists) {
                this.cart.contents.push(newCartItem);
            }

            // aggiorno il local storage
            this.sync();
        },
        decrease(dishObj) {
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

                    if (this.cart.contents[i].quantity == 1) {
                        // rimuovo il piatto dall'array
                        this.remove(newCartItem.id);
                    } else {
                        this.cart.contents[i].quantity--;
                    }

                    itemExists = true;
                }
            }

            this.sync();
        },
        remove(dish_id) {
            this.cart.contents = this.cart.contents.filter(item=>{
                if(item.id !== dish_id) {
                    return true;
                }
            });
        },
        sync() {
            // salvo nel localstorage
            let _cart = JSON.stringify(this.cart.contents);
            localStorage.setItem(this.cart.KEY + this.currentRestaurantId, _cart);
        },
        empty() {
            //remove an item entirely from CART.contents based on its id
            this.cart.contents = this.cart.contents.filter(item=>{
                return false;
            });

            //update localStorage
            this.sync()
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
            // console.log(self.dishes);
        });
    }
});
