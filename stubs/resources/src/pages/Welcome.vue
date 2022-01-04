<template>
  <v-container class="fill-height">
    <v-row>
      <v-col cols="12">

        <Head title="Welcome" />
        <hello-world />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import GuestLayout from '@/layouts/GuestLayout'
import HelloWorld from '@/components/HelloWorld'

export default {
  layout: GuestLayout,
  components: {
    HelloWorld
  }
}
</script>
