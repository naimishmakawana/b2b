<!doctype html>
<html>

<head>
    <title>Bubble Chart</title>
    <script src="../Chart.bundle.js"></script>
    <script src="utils.js"></script>
    <style type="text/css">
    canvas{
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
    </style>
</head>

<body>
    <div id="container" style="width: 75%;">
        <canvas id="canvas"></canvas>
    </div>
    <button id="randomizeData">Randomize Data</button>
    <button id="addDataset">Add Dataset</button>
    <button id="removeDataset">Remove Dataset</button>
    <button id="addData">Add Data</button>
    <button id="removeData">Remove Data</button>
    <script>
        var DEFAULT_DATASET_SIZE = 7;

        var addedCount = 0;
        var color = Chart.helpers.color;
        var bubbleChartData = {
            animation: {
                duration: 10000
            },
            datasets: [{
                label: "My First dataset",
                backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                borderColor: window.chartColors.red,
                borderWidth: 1,
                data: [{
                    x: randomScalingFactor(),
                    y: randomScalingFactor(),
                    r: Math.abs(randomScalingFactor()) / 5,
                }, {
                    x: randomScalingFactor(),
                    y: randomScalingFactor(),
                    r: Math.abs(randomScalingFactor()) / 5,
                }, {
                    x: randomScalingFactor(),
                    y: randomScalingFactor(),
                    r: Math.abs(randomScalingFactor()) / 5,
                }, {
                    x: randomScalingFactor(),
                    y: randomScalingFactor(),
                    r: Math.abs(randomScalingFactor()) / 5,
                }, {
                    x: randomScalingFactor(),
                    y: randomScalingFactor(),
                    r: Math.abs(randomScalingFactor()) / 5,
                }, {
                    x: randomScalingFactor(),
                    y: randomScalingFactor(),
                    r: Math.abs(randomScalingFactor()) / 5,
                }, {
                    x: randomScalingFactor(),
                    y: randomScalingFactor(),
                    r: Math.abs(randomScalingFactor()) / 5,
                }]
            }, {
                label: "My Second dataset",
                backgroundColor: color(window.chartColors.orange).alpha(0.5).rgbString(),
                borderColor: window.chartColors.orange,
                borderWidth: 1,
                data: [{
                    x: randomScalingFactor(),
                    y: randomScalingFactor(),
                    r: Math.abs(randomScalingFactor()) / 5,
                }, {
                    x: randomScalingFactor(),
                    y: randomScalingFactor(),
                    r: Math.abs(randomScalingFactor()) / 5,
                }, {
                    x: randomScalingFactor(),
                    y: randomScalingFactor(),
                    r: Math.abs(randomScalingFactor()) / 5,
                }, {
                    x: randomScalingFactor(),
                    y: randomScalingFactor(),
                    r: Math.abs(randomScalingFactor()) / 5,
                }, {
                    x: randomScalingFactor(),
                    y: randomScalingFactor(),
                    r: Math.abs(randomScalingFactor()) / 5,
                }, {
                    x: randomScalingFactor(),
                    y: randomScalingFactor(),
                    r: Math.abs(randomScalingFactor()) / 5,
                }, {
                    x: randomScalingFactor(),
                    y: randomScalingFactor(),
                    r: Math.abs(randomScalingFactor()) / 5,
                }]
            }]
        };

        window.onload = function() {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myChart = new Chart(ctx, {
                type: 'bubble',
                data: bubbleChartData,
                options: {
                    responsive: true,
                    title:{
                        display:true,
                        text:'Chart.js Bubble Chart'
                    },
                    tooltips: {
                        mode: 'point'
                    }
                }
            });
        };

        document.getElementById('randomizeData').addEventListener('click', function() {
            bubbleChartData.datasets.forEach(function(dataset) {
                dataset.data = dataset.data.map(function() {
                    return {
                        x: randomScalingFactor(),
                        y: randomScalingFactor(),
                        r: Math.abs(randomScalingFactor()) / 5,
                    };
                });
            });
            window.myChart.update();
        });

        var colorNames = Object.keys(window.chartColors);
        document.getElementById('addDataset').addEventListener('click', function() {
            ++addedCount;
            var colorName = colorNames[bubbleChartData.datasets.length % colorNames.length];;
            var dsColor = window.chartColors[colorName];
            var newDataset = {
                label: "My added dataset " + addedCount,
                backgroundColor: color(dsColor).alpha(0.5).rgbString(),
                borderColor: dsColor,
                borderWidth: 1,
                data: []
            };

            for (var index = 0; index < DEFAULT_DATASET_SIZE; ++index) {
                newDataset.data.push({
                    x: randomScalingFactor(),
                    y: randomScalingFactor(),
                    r: Math.abs(randomScalingFactor()) / 5,
                });
            }

            bubbleChartData.datasets.push(newDataset);
            window.myChart.update();
        });

        document.getElementById('addData').addEventListener('click', function() {
            if (bubbleChartData.datasets.length > 0) {
                for (var index = 0; index < bubbleChartData.datasets.length; ++index) {
                    bubbleChartData.datasets[index].data.push({
                        x: randomScalingFactor(),
                        y: randomScalingFactor(),
                        r: Math.abs(randomScalingFactor()) / 5,
                    });
                }

                window.myChart.update();
            }
        });

        document.getElementById('removeDataset').addEventListener('click', function() {
            bubbleChartData.datasets.splice(0, 1);
            window.myChart.update();
        });

        document.getElementById('removeData').addEventListener('click', function() {
            bubbleChartData.datasets.forEach(function(dataset, datasetIndex) {
                dataset.data.pop();
            });

            window.myChart.update();
        });
    </script>
</body>

</html>
