<template>
	<select class="select2" data-toggle="select2" data-options="{}">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
		<!-- <slot></slot> -->
	</select>
</template>

<script>
export default {
	props: ["options", "value"],
	mounted() {
		initSelect2($(this.$el)[0]);
	},

	watch: {
		value: function(value) {
			// update value
			$(this.$el)
				.val(value)
				.trigger("change");
			this.$emit("change", value);
		},
		options: function(options) {
			// update options
			$(this.$el)
				.empty()
				.select2({ data: options });
		}
	}
};
</script>

<style>
</style>