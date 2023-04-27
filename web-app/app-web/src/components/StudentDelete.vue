<template>
  <div>
    <main-menu /> <!-- Componente de menu principal -->
    <v-container>
      <v-card>
        <v-card-title>
          <span class="headline">Exclusão de Aluno</span>
        </v-card-title>
        <v-card-text>
          <div>
            <v-text-field v-model="student.name" label="Nome" disabled></v-text-field>
            <v-text-field v-model="student.email" label="E-mail" disabled></v-text-field>
            <v-text-field v-model="student.ra" label="Registro Acadêmico" disabled></v-text-field>
            <v-text-field v-model="student.cpf" label="CPF" disabled></v-text-field>
          </div>
        </v-card-text>
      </v-card>
    </v-container>
    <v-container>
      <v-btn color="primary"  class="me-4" @click="handleCancelClick">Voltar</v-btn> 
      <v-btn color="red"  @click="handleDeleteClick">Excluir</v-btn>  
    </v-container>
  </div>
</template>

<script>
import MainMenu from '@/components/MainMenu.vue';
import axios from 'axios';

export default {
  name: 'StudentDelete',
  components: {
    MainMenu,
  },
  props: {
    id: {
      type: Number,
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
    handleDeleteClick() {
      // Função para enviar os dados do formulário para o endpoint de cadastro   
      axios.delete(`https://web-service-app.herokuapp.com/api/v1/students/${this.id}`)
        .then(response => {
          this.$router.push({ path: '/', params: { successMessage: 'Estudante removido com sucesso!' } });
        })
        .catch(error => {
          this.errors = error.response.data.errors;
        });
    },
  }
}
</script>