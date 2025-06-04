<script setup>
import LoginLayout from "@/Layouts/LoginLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import AddressRegister from "@/Pages/Registers/AddressRegister.vue";
import PersonalRegister from "@/Pages/Registers/PersonalRegister.vue";


defineOptions({ layout: LoginLayout });

const props = defineProps({
  genders: Object,
  communities: Object,
  housing_profile_questions: Object,
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
  public_place: "",
  number: "",
  complement: "",
  zip_code: "",
  district: "",
  municipality: "",
  state: "",
  housing_questions: {},
  profile_picture: null,
});

Object.values(props.housing_profile_questions).forEach((questions) => {
  questions.forEach((q) => {
    form.housing_questions[q.id] = null;
  });
});

const submit = () => {
  form.post(route("createRegister"));
};
const login = () => {
  form.get(route("redirectLoginUser"));
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
  <div class="painel-registro">
    <div class="painel-esquerdo-registro -usuario">
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

    <div class="col painel-direito-registro">
      <form class="px-4 py-3" @submit.prevent="submit" enctype="multipart/form-data">
        <PersonalRegister
          :genders="props.genders"
          v-model:form="form"
          v-model:handleFileUpload="handleFileUpload"
        />

        <AddressRegister
          :communities="props.communities"
          v-model:form="form"
        />

        <div class="row d-flex justify-content-center mt-4 mb-3">
          <button class="btn btn-register" type="submit">Cadastrar</button>
        </div>
        <div class="row">
             <p class="d-flex justify-content-end">Já possui uma conta?<a class="register-link" @click="login"> Faça login agora!</a></p>
         </div>
      </form>
    </div>
  </div>
</template>
