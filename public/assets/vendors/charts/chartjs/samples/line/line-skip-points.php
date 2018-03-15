<!doctype html>
<html>

<head>
    <title>Line Chart</title>
    <script src="../../Chart.bundle.js"></script>
    <script src="../utils.js"></script>
    <style>
    canvas {
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
        var config = {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                    label: "My First dataset",
                    borderColor: window.chartColors.red,
                    fill: false,
                    // Skip a point in the middle
                    data: [
                        randomScalingFactor(), 
                        randomScalingFactor(), 
                        NaN, 
                        randomScalingFactor(), 
                        randomScalingFactor(), 
                        randomScalingFactor(), 
                        randomScalingFactor()
                    ],

                }, {
                    label: "My Second dataset",
                    borderColor: window.chartColors.blue,
                    fill: false,
                    // Skip first and last points
                    data: [
                        NaN, 
                        randomScalingFactor(), 
                        randomScalingFactor(), 
                        randomScalingFactor(), 
                        randomScalingFactor(), 
                        randomScalingFactor(), 
                        NaN
                    ],
                }]
            },
            options: {
                responsive: true,
                title:{
                    display:true,
                    text:'Chart.js Line Chart - Skip Points'
                },
                tooltips: {
                    mode: 'index',
                },
                hover: {
                    mode: 'index'
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
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        },
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
