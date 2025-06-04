<script setup>
const props = defineProps({
  communities: Object,
});

const form = defineModel("form");
</script>

<template>
  <hr />
  <h3 class="px-4 py-3">
    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 20 20"><path fill="#212121" d="M9 0a9 9 0 1 0 0 18A9 9 0 0 0 9 0m3.46 11.95c0 1.47-.8 3.3-4.06 4.7c.3-4.17-2.52-3.69-3.2-5A3.25 3.25 0 0 1 7 9.1a8.5 8.5 0 0 1-4.18-2c.05.47.279.904.64 1.21a4.2 4.2 0 0 1-1.94-1.5a7.94 7.94 0 0 1 7.25-5.63c-.84 1.38-1.5 4.13 0 5.57C7.23 7 6.26 5 5.41 5.79c-1.13 1.06.33 2.51 3.42 3.08c3.29.59 3.66 1.58 3.63 3.08m1.34-4c-.32-1.11.62-2.23 1.69-3.14a7.27 7.27 0 0 1 .84 6.68c-.77-1.89-2.17-2.32-2.53-3.57z"/></svg>
    Cadastro de Endereço
  </h3>

  <div class="mb-3 row">
    <div class="col">
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
    <div class="col">
      <label for="zip_code">CEP:</label>
      <input
        type="text"
        class="form-control"
        id="zip_code"
        v-model="form.zip_code"
        required
      />
    </div>
  </div>

  <div class="mb-3 row">
    <div class="col">
      <label for="state">Estado:</label>
      <input
        type="text"
        class="form-control"
        id="state"
        v-model="form.state"
        required
      />
    </div>
    <div class="col">
      <label for="municipality">Município:</label>
      <input
        type="text"
        class="form-control"
        id="municipality"
        v-model="form.municipality"
        required
      />
    </div>
    <div class="col">
      <label for="district">Bairro:</label>
      <input
        type="text"
        class="form-control"
        id="district"
        v-model="form.district"
        required
      />
    </div>
  </div>

  <div class="mb-3 row">
    <div class="col">
      <label for="public_place">Logradouro:</label>
      <input
        type="text"
        class="form-control"
        id="public_place"
        v-model="form.public_place"
        required
      />
    </div>
    <div class="col">
      <label for="number">Número:</label>
      <input
        type="text"
        class="form-control"
        id="number"
        v-model="form.number"
        required
      />
    </div>
    <div class="col">
      <label for="complement">Complemento:</label>
      <input
        type="text"
        class="form-control"
        id="complement"
        v-model="form.complement"
      />
    </div>
  </div>
</template>
