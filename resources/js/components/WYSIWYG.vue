<template>
	<div ref="editor"></div>
</template>

<script>
import Quill from "quill";

export default {
	props: {
		value: {
			type: String,
			default: ""
		}
	},

	data() {
		return {
			editor: null
		};
	},
	mounted() {
		this.editor = new Quill(this.$refs.editor, {
			modules: {
				toolbar: [
					["bold", "italic"],
					["link", "blockquote", "code"],
					[
						{
							list: "ordered"
						},
						{
							list: "bullet"
						}
					]
				]
			},
			theme: "snow"
		});

		this.editor.root.innerHTML = this.value;

		this.editor.on("text-change", () => this.update());
	},

	methods: {
		update() {
			this.$emit(
				"input",
				this.editor.getText() ? this.editor.root.innerHTML : ""
			);
			this.$emit('change');
		}
	}
};
</script>

<style>
</style>