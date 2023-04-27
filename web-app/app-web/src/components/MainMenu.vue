<template>
  <v-card>
      <v-navigation-drawer theme="dark" rail permanent>
        <v-divider></v-divider>
        <v-list  nav>
          <v-list-item prepend-icon="mdi-view-dashboard" value="dashboard"></v-list-item>
        </v-list>
      </v-navigation-drawer>
      <v-navigation-drawer >
      <v-list class="v-list--tile theme--light">
        <v-list-item title="Alunos" value="Alunos"></v-list-item>
      </v-list>
      </v-navigation-drawer>
  </v-card>
</template>

<script>

export default {
  name: 'MainMenu',
}

</script>