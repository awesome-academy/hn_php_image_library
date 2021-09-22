function loadUploadChart() {
    $.ajax({
        type: "POST",
        data: {
            'api_token': $('#api_token').val(),
        },
        url: $('#chart_api').val(),
        success: function (response) {
            let data = {
                labels: response.labels,
                datasets: [
                    {
                        label: response.description,
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        data: response.images
                    }
                ]
            }
            let barChartCanvas = $('#barChart').get(0).getContext('2d')
            let barChartData = $.extend(true, {}, data)
            barChartData.datasets[0] = data.datasets[0]

            let barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 50
                        }
                    }]
                }
            }

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })
        }
    })
}

$(document).ready(function () {
    loadUploadChart();
})
