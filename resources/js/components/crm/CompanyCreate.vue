<template>
	<div>
		<div class="header">
			<div class="container-fluid">
				<!-- Body -->
				<div class="header-body">
					<div class="row align-items-end">
						<div class="col">
							<!-- Pretitle -->
							<h6 class="header-pretitle">Companies</h6>

							<!-- Title -->
							<h1
								class="header-title"
								v-text="editing ? newCompany.name : 'New Company'"
							></h1>
						</div>
						<div class="col-auto" v-if="newCompany.id">
							<a
								class="btn btn-success btn-sm"
								:href="
									vueHotelUrl(`reservations/create?company=${newCompany.id}`)
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

		<company-form :company="company" @doneProcessing="doneProcessing" />
	</div>
</template>

<script>
import CompanyForm from "./CompanyForm.vue"

export default {
	props: ["company"],
	components: {CompanyForm},

	data() {
		return {
			newCompany: {id: null},
			editing: false,
		};
	},

	created(){
		if(this.company.id){
			this.editing = true
		}
		this.newCompany = this.company;
	},


	methods: {
		doneProcessing(company){
			this.editing = false
			this.newCompany = company;
		},

		vueHotelUrl(url) {
			return hotelUrl(url);
		},
	},
};
</script>