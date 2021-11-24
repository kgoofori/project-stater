<template>
	<div>
		<div class="card">
			<div class="card-header">
				<h4 class="card-header-title">Rooms</h4>
				<a
					href="#!"
					class="btn btn-sm btn-white"
					@click="clearRoom"
					role="button"
					data-toggle="modal"
					data-target="#roomsModal"
					>Add</a
				>
			</div>
			<div class="card-bod">
				<table class="table table-sm">
					<thead>
						<tr>
							<th>Name/Number</th>
							<th>Floor</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(room, index) in rooms" :key="index">
							<td>{{ room.name }}</td>
							<td>{{ room.floor }}</td>
							<td><span class="badge badge-soft-success">Acive</span></td>
							<td>
								<a href="#!" class="btn btn-sm btn-light" @click="editRoom({...room})">
											Edit
										</a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<div
			class="modal fade room-form-modal"
			id="roomsModal"
			tabindex="-1"
			role="dialog"
			aria-hidden="true"
		>
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<rooms-form
						:categoryId="categoryId"
						@room-added="roomAdded"
						:form-data="editForRoom"
					/>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import RoomsForm from "./RoomsForm";

export default {
	components: {
		RoomsForm,
	},
	props: {
		initialData: {
			type: Array,
		},
		categoryId: {
			type: String,
			required: true,
		},
	},
	data() {
		return {
			rooms: [],
			editForRoom: { room: null, floor: null, id: null },
			processingForm: false,
		};
	},

	created() {
		if (this.initialData) {
			this.rooms = this.initialData;
		}
	},

	methods: {
		roomAdded(room, id) {

			if(id){
				this.rooms.forEach((rm, i) => {
					if(rm.id == id){
						this.rooms[i] = room;
					}
				})
			}else{
				this.rooms.push(room);
			}
			
			$(".modal").modal("hide");
		},

		editRoom(room) {
			this.editForRoom = room;
			$(".room-form-modal").modal("show");
		},

		clearRoom(){
			this.editForRoom = { room: null, floor: null, id: null };
			
		}
	},
};
</script>

<style>
</style>