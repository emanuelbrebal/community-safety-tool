<!-- resources/js/Pages/Home.vue -->
<script setup>
import { ref } from 'vue'
import Switch from '@/components/ui/switch/Switch.vue'

const isChecked = ref(false)
</script>

<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Página Inicial</h1>

    <div class="flex items-center gap-4">
      <label class="font-medium">Ativar:</label>
      <Switch v-model:checked="isChecked" />
      <span>{{ isChecked ? 'Ligado' : 'Desligado' }}</span>
    </div>
  </div>
</template>