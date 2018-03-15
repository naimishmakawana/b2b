<!doctype html>
<html>

<head>
    <title>Suggested Min/Max Settings</title>
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
        var config = {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                    label: "My First dataset",
                    backgroundColor: window.chartColors.red,
                    borderColor: window.chartColors.red,
                    data: [10, 30, 39, 20, 25, 34, -10],
                    fill: false,
                }, {
                    label: "My Second dataset",
                    fill: false,
                    backgroundColor: window.chartColors.blue,
                    borderColor: window.chartColors.blue,
                    data: [18, 33, 22, 19, 11, 39, 30],
                }]
            },
            options: {
                responsive: true,
                title:{
                    display: true,
                    text: 'Grid Line Settings'
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            drawBorder: false,
                            color: ['pink', 'red', 'orange', 'yellow', 'green', 'blue', 'indigo', 'purple']
                        },
                        ticks: {
                            min: 0,
                            max: 100,
                            stepSize: 10
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
