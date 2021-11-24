import FormErrors from "../../../libs/FormErrors";

export default {
    props: {
        reservationId: {
            require: true,
            type: String
        },
        rooms: {
            type: Array
        }
    },

    data() {
        return {
            newStatus: null,
            processingForm: false,
            payData: { amount: null, channel: null },
            payErrors: new FormErrors
        }
    },

    methods: {

        confirmStatus(status){
            this.newStatus = status;

            this.$confirm(
                `Are you sure you want to <strong>${this.statusString}</strong> this reservation?`, 
                "Warning",
                {
                    dangerouslyUseHTMLString: true,
                    confirmButtonText: "Yes, I am sure",
                    cancelButtonText: "Cancel",
                    type: "warning",
                }
            ).then(() => {
                this.changeReservationStatus();
            }).catch(()=> {});
        },

        changeReservationStatus() {
            this.processingForm = true
            axios
                .patch(hotelUrl(`reservations/${this.reservationId}`), {
                    'status': this.newStatus,
                })
                .then(({ data }) => {
                    flash({ type: "success", message: data.message, onClose: () => {
                        window.location = hotelUrl(`reservations/${this.reservationId}`)
                    } });
                })
                .catch(({ response }) => {
                    

                    flash(response.data);
                    this.processingForm = false;

                    $('.modal').modal('hide');
                })
        },

        payReservation() {
            this.processingForm = true
            axios
                .post(hotelUrl(`reservations/${this.reservationId}/pay`), this.payData)
                .then(({ data }) => {
                    flash({ type: "success", message: data.message, onClose: () => {
                        window.location = hotelUrl(`reservations/${this.reservationId}`)
                    } });
                    
                })
                .catch(({ response }) => {
                    

                    flash(response.data);
                    this.processingForm = false;
                })
        },

        printPaymentReceipt(id) {
            let mywindow = window.open(hotelUrl(`payments/${id}/receipt`),
                "PRINT",
                "height=500,width=800"
            );
            mywindow.addEventListener("load", function () {
                mywindow.print();
                setTimeout(() => {
                    mywindow.close();
                }, 500);
            });
        },

        printDivInvoice() {
            let head = document.getElementsByTagName('head')[0].innerHTML;;
            let mywindow = window.open('', 'PRINT', 'height=500,width=800');

            mywindow.document.write(head);
            mywindow.document.write($('#ivoice-card').html());

            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10

            mywindow.addEventListener('load', function () {
                mywindow.print();

                setTimeout(() => {
                    mywindow.close();
                }, 300);
            });
        }
    },

    computed: {
        statusString() {
            if (this.newStatus == null) return '';
            if (this.newStatus == 'CLOSED') return 'close';

            return this.newStatus.replace('ED', '').toLowerCase()
        }
    }
}