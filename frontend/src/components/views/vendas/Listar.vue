<script setup>
  import Tabela from '@/components/views/vendas/Tabela.vue'
</script>

<template>
  <h2 class="mb-3">Vendas</h2>

  <RouterLink :to="{ name: 'vendas-cadastrar' }" class="btn btn-primary mb-3">Cadastrar venda</RouterLink>

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