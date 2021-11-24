<template>
	<div>
		<form>
			<div class="card-header">
				<!-- Title -->
				<h4 class="card-header-title">Invite a user</h4>
			</div>
			<div class="card-header">
				<div class="row no-gutters align-items-center">
					<div class="col-3">
						<!-- Label -->
						<label class="mb-0"> Name </label>
					</div>
					<div class="col">
						<!-- Input -->
						<input
							:class="
								(errors.has('name') ? 'is-invalid' : '') +
								' form-control form-control-flush'
							"
							v-model="formData.name"
							@change="errors.clear('name')"
							type="text"
							placeholder="Full name"
						/>
						<span
							class="invalid-feedback"
							role="alert"
							v-if="errors.has('name')"
						>
							<strong>{{ errors.get("name") }}</strong>
						</span>
					</div>
				</div>
				<!-- / .row -->
			</div>
			<div class="card-header">
				<div class="row no-gutters align-items-center">
					<div class="col-3">
						<!-- Label -->
						<label class="mb-0"> Email </label>
					</div>
					<div class="col">
						<!-- Input -->
						<input
							:class="
								(errors.has('email') ? 'is-invalid' : '') +
								' form-control form-control-flush'
							"
							type="email"
							v-model="formData.email"
							@change="errors.clear('email')"
							placeholder="Email address"
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
				<!-- / .row -->
			</div>
			<div class="card-footer">
				<!-- Button -->
				<button class="btn btn-block btn-primary" @click.prevent="inviteMember">
					<span
						class="spinner-border spinner-border-sm"
						role="status"
						aria-hidden="true"
						v-if="processingForm"
					></span>
					Invite User
				</button>
			</div>
		</form>
	</div>
</template>

<script>
import FormErrors from "../../libs/FormErrors";

export default {
	data() {
		return {
			errors: new FormErrors(),
			processingForm: false,
			formData: { name: null, email: "" },
		};
	},

	methods: {
		inviteMember() {
			this.processingForm = true;
			axios
				.post(hotelUrl("settings/invite-user"), this.formData)
				.then(({ data }) => {
					flash({ type: "success", message: data.message });
					this.formData = { name: null, email: "" };
				})
				.catch(({ response }) => {
					

					flash({ type: "error", message: response.data.message });
					if (response.status == 422) {
						this.errors.record(response.data);
					}
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