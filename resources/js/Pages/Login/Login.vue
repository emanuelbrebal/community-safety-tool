<script setup>
import LoginLayout from "@/Layouts/LoginLayout.vue";
import { useForm } from "@inertiajs/vue3";
import "../../../css/colors.css";

defineOptions({ layout: LoginLayout });

const form = useForm({
  cpf: "",
  password: "",
});

const submit = () => {
  form.post(route("userLogin"));
};
</script>

<template>
  <div class="organiza-login">
    <div class="painel-login">
      <div class="col painel-esquerdo">
        <img src="/storage/app/public/img/Logo Comunidade Alerta.png" alt="" />
      </div>
      <div class="painel-direito">
        <form class="d-grid justify-content-center" @submit.prevent="submit">
          <h1>Login de Usuário</h1>
          <div class="mb-3">
            <label for="cpf" class="form-label">CPF</label>
            <input
              type="text"
              class="form-control"
              id="cpf"
              name="cpf"
              v-model="form.cpf"
            />
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <input
              type="password"
              class="form-control"
              id="password"
              name="password"
              v-model="form.password"
            />
          </div>
          <div class="button-container">
            <button type="submit" class="btn btn-primary btn-login">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>