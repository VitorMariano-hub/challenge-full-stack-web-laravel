<template>
  <v-card>
      <v-navigation-drawer theme="dark" rail permanent>
        <v-divider></v-divider>
        <v-list  nav>
          <v-list-item @click="handleHomeClick" prepend-icon="mdi-book" value="dashboard"></v-list-item>
        </v-list>
      </v-navigation-drawer>
      <v-navigation-drawer >
      <v-list class="v-list--tile theme--light">
        <v-list-item @click="handleHomeClick" title="Alunos" value="Alunos"></v-list-item>
      </v-list>
      </v-navigation-drawer>
  </v-card>
</template>

<script>
export default {
  name: 'MainMenu',
  methods: {
    handleHomeClick() {
      this.$router.push('/');
    }
  }
}
</script>