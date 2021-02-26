var app = new Vue ({
    el:'#errors-root',
    data : {
        errors : [],
        minChars : 11


    },
    methods : {

        validateForm(){

            this.errors = [];

            var name = document.testform.name.value;
            var address = document.testform.address.value;
            var piva = document.testform.piva.value;


            if (!name) {
                this.errors.push('Attenzione! Inserisci il nome del ristorante!');
            }

            if (!address) {
                this.errors.push('Attenzione! Inserisci l\'indirizzo del ristorante!');
            }

            if(!piva || piva.length < this.minChars || isNaN(piva)) {
                this.errors.push('Attenzione! la partita iva deve essere un numero di almeno 11 cifre!');
            }

            if (!document.querySelector('form[name="testform"] input[name="categories[]"]:checked')) {
                this.errors.push('Attenzione! Seleziona almeno una categoria!');
            }

        },

        validateDish(){

            this.errors = [];

            var name = document.dishform.name.value;
            var price = document.dishform.unit_price.value;
            var restaurant = document.dishform.restaurant_id.value;

            if (!name) {
                this.errors.push('Attenzione! Inserisci il nome del ristorante!');
            };

            if (!restaurant) {
                this.errors.push('Attenzione! Seleziona un ristorante!');
            }

            if (!price || price < 0.01 || price > 999.99) {
                this.errors.push('Attenzione! il prezzo deve essere compreso tra 0.01 e e 999.99 €');
            }
        },

        validateCheckout () {

            this.errors = [];

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
            } else if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.mail)) {
                this.errors.push('Attenzione! La mail deve avere un formato valido!');
            }

            if (!address) {
                this.errors.push('Attenzione! Inserisci un indirizzo di consegna!');
            }
        }
    },
    mounted() {

    }
});
