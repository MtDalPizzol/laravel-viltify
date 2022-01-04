<template>
  <v-card
    flat
    color="transparent"
    max-width="740"
  >
    <v-card-title
      class="text-h3 font-weight-bold mb-4"
      style="word-break: break-word;"
    >
      Go ahead and build your app!
    </v-card-title>
    <v-card-text>
      <p class="text-h6 font-weight-regular mb-6">
        That's it. Viltify already installed everything you need to start building your app with Laravel, Inertia, Tailwind and Vuetify.
      </p>
      <p class="text-h6 font-weight-regular mb-6 tw-relative">
        If this package is saving you as much time as it's saving me, give it a star on Github. It's free! =)
        <github-button
          href="https://github.com/MtDalPizzol/laravel-viltify"
          data-color-scheme="no-preference: light; light_high_contrast: light_high_contrast; dark: light_high_contrast;"
          data-size="large"
          data-show-count="true"
          aria-label="Star MtDalPizzol/laravel-viltify on GitHub"
          class="tw-absolute ml-2"
          style="bottom: -7px;"
        >Star</github-button>
      </p>
    </v-card-text>
    <v-card-actions>
      <v-link
        as="v-btn"
        outlined
        depressed
        x-large
        class="mr-4"
        :href="route('register')"
      >Register</v-link>
      <v-link
        as="v-btn"
        depressed
        x-large
        dark
        color="accent"
        :href="route('login')"
      >Login</v-link>
    </v-card-actions>
  </v-card>
</template>

<script>
import GithubButton from 'vue-github-button'

export default {
  components: {
    GithubButton
  }
}
</script>
