<template>
	<div class="list-group-item" v-if="!deleted">
		<div class="row align-items-center">
			<div class="col-auto">
				<!-- Avatar -->
				<div class="avatar avatar-lg">
					<span class="avatar-title rounded-circle">{{ user.initials }}</span>
				</div>
			</div>
			<div class="col ml-n2">
				<!-- Title -->
				<h4 class="mb-1">
					<a href="#!">{{ user.name }}</a>
				</h4>

				<!-- Email -->
				<p class="small text-muted mb-0">
					<a
						class="d-block text-reset text-truncate"
						:href="`mailto:${user.email}`"
						>{{ user.email }}</a
					>
				</p>
			</div>
			<div class="col-auto mr-3" v-if="user.pivot.role == 'OWNER'">
				<!-- Dropdown -->
				OWNER
			</div>

			<div class="col-auto ml-auto mr-n3" v-else>
				<!-- Select -->
				<select class="custom-select" v-model="roleData" @change="changeRole">
					<option value="ADMIN">Admin</option>
					<option value="STAFF">Staff</option>
				</select>
			</div>
			<div class="col-auto" v-if="user.pivot.role != 'OWNER'">
				<div class="dropdown">
					<a
						href="#"
						class="dropdown-ellipses dropdown-toggle"
						role="button"
						data-toggle="dropdown"
						aria-haspopup="true"
						aria-expanded="false"
					>
						<i class="fe fe-more-vertical"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right" style="">
						<a href="#!" class="dropdown-item text-danger" @click="removeUser">
							Remove
						</a>
					</div>
				</div>
			</div>
		</div>
		<!-- / .row -->
	</div>
</template>

<script>
export default {
	props: {
		user: {
			required: true,
			type: Object,
		},
	},
	data() {
		return {
			roleData: null,
			deleted: false
		};
	},
	created() {
		this.roleData = this.user.pivot.role;
	},
	methods: {
		changeRole() {
			axios
				.post(hotelUrl("settings/change-user-role"), {
					user: this.user.id,
					role: this.roleData
				})
				.then(({ data }) => {
					flash({ type: "success", message: data.message });
				})
				.catch(({ response }) => {
					flash({ type: "error", message: response.data.message });
				});
		},
		removeUser() {
			axios
				.post(hotelUrl("settings/remove-user"), {
					user: this.user.id
				})
				.then(({ data }) => {
					flash({ type: "success", message: data.message });
					this.deleted = true;
				})
				.catch(({ response }) => {
					flash({ type: "error", message: response.data.message });
				});
		},
	},
};
</script>

<style>
</style>