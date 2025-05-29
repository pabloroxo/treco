import { createRouter, createWebHistory } from 'vue-router'
import Inicio from '@/components/views/geral/Inicio.vue'

import VendedoresListar from '@/components/views/vendedores/Listar.vue'
import VendedoresCadastrar from '@/components/views/vendedores/Cadastrar.vue'
import VendedoresEditar from '@/components/views/vendedores/Editar.vue'

import VendasListar from '@/components/views/vendas/Listar.vue'
import VendasCadastrar from '@/components/views/vendas/Cadastrar.vue'
import VendasEditar from '@/components/views/vendas/Editar.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'inicio',
      component: Inicio,
    },
    {
      path: '/vendedores',
      name: 'vendedores-listar',
      component: VendedoresListar,
    },
    {
      path: '/vendedores/cadastrar',
      name: 'vendedores-cadastrar',
      component: VendedoresCadastrar,
    },
    {
      path: '/vendedores/:id',
      name: 'vendedores-editar',
      component: VendedoresEditar,
    },
    {
      path: '/vendas',
      name: 'vendas-listar',
      component: VendasListar,
    },
    {
      path: '/vendas/cadastrar',
      name: 'vendas-cadastrar',
      component: VendasCadastrar,
    },
    {
      path: '/vendas/editar/:id',
      name: 'vendas-editar',
      component: VendasEditar,
    },
  ]
})

export default router