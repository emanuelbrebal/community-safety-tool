<script setup>
import { computed, ref, onMounted } from "vue";
import { usePage, useForm, router } from "@inertiajs/vue3";
import "../../css/mainLayout.css";
import "../../css/publication.css";
import "../../css/updateUser.css";
import "../../css/colors.css";
import "@css/flashMessages.css";

const page = usePage();

const success = computed(() => page.props.flash?.success || null);
const error = computed(() => page.props.flash?.error || null);

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
  updateUser: (id) => router.visit(route("redirectUpdateAdmin", id)),
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
      <nav class="navbar navbar-expand-lg navbar-light -admin">
        <div class="container-fluid">
          <a class="navbar-brand" @click="navigation.home">Comunidade Alerta</a>
          <div class="d-flex ms-auto">
            <a
              v-if="admin"
              class="btn btn-secondary me-2"
              @click.prevent="navigation.list"
            >
              Listar Usuários da comunidade
            </a>

            <div v-if="admin" class="logged-user" @click="toggleLogout">
                <a class="logged-user" style="color: white">
                  <div class="profile-pic">

                    <img
                    class="author-profile-picture -sm"
                    :src="`/storage/${admin.profile_picture}`"
                    alt="Foto de Perfil de Usuário"
                    />
                  </div>
                  Bem vindo(a):
                  {{ admin.first_name }}
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
                <a @click="navigation.updateUser(admin.id)" style="color: black">
                  Ver detalhes da conta
                </a>
                <button class="btn btn-danger" @click.stop="navigation.logout">
                  Logout
                </button>
              </div>
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

    <footer class="text-center py-3 mt-auto footer -admin">
      <span> © 2025 Comunidade Alerta. Todos os direitos reservados. </span>
    </footer>
  </div>
</template>
