<template>
	<div class="card">
		<div class="card-header">
			<h4 class="card-header-title">Notes</h4>
		</div>
		<div class="card-body">
			<div class="kanban-add">
				<div class="card card-sm">
					<div class="card-body">
						<div class="text-center" v-show="!showForm">
							<a class="kanban-add-link" href="#!" @click="showForm = true"
								>Add Card</a
							>
						</div>

						<!-- Form -->
						<form class="kanban-add-form" v-show="showForm">
							<!-- Input -->
							<div class="form-group">
								<textarea
									:class="
										(errors.has('body') ? 'is-invalid' : '') +
										' form-control form-control-flush form-control-auto'
									"
									placeholder="Add notes here"
									@change="errors.clear('body')"
									v-model="formData.body"
								></textarea>
								<span
									class="invalid-feedback"
									role="alert"
									v-if="errors.has('body')"
								>
									<strong>{{ errors.get("body") }}</strong>
								</span>
							</div>

							<!-- Footer -->
							<div class="row align-items-center">
								<div class="col-auto">
									<!-- Buttons -->
									<button
										class="btn btn-sm btn-white"
										type="reset"
										@click="showForm = false"
									>
										Cancel
									</button>
									<button
										class="btn btn-sm btn-primary"
										type="button"
										@click.prevent="submitNote"
										:disabled="errors.any() || processingForm"
									>
										<span
											class="spinner-border spinner-border-sm"
											role="status"
											aria-hidden="true"
											v-if="processingForm"
										></span>
										Add
									</button>
								</div>
							</div>
							<!-- / .row -->
						</form>
					</div>
				</div>
			</div>

			<div class="kanban-item" v-for="(note, index) in notes" :key="index">
				<div class="card card-sm mb-3">
					<div class="card-body">
						<!-- Body -->
						<p>
							{{ note.body }}
						</p>

						<!-- Footer -->
						<div class="row align-items-center">
							<div class="col">
								<a
									href="#!"
									class="avatar avatar-xs"
									data-toggle="tooltip"
									data-placement="top"
									:title="note.user.name"
									><span class="avatar-title rounded-circle">{{
										note.user.initials
									}}</span></a
								>
							</div>
							<div class="col-auto">
								<!-- Avatar group -->
								<p class="card-text small text-muted">
									<i class="fe fe-clock"></i> {{ note.created_at }}
								</p>
							</div>
						</div>
						<!-- / .row -->
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import FormErrors from "../../libs/FormErrors";

export default {
	props: {
		customerId: {
			type: String,
			required: true,
		},
	},
	created() {
		this.fetchNotes();
	},
	data() {
		return {
			showForm: false,
			formData: { body: "" },
			errors: new FormErrors(),
			processingForm: false,
			notes: [],
		};
	},

	methods: {
		fetchNotes() {
			axios
				.get(hotelUrl(`customers/${this.customerId}/notes`))
				.then(({ data }) => {
					this.notes = data;
				});
		},

		submitNote() {
			if (this.errors.any()) {
				flash({ type: "error", message: "You have errors in the data" });
				return;
			}

			this.processingForm = true;

			axios
				.post(hotelUrl(`customers/${this.customerId}/notes`), this.formData)
				.then(({ data }) => {
					flash({ type: "success", message: data.message });

					this.notes.unshift(data.note);

					this.formData.body = { body: "" };

					this.showForm = false;
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