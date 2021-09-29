<template>
    <div class="q-pa-md row items-start q-gutter-md">
        <q-card class="my-card text-white">
            <q-form
                @submit.prevent="addImage"
                @reset="onReset"
                class="q-gutter-md"
            >
                <input-csfr />

                <q-card-section class="header">
                    <div class="text-h6" color="white">Add Image</div>
                </q-card-section>

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
                    <q-input
                        filled
                        v-model="resolution"
                        name="resolution"
                        label="Resolution"
                        hint="Please introduce your resolution."
                        lazy-rules
                        bottom-slots
                        :rules="[
                            (val) =>
                                (val && val.length > 0) ||
                                'Please type something.',
                        ]"
                    />
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
import Swal from "sweetalert2";
import Csfr from "./Csrf";
import { ref } from "vue";

export default {
    components: {
        inputCsfr: Csfr,
    },

    setup() {
        const description = ref(null);
        const resolution = ref(null);
        const model = ref(null);

        return {
            description,
            resolution,
            model,

            onReset() {
                description.value = null;
                resolution.value = null;
            },
        };
    },
    data() {
        return {
            image: "",
        };
    },
    methods: {
        showAlert(type, title, message) {
            Swal.fire({
                icon: type,
                title: title,
                text: message,
                confirmButtonText: "Ok",
            });
        },

        onChangeFileUpload(e) {
            this.image = e.target.files[0];
        },

        addImage(e) {
            let data = new FormData(e.target);
            data.append('image', this.image);

            axios
                .post("/api/images", data)
                .then((res) => {
                    this.showAlert("success", "Image Succesfully Uploaded", "");
                    this.$router.push({ name: "home" });
                })
                .catch((err) => {
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
