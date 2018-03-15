<!doctype html>
<html>

<head>
    <title>Line Chart</title>
    <script src="../../Chart.bundle.js"></script>
    <script src="../utils.js"></script>
    <style>
    canvas{
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
    </style>
</head>

<body>
    <div style="width:75%;">
        <canvas id="canvas"></canvas>
    </div>
    <script>
        var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var config = {
            type: 'line',
            data: {
                xLabels: ["January", "February", "March", "April", "May", "June", "July"],
                yLabels: ['', 'Request Added', 'Request Viewed', 'Request Accepted', 'Request Solved', 'Solving Confirmed'],
                datasets: [{
                    label: "My First dataset",
                    data: ['', 'Request Added', 'Request Added', 'Request Added', 'Request Viewed', 'Request Viewed', 'Request Viewed'],
                    fill: false,
                    borderColor: window.chartColors.red,
                    backgroundColor: window.chartColors.red
                }]
            },
            options: {
                responsive: true,
                title:{
                    display:true,
                    text:'Chart with Non Numeric Y Axis'
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        type: 'category',
                        position: 'left',
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Request State'
                        },
                        ticks: {
                            reverse: true
                        }
                    }]
                }
            }
        };

        window.onload = function() {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myLine = new Chart(ctx, config);
        };
    </script>
</body>

</html>
