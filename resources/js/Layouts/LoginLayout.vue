<script setup>
import { computed } from "vue";
import { usePage, useForm } from "@inertiajs/vue3";
import { onMounted } from 'vue';
import '@css/flashMessages.css';

const page = usePage();

const success = computed(() => page.props.flash?.success || null);
const error = computed(() => page.props.flash?.error || null);

defineEmits(['register', 'list']);

const form = useForm();

onMounted(() => {
  const alerts = document.querySelectorAll('.alert')

  alerts.forEach(alert => {
    setTimeout(() => {
      alert.classList.remove('show')
      alert.classList.add('fade')

      setTimeout(() => alert.remove(), 500)
    }, 5000)
  })
});
</script>

<template>
    <main class="main-bg">
      <div v-if="success" class="alert alert-success" role="alert">
        {{ success }}
      </div>
      <div v-if="error" class="alert alert-danger" role="alert">
        {{ error }}
      </div>

      <div class="container">
        <slot />
      </div>
    </main>

</template>
