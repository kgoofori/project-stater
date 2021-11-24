<template>
	<div>
		<div class="header">
			<div class="container-fluid">
				<!-- Body -->
				<div class="header-body">
					<div class="row align-items-end">
						<div class="col">
							<!-- Pretitle -->
							<h6 class="header-pretitle">Customers</h6>

							<!-- Title -->
							<h1
								class="header-title"
								v-text="editing ? newCustomer.full_name : 'New Customer'"
							></h1>
						</div>
						<div class="col-auto" v-if="newCustomer.id">
							<a
								class="btn btn-success btn-sm"
								:href="
									vueHotelUrl(`reservations/create?customer=${newCustomer.id}`)
								"
								>Make Reservation</a
							>
						</div>
					</div>
					<!-- / .row -->
				</div>
				<!-- / .header-body -->
			</div>
		</div>
		<!-- / .header -->

		<customer-from :customer="customer" @processed="doneProcessing" />
	</div>
</template>

<script>
import CustomerFrom from "./CustomerForm.vue"

export default {
	props: ["customer"],
	components: {CustomerFrom},

	data() {
		return {
			newCustomer: {id: null},
			editing: false,
		};
	},

	created(){
		if(this.customer.id){
			this.editing = true
		}
		this.newCustomer = this.customer;
	},


	methods: {
		doneProcessing(customer){
			this.editing = false
			this.newCustomer = customer;
			
		},

		vueHotelUrl(url) {
			return hotelUrl(url);
		},
	},
};
</script>