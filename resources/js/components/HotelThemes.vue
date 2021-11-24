<template>
	<div>
		<div class="row">
			<div class="col-12 col-md-6 mb-3" v-for="(theme, index) in themes" :key="index">
				<div class="card">
					<!-- Image  -->
					<a class href="#details">
						<img class="card-img-top" src="/assets/img/kanban/kanban-2.jpg" alt="..." />
					</a>

					<!-- Body -->
					<div class="card-body">
						<div class="row align-items-center">
							<div class="col">
								<!-- Title -->
								<h4 class="mb-1">{{theme.name}}</h4>
								<!-- Badge -->
								<span class="badge badge-soft-success" v-if="theme.is_installed">Installed</span>
								<span
									class="badge badge-soft-success"
									v-else
									v-text="(theme.price > 0)? 'GHS'.theme.price : 'Free'"
								></span>
							</div>
							<div class="col-auto">
								<!-- Button -->
								<a
									class="btn btn-sm btn-white"
									href="#use"
									v-if="theme.is_installed"
									v-text="(theme.is_active > 0)? 'Active' : 'Use'"
									@click.prevent="useThisTheme(theme)"
								></a>
								<a
									class="btn btn-sm btn-white"
									href="#use"
									v-else
									@click.prevent="buyOrInstallTheme(theme)"
									v-text="(theme.price > 0)? 'Buy' : 'Install'"
								></a>
							</div>
						</div>
						<!-- / .row -->
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="useThemeModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="card">
						<div class="card-header">Select Colors</div>
						<div class="card-body">
							<!--  discount box-->
							<form>
								<div class="discount-box mb-3">
									<div class="row">
										<div class="col-12">
											<!-- Start discount -->
											<div class="form-group">
												<!-- Label -->
												<label>Primary Color</label>

												<label
													class="btn btn-white btn-rounded-circle col"
													v-for="(color, index) in colors"
													:key="index"
													style="backgroud-color: green"
												>
													<input
														type="radio"
														name="primary_color"
														:value="color"
														v-model="formData.primary_color"
														@change="errors.clear('primary_color') "
													/>
												</label>
												<!-- Input -->

												<span
													class="invalid-feedback"
													role="alert"
													v-if="errors.has('primary_color')"
													style="display: block"
												>
													<strong>{{ errors.get('primary_color') }}</strong>
												</span>
											</div>
										</div>

										<div class="col-12">
											<div class="form-group">
												<!-- Label -->
												<label>Secondary Color</label>

												<label
													class="btn btn-white btn-rounded-circle col"
													v-for="(color, index) in colors"
													:key="index"
													:style="`backgroud-color: ${color}`"
												>
													<input
														type="radio"
														name="secondary_color"
														:value="color"
														v-model="formData.secondary_color"
														@change="errors.clear('secondary_color') "
													/>
												</label>

												<span
													class="invalid-feedback"
													role="alert"
													v-if="errors.has('secondary_color')"
													style="display: block"
												>
													<strong>{{ errors.get('secondary_color') }}</strong>
												</span>
											</div>
										</div>
									</div>
									<!-- / .row -->
								</div>
								<button type="button" class="btn btn-primary" @click="processThemeActivation">Activate Theme</button>
							</form>
							<!-- end discount box-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import FormErrors from "../libs/FormErrors";

export default {
	props: ["initThemes", "initActiveTheme"],
	data() {
		return {
			themes: [],
			formData: {},
			colors: ["#1abc9c", "#2ecc71", "#3498db", "#9b59b6", "#34495e"],
			errors: new FormErrors()
		};
	},

	created() {
		if (this.initThemes) {
			this.themes = this.initThemes;
		}
	},
	methods: {
		useThisTheme(theme) {
			this.formData.theme = theme.id;
			$("#useThemeModal").modal("show");
		},

		processThemeActivation() {
			if (this.errors.any()) {
				flash({
					message: "You have errors in the data"
				});
				return;
			}

			axios
				.patch(hotelUrl("themes/activate"), this.formData)
				.then(({ data }) => {
					flash({ type: "success", message: data.message });

					if (data.themes) {
						this.themes = data.themes;
					}

					this.formData = {};

					$(".modal").modal("hide");
				})
				.catch(({ response }) => {
					if (response.status == 422) {
						this.errors.record(response.data);
					}

					flash({ type: "error", message: response.data.message });
					this.processingForm = false;
				});
		},

		buyOrInstallTheme(theme) {
			//install theme
			axios
				.post(hotelUrl("themes/install"), { theme: theme.id })
				.then(({ data }) => {
					flash({ type: "success", message: data.message });

					if (data.themes) {
						this.themes = data.themes;
					}
				})
				.catch(({ response }) => {
					flash({ type: "error", message: response.data.message });
					this.processingForm = false;
				});
		}
	}
};
</script>

<style>
</style>