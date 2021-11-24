<template>
	<div>
		<div class="card">
			<div class="card-header">
				<h4 class="card-header-title">Discounts</h4>
				<a
					href="#!"
					class="btn btn-sm btn-white"
					role="button"
					data-toggle="modal"
					data-target="#discountModal"
				>Add</a>
			</div>
			<div class="card-bod">
				<table class="table table-sm">
					<thead>
						<tr>
							<th>Rate</th>
							<th>Rate Type</th>
							<th>Start</th>
							<th>End</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(discount, index) in discounts" :key="index">
							<td>{{ discount.rate }}</td>
							<td>{{ discount.type }}</td>
							<td>{{ toDate(discount.start_date) }}</td>
							<td>{{ toDate(discount.end_date) }}</td>
							<td>
								<button
									class="btn btn-sm btn-light"
									@click="endDiscount(discount, index)"
									:disabled="processingForm"
								>
									<span
										class="spinner-border spinner-border-sm"
										role="status"
										aria-hidden="true"
										v-if="processingForm"
									></span>
									End Now
								</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<div class="modal fade" id="discountModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<new-discount-card :categoryId="categoryId" @discount-added="discountAdded"/>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import NewDiscountCard from './NewDiscountcard'

export default {
	components: {
		NewDiscountCard
	},
	props: {
		initialData: {
			type: Array,
		},
		categoryId: {
			type: String,
			required: true,
		},
	},
	data() {
		return {
			discounts: [],
			processingForm: false,
		};
	},

	created() {
		if (this.initialData) {
			this.discounts = this.initialData;
			
		}
	},

	methods: {
		toDate(date) {
			return new Date(date).toLocaleDateString();
		},

		discountAdded(discount){
			this.discounts.push(discount)
			$(".modal").modal("hide");
		},
		
		endDiscount(discount, index) {
			axios
				.delete(hotelUrl(`discounts/${discount.id}/end`))
				.then(({ data }) => {
					this.discounts.splice(index, 1);
					flash({ type: "success", message: data.message });
				})
				.catch(({ response }) => {
					flash({ type: "error", message: response.data.message });
				});
		},
	},
};
</script>

<style>
</style>