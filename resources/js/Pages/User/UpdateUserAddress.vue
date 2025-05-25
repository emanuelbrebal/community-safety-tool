<script setup>
import { useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";
import MainLayout from "@/Layouts/MainLayout.vue";

defineOptions({ layout: MainLayout });

const props = defineProps({
  user: Object,
  address: Object,
  communities: Object,
});

const form = useForm({
  public_place: "",
  number: "",
  complement: "",
  zip_code: "",
  district: "",
  municipality: "",
  state: "",
});

onMounted(() => {
  form.community_id = props.address.community_id;
  form.public_place = props.address.public_place;
  form.number = props.address.number;
  form.complement = props.address.complement;
  form.zip_code = props.address.zip_code;
  form.district = props.address.district;
  form.municipality = props.address.municipality;
  form.state = props.address.state;
});

const submit = (id) => {
  form.post(route("updateUserAddress", id));
};
</script>

<template>
  <div>
    <h3 class="px-4 py-3">Cadastro de Endereço</h3>
    <form
      class="px-4 py-3"
      @submit.prevent="submit(user.id)"
      enctype="multipart/form-data"
    >
      <div class="row">
        <div class="mb-3 form-group">
          <label for="community_id">Comunidade: {{ address.community.community }}</label>
        </div>

        <div class="form-group row mb-3">
          <div class="col form-group">
            <label for="public_place">Logradouro:</label>
            <input
              type="text"
              class="form-control"
              v-model="form.public_place"
            />
          </div>
          <div class="col form-group">
            <label for="number">Número:</label>
            <input type="text" class="form-control" v-model="form.number" />
          </div>
        </div>

        <div class="form-group mb-3">
          <label for="complement">Complemento:</label>
          <textarea
            class="form-control"
            v-model="form.complement"
            id="complement"
            cols="30"
            rows="3"
          ></textarea>
        </div>

        <div class="form-group row mb-3">
          <div class="col form-group">
            <label for="zip_code">CEP:</label>
            <input type="text" class="form-control" v-model="form.zip_code" />
          </div>
          <div class="col form-group">
            <label for="district">Bairro:</label>
            <input type="text" class="form-control" v-model="form.district" />
          </div>
        </div>

        <div class="form-group row mb-3">
          <div class="col form-group">
            <label for="municipality">Município:</label>
            <input
              type="text"
              class="form-control"
              v-model="form.municipality"
            />
          </div>
          <div class="col form-group">
            <label for="state">Estado:</label>
            <input type="text" class="form-control" v-model="form.state" />
          </div>
        </div>
        <div class="d-flex justify-content-center">
          <button class="btn btn-primary" type="submit">Editar Endereço</button>
        </div>
      </div>
    </form>
  </div>
</template>
