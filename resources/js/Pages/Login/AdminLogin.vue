<script setup>
import LoginLayout from "@/Layouts/LoginLayout.vue";
import { router, useForm } from "@inertiajs/vue3";
import "../../../css/colors.css";

defineOptions({ layout: LoginLayout });

const form = useForm({
  cpf: "",
  password: "",
  community_id: "",
  guard: ''
});

const props = defineProps({
  communities: Object
})

const submit = () => {
  form.guard = 'admin';
  form.post(route("adminLogin"));
};

const register = () => {
  router.visit(route("redirectAdminRegister"));
};
const redirectLoginUser = () => {
  router.visit(route("redirectLoginUser"));
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
      <div class="col painel-esquerdo -admin">
          <img class="login-img" src="/storage/app/public/img/Logo Comunidade Alerta Login.png" alt="" />
        <p class="login-subtext">Projeto Acadêmico e sem fins lucrativos. <br> Feito por: Emanuel Victor de Melo Brebal</p>
      </div>
      <div class="painel-direito">
        <form class="d-grid justify-content-center" @submit.prevent="submit">
          <h1>
            <svg xmlns="http://www.w3.org/2000/svg" width="55" height="55" viewBox="0 0 24 24"><path fill="#212121" d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12c5.16-1.26 9-6.45 9-12V5Zm0 3.9a3 3 0 1 1-3 3a3 3 0 0 1 3-3m0 7.9c2 0 6 1.09 6 3.08a7.2 7.2 0 0 1-12 0c0-1.99 4-3.08 6-3.08"/></svg>
            Login de Administrador</h1>
            <div class="mb-3">
            <label for="community_id" class="form-label">Comunidade</label>
            <select v-model="form.community_id" class="form-select" required>
              <option disabled value="">Selecione uma comunidade:</option>
              <option
                v-for="community in props.communities"
                :key="community.id"
                :value="community.id"
              >
                {{ community.community }}
              </option>
            </select>
          </div>
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
            <p>É usuário de alguma comunidade? <a class="register-link" @click="redirectLoginUser" >Faça login agora!</a></p>
          </div>
          <div class="button-container">
            <button type="submit" class="btn btn-login">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>