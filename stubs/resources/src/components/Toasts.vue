<template>
  <notifications
    class="vue-notification--custom"
    position="bottom right"
  >
    <template
      slot="body"
      slot-scope="{ item, close }"
    >
      <v-alert
        :type="item.type"
        prominent
      >
        <v-row align="center">
          <v-col class="grow">
            <div v-html="item.text" />
          </v-col>
          <v-col class="shrink">
            <v-btn
              icon
              small
              @click="close"
            >
              <v-icon
                small
                v-html="mdiClose"
              />
            </v-btn>
          </v-col>
        </v-row>
      </v-alert>
    </template>
  </notifications>
</template>

<script>
import { mdiClose } from '@mdi/js'

export default {
  data () {
    return {
      mdiClose
    }
  },
  computed: {
    toasts () {
      return this.$page.props.toasts
    }
  },
  watch: {
    toasts (toasts) {
      toasts.forEach((toast) => {
        this.$notify(toast)
      })
    }
  }
}
</script>

<style lang="scss">
.vue-notification--custom {
  padding: 0;
  background: none;
  border: none;
  margin: 24px;
}
</style>
