import Chart from 'chart.js';
var app = new Vue({
    el: "#app",
    data: {

    },

    mounted() {
        var ctx = document.getElementById('myChart').getContext('2d');

        Chart.defaults.global.defaultFontSize = 18;

        Chart.defaults.global.animation = 'linear';
        
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
                datasets: [{
                    label: 'Vendite mensili',
                    data: [12, 19, 131, 43, 242, 112, 87, 5, 94, 43, 27, 32,],
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
                    text: 'Storico Vendite Mensili',
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

        })
    } 
});

