<template>
	<div>
		<div class="container-fluid">
			<!-- Form -->

			<form class="mb-5" method="POST">
				<!-- product name -->
				<div class="form-group">
					<!-- Label  -->
					<label>Category Name</label>

					<!-- Input -->
					<input
						type="text"
						:class="(errors.has('name') ? 'is-invalid' : '') + ' form-control'"
						name="name"
						required
						v-model="formData.name"
						autocomplete="product"
						@change="errors.clear('name')"
					/>

					<span class="invalid-feedback" role="alert" v-if="errors.has('name')">
						<strong>{{ errors.get("name") }}</strong>
					</span>
				</div>

				<!-- product description -->
				<div class="form-group">
					<!-- Label -->
					<label class="mb-1">Description</label>

					<!-- Textarea -->
					<wysiwyg
						v-model="formData.description"
						@change="errors.clear('description')"
						:class="errors.has('description') ? 'is-invalid ' : ''"
					></wysiwyg>
					<span
						class="invalid-feedback"
						style="display: block"
						role="alert"
						v-if="errors.has('description')"
					>
						<strong>{{ errors.get("description") }}</strong>
					</span>
				</div>

				<!-- product price -->
				<div class="row">
					<div class="col-12 col-md-4">
						<div class="form-group">
							<!-- Label -->
							<label>Daily Rate ({{currency}})</label>
							<input
								id="daily_rate"
								type="number"
								:class="
									(errors.has('daily_rate') ? 'is-invalid ' : '') + 'form-control'
								"
								v-model.number="formData.daily_rate"
								@change="errors.clear('daily_rate')"
							/>
							<span
								class="invalid-feedback"
								role="alert"
								v-if="errors.has('daily_rate')"
							>
								<strong>{{ errors.get("daily_rate") }}</strong>
							</span>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<!-- Label -->
							<label>Weekly Rate ({{currency}})</label>
							<input
								id="weekly_rate"
								type="number"
								:class="
									(errors.has('weekly_rate') ? 'is-invalid ' : '') + 'form-control'
								"
								v-model.number="formData.weekly_rate"
								@change="errors.clear('weekly_rate')"
							/>
							<span
								class="invalid-feedback"
								role="alert"
								v-if="errors.has('weekly_rate')"
							>
								<strong>{{ errors.get("weekly_rate") }}</strong>
							</span>
						</div>
					</div>

					<div class="col-12 col-md-4">
						<div class="form-group">
							<!-- Label -->
							<label>Monthly Rate ({{currency}})</label>
							<input
								id="monthly_rate"
								type="number"
								:class="
									(errors.has('monthly_rate') ? 'is-invalid ' : '') + 'form-control'
								"
								v-model.number="formData.monthly_rate"
								@change="errors.clear('monthly_rate')"
							/>
							<span
								class="invalid-feedback"
								role="alert"
								v-if="errors.has('monthly_rate')"
							>
								<strong>{{ errors.get("monthly_rate") }}</strong>
							</span>
						</div>
					</div>
				</div>

				<!-- Starting files -->
				<div class="form-group">
					<!-- Label -->
					<label class="mb-1">Starting Images</label>
					<!-- Card -->
					<div class="row">
						<div
							class="col-md-4"
							v-for="(image, index) in selectedImages"
							:key="index"
						>
							<div class="card">
								<img :src="image.path" />
							</div>
						</div>
						<div :class="selectedImages.length > 0 ? 'col-md-4' : 'col-12'">
							<div class="card">
								<div class="card-body">
									<!-- Dropzone -->
									<div class="text-center py-5">
										<small class="form-text text-muted"
											>Select images from your gallery.</small
										>
										<a
											role="button"
											data-toggle="modal"
											data-target="#galleryModel"
											class="btn btn-light"
											>Open Gallery</a
										>
									</div>
								</div>
							</div>
						</div>
					</div>
					<span
						class="invalid-feedback"
						role="alert"
						v-if="errors.has('starting_images')"
					>
						<strong>{{ errors.get("starting_images") }}</strong>
					</span>
				</div>

				<!--  facilities box-->
				<div class="facilities-box">
					<!-- SKU and barcode -->
					<div class="row">
						<p class="col-12 header-pretitle">Facilities</p>

						<div class="col-12">
							<div class="form-group">
								<!-- Label  -->
								<label>Please enter comma sperated facilities</label>

								<!-- Input -->
								<input
									type="text"
									:class="
										(errors.has('facilities') ? 'is-invalid' : '') +
										' form-control'
									"
									name="facilities"
									required
									v-model="formData.facilities"
									@change="errors.clear('facilities')"
								/>

								<span
									class="invalid-feedback"
									role="alert"
									v-if="errors.has('facilities')"
								>
									<strong>{{ errors.get("facilities") }}</strong>
								</span>
							</div>
						</div>
					</div>

					<!-- / .row -->
				</div>
				<!-- end facilities box-->

				<!--  rooms box-->
				<div class="rooms-box">
					<div class="row">
						<p class="col-12 header-pretitle">Available Rooms</p>
					</div>

					<div class="row" v-for="(room, index) in formData.rooms" :key="index">
						<div class="col">
							<div class="form-group">
								<!-- Label  -->
								<label>Room Name/Number</label>
								<!-- Input -->
								<input
									type="text"
									:class="
										(errors.has('rooms.name') ? 'is-invalid' : '') +
										' form-control'
									"
									name="rooms.name"
									v-model="room.name"
									@change="errors.clear('rooms.name')"
								/>

								<span
									class="invalid-feedback"
									role="alert"
									v-if="errors.has('rooms.name')"
								>
									<strong>{{ errors.get("rooms.name") }}</strong>
								</span>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<!-- Label  -->
								<label>Floor</label>
								<!-- Input -->
								<input
									type="text"
									:class="
										(errors.has('rooms.floor') ? 'is-invalid' : '') +
										' form-control'
									"
									name="rooms.floor"
									v-model="room.floor"
									@change="errors.clear('rooms.floor')"
								/>

								<span
									class="invalid-feedback"
									role="alert"
									v-if="errors.has('rooms.floor')"
								>
									<strong>{{ errors.get("rooms.floor") }}</strong>
								</span>
							</div>
						</div>

						<div class="col-auto">
							<button
								class="btn btn-rounded-circle btn-sm btn-danger mt-5"
								@click.prevent="removeRoom(room, index)"
							>
								<span class="fe fe-minus"></span>
							</button>
						</div>
					</div>

					<button class="btn btn-sm btn-success" @click.prevent="addRoom">
						Add Room
					</button>

					<!-- / .row -->
				</div>
				<!-- end rooms box-->

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
					Create Category
				</button>
			</form>
		</div>

		<div
			class="modal fade"
			id="galleryModel"
			tabindex="-1"
			role="dialog"
			aria-hidden="true"
		>
			<div class="modal-dialog modal-dialog-centered gallery-modal">
				<div class="modal-content">
					<gallery @selected="selected"></gallery>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import wysiwyg from "../../WYSIWYG.vue";
