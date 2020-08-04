var ctx = document.getElementById('studentRegistrationReport').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: saberReportsData.totalStudentsReport.labels,
        datasets: [{
            label: 'Total Registered Students',
            data: saberReportsData.totalStudentsReport.data,
            backgroundColor: '#0066AA',
            borderColor: [
                '#333333',
                '#333333',
                '#333333',
                '#333333',
                '#333333',
                '#333333'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    //beginAtZero: true
                }
            }]
        }
    }
});
