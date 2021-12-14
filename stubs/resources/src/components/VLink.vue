<template>
  <Link
    as="v-btn"
    v-bind="$attrs"
    v-on="$listeners"
  >
  <slot />
  </Link>
</template>

<script>
import { VBtn } from 'vuetify/lib'

export default {
  components: {
    // eslint-disable-next-line
    VBtn
  }
}
</script>

<style>
</style>
