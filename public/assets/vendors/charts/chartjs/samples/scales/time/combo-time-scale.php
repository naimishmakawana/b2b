<!doctype html>
<html>

<head>
	<title>Line Chart - Combo Time Scale</title>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
	<script src="../../../Chart.js"></script>
	<script src="../../utils.js"></script>
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
	<br>
	<br>
	<button id="randomizeData">Randomize Data</button>
	<button id="addDataset">Add Dataset</button>
	<button id="removeDataset">Remove Dataset</button>
	<button id="addData">Add Data</button>
	<button id="removeData">Remove Data</button>
	<script>
		var timeFormat = 'MM/DD/YYYY HH:mm';

		function newDateString(days) {
			return moment().add(days, 'd').format(timeFormat);
		}

		var color = Chart.helpers.color;
		var config = {
			type: 'bar',
			data: {
				labels: [
					newDateString(0), 
					newDateString(1), 
					newDateString(2), 
					newDateString(3), 
					newDateString(4), 
					newDateString(5), 
					newDateString(6)
				],
				datasets: [{
					type: 'bar',
					label: 'Dataset 1',
					backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
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
				}, {
					type: 'bar',
					label: 'Dataset 2',
					backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
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
				}, {
					type: 'line',
					label: 'Dataset 3',
					backgroundColor: color(window.chartColors.green).alpha(0.5).rgbString(),
					borderColor: window.chartColors.green,
					fill: false,
					data: [
						randomScalingFactor(), 
						randomScalingFactor(), 
						randomScalingFactor(), 
						randomScalingFactor(), 
						randomScalingFactor(), 
						randomScalingFactor(), 
						randomScalingFactor()
					],
				}, ]
			},
			options: {
                title: {
                    text:"Chart.js Combo Time Scale"
                },
				scales: {
					xAxes: [{
						type: "time",
						display: true,
						time: {
							format: timeFormat,
							// round: 'day'
						}
					}],
				},
			}
		};

		window.onload = function() {
			var ctx = document.getElementById("canvas").getContext("2d");
			window.myLine = new Chart(ctx, config);

		};

		document.getElementById('randomizeData').addEventListener('click', function() {
			config.data.datasets.forEach(function(dataset) {
				dataset.data = dataset.data.map(function() {
					return randomScalingFactor();
				});
			});

			window.myLine.update();
		});

		var colorNames = Object.keys(window.chartColors);
		document.getElementById('addDataset').addEventListener('click', function() {
			var colorName = colorNames[config.data.datasets.length % colorNames.length];
			var newColor = window.chartColors[colorName];
			var newDataset = {
				label: 'Dataset ' + config.data.datasets.length,
				borderColor: newColor,
				backgroundColor: color(newColor).alpha(0.5).rgbString(),
				data: [],
			};

			for (var index = 0; index < config.data.labels.length; ++index) {
				newDataset.data.push(randomScalingFactor());
			}

			config.data.datasets.push(newDataset);
			window.myLine.update();
		});

		document.getElementById('addData').addEventListener('click', function() {
			if (config.data.datasets.length > 0) {
				config.data.labels.push(newDateString(config.data.labels.length));

				for (var index = 0; index < config.data.datasets.length; ++index) {
					config.data.datasets[index].data.push(randomScalingFactor());
				}

				window.myLine.update();
			}
		});

		document.getElementById('removeDataset').addEventListener('click', function() {
			config.data.datasets.splice(0, 1);
			window.myLine.update();
		});

		document.getElementById('removeData').addEventListener('click', function() {
			config.data.labels.splice(-1, 1); // remove the label first

			config.data.datasets.forEach(function(dataset, datasetIndex) {
				config.data.datasets[datasetIndex].data.pop();
			});

			window.myLine.update();
		});
	</script>
</body>

</html>
