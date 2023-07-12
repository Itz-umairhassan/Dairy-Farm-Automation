
function plot_pie(dataset) {
    console.log("PIE PLOT IS WORKING");
    var options = {
        series: [dataset['healthy'], dataset['unhealthy'], dataset['pg']],
        chart: {
            type: 'donut',
            responsive: false,
            maintainAspectRatio: false
        },
        labels: ['Healthy Animal', "Sick Animals", "Pregnant Animals"],
        dataLabels: {
            enabled: true
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#dd3"), options);
    chart.render();
}
