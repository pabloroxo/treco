<script setup>
  import VendaService from '@/services/vendas/VendaService.js'
  import VendedorService from '@/services/vendedores/VendedorService.js'
  import Loading from 'vue-loading-overlay'
  import 'vue-loading-overlay/dist/css/index.css'
  import moment from 'moment'
</script>

<template>
  <loading v-model:active="isLoading" />

  <div class="row mb-3">
    <div class="col-8">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Filtro</h5>
          <div class="row">
            <div class="col-7">
              <label for="vendedor" class="mb-2">Vendedor:</label>
              <select class="form-select" id="vendedor" v-model="filtro.vendedor_id">
                <option value="">Todos</option>
                <optgroup v-if="vendedores.length !== 0" label="--"></optgroup>
                <option v-for="vendedor in vendedores" :value="vendedor.id">{{ vendedor.nome }}</option>
              </select>
            </div>
            <div class="col-3">
              <label for="data_venda" class="mb-2">Data:</label>
              <input type="date" id="data_venda" class="form-control" v-model="filtro.data_venda" />
            </div>
            <div class="col-2">
              <button type="button" class="btn btn-primary" @click="listarVendas()" style="margin-top: 32px">OK</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Comissão</h5>
          * Aqui eu mostraria um resumo com a quantidade de vendas, a soma dos preços e a comissão, sendo 8,5% do da soma. Também teria as opções de enviar por e-mail.
        </div>
      </div>
    </div>
  </div>

  <table class="table table-striped table-bordered display">
    <thead>
      <tr>
        <th v-for="coluna in colunas">{{ coluna }}</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="venda in vendas" :key="venda.id">
        <td>{{ venda.vendedor.nome }}</td>
        <td>{{ Intl.NumberFormat('pt-br', {style: 'currency', currency: 'BRL'}).format(venda.valor) }}</td>
        <td>{{ moment(venda.data_venda).format("DD/MM/YYYY") }}</td>
        <td style="width: 200px">
          <RouterLink class="btn btn-warning btn-sm" :to="{ name: 'vendas-editar', params: { id: venda.id } }">Editar</RouterLink>
          <button type="button" class="btn btn-danger btn-sm mx-2" @click="excluirVenda(venda.id)">Excluir</button>
        </td>
      </tr>
      <tr v-if="!isLoading && vendas.length === 0">
        <td colspan="4" class="text-center py-5">Não foram encontradas vendas.</td>
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
        vendas: [],
        vendedores: [],
        filtro: {
          vendedor_id: '',
          data_venda: '',
        },
        options: {
          language: {
            url: import.meta.env.VITE_DATATABLES_I18N
          },
        },
        colunas: [
          'Vendedor',
          'Valor',
          'Data',
          'Opções',
        ],
        isLoading: false,
      }
    },
    async created() {
      this.isLoading = true
      await this.listarVendedores()
      await this.listarVendas()
      this.isLoading = false
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
      },
      listarVendas() {
        VendaService.get(null, this.filtro)
          .then((res) => {
            this.vendas = res.data
          })
          .catch((err) => {
            console.log(err)
          })
      },
      excluirVenda(id) {
        this.$swal({
          title: 'Deseja realmente excluir a venda?',
          text: '',
          showCancelButton: true,
          confirmButtonColor: '#dc3545',
          confirmButtonText: 'Sim',
          cancelButtonText: 'Não',
        }).then((confirm) => {
          if (confirm.value) {
            this.isLoading = true
            VendaService.delete(id)
              .then((res) => {
                this.listarVendaes()
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