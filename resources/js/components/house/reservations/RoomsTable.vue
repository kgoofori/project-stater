<template>
	<div>
		<table class="table table-sm table-nowrap table-hover card-table">
			<thead>
				<tr>
					<th>
						<a href="#" class="text-muted list-sort"> Room Number </a>
					</th>
					<th>
						<a href="#" class="text-muted list-sort"> Floor </a>
					</th>
					<th>
						<a href="#" class="text-muted list-sort"> Customer Name </a>
					</th>
					<th>
						<a href="#" class="text-muted list-sort" data-sort="products-stock">
							Customer Phone
						</a>
					</th>
					<th>
						<a href="#" class="text-muted list-sort" data-sort="products-price">
							From
						</a>
					</th>
					<th>
						<a href="#" class="text-muted list-sort" data-sort="products-price">
							To
						</a>
					</th>
					<th>
						<a href="#" class="text-muted list-sort" data-sort="products-price">
							Status
						</a>
					</th>
					<th colspan="2">
						<a href="#" class="text-muted list-sort" data-sort="products-sales">
							Action
						</a>
					</th>
				</tr>
			</thead>
			<tbody class="list">
				<tr v-for="(booking, index) in rooms" :key="index">
					<td>
						{{ booking.room.name }}
					</td>
					<td>
						{{ booking.room.floor }}
					</td>
					<td>
						<span v-if="booking.customer">
							<a :href="booking.customer.profile_url">{{
								booking.customer.name
							}}</a>
						</span>
					</td>
					<td>
						<span v-if="booking.customer">{{ booking.customer.phone }}</span>
					</td>
					<td>
						{{ booking.from_date }}
					</td>
					<td>
						{{ booking.to_date }}
					</td>

					<td>
						<span
							class="badge badge-soft-warning"
							v-if="booking.status == 'PROCESSING'"
							>PROCESSING</span
						>
						<span
							class="badge badge-soft-success"
							v-if="booking.status == 'CONFIRMED'"
							>CONFIRMED</span
						>
						<span
							class="badge badge-soft-danger"
							v-if="booking.status == 'CANCELED'"
							>CANCELED</span
						>
						<span
							class="badge badge-soft-secondary"
							v-if="booking.status == 'CLOSED'"
							>CLOSED</span
						>
						<span
							class="badge badge-soft-info"
							v-if="booking.status == 'CHECKED_IN'"
							>CHECKED IN</span
						>
					</td>
					<td class="text-right">
						<div class="dropdown">
							<a
								href="#"
								class="dropdown-ellipses dropdown-toggle btn btn-sm btn-dark"
								role="button"
								data-toggle="dropdown"
								aria-haspopup="true"
								aria-expanded="false"
							>
								<i class="fe fe-more-vertical"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<a href="#!" class="dropdown-item"> View </a>
								<a
									:href="vueHotelUrl(`reservations/${booking.reservation_id}`)"
									class="dropdown-item"
									v-if="showReservation"
								>
									Reservation
								</a>

								<a
									href="#!"
									class="dropdown-item"
									v-if="booking.status == 'CONFIRMED'"
									data-toggle="modal"
									data-target="#checkInForm"
									@click="setBooking(booking, index)"
								>
									Check In
								</a>
								<a
									href="#!"
									class="dropdown-item"
									data-toggle="modal"
									data-target="#checkOutComfirm"
									v-if="booking.status == 'CHECKED_IN'"
									@click="setBooking(booking, index)"
								>
									Check Out
								</a>
								<a
									href="#!"
									class="dropdown-item"
									data-toggle="modal"
									data-target="#extensionForm"
									v-if="booking.status == 'CHECKED_IN'"
									@click="setBooking(booking, index)"
								>
									Extend Stay
								</a>
							</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>

		<div
			class="modal fade"
			id="checkInForm"
			tabindex="-1"
			role="dialog"
			aria-hidden="true"
		>
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-card card">
						<div class="card-header">
							<h4 class="card-header-title">Check In Customer</h4>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col">
									<div class="form-group">
										<!-- Label  -->
										<label>Customer</label>
										<select
											id="select-checkin-customer"
											class="custom-select"
											v-model="checkInData.customer_id"
											data-toggle="select"
										>
											<option value>Please select</option>
											<option
												v-for="(customer, index) in customers"
												:value="customer.id"
												:key="index"
											>
												{{ customer.name }} {{ customer.phone }}
											</option>
										</select>
									</div>
								</div>
								<div class="col-auto">
									<div class="form-group">
										<a
											href="#!"
											class="btn btn-light mt-4"
											role="button"
											data-toggle="modal"
											data-target="#customerFormModal"
											><span class="fe fe-user-plus"></span
										></a>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<!-- Label  -->
										<label>Number of Adults</label>
										<!-- Input -->
										<input
											type="text"
											:class="
												(checkInErrors.has('number_of_adults')
													? 'is-invalid'
													: '') + ' form-control'
											"
											name="number_of_adults"
											min="1"
											v-model="checkInData.number_of_adults"
											@change="checkInErrors.clear('number_of_adults')"
											required
										/>
										<span
											class="invalid-feedback"
											role="alert"
											v-if="checkInErrors.has('number_of_adults')"
										>
											<strong>{{
												checkInErrors.get("number_of_adults")
											}}</strong>
										</span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<!-- Label  -->
										<label>Number of Children</label>
										<!-- Input -->
										<input
											type="text"
											:class="
												(checkInErrors.has('number_of_children')
													? 'is-invalid'
													: '') + ' form-control'
											"
											name="number_of_children"
											v-model="checkInData.number_of_children"
											@change="checkInErrors.clear('number_of_children')"
											required
										/>
										<span
											class="invalid-feedback"
											role="alert"
											v-if="checkInErrors.has('number_of_children')"
										>
											<strong>{{
												checkInErrors.get("number_of_children")
											}}</strong>
										</span>
									</div>
								</div>
							</div>
						</div>

						<div class="card-footer text-right">
							<button
								href="#!"
								class="btn btn-sm btn-primary"
								:disabled="processingForm"
								@click="checkIntoFroomRoom"
							>
								<span
									class="spinner-border spinner-border-sm"
									role="status"
									aria-hidden="true"
									v-if="processingForm"
								></span
								>Submit
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div
			class="modal fade"
			id="extensionForm"
			tabindex="-1"
			role="dialog"
			aria-hidden="true"
		>
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-card card">
						<div class="card-header">
							<h4 class="card-header-title">Extend Stay</h4>
						</div>
						<div class="card-body">
							<div class="col">
								<div class="form-group">
									<!-- Label  -->
									<label>To Date</label>
									<!-- Input -->
									<input
										type="date"
										:class="
											(extentioErrors.has('to_date') ? 'is-invalid' : '') +
											' form-control'
										"
										data-toggle="flatpickr"
										name="to_date"
										v-model="extentionData.to_date"
										placeholder="dd/mm/yyyy"
										@change="clearRecords('to_date')"
										required
									/>
									<span
										class="invalid-feedback"
										role="alert"
										v-if="extentioErrors.has('to_date')"
									>
										<strong>{{ extentioErrors.get("to_date") }}</strong>
									</span>
								</div>
							</div>
						</div>
						<div class="card-footer text-right">
							<button
								href="#!"
								class="btn btn-sm btn-primary"
								@click="extendRoomDate"
								:disabled="processingForm"
							>
								<span
									class="spinner-border spinner-border-sm"
									role="status"
									aria-hidden="true"
									v-if="processingForm"
								></span
								>Submit
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div
			class="modal fade"
			id="checkOutComfirm"
			tabindex="-1"
			role="dialog"
			aria-hidden="true"
		>
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-card card">
						<div class="card-header">
							<h4 class="card-header-title">Check Out Customer</h4>
						</div>
						<div class="card-body">
							<p>
								Are you sure you want to
								<span style="font-weight: bold">check out</span>?
							</p>
						</div>
						<div class="card-footer">
							<div class="row">
								<div class="col">
									<a
										href="#!"
										data-dismiss="modal"
										class="btn btn-sm btn-primary"
										>No</a
									>
								</div>
								<div class="col-auto">
									<a
										href="#!"
										class="btn btn-sm btn-danger"
										@click="checkOutFroomRoom"
										><span
											class="spinner-border spinner-border-sm"
											role="status"
											aria-hidden="true"
											v-if="processingForm"
										></span
										>Yes</a
									>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div
			class="modal fade"
			id="customerFormModal"
			tabindex="-1"
			role="dialog"
			aria-hidden="true"
		>
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="card">
						<div class="card-header">
							<h4 class="card-header-title">New Lead</h4>
						</div>
						<div class="card-body">
							<customer-from :customer="{}" @processed="doneProcessing" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import FormErrors from "../../../libs/FormErrors";
