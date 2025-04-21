
<script setup>
import MainLayout from '@/Layouts/MainLayout.vue'

defineOptions({ layout: MainLayout }) 
const usuarios = $usuarios;
</script>

<template>
  <div>
    <h2 class="text-xl font-semibold mb-4">Página Inicial</h2>
    <p>{{ mensagem }}</p>
  </div>
</template>
