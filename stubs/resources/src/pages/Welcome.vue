<template>
  <hello-world />
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
