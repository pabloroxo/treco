<script setup>
  import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">TRECO</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <RouterLink class="nav-link" :to="{ name: 'inicio' }">Início</RouterLink>
          <RouterLink class="nav-link" :to="{ name: 'vendedores-listar' }">Vendedores</RouterLink>
          <RouterLink class="nav-link" :to="{ name: 'vendas-listar' }">Vendas</RouterLink>
          <RouterLink class="nav-link" to="#">Logout</RouterLink>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>

</script>

<style scoped>

</style>