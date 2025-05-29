<script setup>
  import VendaService from '@/services/vendas/VendaService.js'
  import VendedorService from '@/services/vendedores/VendedorService.js'
  import Loading from 'vue-loading-overlay'
  import 'vue-loading-overlay/dist/css/index.css'
  import { Field, Form, ErrorMessage } from 'vee-validate'
  import * as yup from 'yup'
</script>

<template>
  <loading v-model:active="isLoading" />

  <h2 class="mb-3">Cadastrar venda</h2>

  <Form @submit="cadastrar()" :validation-schema="schema">
    <div class="row mb-3">
      <div class="col-4">
        <label for="vendedor_id" class="mb-2">Vendedor:</label>
        <Field id="vendedor_id" name="vendedor_id" v-model="form.vendedor_id" class="form-select" as="select">
          <option value="" style="display: none" disabled selected>Selecione o vendedor</option>
          <option v-for="vendedor in vendedores" :value="vendedor.id">{{ vendedor.nome }}</option>
        </Field>
        <ErrorMessage name="vendedor_id" />
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
        <button type="submit" class="btn btn-success">Cadastrar</button>
        <button type="button" class="btn btn-secondary mx-2" @click="$router.back()">Cancelar</button>
      </div>
    </div>
  </Form>
</template>

<script>
  export default {
    name: 'CadastrarVenda',
    data() {
      return {
        form: {
          vendedor_id: '',
          valor: '0,00',
          data_venda: '',
        },
        vendedores: [],
        isLoading: false,
        schema: yup.object({
          vendedor_id: yup
            .string()
            .required('Campo "Vendedor" obrigatório.'),
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
      this.listarVendedores()
    },
    methods: {
      listarVendedores() {
        this.isLoading = true
        VendedorService
          .get()
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
      cadastrar() {
        this.isLoading = true
        VendaService
          .post(this.form)
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