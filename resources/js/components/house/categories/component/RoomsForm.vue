<template>
	<div class="card">
		<div class="card-header" >{{formData.id ? 'Edit Room': 'Add Room'}}</div>
		<div class="card-body">
			<!--  discount box-->
			<form>
				<div class="discount-box mb-3">
					<div class="row">
						<div class="col-12">
							<!-- Start discount -->
							<div class="form-group">
								<!-- Label -->
								<label>Name/Number</label>

								<!-- Input -->
								<input
									type="text"
									:class="
										(errors.has('name') ? 'is-invalid ' : '') + 'form-control'
									"
									name="name"
									v-model="formData.name"
									@change="errors.clear('name')"
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

						<div class="col-12">
							<!-- Start discount -->
							<div class="form-group">
								<!-- Label -->
								<label>Floor</label>

								<!-- Input -->
								<input
									type="text"
									:class="
										(errors.has('floor') ? 'is-invalid ' : '') + 'form-control'
									"
									name="floor"
									v-model="formData.floor"
									@change="errors.clear('floor')"
								/>
								<span
									class="invalid-feedback"
									role="alert"
									v-if="errors.has('floor')"
								>
									<strong>{{ errors.get("floor") }}</strong>
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
					{{formData.id ? 'Edit Room': 'Add Room'}}
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
		categoryId: { type: String },
		formData: { default: { room: "", floor: "" } },
	},
	data() {
		return {
			errors: new FormErrors(),
			processingForm: false,
		};
	},

	methods: {
		processDiscount() {
			if (this.errors.any()) {
				flash({
					message: "You have errors in the data",
				});
				return;
			}

			let categoryId = this.categoryId
				? this.categoryId
				: this.$attrs.categoryid;

			this.processingForm = true;

			let url = hotelUrl(`room-categories/${categoryId}/add-room`);
			let method = 'POST';

			if(this.formData.id){
				url = hotelUrl(`rooms/${this.formData.id}`)
				method = 'PATCH';
			}

			axios
				.request(url, {method:  method, data: this.formData})
				.then(({ data }) => {
					this.$emit("room-added", data.room, this.formData.id);
					flash({
						message: data.message,
					});
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