<script setup>
  import VendedorService from '@/services/vendedores/VendedorService.js'
  import Loading from 'vue-loading-overlay'
  import 'vue-loading-overlay/dist/css/index.css'
  import { Field, Form, ErrorMessage } from 'vee-validate'
  import * as yup from 'yup'
</script>

<template>
  <loading v-model:active="isLoading" />

  <h2 class="mb-3">Cadastrar vendedor</h2>

  <Form @submit="cadastrar()" :validation-schema="schema">
    <div class="row mb-3">
      <div class="col-4">
        <label for="nome" class="mb-2">Nome:</label>
        <Field id="nome" name="nome" v-model="form.nome" class="form-control" />
        <ErrorMessage name="nome" />
      </div>
      <div class="col-4">
        <label for="email" class="mb-2">E-mail:</label>
        <Field id="email" name="email" v-model="form.email" class="form-control" @blur="erroEmail = ''" />
        <ErrorMessage name="email" />
        <span v-show="erroEmail">{{ erroEmail }}</span>
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
    name: 'CadastrarVendedor',
    data() {
      return {
        form: {
          nome: '',
          email: '',
        },
        isLoading: false,
        schema: yup.object({
          nome: yup
            .string()
            .required('Campo "Nome" obrigatório.')
            .max(50, 'Campo "Nome" permite até 50 caracteres.'),
          email: yup
            .string()
            .required('Campo "E-mail" obrigatório.')
            .email('Campo "E-mail" deve ser válido.')
            .max(50, 'Campo "E-mail" permite até 50 caracteres.'),
        }),
        erroEmail: '',
      }
    },
    methods: {
      cadastrar() {
        this.isLoading = true
        this.erroEmail = ''
        VendedorService
          .post(this.form)
          .then((res) => {
            this.$router.push({ name: 'vendedores-listar'})
          })
          .catch((err) => {
            const erros = err.response.data.errors
            this.erroEmail = erros.email[0] ?? ''
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