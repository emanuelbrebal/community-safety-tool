<script setup>
import LoginLayout from "@/Layouts/LoginLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

defineOptions({ layout: LoginLayout });

const props = defineProps({
  communities: Array,
});

const form = useForm({
  first_name: "",
  surname: "",
  cpf: "",
  gender_id: "",
  email: "",
  mobile_number: "",
  born_date: "",
  password: "",
  community_id: "",
});

const submit = () => {
  form.post(route("createAdminRegister"));
};

const loginAdmin = () => {
  form.get(route("redirectLoginAdmin"));
};
const imageUrl = ref(null);
function handleFileUpload(event) {
  const file = event.target.files[0];
  if (file && file.type.startsWith("image/")) {
    form.profile_picture = file;
    imageUrl.value = URL.createObjectURL(file);
  }
}
function formatCPF(e) {
  let value = e.target.value.replace(/\D/g, "");
  if (value.length > 11) value = value.slice(0, 11);
  value = value.replace(/(\d{3})(\d)/, "$1.$2");
  value = value.replace(/(\d{3})(\d)/, "$1.$2");
  value = value.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
  form.cpf = value;
  e.target.value = value;
}

function formatCellPhone(e) {
  let value = e.target.value.replace(/\D/g, "");
  if (value.length > 11) value = value.slice(0, 11);
  value = value.replace(/^(\d{2})(\d)/g, "($1) $2");
  value = value.replace(/(\d{5})(\d{1,4})$/, "$1-$2");
  form.mobile_number = value;
  e.target.value = value;
}
</script>

<template>
  <div class="painel-registro">
    <div class="painel-esquerdo-registro -admin">
      <div class=""></div>
      <img
        class="register-img"
        src="/storage/app/public/img/Logo Comunidade Alerta Login.png"
        alt=""
      />
      <p class="login-subtext">
        Projeto Acadêmico e sem fins lucrativos. <br />
        Feito por: Emanuel Victor de Melo Brebal
      </p>
    </div>

    <div class="painel-direito-registro">
      <h3
        class="text-center mt-4 mb-4 d-flex align-items-center justify-content-center gap-2"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="40"
          height="40"
          viewBox="0 0 24 24"
        >
          <path
            fill="#212121"
            d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12c5.16-1.26 9-6.45 9-12V5Zm0 3.9a3 3 0 1 1-3 3a3 3 0 0 1 3-3m0 7.9c2 0 6 1.09 6 3.08a7.2 7.2 0 0 1-12 0c0-1.99 4-3.08 6-3.08"
          />
        </svg>
        Cadastro de Administrador
      </h3>

      <form class="form-admin-register" @submit.prevent="submit">
        <div class="row mb-3">
          <div class="col-md-6">
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
          <div class="col-md-6">
            <label for="profile_picture" class="form-label"
              >Foto de Perfil</label
            >
            <input
              type="file"
              class="form-control"
              accept="image/png, image/jpeg"
              @change="handleFileUpload"
            />
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="first_name" class="form-label">Primeiro Nome</label>
            <input
              type="text"
              class="form-control"
              v-model="form.first_name"
              required
            />
          </div>
          <div class="col-md-6">
            <label for="surname" class="form-label">Sobrenome</label>
            <input
              type="text"
              class="form-control"
              v-model="form.surname"
              required
            />
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-4">
            <label for="cpf" class="form-label">CPF</label>
            <input
              type="text"
              class="form-control"
              v-model="form.cpf"
              @input="formatCPF"
              required
            />
          </div>
          <div class="col-md-4">
            <label for="mobile_number" class="form-label"
              >Número de Celular</label
            >
            <input
              type="text"
              class="form-control"
              v-model="form.mobile_number"
              @input="formatCellPhone"
              required
            />
          </div>
          <div class="col-md-4">
            <label for="email" class="form-label">E-mail</label>
            <input
              type="email"
              class="form-control"
              v-model="form.email"
              required
            />
          </div>
        </div>

        <div class="mb-4 col-md-4">
          <label for="password" class="form-label">Senha</label>
          <input
            type="password"
            class="form-control"
            v-model="form.password"
            required
          />
        </div>
        <div class="text-center mb-3">
          <button type="submit" class="btn btn-dark px-5">Cadastrar</button>
        </div>
        <div class="row">
          <p class="d-flex justify-content-end">
            Já é administrador de alguma comunidade?<a class="register-link" @click="loginAdmin">
              Faça login agora!</a
            >
          </p>
        </div>
      </form>
    </div>
  </div>
</template>


     