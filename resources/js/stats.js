import axios from 'axios';
import Chart from 'chart.js';
var app = new Vue({
    el: "#app",
    data: {
        totalGennaio: 0,
        totalOrders: []
    },

    mounted() {

        axios.get('http://localhost:8000/api/completed-orders')
            .then(response => {
                let orders = response.data.results;
                console.log(orders);
                for (let index = 0; index < orders.length; index++) {
                    let price = parseFloat(orders[index].unit_price * orders[index].quantity);

                    this.totalGennaio = this.totalGennaio + price;
                    console.log(this.totalGennaio);

                    if (!this.totalOrders.includes(orders[index].order_id)) {
                        this.totalOrders.push(orders[index].order_id)
                    }
                    
                }

                console.log(this.totalOrders);

                                                                            /* grafico guadagno mensile */
                
                var ctx = document.getElementById('myChart').getContext('2d');

                Chart.defaults.global.defaultFontSize = 18;

                Chart.defaults.global.animation = 'linear';
                
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
                        datasets: [{
                            label: 'Vendite mensili',
                            data: [this.totalGennaio, 19, 131, 43, 242, 112, 87, 5, 94, 43, 27, 32],
                            backgroundColor: [
                                '#71dbd4',
                                '#D0EB99',
                                '#71dbd4',
                                '#D0EB99',
                                '#71dbd4',
                                '#D0EB99',
                                '#71dbd4',
                                '#D0EB99',
                                '#71dbd4',
                                '#D0EB99',
                                '#71dbd4',
                                '#D0EB99'
                            ],

                            borderWidth: 1,
                            borderColor: 'black'
                        }]
                        
                    },

                    options: {
                        title: {
                            display: true,
                            text: 'Guadagni totali per mese',
                            fontSize: 30
                        },

                        legend: {
                            display: false
                        },

                        animation: {
                            duration: 1000,
                            easing: 'linear'
                        },
                        layout: {
                            padding: {
                                left: 0,
                                right: 0,
                                top: 50,
                                bottom: 0
                            }
                        }
                    }

                });

            /* grafico totale ordini */
                
                var newCtx = document.getElementById('myNewChart').getContext('2d');

                Chart.defaults.global.defaultFontSize = 18;

                Chart.defaults.global.animation = 'linear';
                
                var myNewChart = new Chart(newCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
                        datasets: [{
                            label: 'Vendite mensili',
                            data: [this.totalOrders.length, 5, 23, 17, 54, 8, 35, 5, 44, 87, 12, 65],
                            backgroundColor: [
                                '#71dbd4',
                                '#D0EB99',
                                '#71dbd4',
                                '#D0EB99',
                                '#71dbd4',
                                '#D0EB99',
                                '#71dbd4',
                                '#D0EB99',
                                '#71dbd4',
                                '#D0EB99',
                                '#71dbd4',
                                '#D0EB99'
                            ],

                            borderWidth: 1,
                            borderColor: 'black'
                        }]
                        
                    },

                    options: {
                        title: {
                            display: true,
                            text: 'Vendite totali per mese',
                            fontSize: 30
                        },

                        legend: {
                            display: false
                        },

                        animation: {
                            duration: 1000,
                            easing: 'linear'
                        },
                        layout: {
                            padding: {
                                left: 0,
                                right: 0,
                                top: 50,
                                bottom: 0
                            }
                        }
                    }

                });
        })

    } 
});

