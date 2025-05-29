<script setup>
  import VendedorService from '@/services/vendedores/VendedorService.js'
  import Loading from 'vue-loading-overlay';
  import 'vue-loading-overlay/dist/css/index.css';
</script>

<template>
  <loading v-model:active="isLoading" />

  <table class="table table-striped table-bordered display">
    <thead>
      <tr>
        <th v-for="coluna in colunas">{{ coluna }}</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="vendedor in vendedores" :key="vendedor.id">
        <td>{{ vendedor.nome }}</td>
        <td>{{ vendedor.email }}</td>
        <td style="width: 200px">
          <RouterLink class="btn btn-warning btn-sm" :to="{ name: 'vendedores-editar', params: { id: vendedor.id } }">Editar</RouterLink>
          <button type="button" class="btn btn-danger btn-sm mx-2" @click="excluirVendedor(vendedor.id)">Excluir</button>
        </td>
      </tr>
      <tr v-if="!isLoading && vendedores.length === 0">
        <td colspan="3" class="text-center py-5">Não foram encontrados vendedores.</td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <th v-for="coluna in colunas">{{ coluna }}</th>
      </tr>
    </tfoot>
  </table>
</template>

<script>
  export default {
    name: 'Tabela',
    data() {
      return {
        vendedores: [],
        options: {
          language: {
            url: import.meta.env.VITE_DATATABLES_I18N
          },
        },
        colunas: [
          'Nome',
          'E-mail',
          'Opções',
        ],
        isLoading: false,
      }
    },
    created() {
      this.listarVendedores()
    },
    methods: {
      listarVendedores() {
        this.isLoading = true
        VendedorService.get()
          .then((res) => {
            this.vendedores = res.data
          })
          .catch((err) => {
            console.log(err)
          })
          .finally(() => {
            this.isLoading = false
          })
      },
      excluirVendedor(id) {
        this.$swal({
          title: 'Deseja realmente excluir o vendedor?',
          text: 'Todos os registros de vendas e comissões referentesa a ele também serão excluídos.',
          showCancelButton: true,
          confirmButtonColor: '#dc3545',
          confirmButtonText: 'Sim',
          cancelButtonText: 'Não',
        }).then((confirm) => {
          if (confirm.value) {
            this.isLoading = true
            VendedorService.delete(id)
              .then((res) => {
                this.listarVendedores()
              })
              .catch((err) => {
                console.log(err.response.data)
                this.isLoading = false
              })
          }
        })
      }
    }
  }
</script>

<style scoped>

</style>