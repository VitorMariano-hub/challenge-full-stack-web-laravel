<template>
  <div>
    <v-row>
      <v-col>
        <v-text-field
          v-model="searchTerm"
          label="Digite sua busca"
          outlined
        ></v-text-field>
      </v-col>
      <v-col>
        <v-btn class="fixed-bottom"  @click="handleSearchClick">
          <v-icon >mdi-magnify</v-icon>Pesquisar
        </v-btn>
      </v-col>
      <v-col>
        <v-btn color="green"  @click="handleCreateClick">
          <v-icon >mdi-plus</v-icon>Cadastrar
        </v-btn>
      </v-col>
    </v-row>
    <v-table>
    <thead>
      <tr>
        <th class="text-left">Registro Acadêmico</th>
        <th class="text-left">Nome</th>
        <th class="text-left">CPF</th>
        <th class="text-left">Ações</th>
      </tr>
    </thead>
    <v-snackbar v-model="showSnackbar" :timeout="timeout" :color="color">
      {{ message }}
    </v-snackbar>
    <tbody>
      <tr v-for="item in students" :key="item.id">
        <td>{{ item.ra }}</td>
        <td>{{ item.name }}</td>
        <td>{{ item.cpf }}</td>
        <td>
          <v-btn color="primary" size="small" @click="editStudent(item.id)">
           <v-icon>mdi-pencil</v-icon> 
          </v-btn>
          <v-btn color="red"  size="small" @click="deleteStudent(item.id)">
           <v-icon>mdi-delete</v-icon>
          </v-btn>
        </td>
      </tr>
    </tbody>
  </v-table>
  <v-pagination
      :total-visible="totalVisible"
      :length="totalPages"
      :model-value="currentPage"
      @update:model-value="changePage"
  ></v-pagination>
  </div>
</template>

<script>
import axios from 'axios';
import MainMenu from '@/components/MainMenu.vue'; 

export default {
  name: 'StudentShow',
  components: {
    MainMenu
  },
  data() {
    return {
      searchTerm: '',
      students: [],
      currentPage: 1,
      totalStudents: 0,
      perPage: 5,
      totalPages: 1,
      totalVisible: 5,
      showSnackbar: false,
      message: '',
      timeout: 3000, 
      color: 'success',
    };
  },
  created(){
    // Mensagem de alerta ao cadastrar/editar/excluir.
    this.message = this.$route.query.successMessage;
    if (this.message) {
      this.showSnackbar = true;
      setTimeout(() => {
        this.showSnackbar = false;
        this.$router.replace({ query: {} });
      }, this.timeout);
    }
  },
  mounted() {
    this.fetchStudents();
  },
  methods: {
    // Requisição a api
   async fetchStudents() {
        try {
          const response = await axios.get('https://web-service-app.herokuapp.com/api/v1/students', {
            params: {
              page: this.currentPage,
              name: this.searchTerm
            }
        });
          this.students = response.data.data;
          this.totalStudents = response.data.total;
          this.totalPages = Math.ceil(this.totalStudents / this.perPage);
        } catch (error) {
          console.error(error);
        }
        },

        //Paginação
        changePage(page) {
          this.currentPage = page;
          this.fetchStudents();
        },

        // Editando o aluno
        editStudent(id) {
          this.$router.push({ name: 'edit', params: { id: id }});
        },

        //Deletando o aluno
        deleteStudent(id) {
          this.$router.push({ name: 'delete', params: { id: id }});
        },

        // Pesquisando alunos
        handleSearchClick() {
          this.currentPage = 1;
          this.fetchStudents();
        },

        // Link para cadastrar alunos
        handleCreateClick() {
          this.$router.push('/register'); 
        },
  }
};
</script>