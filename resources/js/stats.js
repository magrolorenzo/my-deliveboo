import axios from 'axios';
import Chart from 'chart.js';
var app = new Vue({
    el: "#app",
    data: {
        totalFebbraio: 0,
        totalOrders: []
    },

    mounted() {

        axios.get('http://localhost:8000/api/completed-orders')
            .then(response => {
                let orders = response.data.results;
                console.log(orders);
                for (let index = 0; index < orders.length; index++) {
                    let price = parseFloat(orders[index].unit_price * orders[index].quantity);

                    if (date == 2) {
                        this.totalFebbraio = this.totalFebbraio + price;
                        
                    }

                    if (!this.totalOrders.includes(orders[index].order_id)) {
                        this.totalOrders.push(orders[index].order_id)
                    }
                    
                    let date = dayjs(orders[index].created_at, 'YYYY-M-D  H:m').format('M');
                    console.log(date);
                }



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
                            data: [19, this.totalFebbraio, 131, 43, 242, 112, 87, 5, 94, 43, 27, 32],
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
                            data: [5, this.totalOrders.length, 23, 17, 54, 8, 35, 5, 44, 87, 12, 65],
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

