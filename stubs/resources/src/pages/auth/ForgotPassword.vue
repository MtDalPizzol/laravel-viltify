<template>
  <v-container class="fill-height">

    <Head title="Forgot your Password?" />
    <v-row justify="center">
      <v-col
        cols="12"
        sm="8"
        lg="6"
        xl="4"
      >
        <form @submit.prevent="submit">
          <v-card
            flat
            color="transparent"
          >
            <v-card-text>
              <p class="text-body-1 mb-10">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
              <v-text-field
                v-model="form.email"
                label="Email"
                :error-messages="errors.email"
                outlined
              ></v-text-field>
            </v-card-text>
            <v-card-actions class="py-0 px-4 d-block-xs d-flex-md">
              <v-spacer />
              <v-btn
                :loading="loading"
                color="primary"
                type="submit"
                depressed
                x-large
                dark
              >Send password reset link</v-btn>
            </v-card-actions>
          </v-card>
        </form>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import GuestLayout from '@/layouts/GuestLayout'

export default {
  layout: GuestLayout,
  props: {
    errors: Object
  },
  data () {
    return {
      form: this.$inertia.form({
        email: ''
      }),
      loading: false
    }
  },
  methods: {
    submit () {
      if (this.loading) return

      this.loading = true

      this.form.post(this.route('password.email'), {
        onFinish: () => {
          this.loading = false
        }
      })
    }
  }
}
</script>

<style>
</style>
