
export default {
    methods: {

        acceptInvitation(invitation) {
            axios
                .post('invitations/accept', {id: invitation})
                .then(({ data }) => {
                    flash({ type: "success", message: data.message });
                    window.location.reload();
                })
                .catch(({ response }) => {
                    flash({
                        message: response.data.message
                    });

                });
        },

        skipAll() {
            axios
                .post('invitations/skip-all')
                .then(({ data }) => {
                    flash({ type: "success", message: data.message });
                    window.location = '/';
                })
                .catch(({ response }) => {
                    flash({
                        message: response.data.message
                    });

                });
        },

        
    }
}