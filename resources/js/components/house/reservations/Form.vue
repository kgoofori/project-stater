<template>
	<div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col">
									<div class="form-group">
										<!-- Label  -->
										<label>From Date</label>
										<!-- Input -->
										<input
											type="date"
											:class="
												(errors.has('from_date') ? 'is-invalid' : '') +
												' form-control'
											"
											data-toggle="flatpickr"
											name="from_date"
											v-model="filterData.from_date"
											placeholder="dd/mm/yyyy"
											@change="clearRecords('from_date')"
											required
										/>
										<span
											class="invalid-feedback"
											role="alert"
											v-if="errors.has('from_date')"
										>
											<strong>{{ errors.get("from_date") }}</strong>
										</span>
									</div>
								</div>

								<div class="col">
									<div class="form-group">
										<!-- Label  -->
										<label>To Date</label>
										<!-- Input -->
										<input
											type="date"
											:class="
												(errors.has('to_date') ? 'is-invalid' : '') +
												' form-control'
											"
											data-toggle="flatpickr"
											name="to_date"
											v-model="filterData.to_date"
											placeholder="dd/mm/yyyy"
											@change="clearRecords('to_date')"
											required
										/>
										<span
											class="invalid-feedback"
											role="alert"
											v-if="errors.has('to_date')"
										>
											<strong>{{ errors.get("to_date") }}</strong>
										</span>
									</div>
								</div>
								<div class="col-auto">
									<div class="form-group">
										<button
											class="btn btn-primary mt-4"
											type="submit"
											@click="fetctAvailableRooms"
										>
											<i class="fe fe-search"></i> Fetch Rooms
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<h4 class="card-header-title">Selected Rooms</h4>
							<span class="badge badge-soft-secondary">
								{{ selectedRooms.length }} room(s) selected
							</span>
						</div>
						<div class="card-body">
							<table
								class="table table-striped list-group list-group-flush my-n3"
							>
								<tbody>
									<tr
										class="list-group-item"
										v-for="(room, index) in selectedRooms"
										:key="index"
									>
										<a href="#!" @click="removeRoom(room)">
											<div class="row align-items-center">
												<div class="col ml-n2">
													<!-- Title -->
													<h4 class="mb-1">
														{{ room.name }}
													</h4>

													<!-- Time -->
													<p class="card-text small text-muted">
														{{ room.floor }}
													</p>
												</div>
												<div class="col-auto">
													<h4 class="card-text mb-1">
														{{ currency }} {{ room.rate }}
													</h4>
													<div>
														<span class="badge badge-soft-secondary">
															{{ room.category }}
														</span>
													</div>
												</div>
											</div>
										</a>
										<!-- / .row -->
									</tr>
								</tbody>
							</table>
						</div>
						<div class="card-footer">
							<button class="btn btn-sm btn-success" @click="submitReservation">
								<span
									class="spinner-border spinner-border-sm"
									role="status"
									aria-hidden="true"
									v-if="processingForm"
								></span>
								Submit Reservation
							</button>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card vh-100 available-rooms">
						<div class="card-header">
							<h4 class="card-header-title">Available Rooms</h4>
						</div>
						<div class="card-body">
							<div class="list-group list-group-flush my-n3">
								<div
									class="list-group-item"
									v-for="(category, index) in availableRooms"
									:key="index"
								>
									<a href="#!" @click="showCategoryRooms(category.id)">
										<div class="row align-items-center">
											<div class="col-3">
												<!-- Avatar -->
												<img
													:src="category.image"
													alt="..."
													class="avatar-img rounded"
												/>
											</div>
											<div class="col ml-n2">
												<!-- Title -->
												<h4 class="mb-1">
													{{ category.name }}
												</h4>

												<!-- Time -->
												<p class="card-text small text-muted">
													{{ category.daily_rate }}

													<span class="badge badge-soft-secondary">
														{{ category.rooms.length }} room(s) Available
													</span>
												</p>
											</div>
										</div>
									</a>

									<div v-show="showRooms == category.id">
										<div
											class="comment-body ml-4 mb-2"
											v-for="(room, index) in category.rooms"
											:key="index"
										>
											<a href="#!" @click="selectRoom(room, category)">
												<div class="row">
													<div class="col">
														<!-- Title -->
														<h5 class="comment-title">{{ room.name }}</h5>
														<p class="comment-text">{{ room.floor }}</p>
													</div>
													<div class="col-auto">
														<!-- Time -->
														{{ currency }}
														{{ category.daily_rate }}
													</div>
												</div>
											</a>
											<!-- / .row -->
										</div>
									</div>
									<!-- / .row -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import FormErrors from "../../../libs/FormErrors";

export default {
	props: {
		customer: {
			type: String,
			required: true,
		},

		type: {
			type: String,
			default: 'customer'
		},
	},
	data() {
		return {
			availableRooms: [],
			selectedRooms: [],
			filterData: {from_date: null, to_date: null },
			showRooms: null,
			errors: new FormErrors(),
			processingForm: false,
		};
	},

	computed: {
		currency() {
			return hotelCurrency();
		},
	},

	methods: {

		clearRecords(err) {
			this.errors.clear(err);

			this.selectedRooms = [];
			this.availableRooms = [];
		},

		removeRoom(room) {
			let index = this.selectedRooms.findIndex((el) => el.id == room.id);
			if (index > -1) this.selectedRooms.splice(index, 1);
		},

		selectRoom(room, category) {
			let index = this.selectedRooms.findIndex((el) => el.id == room.id);
			if (index >= 0) return flash({ message: "Room is alrady added" });
			room.rate = category.daily_rate;
			room.category = category.name;
			this.selectedRooms.push(room);
		},

		submitReservation() {

			if (this.selectedRooms.length <= 0)
				return flash({ message: "You need to select rooms" });

			this.processingForm = true;

			axios
				.post(hotelUrl("reservations"), {
					rooms: this.selectedRooms.map((el) => el.id),
					customer: this.customer,
					type: this.type,
					...this.filterData,
				})
				.then(({ data }) => {
					
					flash({ type: "success", message: data.message, onClose: () => {
						window.location = hotelUrl(`reservations/${data.reservation.id}`);
					}});

					
				})
				.catch(({ response }) => {
					

					flash({ type: "error", message: response.data.message });
					this.processingForm = false;
				});
		},

		showCategoryRooms(id) {
			this.showRooms = id;
		},

		fetctAvailableRooms() {
			axios
				.get(
					hotelUrl(
						`reservations/available-rooms/?from_date=${this.filterData.from_date}&to_date=${this.filterData.to_date}`
					)
				)
				.then(({ data }) => {
					this.availableRooms = data.rooms;
				})
				.catch(({ response }) => {
					flash({ type: "error", message: response.data.message });

					if (response.status == 422) {
						this.errors.record(response.data);
					}
				});
		},
	},
};
</script>

<style scoped>
.comment-body {
	display: block;
}

a {
	color: inherit;
}

.available-rooms {
	overflow: scroll;
}
</style>