import Gallery from "../../Gallery";
import FormErrors from "../../../libs/FormErrors";

export default {
	props: ["initCategories"],
	components: {
		wysiwyg,
		Gallery,
	},

	data() {
		return {
			formData: {
				rooms: [{ name: "", floor: "" }],
			},
			activeSection: "facilities",
			selectedImages: [],
			errors: new FormErrors(),
			processingForm: false,
		};
	},

	computed: {
		currency(){
			return hotelCurrency()
		}
	},

	methods: {
		switchPage(page) {
			this.activeSection = page;
		},

		submitForm() {
			if (this.errors.any()) {
				flash({
					message: "You have errors in the data",
				});
				return;
			}

			if (!this.selectedImages.length) {
				flash({
					message: "You must select starting images",
				});
				return;
			}

			this.formData.images = this.selectedImages.map((image) => image.id);

			axios
				.post(hotelUrl("room-categories"), this.formData)
				.then(({ data }) => {
					flash({ type: "success", message: data.message });
					this.formData = {
						rooms: [{ name: "", floor: "" }],
					};
					this.selectedImages = [];
					//clear data
				})
				.catch(({ response }) => {
					
					if (response.status == 422) {
						this.errors.record(response.data);
					}
					flash({ type: "error", message: response.data.message });
					this.processingForm = false;
				});
		},

		selected(images) {
			this.selectedImages = images;
		},

		addRoom() {
			this.formData.rooms.push({ name: "", floor: this.formData.rooms.last().floor });
		},

		removeRoom(room, index) {
			if (room.id) {
				this.$confirm(
					"This will permanently delete the record from our system. Continue?",
					"Warning",
					{
						confirmButtonText: "Delete",
						cancelButtonText: "Cancel",
						type: "warning",
					}
				).then(() => {
					this.$message({
						type: "message",
						message: "Deleting...",
					});

					this.deleteRoom(room, index);
				});
				return;
			}
			this.formData.rooms.splice(index, 1);
		},

		deleteRoom(room, index) {
			axios
				.delete(`/rooms/${room.id}/delete`)
				.then(({ data }) => {
					flash({ type: "success", message: data.message });

					this.formData.rooms.splice(index, 1);
				})
				.catch(({ response }) => {
					flash({ type: "error", message: response.data.message });
				});
		},
	},
};
</script>

<style scoped>
img{
	max-width: 100%;
}
.header-body {
	border-top: 1px solid #e3ebf6;
}

.nav-item:hover {
	cursor: pointer;
}
</style>