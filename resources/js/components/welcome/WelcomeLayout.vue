<template>
    <q-layout view="hHh lpR fFf">
        <q-header
            reveal
            elevated
            class="bg-primary text-white"
            height-hint="98"
        >
            <q-toolbar>
                <q-toolbar-title>
                      <q-avatar>
                        <img
                            src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg"
                        />
                    </q-avatar>
                    UJATCARE.COM
                </q-toolbar-title>
            </q-toolbar>

            <q-tabs v-if="!sessionStarted" align="left">
                <q-route-tab to="/login" label="Login" replace />
                <q-route-tab
                    to="/register"
                    label="Registration"
                    replace
                />
            </q-tabs>
           
        </q-header>

        <q-page-container>
            <router-view v-slot="{ Component }">
                <transition name="fade" mode="out-in">
                    <component :is="Component" />
                </transition>
            </router-view>
        </q-page-container>

        <q-footer reveal elevated class="footer">
            <small>
                <div align="center">
                    <strong
                        >Copyright &copy; 2021 <a href="/login">UJATCARE</a>.</strong
                    >
                </div>
            </small>
        </q-footer>
    </q-layout>
</template>

<script>
export default {
    props: ["session"],
    data() {
        return {
            currSession: JSON.parse(this.session),
        };
    },
    computed: {
        sessionStarted() {
            let session = JSON.parse(this.session);
            return session === null ? false : true;
        },
    },
};
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease;
}


.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>