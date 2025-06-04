<script setup>
import LoginLayout from "@/Layouts/LoginLayout.vue";
import { router, useForm } from "@inertiajs/vue3";
import "../../../css/colors.css";

defineOptions({ layout: LoginLayout });

const form = useForm({
  cpf: "",
  password: "",
});

const submit = () => {
  form.post(route("userLogin"));
};
const register = () => {
  router.visit(route("redirectRegister"));
};
const loginAdmin = () => {
  router.visit(route("redirectLoginAdmin"));
};

function formatCPF(e) {
  let value = e.target.value.replace(/\D/g, '');
  if (value.length > 11) value = value.slice(0, 11);
  value = value.replace(/(\d{3})(\d)/, '$1.$2');
  value = value.replace(/(\d{3})(\d)/, '$1.$2');
  value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
  form.cpf = value;
  e.target.value = value;
}

</script>

<template>
  <div class="organiza-login">
    <div class="painel-login">
      <div class="col painel-esquerdo -usuario">
          <img class="login-img" src="/storage/app/public/img/Logo Comunidade Alerta Login.png" alt="" />
        <p class="login-subtext">Projeto Acadêmico e sem fins lucrativos. <br> Feito por: Emanuel Victor de Melo Brebal</p>
      </div>
      <div class="painel-direito">
        <form class="d-grid justify-content-center" @submit.prevent="submit">
          <h1>
            <svg xmlns="http://www.w3.org/2000/svg" width="55" height="55" viewBox="0 0 24 24"><path fill="#212121" d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4"/></svg>
            Login de Usuário
          </h1>
          <div class="mb-3">
            <label for="cpf" class="form-label">CPF</label>
            <input
              type="text"
              class="form-control"
              id="cpf"
              name="cpf"
              v-model="form.cpf"
              @input="formatCPF"
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
          <div class="row">
            <p>Ainda não possui uma conta? <a class="register-link" @click="register" >Registre-se agora!</a></p>
          </div>
          <div class="row">
            <p>É administrador de alguma comunidade? <a class="register-link" @click="loginAdmin" >Faça login aqui!</a></p>
          </div>
          <div class="button-container">
            <button type="submit" class="btn btn-login">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>