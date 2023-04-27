<template>
  <div>
    <v-container>
    <MainMenu />
    <StudentShow />
    </v-container>
  </div>
</template>

<script>
import MainMenu from '@/components/MainMenu.vue'; 
import StudentShow from '@/components/StudentShow.vue'; 

export default {
  name: 'Layout',
  props: {
    successMessage: String,
  },
  components: {
    MainMenu,
    StudentShow,
  },
}
</script>
