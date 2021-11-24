<template>
	<div class="card mb-0">
		<div class="card-header">
			<h4 class="card-header-title">Gallery</h4>
		</div>

		<div class="dropzone dropzone-multiple p-3" ref="dropzone">
			<!-- Fallback -->
			<div class="fallback">
				<div class="custom-file">
					<input type="file" class="custom-file-input" id="customFileUploadMultiple" multiple />
					<label class="custom-file-label" for="customFileUploadMultiple">Choose file</label>
				</div>
			</div>

			<!-- message -->
			<div class="dz-message">
				<p class="force-center">Drop files to upload</p>
			</div>

			<!-- Preview -->

			<div class="container-fluid">
				<div class="dz-preview dz-preview-multiple row">
					<div class="col-6 col-sm-3 col-md-2 thumb-box" role="checkbox">
						<div class="preview-wraper rounded">
							<span class="icon fe fe-check-square text-success"></span>
							<div class="force-center dz-progress">
								<div class="progress mx-3">
									<div
										class="progress-bar dz-upload"
										role="progressbar"
										aria-valuemin="0"
										aria-valuemax="100"
										data-dz-uploadprogress
									></div>
								</div>
							</div>
							<img class="avatar-img rounded" data-dz-thumbnail />
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Footer -->
		<div class="card-footer card-footer-boxed">
			<!-- Link -->
			<div class="row">
				<div class="col" v-if="selectedImages.length > 0">
					<strong>{{selectedImages.length}} files selected</strong>
				</div>
				<div class="col text-right">
					<button @click="doneSelection" class="btn btn-sm btn-primary" data-dismiss="modal">Done</button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
Dropzone.autoDiscover = false;
import Dropzone from "dropzone";

export default {
	props: {
		selectionType: {
			default: "multiple",
		},
	},
	data() {
		return {
			galleries: [],
			selectedImages: [],
			dropzone: null,
		};
	},

	mounted() {
		this.initDropZone();
	},

	methods: {
		initDropZone() {
			let zoneElement = this.$refs.dropzone;
			this.dropzone = new Dropzone(zoneElement, {
				url: hotelUrl("galleries"),
				previewsContainer: zoneElement.querySelector(".dz-preview"),
				previewTemplate: zoneElement.querySelector(".dz-preview").innerHTML,
				// parallelUploads: 1,
				// resizeWidth: 1024,
				headers: {
					"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
				},
				init: () => {
					this.queryGalleries();
				},
			});

			this.dropzone.on("init", () => {
				this.queryGalleries();
			});

			this.dropzone.on("success", (file, data) => {
				this.dropzone.removeFile(file);

				this.galleries.push(data.image);

				var mockFile = { name: data.image.id, ...data.image };
				this.dropzone.displayExistingFile(mockFile,  data.image.thumb_path ?? data.image.path);
			});

			this.dropzone.on("addedfile", (file) => {
				file.previewElement.addEventListener("click", () => {
					if (file.id) {
						this.toggleSelectedFile(file);
					} else {
						flash({
							type: error,
							message: "File is not yet found on server",
						});
					}
				});
			});
		},

		toggleSelectedFile(file) {
			var index = this.selectedImages.indexOf(file);

			if (index > -1) {
				this.selectedImages.splice(index, 1);
				file.previewElement.classList.remove("selected");
				//remove file
			} else {
				if (this.selectionType == "single") {
					this.resetSelection();
				}

				this.selectedImages.push(file);
				file.previewElement.classList.add("selected");
			}
		},

		doneSelection() {
			if (this.selectedImages) {
				this.selectionType == "single"
					? this.$emit("selected", this.selectedImages[0])
					: this.$emit("selected", this.selectedImages);
			}

			this.resetSelection();
		},

		resetSelection() {
			$(".selected").removeClass("selected");
			this.selectedImages = [];
		},

		queryGalleries() {
			axios.get(hotelUrl("galleries")).then(({ data }) => {
				this.galleries = data;
				data.forEach((gallery) => {
					// this.dropzone.
					var mockFile = { name: gallery.id, ...gallery };
					this.dropzone.displayExistingFile(mockFile, gallery.thumb_path ?? gallery.path);
				});
			});
		},

		thumbnailClicked({ target }) {
			console.log(target);
		},
	},
};
</script>

<style>
.dropzone {
	min-height: 400px;
	position: relative;
	border: 1px dashed #d2ddec;
}

.force-center {
	top: 0;
	bottom: 0;
	position: absolute;
	margin: auto;
	left: 0;
	right: 0;
	height: 1px;
	line-height: 1px;
}

.thumb-box:hover .icon,
.thumb-box.selected .icon {
	display: block;
}

.thumb-box:first-child{
	display: none;
}

.thumb-box:hover .preview-wraper,
.thumb-box.selected .preview-wraper {
	border-color: #00d97e;
	border-width: 2px;
	cursor: pointer;
}

.preview-wraper {
	border: 2px solid transparent;
	position: relative;
}

.preview-wraper .icon {
	position: absolute;
	display: none;
	top: 2;
	left: 5;
}

.dropzone .dz-progress {
	display: none;
}

.dz-processing .dz-progress {
	display: block;
}

.dz-message {
	height: 100%;
	width: 100%;
	position: absolute;
	display: none;
}

.dropzone.dz-drag-hover {
	background-color: #95aac9;
}
</style>