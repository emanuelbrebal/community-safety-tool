<script setup>
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import { useForm } from '@inertiajs/vue3';
import '../../css/mainLayout.css';

const page = usePage();

const success = computed(() => page.props.flash?.success || null);
const error = computed(() => page.props.flash?.error || null);

defineEmits(['register', 'list']);

const form = useForm();

const home = () => {
  form.get(route('redirectHome'));
}

const registrar = () => {
  form.get(route('redirectRegister'));
}

const listar = () => {
  form.get(route('redirectListUsers'));
}
</script>

<template>
  <div class="min-h-screen flex flex-col">
    <header class="header">
      <nav class="navbar navbar-expand-lg navbar-light bg-navbar">
        <div class="container-fluid">
          <a class="navbar-brand" @click="home">Guardião da Vila</a>
          <div class="d-flex ms-auto">
            <button class="btn btn-primary me-2" @click="registrar">
              Registrar
            </button>
            <button class="btn btn-outline-secondary" @click="listar">
              Listar
            </button>
          </div>
        </div>
      </nav>
    </header>

    <main class="main-bg">
      <!-- Exibição de mensagens de sucesso ou erro -->
      <div v-if="success" class="alert alert-success" role="alert">
        {{ success }}
      </div>
      <div v-if="error" class="alert alert-danger" role="alert">
        {{ error }}
      </div>

      <div class="full-size main">
        <slot />
      </div>
    </main>

    <footer class="bg-footer text-center py-3 mt-auto footer">
        <span class="text-muted">
          © 2025 Guardião da Vila. Todos os direitos reservados.
        </span>
    </footer>
  </div>
</template>
