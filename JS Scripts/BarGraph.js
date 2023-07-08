
function plot_bar_graph(dataset, target_element) {
    // plot the graph....of the fetched data....

    var options = {
        series: [{
            name: 'Milk Production',
            data: dataset['data']
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '20%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: dataset['labels'],
            title: {
                text: "Date"
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: ['#ffffff'],
                    fontSize: '14px',
                    fontFamily: 'poppins',
                    fontWeight: 400,
                    cssClass: 'apexcharts-xaxis-label'
                }
            },
            title: {
                text: 'Produces milk (litre)'
            }
        },
        fill: {
            opacity: 1,
            colors: ['#F44336', '#E91E63', '#9C27B0']
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + " liter"
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector(target_element), options);
    chart.render();
}
