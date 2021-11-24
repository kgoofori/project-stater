<template>
	<div>
		<div class="card">
			<div class="card-header">
				<!-- Title -->
				<h4 class="card-header-title">Reservations</h4>
			</div>

			<div class="card-body">
				<div class="chart chart-appended">
					<canvas
						class="chart-canvas"
						id="trafficChart"
						data-toggle="legend"
						data-target="#trafficChartLegend"
					></canvas>
				</div>

				<div class="chart-legend" id="trafficChartLegend"></div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
    props: {
        chartData: {
            type: Array,
            default: () => [0,0,0]
        },
		chartLabels: {
            type: Array,
            default: () => ['','','']
        }
    },

	mounted() {
		new Chart("trafficChart", {
			type: "doughnut",
			options: {
                legend: {
                    display: true
                }
			},
			data: {
				labels: this.chartLabels,
				datasets: [
					{
						data: this.chartData,
						backgroundColor: ["#f6c343", "#2C7BE5",  "#e63757"],
					},
				],
			},
		});
	},
};
</script>

<style>
</style>