base_url = $('#base_url').val();

$(document).ready(function () {
    setTimeout(function () {
        load_dashboard();
    }, 2000);
});

function load_dashboard() {
    $.ajax({
        url: base_url + "Project/load_dashbaord",
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            line_chart(data.line);
            pie_chart(data.pie);
            projects_card(data.info, data.total);
        }
    });

}

function line_chart(data) {
    var chart = new ApexCharts(document.querySelector("#myChart"), {
        series: [{
            name: "Projects",
            data: data.values
        }],
        chart: {
            height: 300,
            type: 'line',
            zoom: {
                enabled: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'straight'
        },
        grid: {
            row: {
                colors: ['#f3f3f3', 'transparent'],
                opacity: 0.5
            },
        },
        xaxis: {
            categories: data.categories,
        }
    });
    chart.render();

    new Chart("myChart", {
        type: "pie",
        data: {
            datasets: [{
                backgroundColor: data.colors,
                data: data.values
            }],
            labels: data.categories,
        }
    });
}

function pie_chart(data) {
    new Chart("salesChart", {
        type: "pie",
        data: {
            datasets: [{
                backgroundColor: data.colors,
                data: data.values
            }],
            labels: data.categories,
        }
    });
}

function projects_card(data, total) {

    for (let key in data) {
        $('.dashboard-donut-chart').append(creat_progress(key, data));
    }
    $('.dashboard-donut-chart').append(`
    <div class="progressBar">
        <span>Total</span>
        <span>${total['total']}</span>
        <div class="progress">
            <div class="progress-bar progress-bar_com" role="progressbar" style="width:100%">
            </div>
        </div>
    </div>
`);
}

function creat_progress(i, data) {
    let progress = `
        <div class="progressBar">
            <span>${i}</span>
            <span>${data[i]}%</span>
            <div class="progress">
                <div class="progress-bar progress-bar_${progress_class(data[i])}" role="progressbar" style="width:${data[i]}%">
                </div>
            </div>
        </div>
    `;
    return progress;
}

function progress_class(val) {
    switch (true) {
        case (val <= 10):
            return "10";
        case (val <= 20):
            return "20";
        case (val <= 40):
            return "40";
        case (val <= 60):
            return "60";
        case (val <= 80):
            return "80";
        default:
            return "com";
    }
}


