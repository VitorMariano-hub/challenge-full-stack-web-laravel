<template>
  <div>
    <main-menu /> <!-- Componente de menu principal -->
    <v-container>
       <h2 class="text-center">Cadastro de aluno</h2> 
      <form @submit.prevent="submit">
        <v-text-field v-model="name" label="Nome" required :error-messages="errors.name" type="text"></v-text-field> 
        <v-text-field v-model="email" label="E-mail" required :error-messages="errors.email" type="email"></v-text-field> 
        <v-text-field v-model="ra" label="Registro Acadêmico" required :error-messages="errors.ra" type="number" mask="######"></v-text-field> 
        <v-text-field v-model="cpf" label="CPF" required :error-messages="errors.cpf" type="number" mask="###.###.###-##"></v-text-field> 
        <v-btn color="red"  class="me-4" @click="handleCancelClick">Cancelar</v-btn> 
        <v-btn color="green"  type="submit">Salvar</v-btn> 
      </form>
    </v-container>
  </div>
</template>

<script>
import MainMenu from '@/components/MainMenu.vue';
import axios from 'axios';

export default {
  name: 'StudentCreate',
  components: {
    MainMenu,
  },
  data() {
    return {
      name: '', 
      email: '', 
      ra: '', 
      cpf: '',
      errors: '',
    };
  },
  methods: {
    handleCancelClick() {
      this.$router.push('/');
    },
    submit() {
      const studentData = {
        name: this.name,
        email: this.email,
        ra: this.ra,
        cpf: this.cpf,
      };
      axios.post('https://web-service-app.herokuapp.com/api/v1/students', studentData)
        .then(response => {
          console.log('Estudante cadastrado com sucesso:', response.data);
          this.$router.push({ path: '/', params: { successMessage: 'Estudante cadastrado com sucesso!' } });
        })
        .catch(error => {
          this.errors = error.response.data.errors;
        });
    }
  }
}
</script>
