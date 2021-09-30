<template>
    <div class="q-pa-md row items-start q-gutter-md">
        <q-card class="my-card">
            <!-- We create the form tag with the submit and reset capabilities -->

            <q-form
                @submit.prevent="addImage"
                @reset="onReset"
                class="q-gutter-md"
            >
                <!-- We create a csrf token for protection -->

                <input-csfr />

                <q-card-section class="header">
                    <div class="text-h6" style="color: white">Add Image</div>
                </q-card-section>

                <!-- We create form controls and validations -->

                <q-card-section class="q-pt-none">
                    <q-input
                        filled
                        v-model="description"
                        name="description"
                        label="Description"
                        hint="Please introduce your description."
                        lazy-rules
                        :rules="[
                            (val) =>
                                (val && val.length > 0) ||
                                'Please type something.',
                        ]"
                    />
                </q-card-section>

                <q-separator inset />

                <q-card-section>
                    <div class="q-gutter-sm">
                        <div class="text-h6">Resolution</div>

                        <q-radio
                            v-model="resolution"
                            name="resolution"
                            val="200x200"
                            label="200x200"
                            color=""
                        />
                        <q-radio
                            v-model="resolution"
                            name="resolution"
                            val="300x300"
                            label="300x300"
                        />
                        <q-radio
                            v-model="resolution"
                            name="resolution"
                            val="400x400"
                            label="400x400"
                        />
                    </div>
                </q-card-section>

                <q-separator inset />

                <q-card-section>
                    <q-file
                        outlined
                        required
                        v-model="model"
                        name="image"
                        label="Image"
                        v-on:change="
                            (e) => {
                                this.onChangeFileUpload(e);
                            }
                        "
                    >
                        <template v-slot:prepend>
                            <q-icon name="attach_file" />
                        </template>
                    </q-file>
                </q-card-section>

                <!-- Finally we create the buttons that submit or reset the data in the form -->

                <q-card-section>
                    <div>
                        <q-btn
                            label="Add Image"
                            type="submit"
                            color="primary"
                            name="enviar"
                        />
                        <q-btn
                            label="Reset"
                            type="reset"
                            color="primary"
                            class="q-ml-sm"
                        />
                    </div>
                </q-card-section>
            </q-form>
        </q-card>
    </div>
</template>

<script>
//We Import all the packages that we need

import Swal from "sweetalert2";
import Csfr from "./Csrf";
import { ref } from "vue";

export default {
    //We finish importing the input csrf token
    components: {
        inputCsfr: Csfr,
    },

    //We setup the controls in the form in accordance with their use in Quazar framework

    setup() {
        const description = ref(null);
        const resolution = ref("200x200");
        const model = ref(null);

        return {
            description,
            resolution,
            model,

            onReset() {
                description.value = null;
            },
        };
    },
    data() {
        return {
            image: "",
        };
    },
    methods: {
        //We prepare the Sweet alert method

        showAlert(type, title, message) {
            Swal.fire({
                icon: type,
                title: title,
                text: message,
                confirmButtonText: "Ok",
            });
        },

        //We set the change file method

        onChangeFileUpload(e) {
            this.image = e.target.files[0];
        },

        //We set the add image method

        addImage(e) {
            //We let the data be a new formData and append the image, to avoid validations errors

            let data = new FormData(e.target);
            data.append("image", this.image);

            //We make a axios post call to the api images to create the new image entry

            axios
                .post("/api/images", data)
                .then((res) => {
                    //If the creation and uploading of the photo is succesfull, we show a message and redirect to home
                    this.showAlert("success", "Image Succesfully Uploaded", "");
                    this.$router.push({ name: "home" });
                })
                .catch((err) => {
                    //If the axios call throws an error status of 401

                    //Means that the user is currently offline, so we do a location reload so that way
                    //We make laravel and vue redirect the user to login and erase the section
                    if (error.response && error.response.status === 401) {
                        location.reload();
                    }

                    //If theres another error that is not a 401, we show a message with sweet alert

                    this.showAlert(
                        "error",
                        err.response.data.message,
                        ...Object.values(err.response.data)[0]
                    );
                });
        },
    },
};
</script>

<style scoped>
.my-card {
    width: 100%;
    max-width: 500px;
    margin: auto;
    margin-top: 4%;
    align-self: center;
    justify-self: center;
    display: flex;
    flex-direction: column;
    border-radius: 15px;
    overflow: hidden;
}
</style>
