var app = new Vue({
    el: "#app",
    data: {
        // Dati che voglio inviare alal rotta e/o Controller
        // array con dati cliente
        // array cart.contents
        errors: [],
        customer_name: "",
        customer_surname: "",
        customer_email: "",
        delivery_address: "",

        currentRestaurantId: "",

        dishes: [],
        cart: {
            KEY: 'cartContent-',
            contents: [],
            subtotal: 0
        },

        JSONCart: '',

    },

    methods: {

        getRestaurantId() {
            this.currentRestaurantId = document.getElementById("restaurant-id").innerHTML;
        },

        // Metodo per incrementare quantità di oggetti nel carrello
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

        // Metodo per diminuire quantità di oggetti nel carrello
        decrease(thisId) {

            let id = thisId;

            for (var i = 0; i < this.cart.contents.length; i++) {
                // se trovo l'id giusto entro nell'if
                if (this.cart.contents[i].id == id) {
                    // controllo la quantità -> se =1 rimuovo dall'array
                    if (this.cart.contents[i].quantity == 1) {
                        // rimuovo il piatto dall'array
                        this.remove(id);
                    } else {
                        // se !=1 riduco la quantità di 1
                        this.cart.contents[i].quantity--;
                    }
                }
                // se non trovo l'id non fa niente
            }

            // calcolo il totale
            this.calculateSubtotal();
            // aggiorno il local storage
            this.sync();
        },

        // Rimuove elemento dal carrello
        remove(dish_id) {
            this.cart.contents = this.cart.contents.filter(item=>{
                if(item.id !== dish_id) {
                    return true;
                }
            });
        },

        // Sincronizza Vue con LocalStorage
        sync() {
            // salvo nel localstorage
            let _cart = JSON.stringify(this.cart.contents);
            localStorage.setItem(this.cart.KEY + this.currentRestaurantId, _cart);
            this.JSONCart = _cart;
            // console.log(_cart);
            // console.log(this.JSONCart);
        },

        empty() {
            // svuota il carrello
            this.cart.contents = [];

            // calcolo il totale
            this.calculateSubtotal();

            // update localStorage
            this.sync();
        },

        // Ricalcola totale carrello
        calculateSubtotal() {
            this.cart.subtotal = 0;
            for (var i = 0; i < this.cart.contents.length; i++) {
                this.cart.subtotal = this.cart.subtotal + this.cart.contents[i].quantity * this.cart.contents[i].unit_price;
                // console.log(this.cart.subtotal);
            }
        },

        // Funzione di controllo degli input
        checkInput() {
            this.validateCheckout();

            this.priceCheck();
        },

        // controlla che non sia modificato il prezzo
        priceCheck() {
            console.log("in funzione check");

            let thisRestaurantDishes;

            // prendo tutti i piatti del ristorante
            axios.get("http://localhost:8000/api/dishes/" + this.currentRestaurantId).then(response => {
                console.log("in chiamata ajax");
                // mi salvo tutti i piatti del ristorante
                thisRestaurantDishes = response.data.results;
                console.log(thisRestaurantDishes);

                // prendo i dati dall'input nascosto e controllo che non sia stato cambiato il prezzo
                let currentInputCart = this.JSONCart;
                console.log("carrello di input modificato");
                console.log(currentInputCart);

                let currentInputArrayCart = JSON.parse(currentInputCart);
                console.log("carrello array modificato");
                console.log(currentInputArrayCart);


                let checkArray; // array di controllo -> se vuoto OK
                checkArray = currentInputArrayCart.filter((item) => {
                    let isCorrectPrice = false; // var appoggio se vera il prezzo è giusto
                    console.log("id del piatto in vue");
                    console.log(item.id);
                    // ciclo tutti i piatti del ristorante
                    thisRestaurantDishes.forEach((databaseItem, i) => {
                        console.log("piatto database id");
                        console.log(databaseItem.id);

                        if (item.id === databaseItem.id && item.unit_price === databaseItem.unit_price) {
                            isCorrectPrice = true;
                            console.log("sono uguali");
                        }
                    });

                    return !isCorrectPrice;
                });
                console.log(checkArray);

                // final check
                if (checkArray.length == 0) {
                    // array controllo vuoto -> ok : submit il form
                    console.log("ARRAY NON MODIFICATO");

                    // ricalcolo il totale
                    this.calculateSubtotal();

                } else {
                    // errore rigenera la pagina
                    this.errors.push('Attenzione! Ordine non effettuato!');
                }


            }); // fine chiamata di controllo
        },

        validateCheckout () {
            console.log("validateCheckout");
            this.errors = [];

            let chart = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

            var name = document.checkoutform.customer_name.value;
            var surname = document.checkoutform.customer_surname.value;
            var mail = document.checkoutform.customer_email.value;
            var address = document.checkoutform.delivery_address.value;


            if (!name) {
                this.errors.push('Attenzione! Inserisci il nome!');
            };

            if (!surname) {
                this.errors.push('Attenzione! Inserisci il cognome!');
            }

            if (!mail) {
                this.errors.push('Attenzione! Inserisci la tua email!');
            }
            else if (!chart.test(mail)) {
                this.errors.push('Attenzione! La mail deve avere un formato valido!');
            }

            if (!address) {
                this.errors.push('Attenzione! Inserisci un indirizzo di consegna!');
            }
        }

    },

    // ***************** Mounted
    mounted() {

        let self = this;

        // prendo l'id del ristorante
        self.getRestaurantId();

        let _contents = localStorage.getItem(this.cart.KEY + this.currentRestaurantId);
        if(_contents){
            this.cart.contents = JSON.parse(_contents);
            this.calculateSubtotal();
        }

        this.sync();
    }
});

// ***************************************** Braintree

// Copiato script in fondo alla  pagina index della repo di demo di braintree

var form = document.querySelector('#payment-form');
var client_token = document.getElementById("token").innerHTML;


braintree.dropin.create({
    authorization: client_token,
    selector: '#bt-dropin'

}, function (createErr, instance) {
    if (createErr) {
        console.log('Create Error', createErr);
        return;
    }
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        instance.requestPaymentMethod(function (err, payload) {
            if (err) {
                console.log('Request Payment Method Error', err);
                return;
            }

            // Add the nonce to the form and submit
            document.querySelector('#nonce').value = payload.nonce;
            form.submit();



        });
    });
});
