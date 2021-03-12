var app = new Vue({
    el: "#app",

    data: {
        categories: [],
        selectedCategories: [],
        restaurants: [],
        url_base: "http://localhost:8000/storage/"
    },

    methods: {

        // Metodo per ricaricare tutti i ristoranti
        loadRestaurants(){
            axios.get("http://localhost:8000/api/restaurants").then((response) => {
                let all_restaurants = response.data.results;
                this.restaurants = all_restaurants;
            });
        },

        // Metodo per svuotare i filtri categorie
        clearCategories(){
            if (this.selectedCategories.length > 0) {
                this.selectedCategories = [];
                this.restaurants = [];
                this.loadRestaurants();
            };
        },

        // Metodo per filtrare i ristoranti con click su bottone categoria
        selectedCategory(category_id) {

            // Se la categoria non è presente, aggiungo ristoranti
            if (!this.selectedCategories.includes(category_id)) {

                // Se è la prima categoria selezionata, svuoto array e faccio chiamata ajax
                if (this.selectedCategories.length == 0) {

                    axios.get("http://localhost:8000/api/filtered-restaurants/" + category_id).then((response) => {
                        let selected_restaurants = response.data.results;
                        this.restaurants = [];
                        this.restaurants = selected_restaurants;
                        this.selectedCategories.push(category_id);
                    });

                } else {
                    // Altrimenti aggiungo i nuovi ristoranti filtrati nell array
                    axios.get("http://localhost:8000/api/filtered-restaurants/" + category_id).then((response) => {
                        let selected_restaurants = response.data.results;
                        for (let index = 0; index < this.restaurants.length; index++) {
                            // Se un ristorante con più categorie è già presente, non lo riaggungo
                            selected_restaurants = selected_restaurants.filter(item => item.id !== this.restaurants[index].id);
                        }
                        this.selectedCategories.push(category_id);
                        this.restaurants = this.restaurants.concat(selected_restaurants);
                    });
                }

            } else {

                // Array di salvataggio ID ristoranti da eliminare
                let res_id = [];

                // Rimuovo category_id dall'array dei filtri applicati
                this.selectedCategories = this.selectedCategories.filter(item => item !== category_id);

                // Rimuovo i ristoranti che non hanno categorie filtrate
                for (var i = 0; i < this.restaurants.length; i++) {

                    let res = this.restaurants[i];
                    let remove_restaurant = true;

                    // Ciclo gli obj categorie di ogni ristorante
                    for (var j = 0; j < res.categories.length; j++) {

                        let cat =  res.categories[j];
                        if(this.selectedCategories.includes( cat.id )){
                            remove_restaurant = false;
                        };
                    };

                    if(remove_restaurant){
                        res_id.push(res.id);
                    };
                };

                // rimuovo i ristoranti dall'array
                this.restaurants = this.restaurants.filter(item => !res_id.includes(item.id));

                // Se non hai più categorie selezionate, mostra tutti i ristoranti
                if (this.restaurants.length == 0) {
                    this.loadRestaurants();
                };

            }; // Chiusura else

        }, // Chiusura metodo per filtrare categorie

        moveRight() {
            if (window.matchMedia("(max-width: 768px)").matches) {
                document.getElementById('cat').scrollLeft += 85;
            }

            document.getElementById('cat').scrollLeft += 150;

        },
        moveLeft() {
            if (window.matchMedia("(max-width: 768px)").matches) {
                document.getElementById('cat').scrollLeft -= 85;
            }
            document.getElementById('cat').scrollLeft -= 150;
        }

    },

    // ***************** Mounted *****************
    mounted() {

        // Carica tutte le categorie
        axios.get("http://localhost:8000/api/categories").then((response) => {
            let all_categories = response.data.results;
            this.categories = all_categories;
        });

        // Carica tutti i ristoranti
        axios.get("http://localhost:8000/api/restaurants").then((response) => {
            let all_restaurants = response.data.results;
            this.restaurants = all_restaurants;
        });
    }
});
