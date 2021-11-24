<template>
	<div class="card">
		<div class="card-header">Add Discount</div>
		<div class="card-body">
			<!--  discount box-->
			<form>
				<div class="discount-box mb-3">
					<div class="row">
						<div class="col-12 col-md-6">
							<!-- Start discount -->
							<div class="form-group">
								<!-- Label -->
								<label>Discount</label>

								<!-- Input -->
								<input
									type="number"
									:class=" (errors.has('discount')? 'is-invalid ': '')  + 'form-control'"
									name="discount"
									v-model.number="formData.discount"
									@change="errors.clear('discount')"
								/>
								<span class="invalid-feedback" role="alert" v-if="errors.has('discount')">
									<strong>{{ errors.get('discount') }}</strong>
								</span>
							</div>
						</div>

						<div class="col-12 col-md-6">
							<div class="form-group">
								<!-- Label -->
								<label>Discount Type</label>

								<!-- Select -->
								<select
									:class=" (errors.has('rate_type')? 'is-invalid ': '')  + 'custom-select'"
									name="rate_type"
									v-model="formData.rate_type"
									@change="errors.clear('rate_type')"
								>
									<option value="">Please Select</option>
									<option>FLAT</option>
									<option>PERCENTAGE</option>
								</select>
								<span class="invalid-feedback" role="alert" v-if="errors.has('rate_type')">
									<strong>{{ errors.get('rate_type') }}</strong>
								</span>
							</div>
						</div>

						<div class="col-12 col-md-6">
							<!-- Start date -->
							<div class="form-group">
								<!-- Label -->
								<label>Start date</label>

								<!-- Input -->
								<input
									type="text"
									data-toggle="flatpickr"
									:class=" (errors.has('start_date')? 'is-invalid ': '')  + 'form-control'"
									name="start_date"
									v-model="formData.start_date"
									@change="errors.clear('start_date')"
								/>
								<span class="invalid-feedback" role="alert" v-if="errors.has('start_date')">
									<strong>{{ errors.get('start_date') }}</strong>
								</span>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<!-- Start date -->
							<div class="form-group">
								<!-- Label -->
								<label>End date</label>

								<!-- Input -->
								<input
									type="text"
									data-toggle="flatpickr"
									:class=" (errors.has('end_date')? 'is-invalid ': '')  + 'form-control'"
									name="end_date"
									v-model="formData.end_date"
									@change="errors.clear('end_date')"
								/>
								<span class="invalid-feedback" role="alert" v-if="errors.has('end_date')">
									<strong>{{ errors.get('end_date') }}</strong>
								</span>
							</div>
						</div>
					</div>
					<!-- / .row -->
				</div>
				<button
					type="button"
					class="btn btn-primary"
					:disabled="errors.any() || processingForm"
					@click="processDiscount"
				>
					<span
						class="spinner-border spinner-border-sm"
						role="status"
						aria-hidden="true"
						v-if="processingForm"
					></span>
					Add Discount
				</button>
			</form>
			<!-- end discount box-->
		</div>
	</div>
</template>

<script>
import FormErrors from "../../../../libs/FormErrors";

export default {
	props: ['categoryId'],
    data(){
        return {
            formData: {discount: 0, end_date: null, start_date: null, rate_type: null},
			errors: new FormErrors(),
			processingForm: false,
        }
    },

	methods: {
		processDiscount() {
			if (this.errors.any()) {
				flash({
					message: "You have errors in the data",
				});
				return;
            }
            
            let categoryId = (this.categoryId)? this.categoryId : this.$attrs.categoryid

			this.processingForm = true;
			axios
				.post(hotelUrl(`room-categories/${categoryId}/discount`), this.formData)
				.then(({ data }) => {

                    this.$emit('discount-added', data.discount);
                    
					flash({
						message: data.message,
					});
					this.formData = {};
					
				})
				.catch(({ response }) => {
					if (response.status == 422) {
						this.errors.record(response.data);
					}
					flash({ type: "error", message: response.data.message });
				})
				.finally(() => {
					this.processingForm = false;
				});
		},
	},
};
</script>

<style>
</style>