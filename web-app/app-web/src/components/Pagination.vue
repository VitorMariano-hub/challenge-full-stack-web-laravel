<template>
  <div class="text-center" >
    <v-pagination 
    v-model="pagination.current_page"
    :length="pagination.total" 
    total-visible="10"
    dark
    color="grey"
    />
  </div>
</template>

<script>

export default {
  name: 'Pagination',
  props: {
    pagination: {}
  },

  methods: {
    previous() {
      const page = Math.max(1, this.pagination.current_page - 1);
      this.goToPage(page);
    },
    next() {
      const page = Math.min(this.pagination.last_page, this.pagination.current_page + 1);
      this.goToPage(page);
    },
    goToPage(page) {
      this.$emit('input', page);
    }
  }
}
</script>

