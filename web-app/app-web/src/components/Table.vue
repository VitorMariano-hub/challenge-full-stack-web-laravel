<template>
  <v-table>
    <thead>
      <tr>
        <th class="text-left">
          Registro Acadêmico
        </th>
        <th class="text-left">
          Nome
        </th>
        <th class="text-left">
          Cpf
        </th>
        <th class="text-left">
          Ações
        </th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="item in students"
        :key="item.id"
      >
        <td>{{ item.ra }}</td>
        <td>{{ item.name }}</td>
        <td>{{ item.cpf }}</td>
        <td>
          <!-- Botões de ações aqui -->
        </td>
      </tr>
    </tbody>
  </v-table>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Table',
  data() {
    return {
      students: [], // Array para armazenar os dados dos estudantes
    };
  },
  mounted() {
    // Fazer a requisição à API ao montar o componente
    this.fetchStudents();
  },
  methods: {
    fetchStudents() {
      axios.get('https://web-service-app.herokuapp.com/api/v1/students')
        .then(response => {
          this.students = response.data; // Atualizar o array com os dados da API
        })
        .catch(error => {
          console.error(error);
        });
    },
  },
};
</script>
