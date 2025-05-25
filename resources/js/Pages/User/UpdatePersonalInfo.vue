<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";

defineOptions({ layout: MainLayout });

const props = defineProps({
  user: Object,
  genders: Array,
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
  profile_picture: null,
});

onMounted(() => {
  form.first_name = props.user.first_name;
  form.surname = props.user.surname;
  form.cpf = props.user.cpf;
  form.gender_id = props.user.gender_id;
  form.email = props.user.email;
  form.mobile_number = props.user.mobile_number;
  form.born_date = props.user.born_date;
  form.profile_picture = props.user.profile_picture;
});

const submit = (id) => {
  form.post(route("updateUser", id));
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
    <h3 class="px-4 py-3">Editar Informações Pessoais</h3>
    <form
      class="px-4 py-3"
      @submit.prevent="submit(user.id)"
      enctype="multipart/form-data"
    >
      <div class="col-md-4 mb-3">
        <label for="profile_picture">Foto de Perfil Atual:</label>
        
        <div class="profile-pic mb-3">
          <img
            v-if="props.user.profile_picture"
            :src="`/storage/${props.user.profile_picture}`"
            alt="Foto de perfil do autor da publicação"
            class="img-fluid author-profile-picture"
          />
          <img
            v-else
            src="/public/storage/img/profile-picture-placeholder.png"
            alt="Foto de perfil padrão"
            class="img-fluid author-profile-picture"
          />
        </div>
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
            :placeholder="user.first_name"
          />
        </div>
        <div class="col form-group">
          <label for="surname">Sobrenome:</label>
          <input type="text" class="form-control" v-model="form.surname" />
        </div>
      </div>
      <div class="mb-3 form-group">
        <label for="cpf">CPF:</label>
        <input type="text" class="form-control" v-model="form.cpf" />
      </div>
      <div class="mb-3 form-group">
        <label for="gender_id">Gênero:</label>
        <select v-model="form.gender_id" class="form-control" id="gender_id">
          <option disabled value="">Selecione um gênero:</option>
          <option v-for="gender in genders" :key="gender.id" :value="gender.id">
            {{ gender.gender }}
          </option>
        </select>
      </div>
      <div class="mb-3 form-group">
        <label for="email">E-mail:</label>
        <input type="email" class="form-control" v-model="form.email" />
      </div>
      <div class="mb-3 form-group">
        <label for="mobile_number">Número de celular:</label>
        <input
          type="text"
          class="form-control"
          v-model="form.mobile_number"
          max="11"
        />
      </div>
      <div class="mb-3 form-group">
        <label for="born_date">Data de nascimento:</label>
        <input type="date" class="form-control" v-model="form.born_date" />
      </div>
      <div class="mb-3 form-group">
        <label for="password">Senha:</label>
        <input type="password" class="form-control" v-model="form.password" />
      </div>

      <div class="d-flex justify-content-center">
        <button class="btn btn-primary" type="submit">Editar Usuário</button>
      </div>
    </form>
  </div>
</template>
