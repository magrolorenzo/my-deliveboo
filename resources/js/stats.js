import axios from 'axios';
import Chart from 'chart.js';
var app = new Vue({
    el: "#app",
    data: {
        totalGennaio: 42,
        totalFebbraio: 56,
        totalMarzo: 0,
        totalAprile: 151,
        totalMaggio: 345,
        totalGiugno: 87,
        totalLuglio: 63,
        totalAgosto: 22,
        totalSettembre: 88,
        totalOttobre: 53,
        totalNovembre: 24,
        totalDicembre: 23,

        totalOrdersGennaio: [],
        totalOrdersFebbraio: [],
        totalOrdersMarzo: [],
        totalOrdersAprile: [],
        totalOrdersMaggio: [],
        totalOrdersGiugno: [],
        totalOrdersLuglio: [],
        totalOrdersAgosto: [],
        totalOrdersSettembre: [],
        totalOrdersOttobre: [],
        totalOrdersNovembre: [],
        totalOrdersDicembre: [],
    },

    mounted() {

        axios.get('http://localhost:8000/api/completed-orders')
            .then(response => {
                let orders = response.data.results;
                console.log(orders);
                for (let index = 0; index < orders.length; index++) {

                    let price = parseFloat(orders[index].amount);

                    let date = dayjs(orders[index].created_at, 'YYYY-M-D  H:m').format('M');
                    console.log(date);

                    /* se date corrisponde al numero mese di cui voglio il totale faccio l'operazione */
                    switch (date*1) {
                        case 1:
                            this.totalGennaio = this.totalGennaio + price;
                            if (!this.totalOrdersGennaio.includes(orders[index].id)) {
                                this.totalOrdersGennaio.push(orders[index].id);
                            }
                            break;
                        case 2:
                            this.totalFebbraio = this.totalFebbraio + price;
                            if (!this.totalOrdersFebbraio.includes(orders[index].id)) {
                                this.totalOrdersFebbraio.push(orders[index].id);
                            }
                            break;
                        case 3:
                            this.totalMarzo = this.totalMarzo + price;
                            if (!this.totalOrdersMarzo.includes(orders[index].id)) {
                                this.totalOrdersMarzo.push(orders[index].id);
                            }
                            break;
                        case 4:
                            this.totalAprile = this.totalAprile + price;
                            if (!this.totalOrdersAprile.includes(orders[index].id)) {
                                this.totalOrdersAprile.push(orders[index].id);
                            }
                            break;
                        case 5:
                            this.totalMaggio = this.totalMaggio + price;
                            if (!this.totalOrdersMaggio.includes(orders[index].id)) {
                                this.totalOrdersMaggio.push(orders[index].id);
                            }
                            break;
                        case 6:
                            this.totalGiugno = this.totalGiugno + price;
                            if (!this.totalOrdersGiugno.includes(orders[index].id)) {
                                this.totalOrdersGiugno.push(orders[index].id);
                            }
                            break;
                        case 7:
                            this.totalLuglio = this.totalLuglio + price;
                            if (!this.totalOrdersLuglio.includes(orders[index].id)) {
                                this.totalOrdersLuglio.push(orders[index].id);
                            }
                            break;
                        case 8:
                            this.totalAgosto = this.totalAgosto + price;
                            if (!this.totalOrdersAgosto.includes(orders[index].id)) {
                                this.totalOrdersAgosto.push(orders[index].id);
                            }
                            break;
                        case 9:
                            this.totalSettembre = this.totalSettembre + price;
                            if (!this.totalOrdersSettembre.includes(orders[index].id)) {
                                this.totalOrdersSettembre.push(orders[index].id);
                            }
                            break;
                        case 10:
                            this.totalOttobre = this.totalOttobre + price;
                            if (!this.totalOrdersOttobre.includes(orders[index].id)) {
                                this.totalOrdersOttobre.push(orders[index].id);
                            }
                            break;
                        case 11:
                            this.totalNovembre = this.totalNovembre + price;
                            if (!this.totalOrdersNovembre.includes(orders[index].id)) {
                                this.totalOrdersNovembre.push(orders[index].id);
                            }
                            break;
                        case 12:
                            this.totalDicembre = this.totalDicembre + price;
                            if (!this.totalOrdersDicembre.includes(orders[index].id)) {
                                this.totalOrdersDicembre.push(orders[index].id);
                            }
                            break;
                    }; 
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
                            label: 'Storico entrate',
                            data:
                                [this.totalGennaio, this.totalFebbraio, this.totalMarzo, this.totalAprile, this.totalMaggio, this.totalGiugno,
                                    this.totalLuglio, this.totalAgosto, this.totalSettembre, this.totalOttobre, this.totalNovembre, this.totalDicembre],
                            backgroundColor: [
                                '#71dbd4',
                                '#FFAD00',
                                '#71dbd4',
                                '#FFAD00',
                                '#71dbd4',
                                '#FFAD00',
                                '#71dbd4',
                                '#FFAD00',
                                '#71dbd4',
                                '#FFAD00',
                                '#71dbd4',
                                '#FFAD00'
                            ],

                            borderWidth: 1,
                            borderColor: 'black'
                        }]
                        
                    },

                    options: {
                        title: {
                            display: true,
                            text: 'Storico entrate',
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
                            label: 'Storico vendite',
                            data: [5, 23, this.totalOrdersMarzo.length, 17, 54, 8, 35, 5, 44, 87, 12, 65],
                            backgroundColor: [
                                '#71dbd4',
                                '#FFAD00',
                                '#71dbd4',
                                '#FFAD00',
                                '#71dbd4',
                                '#FFAD00',
                                '#71dbd4',
                                '#FFAD00',
                                '#71dbd4',
                                '#FFAD00',
                                '#71dbd4',
                                '#FFAD00'
                            ],

                            borderWidth: 1,
                            borderColor: 'black'
                        }]
                        
                    },

                    options: {
                        title: {
                            display: true,
                            text: 'Storico vendite',
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