import CustomerFrom from "../../crm/CustomerForm.vue";

export default {
	props: {
		rooms: {
			require: true,
			type: Array,
		},
		showReservation: false,
	},
	components: { CustomerFrom },
	data() {
		return {
			currentBooking: {},
			customers: [],
			currentIndex: null,
			processingForm: false,
			checkInErrors: new FormErrors(),
			extentioErrors: new FormErrors(),
			extentionData: { to_date: null },
			checkInData: {
				customer_id: null,
				number_of_adults: 1,
				number_of_children: null,
			},
		};
	},

	mounted() {
		$("#select-checkin-customer").on("select2:select", ({ params }) => {
			this.checkInData.customer_id = params.data.id;
		});
	},

	created() {
		this.fetchCustomer();
	},

	methods: {
		doneProcessing(customer) {
			this.customers.push(customer);
			this.checkInData.customer_id = customer.id;

			let newOPtion = new Option(
				customer.name + "(" + customer.phone + ")",
				customer.id,
				false,
				true
			);
			$("#select-checkin-customer").append(newOPtion).trigger("change");

			$("#customerFormModal").modal("hide");
		},
		checkOutFroomRoom() {
			this.processingForm = true;
			axios
				.post(
					hotelUrl(`bookings/${this.currentBooking.id}/check-out`),
					this.extentionData
				)
				.then(({ data }) => {

					let revervationId = this.currentBooking.reservation_id;

					flash({
						type: "success",
						message: data.message,
						onClose: () => {
							window.location = hotelUrl(
								`reservations/${revervationId}`
							);
						},
					});

					this.clearAll();
				})
				.catch(({ response }) => {
					
					flash({ type: "error", message: response.data.message });
				})
				.finally(() => {
					this.processingForm = false;
				});
		},

		extendRoomDate() {
			this.processingForm = true;
			axios
				.post(
					hotelUrl(`bookings/${this.currentBooking.id}/extension`),
					this.extentionData
				)
				.then(({ data }) => {
					flash({
						type: "success",
						message: data.message,
						onClose: () => {
							window.location = hotelUrl(
								`reservations/${this.currentBooking.reservation_id}`
							);
						},
					});

					this.clearAll();
				})
				.catch(({ response }) => {
					

					flash({ type: "error", message: response.data.message });
				})
				.finally(() => {
					this.processingForm = false;
				});
		},
		checkIntoFroomRoom() {
			this.processingForm = true;
			axios
				.post(
					hotelUrl(`bookings/${this.currentBooking.id}/check-in`),
					this.checkInData
				)
				.then(({ data }) => {
					flash({ type: "success", message: data.message });

					this.rooms[this.currentIndex] = data.booking;
					this.clearAll();
				})
				.catch(({ response }) => {
					

					flash({ type: "error", message: response.data.message });
					this.processingForm = false;
				})
				.finally(() => {
					this.processingForm = false;
				});
		},

		fetchCustomer() {
			axios.get(hotelUrl("customers")).then(({ data }) => {
				this.customers = data.customers;
			});
		},

		vueHotelUrl(url) {
			return hotelUrl(url);
		},

		setBooking(booking, index) {
			this.currentBooking = booking;
			this.currentIndex = index;
		},

		clearAll() {
			(this.currentBooking = {}),
				(this.currentIndex = null),
				$(".modal").modal("hide");
		},
	},
};
</script>

<style>
</style>