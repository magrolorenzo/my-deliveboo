var app = new Vue({
    el: "#app",
    data: {
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
        }

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
                        this.remove(thisId);
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

    }
});


// ***
var button = document.querySelector('#submit-button');

braintree.dropin.create({
    // Insert your tokenization key here
    authorization: 'sandbox_q7sppc96_t2dv6mqb3mg6srfn',
    container: '#dropin-container'
}, function (createErr, instance) {
    button.addEventListener('click', function () {
        instance.requestPaymentMethod(function (requestPaymentMethodErr, payload) {
            // When the user clicks on the 'Submit payment' button this code will send the
            // encrypted payment information in a variable called a payment method nonce
            $.ajax({
                type: 'POST',
                url: '/checkout',
                data: {'paymentMethodNonce': payload.nonce}
            }).done(function(result) {
                // Tear down the Drop-in UI
                instance.teardown(function (teardownErr) {
                    if (teardownErr) {
                        console.error('Could not tear down Drop-in UI!');
                    } else {
                        console.info('Drop-in UI has been torn down!');
                        // Remove the 'Submit payment' button
                        $('#submit-button').remove();
                    }
                });
                
                if (result.success) {
                    $('#checkout-message').html('<h1>Success</h1><p>Your Drop-in UI is working! Check your <a href="https://sandbox.braintreegateway.com/login">sandbox Control Panel</a> for your test transactions.</p><p>Refresh to try another transaction.</p>');
                } else {
                    console.log(result);
                    $('#checkout-message').html('<h1>Error</h1><p>Check your console.</p>');
                }
            });
        });
    });
});


// Braintree
// var button = document.querySelector('#submit-button');
//
// braintree.dropin.create({
//     authorization: 'sandbox_g42y39zw_348pk9cgf3bgyw2b',
//     selector: '#dropin-container'
// }, function (err, instance) {
//     button.addEventListener('click', function () {
//         instance.requestPaymentMethod(function (err, payload) {
//             // Submit payload.nonce to your server
//         });
//     })
// });
