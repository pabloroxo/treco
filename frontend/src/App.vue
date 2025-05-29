<script setup>
  import Menu from "@/components/template/Menu.vue"
  import "bootstrap/dist/css/bootstrap.min.css"
  import "bootstrap"
</script>

<template>
  <header>
    <Menu class="mb-3"></Menu>
  </header>

  <main>
    <router-view></router-view>
  </main>
</template>

<script>

</script>

<style scoped>

</style>
