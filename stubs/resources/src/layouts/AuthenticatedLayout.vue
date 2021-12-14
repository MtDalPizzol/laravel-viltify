<template>
  <v-app>
    <v-navigation-drawer
      app
      dark
      color="drawer"
      v-model="drawer"
      width="300"
      :mini-variant="mini && !$vuetify.breakpoint.mobile"
      :expand-on-hover="mini && !$vuetify.breakpoint.mobile"
    >
      <v-list
        nav
        dense
      >
        <v-list-group>
          <template #activator>
            <v-list-item
              class="px-0"
              style="height: 60px;"
            >
              <v-list-item-avatar size="24">
                <v-img :src="auth.user.avatar" />
              </v-list-item-avatar>
              <v-list-item-content>
                <v-list-item-title>
                  {{ auth.user.name }}
                </v-list-item-title>
                <v-list-item-subtitle>
                  {{ auth.user.email }}
                </v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
          </template>
          <Link
            as="v-list-item"
            :href="route('logout')"
            method="post"
          >
          <v-list-item-icon>
            <v-icon v-html="icons.mdiPower" />
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Logout</v-list-item-title>
          </v-list-item-content>
          </Link>
        </v-list-group>
      </v-list>

      <v-divider />

      <v-list
        dense
        nav
      >
        <Link
          as="v-list-item"
          v-for="(item, key) in menu"
          :key="key"
          link
          :input-value="item.active"
        >
        <v-list-item-icon>
          <v-icon v-html="item.icon" />
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title v-text="item.text" />
        </v-list-item-content>
        </Link>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar
      app
      flat
      hide-on-scroll
      color="appBar"
    >
      <v-app-bar-nav-icon
        v-if="$vuetify.breakpoint.mobile"
        @click="drawer = !drawer"
      />
      <v-btn
        icon
        v-if="!$vuetify.breakpoint.mobile"
        @click="mini = !mini"
        title="Toggle menu"
      >
        <v-icon v-html="icons.mdiMenuOpen" />
      </v-btn>
      <v-btn
        icon
        v-if="!$vuetify.breakpoint.mobile"
        @click="$vuetify.theme.dark = !$vuetify.theme.dark"
        title="Toggle dark mode"
      >
        <v-icon v-html="icons.mdiBrightness6" />
      </v-btn>
      <v-app-bar-title v-text="title" />
      <v-spacer />
    </v-app-bar>

    <v-main class="mb-10">
      <slot />
    </v-main>

    <Footer />
    <Toasts />
  </v-app>
</template>

<script>
import Footer from '@/components/Footer'
import Toasts from '@/components/Toasts'
import {
  mdiViewDashboardOutline,
  mdiPower,
  mdiMenuOpen,
  mdiBrightness6
} from '@mdi/js'

export default {
  components: {
    Footer,
    Toasts
  },
  computed: {
    title () {
      return this.$page.props.title
    },
    auth () {
      return this.$page.props.auth
    }
  },
  data () {
    return {
      drawer: true,
      mini: true,
      icons: {
        mdiMenuOpen,
        mdiBrightness6,
        mdiPower
      },
      menu: [
        {
          icon: mdiViewDashboardOutline,
          text: 'Dashboard'
        }
      ]
    }
  }
}
</script>

<style lang="scss">
@use "../scss/layout";
</style>
