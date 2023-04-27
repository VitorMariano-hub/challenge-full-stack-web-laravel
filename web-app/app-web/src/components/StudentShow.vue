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
  <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
  <v-table>
    <thead>
      <tr>
        <th class="text-left">Registro Acadêmico</th>
        <th class="text-left">Nome</th>
        <th class="text-left">CPF</th>
        <th class="text-left">Ações</th>
      </tr>
    </thead>
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
    <Pagination :pagination="pagination"  @input="handlePageChange" />
  </div>
</template>

<script>
import axios from 'axios';
import MainMenu from '@/components/MainMenu.vue'; 
import Pagination from '@/components/Pagination.vue'; 

export default {
  name: 'StudentShow',
  components: {
    Pagination,
    MainMenu
  },
  data() {
    return {
      searchTerm: '',
      students: [],
       pagination: {
          total: '',
          per_page: '',
          current_page: '',
          last_page: ''
      },
    };
  },
  mounted() {
    this.fetchStudents();
  },
  methods: {
    fetchStudents() {
      axios
        .get('https://web-service-app.herokuapp.com/api/v1/students', { params: this.pagination.current_page })
        .then(response => {
          this.students = response.data.data; 
          this.pagination.total = response.data.total; 
          this.pagination.per_page = response.data.per_page; 
          this.pagination.current_page = response.data.current_page; 
          this.pagination.last_page = response.data.last_page; 
        })
        .catch(error => {
          console.error(error);
        });
    },
    editStudent(id) {
      this.$router.push({ name: 'edit', params: { id: id }});
    },
    deleteStudent(id) {
      this.$router.push({ name: 'delete', params: { id: id }});
    },
    handlePageChange(value) {
      this.pagination.current_page = value;
    },
    handleSearchClick() {
      axios.get('https://web-service-app.herokuapp.com/api/v1/students', {
        params: {
          name: this.searchTerm
        }
      }).then(response => {
        this.students = response.data.data;
        this.pagination.total = response.data.total;
        this.pagination.per_page = response.data.per_page;
        this.pagination.current_page = response.data.current_page;
        this.pagination.last_page = response.data.last_page;
      }).catch(error => {
        console.log(error);
      });
    },
    handleCreateClick() {
      this.$router.push('/register'); 
    },
  }
};
</script>
