<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

defineOptions({ layout: MainLayout });

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

const imageUrl = ref(null);
function handleFileUpload(event) {
  const file = event.target.files[0];
  if (file && file.type.startsWith("image/")) {
    form.profile_picture = file;
    imageUrl.value = URL.createObjectURL(file);
  }
}
</script>

<template>
  <div class="">
    <h3 class="px-4 py-3">Cadastro de Administrador de Comunidade</h3>
    <form
      class="px-4 py-3"
      @submit.prevent="submit"
      enctype="multipart/form-data"
    >
    <div class="row">
        <div class="mb-3 form-group">
          <label for="community_id">Comunidade:</label>
          <select
            v-model="form.community_id"
            class="form-control"
            id="community_id"
            required
          >
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

    </div>
      <div class="col-md-4 mb-3">
        <label for="profile_picture">Foto de Perfil</label>
        <input
          type="file"
          class="form-control"
          accept="image/png, image/jpeg, image/jpg"
          @change="handleFileUpload"
        />
      </div>
      <div class="row mb-3">
        <div class="col form-group">
          <label for="first_name">Primeiro nome:</label>
          <input
            type="text"
            class="form-control"
            v-model="form.first_name"
            required
          />
        </div>
        <div class="col form-group">
          <label for="surname">Sobrenome:</label>
          <input
            type="text"
            class="form-control"
            v-model="form.surname"
            required
          />
        </div>
      </div>
      <div class="mb-3 form-group">
        <label for="cpf">CPF:</label>
        <input type="text" class="form-control" v-model="form.cpf" required />
      </div>
      
      <div class="mb-3 form-group">
        <label for="email">E-mail:</label>
        <input
          type="email"
          class="form-control"
          v-model="form.email"
          required
        />
      </div>
      <div class="mb-3 form-group">
        <label for="mobile_number">Número de celular:</label>
        <input
          type="text"
          class="form-control"
          v-model="form.mobile_number"
          max="11"
          required
        />
      </div>
      <div class="mb-3 form-group">
        <label for="password">Senha:</label>
        <input
          type="password"
          class="form-control"
          v-model="form.password"
          required
        />
      </div>

      
        <div class="">
          <button class="btn btn-primary" type="submit">Cadastrar</button>
        </div>
    </form>
  </div>
</template>
