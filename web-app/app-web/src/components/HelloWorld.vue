<template>
  <div>
    <MainMenu />
    <Table />
  </div>
</template>

<script>
import MainMenu from '@/components/MainMenu.vue'; 
import Table from '@/components/Table.vue'; 

export default {
  name: 'HomePage',
  components: {
    MainMenu,
    Table
  },
}
</script>
