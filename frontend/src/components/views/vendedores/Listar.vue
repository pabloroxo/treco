<script setup>
  import Tabela from '@/components/views/vendedores/Tabela.vue'
</script>

<template>
  <h2 class="mb-3">Vendedores</h2>

  <RouterLink :to="{ name: 'vendedores-cadastrar' }" class="btn btn-primary mb-3">Cadastrar vendedor</RouterLink>

  <Tabela></Tabela>
</template>

<script>
  export default {
    data() {
      return { }
    },
  }
</script>

<style scoped>

</style>