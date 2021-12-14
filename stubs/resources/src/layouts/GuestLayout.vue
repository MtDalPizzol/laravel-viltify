<template>
  <v-app>
    <v-app-bar
      app
      flat
      color="background"
      height="100"
      hide-on-scroll
    >
      <v-container>
        <v-row>
          <v-col cols="12">
            <div class="d-flex align-center">
              <Link
                class="d-flex"
                :href="route('welcome')"
              >
              <Logo />
              </Link>
              <v-spacer />
              <!-- Place this tag where you want the button to render. -->
              <v-link
                text
                rounded
                class="mr-4"
                :href="route('register')"
              >Register</v-link>
              <v-link
                text
                rounded
                :href="route('login')"
              >Login</v-link>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </v-app-bar>

    <v-main class="mb-12">
      <slot />
    </v-main>

    <Footer />
    <Toasts />
  </v-app>
</template>

<script>
import Logo from '@/components/Logo'
import Footer from '@/components/Footer'
import Toasts from '@/components/Toasts'

export default {
  components: {
    Logo,
    Footer,
    Toasts
  }
}
</script>

<style lang="scss">
@use "../scss/layout";
</style>
