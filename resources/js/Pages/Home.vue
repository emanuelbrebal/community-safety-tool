<!-- resources/js/Pages/Home.vue -->
<script setup>
import MainLayout from '@/Layouts/MainLayout.vue'

defineOptions({ layout: MainLayout }) 

const mensagem = 'Bem-vindo à Home!'
</script>

<template>
  <div>
    <h2 class="text-xl font-semibold mb-4">Página Inicial</h2>
    <p>{{ mensagem }}</p>
  </div>
</template>
