var app = new Vue({
    el: "#app",

    data: {
        currentRestaurantId: "",
        dishes: [],
        cart: {
            KEY: 'cartContent-',
            contents: [],
            subtotal: 0
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

            // calcolo il totale
            this.calculateSubtotal();

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

            // calcolo il totale
            this.calculateSubtotal();

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

            // calcolo il totale
            this.calculateSubtotal();

            //update localStorage
            this.sync()
        },
        calculateSubtotal() {
            this.cart.subtotal = 0;
            for (var i = 0; i < this.cart.contents.length; i++) {
                this.cart.subtotal = this.cart.subtotal + this.cart.contents[i].quantity * this.cart.contents[i].unit_price;
                console.log(this.cart.subtotal);
            }
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

        // controllo se c'è qlc nel carrello in local storage
        let _contents = localStorage.getItem(this.cart.KEY + this.currentRestaurantId);
        if(_contents){
            this.cart.contents = JSON.parse(_contents);
            this.calculateSubtotal();
        }
    }
});
