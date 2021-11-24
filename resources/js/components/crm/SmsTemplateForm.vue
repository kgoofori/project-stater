<template>
	<div>
		<div class="container-fluid">
			<!-- Form -->
			<form method="POST">
				<!-- product name -->
				<div class="form-group">
					<!-- Label  -->
					<label>Template Name</label>

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
						placeholder="Birthday Template "
						@change="errors.clear('name')"
					/>

					<span class="invalid-feedback" role="alert" v-if="errors.has('name')">
						<strong>{{ errors.get("name") }}</strong>
					</span>
				</div>
				<!-- Template body -->
				<div class="form-group">
					<!-- Label -->
					<label class="mb-1"> Body </label>

					<!-- Text -->
					<small class="form-text text-muted">
						You can inclue keywords like <code>{first_name}</code>,
						<code>{surname}</code>, <code>{full_name}</code>.
					</small>

					<!-- Textarea -->
					<textarea
						name="body"
						:class="(errors.has('body') ? 'is-invalid' : '') + ' form-control'"
						id="body"
						cols="30"
						rows="3"
						v-model="formData.body"
						@change="errors.clear('body')"
						required
						placeholder="Hello {first_name},"
					></textarea>
					<span class="invalid-feedback" role="alert" v-if="errors.has('body')">
						<strong>{{ errors.get("body") }}</strong>
					</span>
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
	props: ["template", "isModal"],
	components: {},

	data() {
		return {
			formData: {
				id: "",
				type: "SMS",
				body: "",
				name: "",
			},
			btnLabel: "Create Template",
			errors: new FormErrors(),
			processingForm: false,
		};
	},

	created() {
		if (this.template && this.template.id) {
			this.formData = { ...this.template };
			this.btnLabel = "Update Template";
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
				.request(hotelUrl(`campaigns/templates/${this.formData.id}`), {
					method: method,
					data: this.formData,
				})
				.then(({ data }) => {
					flash({ type: "success", message: data.message });

					this.$emit("doneProcessing", data.template);

					this.formData = {
						id: "",
						type: "SMS",
						body: "",
						name: "",
					};

					this.btnLabel = "Create Template";
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