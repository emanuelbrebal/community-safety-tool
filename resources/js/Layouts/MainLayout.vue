<script setup>
import { computed, ref } from "vue";
import { usePage, useForm, router } from "@inertiajs/vue3";
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
  list: () => form.get(route("redirectListUsers")),
  logout: () => form.post(route("logout")),
  createPublication: () => form.get(route("redirectCreatePublication")),
  updateUser: (id) => form.get(route('redirectUpdateUser', id))
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

const showLogoutMenu = ref(false);

const toggleLogout = () => {
  showLogoutMenu.value = !showLogoutMenu.value;
};
</script>

<template>
  <div class="min-h-screen flex flex-col">
    <header class="header">
      <nav class="navbar navbar-expand-lg navbar-light bg-navbar">
        <div class="container-fluid">
          <a class="navbar-brand" @click="navigation.home">Comunidade Alerta</a>
          <div class="d-flex ms-auto">
            <a
              v-if="admin"
              class="btn btn-secondary me-2"
              @click="navigation.list"
            >
              Listar
            </a>
          </div>
          <div v-if="user" class="logged-user" @click="toggleLogout">
            <a>
              <img
                class="author-profile-picture -sm"
                :src="`/storage/${user.profile_picture}`"
                alt="Foto de Perfil de Usuário"
              />
              Bem vindo(a):
              {{ user.first_name }}

              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
              >
                <path fill="currentColor" d="m7 10l5 5l5-5z" />
              </svg>
            </a>

            <div v-if="showLogoutMenu" class="dropdown-user">
              <a
                v-if="admin"
                @click="route.visit(route('redirectUpdateAdmin', admin.id))"
                style="color: black"
              >
                Ver detalhes da conta
              </a>
              <a
                v-else-if="user"
                @click="navigation.updateUser(user.id)"
                style="color: black; text-decoration: underline;"
              >
                Ver detalhes da conta
              </a>
              <button class="btn btn-danger" @click.stop="navigation.logout">
                Logout
              </button>
            </div>
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
