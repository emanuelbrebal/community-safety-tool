<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";

defineOptions({ layout: AdminLayout });

const props = defineProps({
  admin: Object,
});

const form = useForm({
  first_name: "",
  surname: "",
  cpf: "",
  email: "",
  mobile_number: "",
  password: "",
  profile_picture: null,
});

onMounted(() => {
  form.first_name = props.admin.first_name;
  form.surname = props.admin.surname;
  form.cpf = props.admin.cpf;
  form.email = props.admin.email;
  form.mobile_number = props.admin.mobile_number;
  form.profile_picture = props.admin.profile_picture;
});

const submit = (id) => {
  form.post(route("updateAdmin", id));
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
    <h3 class="px-4 py-3">Editar dados de Administrador de Comunidade</h3>
    <form
      class="px-4 py-3"
      @submit.prevent="submit(admin.id)"
      enctype="multipart/form-data"
    >
      <div class="row">
        <div class="mb-3 form-group">
          <label for="community_id"
            >Comunidade: {{ admin.community.community }}</label
          >
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <label for="profile_picture">Foto de Perfil Atual:</label>

        <div class="profile-pic mb-3">
          <img
            v-if="props.admin.profile_picture"
            :src="`/storage/${props.admin.profile_picture}`"
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
            
          />
        </div>
        <div class="col form-group">
          <label for="surname">Sobrenome:</label>
          <input
            type="text"
            class="form-control"
            v-model="form.surname"
            
          />
        </div>
      </div>
      <div class="mb-3 form-group">
        <label for="cpf">CPF:</label>
        <input type="text" class="form-control" v-model="form.cpf"  />
      </div>

      <div class="mb-3 form-group">
        <label for="email">E-mail:</label>
        <input
          type="email"
          class="form-control"
          v-model="form.email"
          
        />
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
        <label for="password">Senha:</label>
        <input
          type="password"
          class="form-control"
          v-model="form.password"
          
        />
      </div>

      <div class="">
        <button class="btn btn-primary" type="submit">Editar Administrador</button>
      </div>
    </form>
  </div>
</template>
