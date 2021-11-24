<template>
	<div>
		<div class="card">
			<div class="card-header">
				<!-- Title -->
				<h4 class="card-header-title">Bookings</h4>

				<!-- Caption -->
				<span class="text-muted mr-3"> Last year comparision: </span>

				<!-- Switch -->
				<div class="custom-control custom-switch">
					<input
						type="checkbox"
						class="custom-control-input"
						id="cardToggle"
						@change="toggleChart"
					/>
					<label class="custom-control-label" for="cardToggle"></label>
				</div>
			</div>

			<div class="card-body">
				<div class="chart">
					<canvas id="salesChart" class="chart-canvas"></canvas>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: {
		currentData: {
			type: Array,
			default: () => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
		},
		prevData: {
			type: Array,
			default: () => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
		},
	},
	data() {
		return {
			chartJs: null,
			currency: '',
		};
	},

	created(){
		this.currency = hotelCurrency();
	},

	mounted() {
		this.chartJs = new Chart("salesChart", {
			type: "bar",
			options: {
				scales: {
					yAxes: [
						{
							ticks: {
								callback: (value) =>  {
									return this.currency + ' ' + value/1000 + "k";
								},
								autoSkip: true,
								maxTicksLimit: 10,
							},
						},
					],
				},
			},
			data: {
				labels: [
					"Jan",
					"Feb",
					"Mar",
					"Apr",
					"May",
					"Jun",
					"Jul",
					"Aug",
					"Sept",
					"Oct",
					"Nov",
					"Dec",
				],
				datasets: [
					{
						label: "",
						data: this.currentData,
						backgroundColor: "#2C7BE5",
					},
					{
						label: "",
						data: this.prevData,
						backgroundColor: "#d2ddec",
						hidden: true,
					},
				],
			},
		});
	},

	methods: {
		toggleChart() {
			var dataset = this.chartJs.data.datasets[1];
			var isHidden = dataset.hidden;

			// Toggle dataset
			dataset.hidden = !isHidden;
			this.chartJs.update();
		},
	},
};
</script>

<style>
</style>