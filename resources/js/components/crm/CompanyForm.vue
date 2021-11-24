<template>
	<div>
		<div class="container-fluid">
			<!-- Form -->
			<form class="mb-6" method="POST">
				<!-- product name -->
				<div class="form-group">
					<!-- Label  -->
					<label>Company Name</label>

					<!-- Input -->
					<input
						type="text"
						ref="name"
						:class="(errors.has('name') ? 'is-invalid' : '') + ' form-control'"
						name="name"
						autofocus
						required
						v-model="formData.name"
						autocomplete="name"
						@change="errors.clear('name')"
					/>

					<span class="invalid-feedback" role="alert" v-if="errors.has('name')">
						<strong>{{ errors.get("name") }}</strong>
					</span>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<!-- Label  -->
							<label>Phone</label>

							<!-- Input -->
							<input
								type="text"
								:class="
									(errors.has('phone') ? 'is-invalid' : '') + ' form-control'
								"
								ref="phone"
								name="phone"
								required
								v-model="formData.phone"
								autocomplete="phone"
								@change="errors.clear('phone')"
							/>

							<span
								class="invalid-feedback"
								role="alert"
								v-if="errors.has('phone')"
							>
								<strong>{{ errors.get("phone") }}</strong>
							</span>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<!-- Label  -->
							<label>Email</label>

							<!-- Input -->
							<input
								type="email"
								:class="
									(errors.has('email') ? 'is-invalid' : '') + ' form-control'
								"
								name="email"
								v-model="formData.email"
								autocomplete="email"
								@change="errors.clear('email')"
							/>

							<span
								class="invalid-feedback"
								role="alert"
								v-if="errors.has('email')"
							>
								<strong>{{ errors.get("email") }}</strong>
							</span>
						</div>
					</div>
				</div>

				<hr />

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<!-- Label  -->
							<label>Address</label>

							<!-- Input -->
							<input
								type="text"
								:class="
									(errors.has('address') ? 'is-invalid' : '') + ' form-control'
								"
								name="address"
								required
								v-model="formData.address"
								autocomplete="address"
								@change="errors.clear('address')"
							/>

							<span
								class="invalid-feedback"
								role="alert"
								v-if="errors.has('address')"
							>
								<strong>{{ errors.get("address") }}</strong>
							</span>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<!-- Label  -->
							<label>City</label>

							<!-- Input -->
							<input
								type="text"
								:class="
									(errors.has('city') ? 'is-invalid' : '') + ' form-control'
								"
								name="city"
								required
								v-model="formData.city"
								autocomplete="city"
								@change="errors.clear('city')"
							/>

							<span
								class="invalid-feedback"
								role="alert"
								v-if="errors.has('city')"
							>
								<strong>{{ errors.get("city") }}</strong>
							</span>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<!-- Label  -->
							<label>Region/State</label>

							<!-- Input -->
							<input
								type="text"
								:class="
									(errors.has('region') ? 'is-invalid' : '') + ' form-control'
								"
								name="region"
								required
								v-model="formData.region"
								autocomplete="region"
								@change="errors.clear('region')"
							/>

							<span
								class="invalid-feedback"
								role="alert"
								v-if="errors.has('region')"
							>
								<strong>{{ errors.get("region") }}</strong>
							</span>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<!-- Label  -->
							<label>Country</label>

							<!-- Input -->
							<input
								type="text"
								:class="
									(errors.has('country') ? 'is-invalid' : '') + ' form-control'
								"
								name="country"
								required
								v-model="formData.country"
								autocomplete="country"
								@change="errors.clear('country')"
							/>

							<span
								class="invalid-feedback"
								role="alert"
								v-if="errors.has('country')"
							>
								<strong>{{ errors.get("country") }}</strong>
							</span>
						</div>
					</div>
				</div>

				<!-- Divider -->
				<hr class="mt-5 mb-5" />

				<!-- Buttons -->
				<button
					class="btn btn-block btn-primary"
					:disabled="errors.any() || processingForm"
					@click.prevent="submitForm"
				>
					<span
						class="spinner-border spinner-border-sm"
						role="status"
						aria-hidden="true"
						v-if="processingForm"
					></span>
					{{ btnLabel }}
				</button>
			</form>
		</div>
	</div>
</template>

<script>
import FormErrors from "../../libs/FormErrors";

export default {
	props: ["company", "isModal"],
	components: {},

	data() {
		return {
			formData: {
				id: "",
				gender: null,
				verification_card_id: null,
				is_a8: false,
			},
			btnLabel: "Create Company",
			errors: new FormErrors(),
			processingForm: false,
		};
	},

	created() {
		if (this.company && this.company.id) {
			this.formData = { ...this.company };
			this.btnLabel = "Update Company Information";
		}
	},

	methods: {
		submitForm() {
			if (this.errors.any()) {
				flash({ type: "error", message: "You have errors in the data" });
				return;
			}

			let method = this.formData.id ? "PATCH" : "POST";

			this.processingForm = true;

			axios
				.request(hotelUrl(`companies/${this.formData.id}`), {
					method: method,
					data: this.formData,
				})
				.then(({ data }) => {
					flash({ type: "success", message: data.message });

					if (!this.isModal && this.formData.id)
						window.history.pushState(null, "Create Company", `/${this.formData.hotel_id}/companies/create`);

					this.$emit("doneProcessing", data.company);

					this.formData = { id: "" };
					this.btnLabel = "Create Company";
				})
				.catch(({response}) => {
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