<script setup>
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import { useForm } from '@inertiajs/vue3';
import '../../css/mainLayout.css';
import '../../css/publication.css';
import '../../css/colors.css';
import '@css/flashMessages.css';

const page = usePage();

const success = computed(() => page.props.flash?.success || null);
const error = computed(() => page.props.flash?.error || null);

defineEmits(['register', 'list']);

const form = useForm();

const navigation = {
  home: () => form.get(route('redirectHome')),
  register: () => form.get(route('redirectRegister')),
  list: () => form.get(route('redirectListUsers')),
  login: () => form.get(route('redirectLoginUser')),
  logout: () => form.post(route('logout')),
  adminLogin: () => form.get(route('redirectLoginAdmin')),
  createPublication: () => form.get(route('redirectCreatePublication')),
};


</script>

<template>
  <div class="min-h-screen flex flex-col">
    <header class="header">
      <nav class="navbar navbar-expand-lg navbar-light bg-navbar">
        <div class="container-fluid">
          <a class="navbar-brand" @click="navigation.home">Guardião da Vila</a>
          <div class="d-flex ms-auto">
            <button class="btn btn-success me-2" @click="navigation.login">
              Login
            </button>
            <button class="btn btn-success me-2" @click="navigation.adminLogin">
              Login Adm
            </button>
            <button class="btn btn-success me-2" @click="navigation.createPublication">
              Criar Publicação
            </button>
            <button class="btn btn-primary me-2" @click="navigation.register">
              Registrar
            </button>
            <button class="btn btn-secondary me-2" @click="navigation.list">
              Listar
            </button>
            <button class="btn btn-danger" @click="navigation.logout">
              Logout
            </button>
          </div>
        </div>
      </nav>
    </header>

    <main class="main-bg">
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
        <span>
          © 2025 Guardião da Vila. Todos os direitos reservados.
        </span>
    </footer>
  </div>
</template>
