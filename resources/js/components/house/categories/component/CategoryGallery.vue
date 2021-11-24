<template>
	<div>
		<div class="card">
			<div class="card-header">
				<h4 class="card-header-title">Images</h4>
				<a
					href="#!"
					class="btn btn-sm btn-white"
					role="button"
					data-toggle="modal"
					data-target="#galleryModel"
				>Add More</a>
			</div>

			<div class="card-body">
				<div class="row">
					<div class="col col-md-4 p-2" v-for="(image, index) in images" :key="index">
						<a href="#" role="button" class="remove" @click.prevent="removeImage(image, index)">X</a>
						<img :src="image.path" alt style="max-width: 100%; height: auto" />
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="galleryModel" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<gallery @selected="addSelectedImages"></gallery>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import Gallery from "../../../Gallery";

export default {
	components: {
		Gallery
	},
	props: {
		initialData: {
			type: Array
		},
		categoryId: {
			type: String,
			required: true
		}
	},
	data() {
		return {
			images: []
		};
	},

	created() {
		if (this.initialData) {
			this.images = this.initialData;
		}
	},

	methods: {
		addSelectedImages(selectedImages) {
			axios
				.post(hotelUrl(`room-categories/${this.categoryId}/attach-images`), {
					images: selectedImages.map(image => image.id)
				})
				.then(({ data }) => {
					this.images = data.images;

					flash({ type: "success", message: data.message });
				})
				.catch(({ response }) => {
					flash({ type: "error", message: response.data.message });
				});
		},

		removeImage(image, index) {
			axios
				.post(hotelUrl(`room-categories/${this.categoryId}/detach-image`), {
					image_id: image.id
				})
				.then(({ data }) => {
					this.images.splice(index, 1);
					flash({ type: "success", message: data.message });
				})
				.catch(({ response }) => {
					flash({ type: "error", message: response.data.message });
				});
		}
	}
};
</script>

<style scoped>
.modal-dialog {
	width: calc(100% - 3.5rem);
	height: calc(100% - 3.5rem);
	max-width: calc(100% - 3.5rem);
	overflow: scroll;
}
</style>