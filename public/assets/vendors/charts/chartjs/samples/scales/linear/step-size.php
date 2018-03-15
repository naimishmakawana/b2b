<!doctype html>
<html>

<head>
    <title>Line Chart</title>
    <script src="../../../Chart.bundle.js"></script>
    <script src="../../utils.js"></script>
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
    <br>
    <br>
    <button id="randomizeData">Randomize Data</button>
    <button id="addDataset">Add Dataset</button>
    <button id="removeDataset">Remove Dataset</button>
    <button id="addData">Add Data</button>
    <button id="removeData">Remove Data</button>
    <script>
        var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        
        var randomScalingFactor = function() {
            return Math.round(Math.random() * 100);
        };

        var config = {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                    label: "My First dataset",
                    backgroundColor: window.chartColors.red,
                    borderColor: window.chartColors.red,
                    data: [
                        randomScalingFactor(), 
                        randomScalingFactor(), 
                        randomScalingFactor(), 
                        randomScalingFactor(), 
                        randomScalingFactor(), 
                        randomScalingFactor(), 
                        randomScalingFactor()
                    ],
                    fill: false,
                }, {
                    label: "My Second dataset",
                    fill: false,
                    backgroundColor: window.chartColors.blue,
                    borderColor: window.chartColors.blue,
                    data: [
                        randomScalingFactor(), 
                        randomScalingFactor(), 
                        randomScalingFactor(), 
                        randomScalingFactor(), 
                        randomScalingFactor(), 
                        randomScalingFactor(), 
                        randomScalingFactor()
                    ],
                }]
            },
            options: {
                responsive: true,
                title:{
                    display:true,
                    text:'Chart.js Line Chart'
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
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
                        ticks: {
                            min: 0,
                            max: 100,

                            // forces step size to be 5 units
                            stepSize: 5
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
