<template>
  <v-container class="fill-height">

    <Head title="Verify your email" />
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
            <v-card-text class="text-body-1">
              <p>Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</p>
            </v-card-text>
            <v-card-actions class="py-0 px-4 d-block-xs d-flex-md">
              <p class="ma-0">
                <Link
                  :href="route('logout')"
                  color="primary"
                  text
                  method="post"
                  class="text-body-1 primary--text text--lighten-2"
                >Logout</Link>
              </p>
              <v-spacer />
              <v-btn
                :loading="loading"
                color="primary"
                type="submit"
                depressed
                x-large
                dark
              >Resend verification email</v-btn>
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
    email: String,
    token: String,
    errors: Object
  },
  data () {
    return {
      loading: false,
      form: this.$inertia.form()
    }
  },
  methods: {
    submit () {
      if (this.loading) return

      this.loading = true

      this.form.post(this.route('verification.send'), {
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
