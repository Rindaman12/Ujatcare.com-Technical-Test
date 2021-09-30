<template>
  <!-- Similar functionality to Add.vue, please see that file for the full explanation -->

  <div class="welcome-image">
    <div class="q-pa-md row items-start q-gutter-md">
      <q-card class="my-card text-white">
        <q-form @submit.prevent="register" @reset="onReset" class="q-gutter-md">
          <input-csfr />

          <q-card-section class="header">
            <div class="text-h6" color="white">Register</div>
          </q-card-section>

          <q-card-section class="q-pt-none">
            <q-input
              filled
              v-model="username"
              name="username"
              label="Username"
              hint="Please introduce your username."
              lazy-rules
              :rules="[
                (val) => (val && val.length > 0) || 'Please type something.',
              ]"
            />
          </q-card-section>

          <q-separator inset />

          <q-card-section>
            <q-input
              filled
              v-model="password"
              type="password"
              name="password"
              label="Password"
              hint="Please introduce your password."
              lazy-rules
              bottom-slots
              :rules="[
                (val) => (val && val.length > 0) || 'Please type something.',
              ]"
            />
          </q-card-section>

            <q-separator inset />

          <q-card-section>
            <q-input
              filled
              v-model="password_confirmation"
              type="password"
              name="password_confirmation"
              label="Password Confirmation"
              hint="Please confirm your password."
              lazy-rules
              bottom-slots
              :rules="[
                (val) => (val && val.length > 0) || 'Please type something.',
              ]"
            />
          </q-card-section>

            <!-- 
          <q-separator inset />

          <q-card-section>
            <recaptcha
              v-if="showRecaptcha"
              class="justify-content-center"
              siteKey="6LcVBCYcAAAAANyRP9722ZYtHWyRnNLUOk8iWFAc"
              size="normal"
              theme="light"
              :tabindex="0"
              @verify="recaptchaVerified"
              @expire="recaptchaExpired"
              @fail="recaptchaFailed"
              ref="recaptcha"
            />
          </q-card-section>

          <q-separator inset />
            -->

          <q-card-section>
            <div>
              <q-btn
                label="Register"
                type="submit"
                color="primary"
                name="enviar"
                :disabled="disable"
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
  data() {
    return {
      showRecaptcha: true,
      disable: false,
    };
  },
  setup() {
    const username = ref(null);
    const password = ref(null);
    const password_confirmation = ref(null); 

    return {
      username,
      password,
      password_confirmation,

      onReset() {
        username.value = null;
        password.value = null;
        password_confirmation.value = null;
      },
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

    register(e) {
      let data = Object.fromEntries(new FormData(e.target));
      axios
        .post("/register", data)
        .then((res) => {
          this.showAlert("success", "Register Succesfull", "");
          location.href = "/home";
        })
        .catch((err) => {
          this.showAlert(
            "error",
            err.response.data.message,
            ...Object.values(err.response.data)[0]
          );
        });
    },
  

    // Recaptcha methods
    recaptchaVerified(res) {
      this.disable = false;
    },
    recaptchaExpired() {
      this.$refs.recaptcha.reset();
      this.disable = true;
    },
    recaptchaFailed() {},
  },
};
</script>
