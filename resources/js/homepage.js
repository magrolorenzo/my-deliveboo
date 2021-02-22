// import Vue from "vue";
// window.onload = function(){

var app = new Vue({
    el: "#app",

    data: {
        categories: [],
        restaurants: [],
        selectedRestaurants: [],
        selectedCategories: [],
        url_base: "http://localhost:8000/storage/",
    },

    methods: {

        selectedCategory(category_id) {

            console.log("ID cateogria selezionata: " + category_id);
            console.log("Le categorie sono: " + this.selectedCategories);

            // Se la categoria selezionata è gia presente, deseleziono i risultati
            if (this.selectedCategories.includes(category_id)) {

                console.log("Categoria già selezionata, rimuvore dal filtro");

                // Rimuovo category_id dall'array dei filtri applicati
                this.selectedCategories = this.selectedCategories.filter(item => item !== category_id);
                console.log("Le categorie sono: " + this.selectedCategories);
                // Rimuovo i ristoranti che hanno SOLO la categoria deselezionata
                // this.restaurants = this.restaurants.filter(item => item.categories[0].id !== category_id);

                // Ciclo i ristoranti
                for (var i = 0; i < this.restaurants.length; i++) {
                    let res = this.restaurants[i];
                    let remove_restaurant = true;

                    // Ciclo gli obj categorie di ogniuno

                    for (var j = 0; j < res.categories.length; j++) {

                        let cat =  res.categories[j];

                        // Se la categoria attuale del ristorante è quella deselezionata
                        // if(cat.id == category_id){
                        //     remove_restaurant = true;
                        //     console.log("** Categoria trovata **");
                        // };
                        // E non ha altre categorie selezionate

                        if(this.selectedCategories.includes( cat.id )){
                            remove_restaurant = false;
                            console.log("*** Non rimuovere");
                        };
                    };

                    // rimuovo il ristorante dall'array
                    if(remove_restaurant){
                        console.log("Ristorante con ID " +res.id+ " rimosso");

                        this.restaurants.splice(i,1);

                        console.log(this.restaurants);
                    };
                };


                // Se non hai più categorie selezionate, mostra tutti i ristoranti
                if (this.selectedCategories.length == 0) {
                    console.log("Ripopolo la homepage con tutti i ristoranti");
                    axios.get("http://localhost:8000/api/restaurants").then(restaurants => {
                        let restaurant = restaurants.data.results;
                        this.restaurants = restaurant;
                    });
                };

            } else {
                /* se è la prima categoria selezionata, svuoto array
                e richiamo dati con chiamata all'api */
                if (this.selectedCategories.length == 0) {
                    this.restaurants = [];
                    axios.get("http://localhost:8000/api/filtered-restaurants/" + category_id).then(response => {
                        let restaurant = response.data.results;
                        this.restaurants = restaurant;
                        console.log(this.restaurants);
                    });

                } else {
                    /* se seleziono una categoria non presente
                    aggiungo i risultati ai dati precedenti */
                    axios.get("http://localhost:8000/api/filtered-restaurants/" + category_id).then(response => {
                        let restaurant = response.data.results;
                        for (let index = 0; index < this.restaurants.length; index++) {
                            restaurant = restaurant.filter(item => item.id !== this.restaurants[index].id);
                        }
                        this.restaurants = this.restaurants.concat(restaurant);
                        console.log(this.restaurants);
                    });
                }

                // Aggiunngo id della cateogria selezionata
                this.selectedCategories.push(category_id);
                console.log("Le categorie sono: " + this.selectedCategories);
            };

        },
        moveRight() {
            document.getElementById('cat').scrollLeft += 700;

        },
        moveLeft() {
            document.getElementById('cat').scrollLeft -= 700;
        }

    },

    // ***************** Mounted
    mounted() {

        // Carica tutte le categorie
        axios.get("http://localhost:8000/api/categories").then(categories => {
            let category = categories.data.results;
            this.categories = category;
        });

        // Carica tutti i ristoranti
        axios.get("http://localhost:8000/api/restaurants").then(restaurants => {
            let restaurant = restaurants.data.results;
            this.restaurants = restaurant;
            console.log(this.restaurants);
        });
    }
});
