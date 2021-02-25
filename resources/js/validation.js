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
                this.errors.push('Attenzione! la partita iva deve essere un numero di almeno 11 caratteri!');
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
        }
    },
    mounted() {

    }
});
