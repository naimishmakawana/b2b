<!doctype html>
<html>

<head>
    <title>Legend Point Style</title>
    <script src="../../Chart.bundle.js"></script>
    <script src="../utils.js"></script>
    <style>
        canvas {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
        }
        .chart-container {
            width: 500px;
            margin-left: 40px;
            margin-right: 40px;
        }
        .container {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="chart-container">
            <canvas id="chart-legend-normal"></canvas>
        </div>
        <div class="chart-container">
            <canvas id="chart-legend-pointstyle"></canvas>
        </div>
    </div>
    <script>
        var color = Chart.helpers.color;
        function createConfig(colorName) {
            return {
                type: 'line',
                data: {
                    labels: ["January", "February", "March", "April", "May", "June", "July"],
                    datasets: [{
                        label: "My First dataset",
                        data: [
                            randomScalingFactor(), 
                            randomScalingFactor(), 
                            randomScalingFactor(), 
                            randomScalingFactor(), 
                            randomScalingFactor(), 
                            randomScalingFactor(), 
                            randomScalingFactor()
                        ],
                        backgroundColor: color(window.chartColors[colorName]).alpha(0.5).rgbString(),
                        borderColor: window.chartColors[colorName],
                        borderWidth: 1,
                        pointStyle: 'rectRot',
                        pointRadius: 5,
                        pointBorderColor: 'rgb(0, 0, 0)'
                    }]
                },
                options: {
                    responsive: true,
                    legend: {
                        labels: {
                            usePointStyle: false
                        }
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
                            }
                        }]
                    },
                    title: {
                        display: true,
                        text: 'Normal Legend'
                    }
                }
            };
        }

        function createPointStyleConfig(colorName) {
            var config = createConfig(colorName);
            config.options.legend.labels.usePointStyle = true;
            config.options.title.text = 'Point Style Legend';
            return config;
        }

        window.onload = function() {
            [{
                id: 'chart-legend-normal',
                config: createConfig('red')
            }, {
                id: 'chart-legend-pointstyle',
                config: createPointStyleConfig('blue')
            }].forEach(function(details) {
                var ctx = document.getElementById(details.id).getContext('2d');
                new Chart(ctx, details.config)
            })
        };
    </script>
</body>

</html>
