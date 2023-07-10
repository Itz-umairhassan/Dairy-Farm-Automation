function monthly_labels(production_history) {

    // let's print the name of previous seven months...
    let today = new Date();
    let labels = [];
    let data = [];
    let temp;
    let found = false;

    // just for temporary filling ...
    let fun = [190, 250, 160, 225]; let fun_index = 0;

    let month_names = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    for (let i = 6; i >= 0; i--) {
        let new_date = new Date(today.getFullYear(), today.getMonth() - i, 1);

        let name = month_names[new_date.getMonth()];

        console.log(name);
        labels.push(name);

        found = false;
        for (let j in production_history) {
            temp = production_history[j];

            if (temp['date'] == name) {
                data.push(parseInt(temp['milk']));
                found = true;
                break;
            }
        }

        if (!found) {
            data.push(fun[fun_index = (fun_index + 1) % 4]);
        }
    }


    return {
        'labels': labels,
        'data': data
    }
}

function daily_labels(production_history) {
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
                our_data.push(parseInt(temp['milk']));
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

function find_labels(production_history, interval) {

    if (interval == "days") {
        return daily_labels(production_history);
    }
    if (interval == "months") {
        return monthly_labels(production_history);
    }

}

function plot_this_chart(production_details) {

    let obj = find_lables(production_details);
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
