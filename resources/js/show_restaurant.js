var app = new Vue({
    el: "#app",

    data: {
            contents: [],
            // restaurant: {{!!json_encode($restaurant->toArray())!!}}
            // nome: "{{ $restaurant->name }}"


    },

    methods: {
    },

    // ***************** Mounted
    mounted() {
        // console.log(this.nome);
    }
});

var nome = document.getElementsByClassName("text-capitalize")[0].innerHTML();
// var restaurant = {!! json_encode($restaurant) !!};
// var restaurant = @json($restaurant->toArray());
// var restaurant = {{$restaurant->toJson()}}

// var nome = "{{ $restaurant->name }}";
// localStorage.setItem('myCat', 'Tom');
// console.log(localStorage.getItem("myCat"));
console.log(nome);
