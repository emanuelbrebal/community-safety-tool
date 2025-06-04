<script setup>

const props = defineProps({
  genders: Object,
});

const form = defineModel("form");
const handleFileUpload = defineModel("handleFileUpload");

function formatCPF(e) {
  let value = e.target.value.replace(/\D/g, '');
  if (value.length > 11) value = value.slice(0, 11);
  value = value.replace(/(\d{3})(\d)/, '$1.$2');
  value = value.replace(/(\d{3})(\d)/, '$1.$2');
  value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
  form.cpf = value;
  e.target.value = value;
}

function formatCellPhone(e) {
  let value = e.target.value.replace(/\D/g, '');
  if (value.length > 11) value = value.slice(0, 11);
  value = value.replace(/^(\d{2})(\d)/g, '($1) $2');
  value = value.replace(/(\d{5})(\d{1,4})$/, '$1-$2');
  form.mobile_number = value;
  e.target.value = value;
}

</script>

<template>
  <div class="personal-register">
    <h3 class="px-4 py-3">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        width="55"
        height="55"
        viewBox="0 0 24 24"
      >
        <path
          fill="#212121"
          d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4"
        />
      </svg>
      Cadastro Pessoal
    </h3>

    <div class="col-md-6 mb-3"></div>

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

    <div class="mb-3 form-group row">
      <div class="col">
        <label for="cpf">CPF:</label>
        <input
          id="cpf"
          type="text"
          class="form-control"
          v-model="form.cpf"
          @input="formatCPF"
          required
        />
      </div>

      <div class="col">
        <label for="gender_id">Sexo:</label>
        <select
          v-model="form.gender_id"
          class="form-control"
          id="gender_id"
          required
        >
          <option disabled value="">Selecione um sexo:</option>
          <option
            v-for="gender in props.genders"
            :key="gender.id"
            :value="gender.id"
          >
            {{ gender.gender }}
          </option>
        </select>
      </div>

      <div class="col">
        <label for="born_date">Data de nascimento:</label>
        <input
          type="date"
          class="form-control"
          v-model="form.born_date"
          required
        />
      </div>
    </div>

    <div class="mb-3 form-group row">
      <div class="col">
        <label for="email">E-mail:</label>
        <input
          type="email"
          class="form-control"
          v-model="form.email"
          required
        />
      </div>
      <div class="col">
        <label for="mobile_number">Número de celular:</label>
        <input
          type="text"
          class="form-control"
          v-model="form.mobile_number"
          required
          @input="formatCellPhone"
        />
      </div>
      <div class="col">
        <label for="profile_picture">Foto de Perfil</label>
        <input
          type="file"
          class="form-control"
          accept="image/png, image/jpeg, image/jpg"
          @change="handleFileUpload"
        />
      </div>
    </div>

    <div class="mb-3 col-md-4 form-group">
      <label for="password">Senha:</label>
      <input
        type="password"
        class="form-control"
        v-model="form.password"
        required
      />
    </div>
  </div>
</template>