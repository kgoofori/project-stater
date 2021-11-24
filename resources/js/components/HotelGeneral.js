
import Gallery from './Gallery'
import FormErrors from "../libs/FormErrors";

export default {
    components: {
        Gallery
    },

    props: {
        initHotelInfo: {
            required: true
        }
    },

    data() {
        return {
            hotelInfo: {},
            errors: new FormErrors(),
            processingForm: false,
            imageType: null,
            favicon: {},
            logo: {},
        }
    },

    created() {
        this.hotelInfo = this.initHotelInfo
    },

    methods: {

        openImagePickerModal(type) {
            this.imageType = type

            $('#imagePickerModal').modal('show');
        },

        updateHotelInfo() {
            if (this.errors.any()) {
                flash({
                    message: "You have errors in the data"
                });
                return;
            }

            this.processingForm = true;

            axios
                .patch(hotelUrl(`update`), this.hotelInfo)
                .then(({ data }) => {
                    flash({ type: "success", message: data.message });
                })
                .catch(({ response }) => {
                    
                    if (response.status == 422) {
                        this.errors.record(response.data);
                    }
                    flash({
                        message: response.data.message
                    });

                }).finally(() => {
                    this.processingForm = false;
                });
        },

        changeLogo(data) {
            this.shipping = data
        },

        changeFavicon(data) {
            this.shipping = data
        },

        selected(image) {
            if (image) {
                
                var data;

                if(this.imageType == 'logo'){
                    this.logo = image
                    data = {logo_id: image.id}
                }else{
                    this.favicon = image
                    data = {favicon_id: image.id}
                }

                axios
                    .patch(hotelUrl(`update/icons`), data)
                    .then(({ data }) => {
                        flash({ type: "success", message: data.message });
                    })
                    .catch(({ response }) => {
                        flash({
                            message: response.data.message
                        });
                    });

                return;
            }

            flash({
                message: 'No image was selected'
            })

        }
    },
}