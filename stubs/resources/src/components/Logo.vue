<template>
  <span class="d-flex">
    <img
      alt="Viltify Logo"
      class="logo d-block shrink mr-4"
      contain
      :src="signature"
      transition="scale-transition"
    />
    <img
      alt="Viltify Logo"
      class="logo d-none d-md-block shrink"
      contain
      :src="text"
      transition="scale-transition"
    />
  </span>
</template>

<script>
import logoSignature from '@/assets/logo-signature.png'
import logoText from '@/assets/logo-text.png'
import logoDarkSignature from '@/assets/logo-dark-signature.png'
import logoDarkText from '@/assets/logo-dark-text.png'

export default {
  computed: {
    signature () {
      return this.$vuetify.theme.dark
        ? logoDarkSignature
        : logoSignature
    },
    text () {
      return this.$vuetify.theme.dark
        ? logoDarkText
        : logoText
    }
  }
}
</script>
