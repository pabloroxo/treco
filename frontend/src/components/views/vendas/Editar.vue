<script setup>
  import VendaService from '@/services/vendas/VendaService.js'
  import Loading from 'vue-loading-overlay'
  import 'vue-loading-overlay/dist/css/index.css'
  import { Field, Form, ErrorMessage } from 'vee-validate'
  import * as yup from 'yup'
</script>

<template>
  <loading v-model:active="isLoading" />

  <h2 class="mb-3">Cadastrar venda</h2>

  <Form @submit="editar()" :validation-schema="schema">
    <div class="row mb-3">
      <div class="col-4">
        <label for="vendedor_id" class="mb-2">Vendedor:</label>
        <input id="vendedor_id" v-model="form.vendedor.nome" class="form-control" disabled />
      </div>
      <div class="col-4">
        <label for="valor" class="mb-2">Valor (R$):</label>
        <Field id="valor" name="valor" v-model="form.valor" class="form-control" />
        <ErrorMessage name="valor" />
      </div>
      <div class="col-4">
        <label for="data_venda" class="mb-2">Data:</label>
        <Field type="date" id="data_venda" name="data_venda" v-model="form.data_venda" class="form-control" />
        <ErrorMessage name="data_venda" />
      </div>
    </div>
    <div class="row">
      <div class="col-4">
        <button type="submit" class="btn btn-success">Salvar</button>
        <button type="button" class="btn btn-secondary mx-2" @click="this.$router.back()">Cancelar</button>
      </div>
    </div>
  </Form>
</template>

<script>
  export default {
    name: 'EditarVenda',
    data() {
      return {
        form: {
          vendedor: {
            nome: '',
          },
          valor: '',
          data_venda: '',
        },
        id: null,
        isLoading: false,
        schema: yup.object({
          valor: yup
            .string()
            .required('Campo "Valor" obrigatório.')
            .matches(/^(\d{1,8}\,\d{2})$/, 'Campo "Valor" deve ser de 0,01 até 99999999,99')
            .test('notZero', 'Campo "Valor" deve ser de 0,01 até 99999999,99', (value) => {
              const numero = value.split(',')
              return !(parseInt(numero[0]) === 0 && parseInt(numero[1]) === 0)
            }),
          data_venda: yup
            .date()
            .nullable()
            .typeError('Campo "Data" obrigatório.'),
        }),
      }
    },
    created() {
      this.id = this.$route.params.id
      this.exibirVenda(this.id)
    },
    methods: {
      exibirVenda(id) {
        this.isLoading = true
        VendaService
          .get(id)
          .then((res) => {
            res.data.valor = res.data.valor.replace('.', ',')
            this.form = res.data
          })
          .catch((err) => {
            console.log(err)
          })
          .finally(() => {
            this.isLoading = false
          })
      },
      editar() {
        this.isLoading = true
        VendaService
          .put(this.id, this.form)
          .then((res) => {
            this.$router.push({ name: 'vendas-listar'})
          })
          .catch((err) => {
            console.log(err)
          })
          .finally(() => {
            this.isLoading = false
          })
      }
    },
  }
</script>

<style scoped>

</style>