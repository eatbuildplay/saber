/*
 * Student status pie chart
 */
 var ctx = document.getElementById('studentStatusReport').getContext('2d');
 var myPieChart = new Chart(ctx, {
   type: 'pie',
   data: {
    datasets: [{
      data: [10, 20, 30],
      backgroundColor: '#00BCD5'
    }],
    labels: [
      'Active',
      'Inactive',
      'Dormant'
    ]
  }
 });


/*
 * Student registration report
 */

var ctx = document.getElementById('studentsNewReport').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['February', 'April', 'May', 'June', 'July', 'August'],
        datasets: [{
            label: 'New Students',
            data: [9, 11, 17, 12, 3, 28],
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



/*
 * Student registration report
 */

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



/*
 * Course registration report
 */

var ctx = document.getElementById('courseRegistrationReport').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['February', 'April', 'May', 'June', 'July', 'August'],
        datasets: [{
            label: 'Active Course Registrations',
            data: [9, 11, 17, 12, 3, 28],
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


/*
 * Course start report
 */

var ctx = document.getElementById('courseStartReport').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['February', 'April', 'May', 'June', 'July', 'August'],
        datasets: [{
            label: 'Active Course Registrations',
            data: [9, 11, 17, 12, 3, 28],
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



var ctx = document.getElementById('courseLineReport').getContext('2d');
var chart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: [444, 555],
    datasets: [
      {
        data: [20, 10],
        label: "Africa",
        borderColor: "#3e95cd"
      }
    ]
  }
});
