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
        v-model="pagination.page"
        :total-rows="count"
        :per-page="pageSize"
        prev-text="Prev"
        next-text="Next"
        @change="handlePageChange"
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
      pagination: {
        currentIndex: -1,
        page: 1,
        count: 0
      }
    };
  },
  mounted() {
    this.fetchStudents();
  },
  methods: {
    fetchStudents() {
      axios
        .get('https://web-service-app.herokuapp.com/api/v1/students', {
          params: { page: this.pagination.page }})
        .then(response => {
          this.students = response.data.data; 
          this.pagination = response.data;
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
    getRequestParams(page, pageSize) {
      let params = {};

      if (page) {
        params["page"] = page - 1;
      }

      if (pageSize) {
        params["size"] = pageSize;
      }

      return params;
    },

    retrieveTutorials() {
      const params = this.getRequestParams(
        this.page
      );

      fetchStudents(params)
        .then((response) => {
          const totalItems = response.data;
          this.count = totalItems.total;

          console.log(response.data);
        })
        .catch((e) => {
          console.log(e);
        });
    },

    handlePageChange(value) {
      this.page = value;
      this.retrieveTutorials();
    },

    handlePageSizeChange(event) {
      this.pageSize = event.target.value;
      this.page = 1;
      this.retrieveTutorials();
    },
  }
};
</script>
