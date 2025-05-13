<script setup>
import MainLayout from '@/Layouts/MainLayout.vue'

defineOptions({ layout: MainLayout });

defineProps({
  user: Object
});

const mensagem = 'Bem-vindo à Home!';
</script>

<template>
  <div class="container main-size main">
    <h2 class="text-xl font-semibold mb-4">Página Inicial</h2>
    <p>{{ user ? mensagem : "Não foi encontrado usuário logado"  }}, {{ user ? user.first_name : "Faça seu login agora!" }}</p>
  </div>
</template>
