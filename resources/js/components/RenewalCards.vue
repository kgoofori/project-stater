<template>
	<div>
		<div class="card">
			<div class="card-header">
				<div class="row align-items-center">
					<div class="col">
						<!-- Title -->
						<h4 class="card-header-title">Payment methods</h4>
					</div>
					<!-- <div class="col-auto">
						<a class="btn btn-sm btn-primary" href="#add_payment_method">Add method</a>
					</div> -->
				</div>
			</div>
			<div class="card-body">
				<!-- List group -->
				<div class="list-group list-group-flush my-n3">
					<div class="list-group-item" v-for="(card, index) in cards" :key="index">
						<div class="row align-items-center">
							<div class="col-auto">
								<!-- Image -->
								<img
									class="img-fluid"
									src="/assets/img/payment-methods/visa.svg"
									alt="..."
									style="max-width: 38px;"
									v-if="card.card_type == 'visa'"
								/>
								<img
									class="img-fluid"
									src="/assets/img/payment-methods/mastercard.svg"
									alt="..."
									style="max-width: 38px;"
									v-if="card.card_type == 'master'"
								/>
							</div>
							<div class="col ml-n2">
								<!-- Heading -->
								<h4 class="mb-1">{{card.card_type}} ending in {{card.last4}}</h4>

								<!-- Text -->
								<small class="text-muted">Expires {{card.exp_month}}/{{card.exp_year}}</small>
							</div>
							<div class="col-auto mr-n3" v-if="card.is_default">
								<!-- Badge -->
								<span class="badge badge-light">Default</span>
							</div>
							<div class="col-auto" v-else>
								<!-- Dropdown -->
								<div class="dropdown">
									<a
										class="dropdown-ellipses dropdown-toggle"
										href="#"
										role="button"
										data-toggle="dropdown"
										aria-haspopup="true"
										aria-expanded="false"
									>
										<i class="fe fe-more-vertical"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right" style>
										<a
											class="dropdown-item"
											href="#make_default"
											@click.prevent="makeCardDefault(card, index)"
										>Make Default</a>
										<a
											class="dropdown-item text-red"
											href="#remove_card"
											@click.prevent="removeCard(card, index)"
										>Remove</a>
									</div>
								</div>
							</div>
						</div>
						<!-- / .row -->
					</div>
				</div>
			</div>
		</div>

		<p class="text-center" v-if="renewable">
			<small class="text-muted">
				<a
					href="#cancel"
					class="text-red"
					@click.prevent="showCancelSubDialog"
                    role="button"
					data-toggle="modal"
					data-target="#cancelSubscription"
				>Cancel shop's subscription</a>
			</small>
		</p>



		<div class="modal fade" id="cancelSubscription" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="card">
						<div class="card-header">Cancel Subscription</div>
						<div class="card-body">
							<p>Your current subscription will not be renwed at the end date if you continue</p>
							<button type="button" class="btn btn-light mr-3" @click="hideModel">Cancel</button>
							<button
								type="button"
								class="btn btn-danger"
								:disabled="processingForm"
								@click="showCancelSubscription"
							>
								<span
									class="spinner-border spinner-border-sm"
									role="status"
									aria-hidden="true"
									v-if="processingForm"
								></span>
								Continue
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>

        <div class="modal fade" id="removeCard" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="card">
						<div class="card-header">Remove Card</div>
						<div class="card-body">
							<p>Are you sure you want remove {{selectedCard.type}} ending {{selectedCard.last4}}?</p>
							<button type="button" class="btn btn-light mr-3" @click="hideModel">Cancel</button>
							<button
								type="button"
								class="btn btn-danger"
								:disabled="processingForm"
								@click="processCardRemoval"
							>
								<span
									class="spinner-border spinner-border-sm"
									role="status"
									aria-hidden="true"
									v-if="processingForm"
								></span>
								Remove
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: ["initCards", "renewable"],
	data() {
		return {
			cards: [],
            processingForm: false,
            selectedCard: {},
            cardIndex: null,
		};
	},

	methods: {
		makeCardDefault(card, index) {},
        removeCard(card, index) {
            this.selectedCard = card;
            this.cardIndex = index;

            $('#removeCard').modal('show')
        },
        
		showCancelSubscription() {
            axios
				.delete(hotelUrl(`subscription/cancel`))
				.then(({ data }) => {
                    flash({ type: "success", message: data.message, onClose: () => {
						window.location = hotelUrl('settings/subscription');
					} });
                    
                    //reload page
                    
				})
				.catch(({ response }) => {
					flash({
						message: response.data.message
                    });
                })
                .finally(() => {
                    this.hideModel()
				});
        },

        processCardRemoval(){
            axios
				.delete(hotelUrl(`subscription/cards`, {card_id: this.selectedCard.id}))
				.then(({ data }) => {
                    flash({ type: "success", message: data.message });
                    this.cards.splice(this.cardIndex, 1);
				})
				.catch(({ response }) => {
					flash({
						message: response.data.message
                    });
                })
                .finally(() => {
                    this.hideModel()
				});
        },

		hideModel() {
			this.processingForm = false;
			$(".modal").modal("hide");
		},
	},
	created() {
		if (this.initCards) {
			this.cards = this.initCards;
		}
	},
};
</script>

<style>
</style>