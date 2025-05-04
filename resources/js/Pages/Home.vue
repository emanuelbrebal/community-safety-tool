<script setup>
import MainLayout from '@/Layouts/MainLayout.vue'

defineOptions({ layout: MainLayout }) 

const mensagem = 'Bem-vindo à Home!'
</script>

<template>
  <div class="container main-size main">
    <h2 class="text-xl font-semibold mb-4">Página Inicial</h2>
    <p>{{ mensagem }}</p>
  </div>
</template>
