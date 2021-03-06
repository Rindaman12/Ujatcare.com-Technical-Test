<template>
    <!-- We create a layout component to house all of the others components and views that we will use -->

    <q-layout view="hHh lpR fFf">
        <q-header elevated class="bg-primary text-white" height-hint="98">
            <q-toolbar>
                <q-toolbar-title>
                    <q-avatar>
                        <img
                            src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg"
                        />
                    </q-avatar>
                    UJATCARE.COM
                </q-toolbar-title>

                <!-- We assign a toggle for the column where we will put the logout control -->
                <q-btn
                    dense
                    flat
                    round
                    icon="menu"
                    @click="toggleRightDrawer"
                />
            </q-toolbar>

            <!-- We use the q-tabs as a substitution for vue router instructions -->

            <q-tabs align="left">
                <q-route-tab to="/home" label="Home" replace />
                <q-route-tab to="/add" label="Add Image" replace />
            </q-tabs>
        </q-header>

        <!-- If the drawer is open, we show the logout control -->

        <q-drawer show-if-above v-model="rightDrawerOpen" side="left" bordered>
            <q-scroll-area
                style="
                    height: calc(100% - 150px);
                    margin-top: 150px;
                    border-right: 1px solid #ddd;
                "
            >
                <q-list padding>
                    <q-item active clickable v-ripple>
                        <q-item-section avatar>
                            <q-icon
                                @click.prevent="logout"
                                href="/logout"
                                name="logout"
                                color="black"
                            />
                        </q-item-section>

                        <q-item-section>
                            <a
                                class="link"
                                @click.prevent="logout"
                                href="/logout"
                                >Logout</a
                            >
                            <form
                                id="logout-form"
                                :action="'/logout'"
                                method="POST"
                            >
                                <input-csfr />
                            </form>
                        </q-item-section>
                    </q-item>
                </q-list>
            </q-scroll-area>

            <!-- We also make use of 2 cosmetic images and we show the name of the user currently logged in -->

            <q-img
                class="absolute-top"
                src="https://cdn.quasar.dev/img/material.png"
                style="height: 150px"
            >
                <div class="absolute-bottom bg-transparent">
                    <q-avatar size="56px" class="q-mb-sm">
                        <img src="https://cdn.quasar.dev/img/boy-avatar.png" />
                    </q-avatar>
                    <div class="text-weight-bold"></div>
                    <div>@{{ userUsername }}</div>
                </div>
            </q-img>
        </q-drawer>

        <!-- We created the container for the others vue components -->

        <q-page-container>
            <router-view v-slot="{ Component }">
                <transition name="slide">
                    <component :is="Component" />
                </transition>
            </router-view>
            <particles-bg color="#014a88" type="square" :bg="true" />
        </q-page-container>

        <q-footer reveal elevated class="footer">
            <small>
                <div align="center">
                    <strong
                        >Copyright &copy; 2021
                        <a href="/home">UJATCARE</a>.</strong
                    >
                </div>
            </small>
        </q-footer>
    </q-layout>
</template>

<script>
//We import all the packages we need

import Csfr from "./Csrf";
import { ref } from "vue";
import { ParticlesBg } from "particles-bg-vue";

export default {
    components: {
        inputCsfr: Csfr,
        ParticlesBg,
    },

    //We use the username as a prop to mention it in the layout
    props: {
        userUsername: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            user: this.userId,
        };
    },
    created() {
        sessionStorage.userId = this.userId;
    },
    setup() {
        const rightDrawerOpen = ref(false);

        return {
            rightDrawerOpen,
            toggleRightDrawer() {
                rightDrawerOpen.value = !rightDrawerOpen.value;
            },
        };
    },
    methods: {
        //We assign the logout method and we erase all the localstorage tabs
        logout() {
            document.getElementById("logout-form").submit();
            localStorage.tabs = "[]";
        },
    },
};
</script>

<style scoped>
.link {
    text-decoration: none;
    color: black;
}

.slide-enter-active,
.slide-leave-active {
    transition: all 0.75s ease-out;
}

.slide-enter-to {
    position: absolute;
    right: 0;
}

.slide-enter-from {
    position: absolute;
    right: -100%;
}

.slide-leave-to {
    position: absolute;
    left: -100%;
}

.slide-leave-from {
    position: absolute;
    left: 0;
}
</style>
