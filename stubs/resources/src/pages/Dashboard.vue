<template>
  <v-container>
    <v-row justify="center">
      <v-col cols="12">
        <div class="pa-8">
          <v-card
            flat
            color="transparent"
            max-width="740"
          >
            <v-card-title
              class="text-h3 font-weight-bold mb-4"
              style="word-break: break-word;"
            >Welcome to your dashboard</v-card-title>
            <v-card-text>
              <p class="text-h6 font-weight-regular mb-6 tw-relative">
                Ok! Now you're logged in into this cool dashboard with light and dark theme options and expandable navigation drawer.
                <strong>FOR FREE!</strong>
              </p>
              <p class="text-h6 font-weight-regular mb-6 tw-relative">
                Com'on... It's time to give Viltify a star, don't you think? =)
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
          </v-card>
        </div>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout'
import GithubButton from 'vue-github-button'

export default {
  layout: AuthenticatedLayout,
  components: {
    GithubButton
  }
}
</script>

<style>
</style>
