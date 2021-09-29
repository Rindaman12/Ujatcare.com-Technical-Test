<template>
    <div class="q-pa-md row items-start q-gutter-md">
        <q-card class="my-card">
            <q-card-section class="header text-white">
                <div class="text-h6" color="white">List Images</div>
            </q-card-section>
            <div v-for="image in images" :key="image.created_at">
                <q-separator inset />

                <div class="q-pa-md row items-start q-gutter-md">
                    <q-card class="image-card">
                        <img class="img-responsive"  :src="'../images/uploads/'+ image.image" />

                        <q-card-section>
                            <div class="text-h6">Image Description:</div>
                            <div class="text-subtitle2">
                                {{ image.description }}
                            </div>
                        </q-card-section>
                    </q-card>
                </div>
                <q-separator inset />
            </div>
        </q-card>
    </div>
</template>

<script>
import Csfr from "./Csrf";
import Swal from "sweetalert2";

export default {
    components: {
        inputCsfr: Csfr,
    },

    data() {
        return {
            errors: [],
            images: "",
        };
    },
    created() {
        // Simple GET request using axios
        this.getImages();
    },
    methods: {
        showAlert(type, title, message) {
            Swal.fire({
                icon: type,
                title: title,
                text: message,
            });
        },

        getImages: function () {
            axios
                .get("/api/images")
                .then((response) => {
                    setTimeout(() => {
                        this.images = response.data.images;
                    }, 1000);
                })

                .catch((err) => {
                    if (error.response && error.response.status === 401) {
                        location.reload();
                    }

                    console.log(err.response);
                    this.showAlert(
                        "error",
                        "List Couldn't be Loaded.",
                        ...Object.values(err.response.data)[0]
                    );
                });
        },
        exit() {
            this.errors = [];
        },
    },
};
</script>

<style scoped>
.image-card {
    width: 100%;
    max-width: 250px;
    margin: auto;
    margin-top: 4%;
    margin-bottom: 4%;
    align-self: center;
    justify-self: center;
    display: flex;
    flex-direction: column;
    border-radius: 15px;
    overflow: hidden;
}

.my-card {
    width: 100%;
    max-width: 600px;
    margin: auto;
    margin-top: 4%;
    margin-bottom: 4%;
    align-self: center;
    justify-self: center;
    display: flex;
    flex-direction: column;
    border-radius: 15px;
    overflow: hidden;
}
</style>
