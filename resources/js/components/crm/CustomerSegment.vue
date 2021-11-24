<template>
	<select
		class="form-control"
		data-toggle="select"
		multiple
		id="select-segment"
		data-options='{"tags": "true"}'
	>
		<option
			v-for="(segment, index) in segments"
			:value="segment.id"
			:key="index"
			:selected="isSelected(segment)"
		>
			{{ segment.name }}
		</option>
	</select>
</template>

<script>
export default {
	props: {
        customer: {
            type: String,
            required: true
        }, 
        type: {
            type: String,
            default: 'customer'
        },
        initSegments: {
            type: Array,
            default: []
        }
    },
	data() {
		return {
			segments: [],
		};
	},

	created(){
		this.fetchCategories()
	},

	mounted() {
		$("#select-segment").on("select2:select", ({ params }) => {
			this.customerSegment(params.data, 'attach')
		});	

		$("#select-segment").on("select2:unselect", ({ params }) => {
			this.customerSegment(params.data, 'detach')
		});
	},

	computed: {
		
	},

	methods: {
		isSelected(segment){
			let index = this.initSegments.findIndex((el) => el.id == segment.id)

			if(index >= 0) return true;

			return false
		},

		customerSegment(data, action){
			axios
				.post(hotelUrl("segments"), {
					customer: this.customer,
					type: this.type,
					segment: data.text,
					action: action
				})
				.then(({data}) => {
					flash({message: data.message})
				});
		},
		fetchCategories() {
			axios.get(hotelUrl("segments")).then(({ data }) => {
				this.segments = data;
			});
		},
	},
};
</script>

<style>
</style>