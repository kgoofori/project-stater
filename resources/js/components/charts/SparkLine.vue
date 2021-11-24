<template>
	<div>
		<div class="chart chart-sparkline">
			<canvas class="chart-canvas" id="sparklineChart" ref="canvas"></canvas>
		</div>
	</div>
</template>

<script>
export default {
	props: {
		chartData: {
			type: Array,
			default: () => [50, 80, 60, 55, 65],
		},
	},
	mounted() {
		let context = this.$refs.canvas.getContext("2d");
		new Chart(context, {
			type: "line",
			options: {
				scales: {
					yAxes: [
						{
							display: false,
						},
					],
					xAxes: [
						{
							display: false,
						},
					],
				},
				elements: {
					line: {
						borderWidth: 2,
						borderColor: "#2C7BE5",
					},
					point: {
						hoverRadius: 0,
					},
				},
				tooltips: {
					custom: function () {
						return false;
					},
				},
			},
			data: {
				labels: new Array(this.chartData.length),
				datasets: [
					{
						data: this.chartData,
					},
				],
			},
		});
	},
};
</script>

<style>
</style>