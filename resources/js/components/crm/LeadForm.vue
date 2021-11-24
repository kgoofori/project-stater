<template>
	<div>
		<div class="container-fluid">
			<!-- Form -->
			<form class="mb-3 mt-3" method="POST">
				<!-- product name -->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<!-- Label  -->
							<label>Surname</label>

							<!-- Input -->
							<input
								type="text"
								ref="surname"
								:class="
									(errors.has('surname') ? 'is-invalid' : '') + ' form-control'
								"
								name="surname"
								autofocus
								required
								v-model="formData.surname"
								autocomplete="surname"
								@change="errors.clear('surname')"
							/>

							<span
								class="invalid-feedback"
								role="alert"
								v-if="errors.has('surname')"
							>
								<strong>{{ errors.get("surname") }}</strong>
							</span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<!-- Label  -->
							<label>Other Names</label>

							<!-- Input -->
							<input
								type="text"
								:class="
									(errors.has('other_names') ? 'is-invalid' : '') +
									' form-control'
								"
								name="other_names"
								required
								v-model="formData.other_names"
								autocomplete="other_names"
								@change="errors.clear('other_names')"
							/>

							<span
								class="invalid-feedback"
								role="alert"
								v-if="errors.has('other_names')"
							>
								<strong>{{ errors.get("other_names") }}</strong>
							</span>
						</div>
					</div>
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
	props: ["customer"],
	components: {},

	data() {
		return {
			verificationCards: [],
			formData: {
				id: "",
				gender: null,
				verification_card_id: null,
				is_18: false,
			},
			btnLabel: "Create Lead",
			errors: new FormErrors(),
			processingForm: false,
		};
	},

	created() {
		if (this.customer && this.customer.id) {
			this.formData = { ...this.customer };
			this.btnLabel = "Update Customer Information";
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
				.request(hotelUrl(`leads/${this.formData.id}`), {
					method: method,
					data: this.formData,
				})
				.then(({ data }) => {
					this.$emit("processed", data.customer);

					flash({ type: "success", message: data.message });
					
					this.formData = { id: ""};
					this.btnLabel = "Create Lead";
					this.$refs.surname.focus();

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
		},

		fetchVerificationCards() {
			axios.get("/data/verification-ids.json").then(({ data }) => {
				this.verificationCards = data;
			});
		},
	},
};
</script>