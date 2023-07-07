function find_lables(production_history) {
    let labels = [];
    let our_data = [];
    let found = false;

    // just for temporary filling ...
    let fun = [190, 250, 160, 225]; let fun_index = 0;

    let dd, temp;
    for (i = 0; i < 7; i++) {
        dd = new Date(Date.now() - (7 - i - 1) * 24 * 60 * 60 * 1000);
        dd = dd.toISOString().split('T')[0];
        labels.push(dd);

        found = false;
        for (let j in production_history) {
            temp = production_history[j];

            if (temp['date'] == dd) {
                our_data.push(parseInt(temp['production']));
                found = true;
                break;
            }
        }

        if (!found) {
            our_data.push(fun[(fun_index = fun_index + 1) % 4]);
        }
    }

    return {
        'labels': labels,
        'data': our_data
    }

}

function plot_this_chart(production_details) {

    let obj=find_lables(production_details);
    console.log(obj);

    // plot the graph....of the fetched data....

    var options = {
        series: [{
            name: 'Milk Production',
            data: obj['data']
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
            categories: obj['labels'],
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

    var chart = new ApexCharts(document.querySelector("#production_chart"), options);
    chart.render();
}
