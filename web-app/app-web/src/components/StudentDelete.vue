<template>
  <div>
    <v-dialog v-model="showDeleteDialog" max-width="500px"> <!-- Card confirmação exclusão -->
      <v-card>
        <v-card-title class="headline">Tem certeza que deseja remover esse estudante?</v-card-title>
        <v-card-text>
          <p>Esta ação é irreversível e o registro do estudante será excluído permanentemente.</p>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" text @click="showDeleteDialog = false">Cancelar</v-btn>
          <v-btn color="red" text @click="deleteStudent()">Deletar</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
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
    showDeleteDialog: false
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
    deleteStudent() {
      axios.delete(`https://web-service-app.herokuapp.com/api/v1/students/${this.id}`)
        .then(response => {
          this.$router.push({ path: '/', params: { successMessage: 'Estudante removido com sucesso!' } });
        })
        .catch(error => {
          this.errors = error.response.data.errors;
        });
      this.showDeleteDialog = false;
    },

    handleCancelClick() {
      this.$router.push('/');
    },
    handleDeleteClick(id) {
      this.idToDelete = id;
      this.showDeleteDialog = true;
    },
  }
}
</script>