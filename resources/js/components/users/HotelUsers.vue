<template>
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<!-- Title -->
				<h4 class="card-header-title">All Users</h4>

				<!-- Dropdown -->
			</div>
			<div class="card-body">
				<div class="list-group list-group-flush my-n3">
					<user-card-item v-for="(user, index) in users" :key="index" :user="user" />
				</div>
			</div>
			<!-- / .card-body -->
		</div>
	</div>
</template>

<script>
import UserCardItem from "./UserCardItem.vue";

export default {
	components: { UserCardItem },
	props: ["initUsers"],
	data() {
		return {
			users: [],
		};
	},
	created() {
		if (this.initUsers) {
			this.users = this.initUsers;
		}
	},
};
</script>

<style>
</style>