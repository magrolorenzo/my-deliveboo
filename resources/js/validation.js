var app = new Vue ({
    el:'#errors-root',
    data : {
        errors : [],
        name : null,
        address : null,
        pIva : null,
        maxChars : 11
    },
    methods : {
        validateForm(e) {

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
                this.errors.push('la partiva iva deve essere di 11 caratteri!')
            }

            e.preventDefault();
        }
    },
});
