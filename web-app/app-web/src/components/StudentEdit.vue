<template>
  <div>
    <main-menu /> <!-- Componente de menu principal -->
    <v-container>
       <h2 class="text-center">Edição do aluno</h2> 
      <form @submit.prevent="submit">
        <v-text-field v-model="student.name" label="Nome" required :error-messages="errors.name" type="text"></v-text-field> 
        <v-text-field v-model="student.email" label="E-mail" required :error-messages="errors.email" type="email"></v-text-field> 
        <v-text-field v-model="student.ra" label="Registro Acadêmico" required :error-messages="errors.ra" type="number" mask="######" disabled readonly></v-text-field> 
        <v-text-field v-model="student.cpf" label="CPF" required :error-messages="errors.cpf" type="number" mask="###.###.###-##" disabled readonly></v-text-field> 
        <v-btn color="red"  class="me-4" @click="handleCancelClick">Cancelar</v-btn> 
        <v-btn color="green"  @click="handleUpdateClick">Atualizar</v-btn> 
      </form>
    </v-container>
  </div>
</template>

<script>
import MainMenu from '@/components/MainMenu.vue';
import axios from 'axios';

export default {
  name: 'StudentEdit',
  components: {
    MainMenu,
  },
  props: {
    id: {
      required: true
    }
  },
  data() {
    return {
      student: {},
      errors: '',
    };
  },
  mounted() {
    axios
      .get(`https://web-service-app.herokuapp.com/api/v1/students/${this.id}`)
      .then(response => {
        this.student = response.data;
      })
      .catch(error => {
        console.error(error);
      });
  },
  methods: {
    handleCancelClick() {
      this.$router.push('/');
    },
    handleUpdateClick() {
      axios.put(`https://web-service-app.herokuapp.com/api/v1/students/${this.id}`, this.student)
        .then(response => {
          this.$router.push({ path: '/', query: { successMessage: 'Aluno atualizado com sucesso!' } });
        })
        .catch(error => {
          this.errors = error.response.data.errors;
        });
    },
  }
}
</script>