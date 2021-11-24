<template>
	<div class="alert-box flash-alert">
		<div class="alert alert-dark" role="alert" v-show="show">{{body}}</div>
	</div>
</template>

<script>
export default {
	props: ['message'],

	data() {
		return {
			body: "", show : false,
		};
	},

	created() {
		if (this.message.trim()) {
			this.flash({message: this.message.trim()});
		}

		window.events.$on("flash", options => {
			this.flash(options);
		});
	},

	methods: {
		flash(options) {
            this.$notify({message: options.message, type: options.type ?? 'info', onClose: options.onClose})
		}
	}
};
</script>

<style>
    .flash-alert{
        position: fixed;
        bottom: 25px;
        right: 25px;
		z-index: 99999999999999999;
    }
</style>