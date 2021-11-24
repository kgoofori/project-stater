<template>
	<div class="card">
		<div class="card-header">Edit Pricing</div>
		<div class="card-body">
			<!--  discount box-->
			<form>
				<div class="row">
					<div class="col-12 col-md-6">
						<div class="form-group">
							<!-- Label -->
							<label>Rate</label>

							<input
								id="rate"
								type="number"
								:class=" (errors.has('rate')? 'is-invalid ': '')  + 'form-control'"
								v-model.number="formData.rate"
								@change="errors.clear('rate')"
							/>
							<span class="invalid-feedback" role="alert" v-if="errors.has('rate')">
								<strong>{{ errors.get('rate') }}</strong>
							</span>
						</div>
					</div>
				</div>
				<button
					type="button"
					class="btn btn-primary"
					@click="processPricing"
					:disabled="errors.any() || processingForm"
				>
					<span
						class="spinner-border spinner-border-sm"
						role="status"
						aria-hidden="true"
						v-if="processingForm"
					></span>
					Confirm
				</button>
			</form>
			<!-- end discount box-->
		</div>
	</div>
</template>

<script>

import FormErrors from "../../../../libs/FormErrors";

export default {
	props: {
		rate: {
			required: true
		},
		categoryId: {
			required: true
		}
    },

	data() {
		return {
			formData: {rate: 0},
            processingForm: false,
            errors: new FormErrors
		};
    },
    
    created(){
        this.formData = {
			rate: this.rate,
		}
    },

	methods: {
		processPricing() {
			if (this.errors.any()) {
				flash({
					message: "You have errors in the data"
				});
				return;
			}

			this.processingForm = true;
			axios
				.patch(hotelUrl(`room-categories/${this.categoryId}/update`), this.formData)
				.then(({ data }) => {
					flash({ type: "success", message: data.message });

					this.$emit('completed', this.formData)

					$(".modal").modal("hide");
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
		}
	}
};
</script>

<style>
</style>