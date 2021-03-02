import axios from 'axios';
import Chart from 'chart.js';

Chart.defaults.global.defaultFontSize = 18;
Chart.defaults.global.animation = 'linear';

var app = new Vue({
    el: "#app",
    data: {
        restaurants: [],
        totalOrders: [],
        datas: [],
        currentRestaurant: null,
        myChart: null,
        myNewChart: null,
        
    },

    computed: {
        userId: function () {
            return document.getElementById("user-id").value;
        },
    },

    methods: {

        changeRestaurant(event) {
            this.currentRestaurant = event.target.value;
            this.showStats((datas, newDatas) => {
                this.updateChart('myChart', datas)
                this.updateChart('myNewChart', newDatas)

            });
        },

        showStats(cb = ()=>{}) {
            let self = this;

            let totalGennaio = 42;
            let totalFebbraio = 56;
            let totalMarzo = 0;
            let totalAprile = 15;
            let totalMaggio = 34;
            let totalGiugno = 87;
            let totalLuglio = 63;
            let totalAgosto = 22;
            let totalSettembre = 88;
            let totalOttobre = 53;
            let totalNovembre = 24;
            let totalDicembre = 23;

            let totalOrdersGennaio = [];
            let totalOrdersFebbraio =  [];
            let totalOrdersMarzo = [];
            let totalOrdersAprile = [];
            let totalOrdersMaggio = [];
            let totalOrdersGiugno = [];
            let totalOrdersLuglio = [];
            let totalOrdersAgosto = [];
            let totalOrdersSettembre = [];
            let totalOrdersOttobre = [];
            let totalOrdersNovembre = [];
            let totalOrdersDicembre = [];

            axios.get('http://localhost:8000/api/completed-orders/' + self.userId)
                .then(response => {

                    this.totalOrders = response.data.results['ordini'];

                    let orders = this.totalOrders;

                    let userRestaurants = response.data.results['ristoranti'];

                    this.restaurants = userRestaurants;
                    if (this.currentRestaurant == null) {
                        this.currentRestaurant = this.restaurants[0].id
                        
                    }
                    
                    for (let index = 0; index < orders.length; index++) {

                        if (orders[index].restaurant_id == this.currentRestaurant) {
                            let price = parseFloat(orders[index].amount);

                            let date = dayjs(orders[index].created_at, 'YYYY-M-D  H:m').format('M');

                            /* se date corrisponde al numero mese di cui voglio il totale faccio l'operazione */
                            switch (date * 1) {
                                case 1:
                                    totalGennaio = totalGennaio + price;
                                    if (!totalOrdersGennaio.includes(orders[index].id)) {
                                        totalOrdersGennaio.push(orders[index].id);
                                    }
                                    break;
                                case 2:
                                    totalFebbraio = totalFebbraio + price;
                                    if (!totalOrdersFebbraio.includes(orders[index].id)) {
                                        totalOrdersFebbraio.push(orders[index].id);
                                    }
                                    break;
                                case 3:
                                    totalMarzo = totalMarzo + price;
                                    if (!totalOrdersMarzo.includes(orders[index].id)) {
                                        totalOrdersMarzo.push(orders[index].id);
                                    }
                                    break;
                                case 4:
                                    totalAprile = totalAprile + price;
                                    if (!totalOrdersAprile.includes(orders[index].id)) {
                                        totalOrdersAprile.push(orders[index].id);
                                    }
                                    break;
                                case 5:
                                    totalMaggio = totalMaggio + price;
                                    if (!totalOrdersMaggio.includes(orders[index].id)) {
                                        totalOrdersMaggio.push(orders[index].id);
                                    }
                                    break;
                                case 6:
                                    totalGiugno = totalGiugno + price;
                                    if (!totalOrdersGiugno.includes(orders[index].id)) {
                                        totalOrdersGiugno.push(orders[index].id);
                                    }
                                    break;
                                case 7:
                                    totalLuglio = totalLuglio + price;
                                    if (!totalOrdersLuglio.includes(orders[index].id)) {
                                        totalOrdersLuglio.push(orders[index].id);
                                    }
                                    break;
                                case 8:
                                    totalAgosto = totalAgosto + price;
                                    if (!totalOrdersAgosto.includes(orders[index].id)) {
                                        totalOrdersAgosto.push(orders[index].id);
                                    }
                                    break;
                                case 9:
                                    totalSettembre = totalSettembre + price;
                                    if (!totalOrdersSettembre.includes(orders[index].id)) {
                                        totalOrdersSettembre.push(orders[index].id);
                                    }
                                    break;
                                case 10:
                                    totalOttobre = totalOttobre + price;
                                    if (!totalOrdersOttobre.includes(orders[index].id)) {
                                        totalOrdersOttobre.push(orders[index].id);
                                    }
                                    break;
                                case 11:
                                    totalNovembre = totalNovembre + price;
                                    if (!totalOrdersNovembre.includes(orders[index].id)) {
                                        totalOrdersNovembre.push(orders[index].id);
                                    }
                                    break;
                                case 12:
                                    totalDicembre = totalDicembre + price;
                                    if (!totalOrdersDicembre.includes(orders[index].id)) {
                                        totalOrdersDicembre.push(orders[index].id);
                                    }
                                    break;
                            };
                        }
                        
                        this.datas = [totalGennaio, totalFebbraio, totalMarzo, totalAprile, totalMaggio, totalGiugno,
                            totalLuglio, totalAgosto, totalSettembre, totalOttobre, totalNovembre, totalDicembre];
                        
                        this.newDatas = [totalOrdersGennaio.length,
                        totalOrdersFebbraio.length,
                        totalOrdersMarzo.length,
                        totalOrdersAprile.length,
                        totalOrdersMaggio.length,
                        totalOrdersGiugno.length,
                        totalOrdersLuglio.length,
                        totalOrdersAgosto.length,
                        totalOrdersSettembre.length,
                        totalOrdersOttobre.length,
                        totalOrdersNovembre.length,
                        totalOrdersDicembre.length]
                        
                        }
                    
                    if (typeof cb === 'function') {
                        return cb(this.datas, this.newDatas)
                    }
                })
        },

        initChart(id, data) {
            var ctx = document.getElementById(id).getContext('2d');

            return new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
                    datasets: [{
                        label: 'Storico entrate',
                        data: data,
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
            
        },

        updateChart(id, datas) {
            if (id == 'myChart') {
                this.myChart.destroy()
                this.myChart = this.initChart(id, datas)
                
            } else {
                this.myNewChart.destroy()
                this.myNewChart = this.initChart(id, datas)
            }

        }
    },

    mounted() {

        console.log(this.userId);
        console.log(this.currentRestaurant);


        this.showStats((datas, newDatas) => {
            this.myChart = this.initChart('myChart', datas);
            this.myNewChart = this.initChart('myNewChart', newDatas);

        });
    },
});