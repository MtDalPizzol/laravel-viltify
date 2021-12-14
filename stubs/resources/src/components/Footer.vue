<template>
  <v-footer
    app
    absolute
    inset
    flat
    color="footer"
  >
    <v-container>
      <v-row>
        <v-col cols="12">
          <v-btn
            text
            class="mr-4"
            @click="$vuetify.theme.dark = !$vuetify.theme.dark"
          >
            <v-icon
              left
              v-html="icons.mdiBrightness6"
            />
            Toggle dark mode
          </v-btn>
          <v-btn
            text
            href="https://github.com/MtDalPizzol/laravel-viltify"
            target="_blank"
          >
            <v-icon
              left
              v-html="icons.mdiGithub"
            />
            Give it a star!
          </v-btn>
        </v-col>
      </v-row>
    </v-container>
  </v-footer>
</template>

<script>
import { mdiBrightness6, mdiGithub } from '@mdi/js'

export default {
  data () {
    return {
      icons: {
        mdiBrightness6,
        mdiGithub
      }
    }
  }
}
</script>

<style>
</style>
