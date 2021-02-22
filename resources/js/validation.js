var app = new Vue ({
    el:'#errors-root',
    data : {
        errors : [],
        name : null,
        address : null,
        pIva : null,
        maxChars : 11,
        price : null,
        restaurant_id : null
    },
    methods : {
        validateForm : function(e) {

            //svuota array
            this.errors = [];

            //campi non vuoti
            if(!this.name) {
                this.errors.push('inserisci nome!');
            }

            if(!this.address) {
                this.errors.push('inserisci indirizzo!');
            }

            if(!this.pIva) {
                this.errors.push('inserisci partita iva!');
            }

            if(this.pIva.length < this.maxChars) {
                this.errors.push('la partiva iva deve essere di ' + this.maxChars +' caratteri!')
            }

            e.preventDefault();
        },

        validateDish : function(e) {

            //svuota array
            this.errors = [];

            //campi non vuoti
            if(!this.name) {
                this.errors.push('inserisci nome!');
            }

            if(this.price < 0.01 || this.price > 1000) {
                this.errors.push('prezzo non valido');
            }

            if(!this.restaurant_id){
                this.errors.push('seleziona il ristorante!');
            }

            e.preventDefault();
        }
    },
});
