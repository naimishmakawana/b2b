<!doctype html>
<html>

<head>
	<title>Line Chart with Custom Tooltips</title>
	<script src="../../Chart.bundle.js"></script>
	<script src="../utils.js"></script>
	<style>
		canvas{
			-moz-user-select: none;
			-webkit-user-select: none;
			-ms-user-select: none;
		}
		#chartjs-tooltip {
			opacity: 1;
			position: absolute;
			background: rgba(0, 0, 0, .7);
			color: white;
			border-radius: 3px;
			-webkit-transition: all .1s ease;
			transition: all .1s ease;
			pointer-events: none;
			-webkit-transform: translate(-50%, 0);
			transform: translate(-50%, 0);
		}

		.chartjs-tooltip-key {
			display: inline-block;
			width: 10px;
			height: 10px;
			margin-right: 10px;
		}
	</style>
</head>

<body>
	<div id="canvas-holder1" style="width:75%;">
		<canvas id="chart"/>
	</div>
	<script>
		Chart.defaults.global.pointHitDetectionRadius = 1;

		var customTooltips = function(tooltip) {
			// Tooltip Element
			var tooltipEl = document.getElementById('chartjs-tooltip');

			if (!tooltipEl) {
				tooltipEl = document.createElement('div');
				tooltipEl.id = 'chartjs-tooltip';
				tooltipEl.innerHTML = "<table></table>"
				document.body.appendChild(tooltipEl);
			}

			// Hide if no tooltip
			if (tooltip.opacity === 0) {
				tooltipEl.style.opacity = 0;
				return;
			}

			// Set caret Position
			tooltipEl.classList.remove('above', 'below', 'no-transform');
			if (tooltip.yAlign) {
				tooltipEl.classList.add(tooltip.yAlign);
			} else {
				tooltipEl.classList.add('no-transform');
			}

			function getBody(bodyItem) {
				return bodyItem.lines;
			}

			// Set Text
			if (tooltip.body) {
				var titleLines = tooltip.title || [];
				var bodyLines = tooltip.body.map(getBody);

				var innerHtml = '<thead>';

				titleLines.forEach(function(title) {
					innerHtml += '<tr><th>' + title + '</th></tr>';
				});
				innerHtml += '</thead><tbody>';

				bodyLines.forEach(function(body, i) {
					var colors = tooltip.labelColors[i];
					var style = 'background:' + colors.backgroundColor;
					style += '; border-color:' + colors.borderColor;
					style += '; border-width: 2px'; 
					var span = '<span class="chartjs-tooltip-key" style="' + style + '"></span>';
					innerHtml += '<tr><td>' + span + body + '</td></tr>';
				});
				innerHtml += '</tbody>';

				var tableRoot = tooltipEl.querySelector('table');
				tableRoot.innerHTML = innerHtml;
			}

			var position = this._chart.canvas.getBoundingClientRect();

			// Display, position, and set styles for font
			tooltipEl.style.opacity = 1;
			tooltipEl.style.left = position.left + tooltip.caretX + 'px';
			tooltipEl.style.top = position.top + tooltip.caretY + 'px';
			tooltipEl.style.fontFamily = tooltip._fontFamily;
			tooltipEl.style.fontSize = tooltip.fontSize;
			tooltipEl.style.fontStyle = tooltip._fontStyle;
			tooltipEl.style.padding = tooltip.yPadding + 'px ' + tooltip.xPadding + 'px';
		};

		var lineChartData = {
			labels: ["January", "February", "March", "April", "May", "June", "July"],
			datasets: [{
				label: "My First dataset",
				borderColor: window.chartColors.red,
				pointBackgroundColor: window.chartColors.red,
				fill: false,
				data: [
					randomScalingFactor(), 
					randomScalingFactor(), 
					randomScalingFactor(), 
					randomScalingFactor(), 
					randomScalingFactor(), 
					randomScalingFactor(), 
					randomScalingFactor()
				]
			}, {
				label: "My Second dataset",
				borderColor: window.chartColors.blue,
				pointBackgroundColor: window.chartColors.blue,
				fill: false,
				data: [
					randomScalingFactor(), 
					randomScalingFactor(), 
					randomScalingFactor(), 
					randomScalingFactor(), 
					randomScalingFactor(), 
					randomScalingFactor(), 
					randomScalingFactor()
				]
			}]
		};

		window.onload = function() {
			var chartEl = document.getElementById("chart");
			window.myLine = new Chart(chartEl, {
				type: 'line',
				data: lineChartData,
				options: {
					title:{
						display:true,
						text:'Chart.js Line Chart - Custom Tooltips'
					},
					tooltips: {
						enabled: false,
						mode: 'index',
						position: 'nearest',
						custom: customTooltips
					}
				}
			});
		};
	</script>
</body>

</html>
