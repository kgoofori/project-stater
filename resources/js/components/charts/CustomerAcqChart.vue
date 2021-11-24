<template>
	<div>
		<div class="card">
			<div class="card-header">
				<!-- Title -->
				<h4 class="card-header-title">Customer Conversion</h4>

				<!-- Caption -->
				<!-- <span class="text-muted mr-3"> Show Companies: </span> -->

				<!-- Switch
				<div class="custom-control custom-switch">
					<input
						type="checkbox"
						class="custom-control-input"
						id="cardToggle"
						@change="toggleChart"
					/>
					<label class="custom-control-label" for="cardToggle"></label>
				</div> -->
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
		customersData: {
			type: Array,
			default: () => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
		},
		leadsData: {
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

	mounted() {
		this.chartJs = new Chart("salesChart", {
			type: "bar",
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
						label: "Leads",
						data: this.leadsData,
						backgroundColor: "#00d97e",
					},
					{
						label: "Customers",
						data: this.customersData,
						backgroundColor: "#2C7BE5",
						// hidden: true,
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