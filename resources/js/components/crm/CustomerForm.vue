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

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<!-- Label  -->
							<label>Gender</label>

							<!-- Input -->
							<!-- Input -->
							<select
								:class="
									(errors.has('gender') ? 'is-invalid ' : '') + 'custom-select'
								"
								v-model="formData.gender"
								@change="errors.clear('gender')"
							>
								<option value>Please select</option>
								<option value="MALE">MALE</option>
								<option value="FEMALE">FEMALE</option>
							</select>

							<span
								class="invalid-feedback"
								role="alert"
								v-if="errors.has('gender')"
							>
								<strong>{{ errors.get("gender") }}</strong>
							</span>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<!-- Label  -->
							<label
								>Date of Birth
								<small class="text-muted"> (Not required)</small></label
							>
							<!-- Input -->
							<input
								type="date"
								:class="
									(errors.has('date_of_birth') ? 'is-invalid' : '') +
									' form-control'
								"
								name="date_of_birth"
								placeholder="dd/mm/yyyy"
								data-toggle="flatpickr"
								required
								v-model="formData.date_of_birth"
								@change="errors.clear('date_of_birth')"
							/>

							<span
								class="invalid-feedback"
								role="alert"
								v-if="errors.has('date_of_birth')"
							>
								<strong>{{ errors.get("date_of_birth") }}</strong>
							</span>
						</div>
					</div>
				</div>

				<hr />

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<!-- Label  -->
							<label>Verification Card Type</label>

							<!-- Input -->
							<!-- Input -->
							<select
								:class="
									(errors.has('verification_card_id') ? 'is-invalid ' : '') +
									'custom-select'
								"
								v-model="formData.verification_card_id"
								@change="errors.clear('verification_card_id')"
							>
								<option value>Please select</option>
								<option
									v-for="(verificationCard, index) in verificationCards"
									:value="verificationCard.id"
									:key="index"
								>
									{{ verificationCard.name }}
								</option>
							</select>

							<span
								class="invalid-feedback"
								role="alert"
								v-if="errors.has('verification_card_id')"
							>
								<strong>{{ errors.get("verification_card_id") }}</strong>
							</span>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<!-- Label  -->
							<label>Verification Card Number</label>
							<!-- Input -->
							<input
								type="text"
								:class="
									(errors.has('verification_card_number') ? 'is-invalid' : '') +
									' form-control'
								"
								name="verification_card_number"
								required
								v-model="formData.verification_card_number"
								@change="errors.clear('verification_card_number')"
							/>

							<span
								class="invalid-feedback"
								role="alert"
								v-if="errors.has('verification_card_number')"
							>
								<strong>{{ errors.get("verification_card_number") }}</strong>
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

				<div class="custom-control custom-switch" v-if="!formData.id">
					<input
						type="checkbox"
						class="custom-control-input"
						id="ageSwitch"
						v-model="formData.is_18"
					/>
					<label class="custom-control-label" for="ageSwitch"
						>Contact 18 year or older</label
					>
				</div>

				<hr />

				<p class="header-pretitle">Emergency Contact</p>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<!-- Label  -->
							<label>Contact Name</label>

							<!-- Input -->
							<input
								type="text"
								:class="
									(errors.has('contact_name') ? 'is-invalid' : '') +
									' form-control'
								"
								name="contact_name"
								required
								v-model="formData.contact_name"
								autocomplete="name"
								@change="errors.clear('contact_name')"
							/>

							<span
								class="invalid-feedback"
								role="alert"
								v-if="errors.has('contact_name')"
							>
								<strong>{{ errors.get("contact_name") }}</strong>
							</span>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<!-- Label  -->
							<label>Phone</label>

							<!-- Input -->
							<input
								type="text"
								:class="
									(errors.has('contact_phone') ? 'is-invalid' : '') +
									' form-control'
								"
								name="contact_phone"
								required
								v-model="formData.contact_phone"
								autocomplete="phone"
								@change="errors.clear('contact_phone')"
							/>

							<span
								class="invalid-feedback"
								role="alert"
								v-if="errors.has('contact_phone')"
							>
								<strong>{{ errors.get("contact_phone") }}</strong>
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
			btnLabel: "Create Customer",
			errors: new FormErrors(),
			processingForm: false,
		};
	},

	created() {
		if (this.customer && this.customer.id) {
			this.formData = { ...this.customer };
			this.btnLabel = "Update Customer Information";
		}
		this.fetchVerificationCards();
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
				.request(hotelUrl(`customers/${this.formData.id}`), {
					method: method,
					data: this.formData,
				})
				.then(({ data }) => {
					this.$emit("processed", data.customer);

					flash({ type: "success", message: data.message });
					
					if (this.formData.id) {
						window.history.pushState(null, "Create Customer", `/${this.formData.hotel_id}/customers/create`);
					}

					this.formData = { id: "", is_a8: false };
					this.btnLabel = "Create Customer";
					this.$refs.surname.focus();
					window.scroll(0, 0);

					
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