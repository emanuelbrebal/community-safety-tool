<script setup>
import { computed } from "vue";
import { usePage, useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";
import "../../css/mainLayout.css";
import "../../css/publication.css";
import "../../css/updateUser.css";
import "../../css/colors.css";
import "@css/flashMessages.css";

const page = usePage();

const success = computed(() => page.props.flash?.success || null);
const error = computed(() => page.props.flash?.error || null);

defineEmits(["register", "list"]);

const form = useForm();

const props = defineProps({
  user: Object,
  admin: Object,
  admin_id: Number,
});

const navigation = {
  home: () => form.get(route("redirectHome")),
  register: () => form.get(route("redirectRegister")),
  list: () => form.get(route("redirectListUsers")),
  login: () => form.get(route("redirectLoginUser")),
  logout: () => form.post(route("logout")),
  adminLogin: () => form.get(route("redirectLoginAdmin")),
  createAdmin: () => form.get(route("redirectAdminRegister")),
  updateAdmin: (id) => form.get(route("redirectUpdateAdmin", id)),
  deleteAdmin: (id) => form.get(route("redirectDeleteAdmin", id)),
  createPublication: () => form.get(route("redirectCreatePublication")),
};
onMounted(() => {
  const alerts = document.querySelectorAll(".alert");

  alerts.forEach((alert) => {
    setTimeout(() => {
      alert.classList.remove("show");
      alert.classList.add("fade");

      setTimeout(() => alert.remove(), 500);
    }, 5000);
  });
});
</script>

<template>
  <div class="min-h-screen flex flex-col">
    <header class="header">
      <nav class="navbar navbar-expand-lg navbar-light bg-navbar">
        <div class="container-fluid">
          <a class="navbar-brand" @click="navigation.home">Comunidade Alerta</a>
          <div class="d-flex ms-auto">
            <p>
              Usuário logado:
              {{
                admin ? admin.nome : user ? user.nome : "Usuário não encontrado"
              }}
            </p>
            
            <button
              class="btn btn-success me-2"
              @click="navigation.createPublication"
            >
              Criar Publicação
            </button>
            <a v-if="administrador" class="btn btn-secondary me-2" @click="navigation.list">
              Listar
            </a>
            <button class="btn btn-danger" @click="navigation.logout">
              Logout
            </button>
          </div>
        </div>
      </nav>
    </header>

    <main class="main-bg">
      <div v-if="success" class="alert alert-success fade show" role="alert">
        {{ success }}
      </div>
      <div v-if="error" class="alert alert-danger fade show" role="alert">
        {{ error }}
      </div>

      <div class="full-size main">
        <slot />
      </div>
    </main>

    <footer class="bg-footer text-center py-3 mt-auto footer">
      <span> © 2025 Comunidade Alerta. Todos os direitos reservados. </span>
    </footer>
  </div>
</template>
