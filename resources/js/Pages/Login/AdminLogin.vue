<script setup>
import LoginLayout from "@/Layouts/LoginLayout.vue";
import { useForm } from "@inertiajs/vue3";

defineOptions({ layout: LoginLayout });

const form = useForm({
  cpf: "",
  password: "",
});

const submit = () => {
  form.post(route("adminLogin"));
};
</script>

<template> 
  <form @submit.prevent="submit">
    <h1>Login de Administrador</h1>
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
      <input type="password" class="form-control" id="password" name="password" v-model="form.password"/>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</template>