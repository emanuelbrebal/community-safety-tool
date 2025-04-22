<script setup>
import { ref, watchEffect } from "vue";
import { usePage } from "@inertiajs/vue3";

const flashMessage = ref(null);

// atualiza o flashMessage quando mudar
watchEffect(() => {
  const msg = usePage().props.flash.success;
  flashMessage.value = msg;

  if (msg) {
    setTimeout(() => {
      flashMessage.value = null;
    }, 5000);
  }
});
</script>

<template>
  <div class="min-h-screen flex flex-col">
    <header class="bg-blue-600 p-4 w-100">
      <h1 class="text-lg font-bold">Guardião da Vila</h1>
    </header>

    <main class="flex-1 p-6 w-80">
      <div
        v-if="$page.props.flash.success"
        class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg"
      >
        {{ $page.props.flash.success }}
      </div>

      <slot />
    </main>

    <footer class="bg-gray-100 text-center text-sm py-4 w-100">
      &copy; {{ new Date().getFullYear() }} - Todos os direitos reservados
    </footer>
  </div>
</template>
  