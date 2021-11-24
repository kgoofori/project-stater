<template>
	<div>
		<div class="row justify-content-center">
			<div class="col-12 col-md-5 col-xl-4 my-5">
				<!-- Heading -->
				<h1 class="display-4 text-center mb-3">Payment</h1>

				<!-- Subheading -->
				<p class="text-muted text-center mb-5">{{plan.name}} plan @GHS{{plan.price}}</p>

				<!-- Form -->
				<form method="POST" v-if="payWith == 'new-card'">
					<!-- Email address -->
					<div class="form-group">
						<label>Email</label>

						<!-- Input -->
						<input
							v-model="formData.email"
							type="email"
							:class=" (errors.has('email')? 'is-invalid ': '')  + 'form-control'"
							autocomplete="email"
							@change="errors.clear('email')"
						/>
						<span class="invalid-feedback" role="alert" v-if="errors.has('email')">
							<strong>{{ errors.get('email') }}</strong>
						</span>
					</div>

					<!-- Submit -->
					<button
						:disabled="errors.any() || processingForm"
						@click.prevent="subscribeToPlan"
						class="btn btn-lg btn-block btn-primary mb-3"
					>
						<span
							class="spinner-border spinner-border-sm"
							role="status"
							aria-hidden="true"
							v-if="processingForm"
						></span>
						Pay GHS{{ plan.price }}
					</button>
				</form>

				<div class="list-group list-group-flush my-n3" v-if="payWith == 'old-card'">
					<div class="list-group-item" v-for="(card, index) in cards" :key="index">
						<label class="btn btn-white" style="display: block">
							<div class="row align-items-center">
								<div class="col-auto">
									<input type="radio" name="card" :value="card.id" v-model="formData.card_id" />
								</div>
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
								<div class="col ml-n2 text-left">
									<!-- Heading -->
									<h4 class="mb-1">{{card.card_type}} ending in {{card.last4}}</h4>

									<!-- Text -->
									<small class="text-muted">Expires {{card.exp_month}}/{{card.exp_year}}</small>
								</div>
								<div class="col-auto" v-if="card.is_default">
									<!-- Badge -->
									<span class="badge badge-light">Default</span>
								</div>
							</div>
						</label>
					</div>

					<button
						:disabled="errors.any() || processingForm"
						@click.prevent="subscribeToPlanWithCard"
						class="btn btn-lg btn-block btn-primary mb-3"
					>
						<span
							class="spinner-border spinner-border-sm"
							role="status"
							aria-hidden="true"
							v-if="processingForm"
						></span>
						Pay GHS{{ plan.price }}
					</button>

					<p class="text-center">
						<small class="text-muted">
							<a href="#cancel" @click.prevent="payWithNewCard">I want to pay with a new Card</a>
						</small>
					</p>
				</div>
			</div>
		</div>
		<!-- / .row -->
	</div>
</template>

<script>
import Config from "../libs/Config";
import FormErrors from "../libs/FormErrors";

export default {
	props: {
		plan: {
			required: true,
		},
		cards: {},
	},

	data() {
		return {
			formData: { currency: "GHS" },
			processingForm: false,
			errors: new FormErrors(),
			payWith: "new-card",
		};
	},

	created() {
		if (this.plan) {
			this.formData.amount = this.plan.price * 100;
			this.formData.plan_id = this.plan.id;
		}

		if (this.cards) {
			this.payWith = "old-card";
		}
	},
	computed: {
		currency(){
			return hotelCurrency()
		}
	},

	methods: {
		subscribeToPlan() {
			//create a subscription invoice
			axios
				.post(hotelUrl("subscribe"), this.formData)
				.then(({ data }) => {
					this.formData.ref = data.reference;

					if (!this.formData.card_id) {
						this.triggerPayment();
					}
				})
				.catch(({ response }) => {
					if (response.status == 422) {
						this.errors.record(response.data);
					}

					flash({ type: "error", message: response.data.message });

					this.processingForm = false;
				});
		},

		subscribeToPlanWithCard(){
			if(this.formData.card_id){
				this.subscribeToPlan()
			}else{
				flash({
					message: 'Please select a card'
				});
			}
		},

		triggerPayment() {
			this.formData.key = Config.paystckPub;

			let handler = PaystackPop.setup({
				...this.formData,
				onClose: () => {
					flash({
						message: "Could not complete subscription, please try again",
					});
				},
				callback: (response) => {
					if (response.status == "success") {
						window.location = hotelUrl("settings/subscription?success");
					} else {
						flash({ message: "Subscription failed, please try again later" });
					}
					
				},
			});
			handler.openIframe();
		},

		payWithNewCard(card) {
			delete this.formData.card_id;
			this.payWith = "new-card";

		},
	},
};
</script>

<style>
</style>