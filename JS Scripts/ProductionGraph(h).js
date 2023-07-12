function get_labels(production_history) {
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

function Line_Graph_Load(production_history) {
    
    let obj = get_labels(production_history);

    let config = {
        type: "line",
        data: {
            labels: obj['labels'], //["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Sales ($)",
                fill: true,
                borderColor: '#0288d1',
                backgroundColor: "transparent",
                data: obj['data'], //[2115, 1562, 1584, 1892, 1487, 2223, 2966, 2448, 2905, 3838, 2917, 3327]
            }]//, //{
            //     label: "Orders",
            //     fill: true,
            //     backgroundColor: "transparent",
            //     borderColor: "#66bb6a",
            //     borderDash: [4, 4],
            //     data: [958, 724, 629, 883, 915, 1214, 1476, 1212, 1554, 2128, 1466, 1827]
            // }]
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            tooltips: {
                intersect: false
            },
            hover: {
                intersect: true
            },
            plugins: {
                filler: {
                    propagate: false
                }
            },
            scales: {
                xAxes: [{
                    reverse: true,
                    gridLines: {
                        color: "rgba(0,0,0,0.05)"
                    }
                }],
                yAxes: [{
                    ticks: {
                        stepSize: 500
                    },
                    display: true,
                    borderDash: [5, 5],
                    gridLines: {
                        color: "rgba(0,0,0,0)",
                        fontColor: "#fff"
                    }
                }]
            }
        }
    }
    // new Chart($("#dummy"), config);
    new Chart($("#dd3"), config);
}
