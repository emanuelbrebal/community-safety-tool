<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";

defineOptions({ layout: MainLayout });

const props = defineProps({
  genders: Array,
  communities: Array,
  housing_profile_questions: Array,
});
</script>

<template>
  <div class="">
    <h3 class="px-4 py-3">Cadastro Pessoal</h3>
    <form class="px-4 py-3" action="{{ route('createRegister') }}">
      <div class="row mb-3">
        <div class="col form-group">
          <label for="first_name">Primeiro nome:</label>
          <input type="text" class="form-control" name="first_name" required />
        </div>
        <div class="col form-group">
          <label for="first_name">Sobrenome:</label>
          <input type="text" class="form-control" name="surname" required />
        </div>
      </div>
      <div class="mb-3 form-group">
        <label for="first_name">CPF:</label>
        <input type="text" class="form-control" name="cpf" required />
      </div>
      <div class="mb-3 form-group">
        <label for="gender_id">Gênero:</label>
        <select name="gender_id" class="form-control" id="gender_id" required>
          <option disabled value="">Selecione um gênero:</option>
          <option
            v-for="gender in props.genders"
            :key="gender.id"
            :value="gender.id"
          >
            {{ gender.gender }}
          </option>
        </select>
      </div>
      <div class="mb-3 form-group">
        <label for="email">E-mail:</label>
        <input type="email" class="form-control" name="email" required />
      </div>
      <div class="mb-3 form-group">
        <label for="first_name">Número de celular:</label>
        <input type="text" class="form-control" name="mobile_number" required />
      </div>
      <div class="mb-3 form-group">
        <label for="first_name">Data de nascimento:</label>
        <input type="date" class="form-control" name="born_date" required />
      </div>
      <div class="mb-3 form-group">
        <label for="first_name">Senha:</label>
        <input type="password" class="form-control" name="password" required />
      </div>

      <hr />
      <h3 class="px-4 py-3">Cadastro de Endereço</h3>
      <div class="row">
        <!-- colocar o valor do address_id para salvar os dados de endereço do usuário ao submeter o formulário -->
        <input type="hidden" name="address_id" value="" />
        <div class="mb-3 form-group">
          <label for="community_id">Comunidade:</label>
          <select
            name="community_id"
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

        <div class="form-group row mb-3">
          <div class="col form-group">
            <label for="first_name">Logradouro:</label>
            <input
              type="text"
              class="form-control"
              name="first_name"
              required
            />
          </div>
          <div class="col form-group">
            <label for="first_name">Número:</label>
            <input type="text" class="form-control" name="surname" required />
          </div>
        </div>

        <div class="form-group mb-3">
          <label for="complement">Complemento:</label>
          <textarea
            class="form-control"
            name="complement"
            id="complement"
            cols="30"
            rows="3"
          ></textarea>
        </div>

        <div class="form-group row mb-3">
          <div class="col form-group">
            <label for="first_name">CEP:</label>
            <input
              type="text"
              class="form-control"
              name="first_name"
              required
            />
          </div>
          <div class="col form-group">
            <label for="first_name">Bairro:</label>
            <input type="text" class="form-control" name="surname" required />
          </div>
        </div>

        <div class="form-group row mb-3">
          <div class="col form-group">
            <label for="first_name">Cidade:</label>
            <input
              type="text"
              class="form-control"
              name="first_name"
              required
            />
          </div>
          <div class="col form-group">
            <label for="first_name">Estado:</label>
            <input type="text" class="form-control" name="surname" required />
          </div>
        </div>

        <hr />
        <h3 class="px-4 py-3">Perfil de Moradia</h3>
        <input type="hidden" name="address_id" value="" />

        <div
          v-for="(questions, sectionTitle) in props.housing_profile_questions"
          :key="sectionTitle"
        >
          <h4 class="mt-4">{{ questions[0].section_id + '. ' + sectionTitle }}</h4>

          <div
            class="mb-3 form-group"
            v-for="question in questions"
            :key="question.id"
          >
            <label :for="'question_' + question.id" class="form-label">
              {{ question.question }}
            </label>

            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                :id="'question_' + question.id + '_yes'"
                :name="'question_' + question.id"
                value="yes"
                v-model="question.checked"
              />
              <label
                class="form-check-label"
                :for="'question_' + question.id + '_yes'"
              >
                Sim
              </label>
            </div>

            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                :id="'question_' + question.id + '_no'"
                :name="'question_' + question.id"
                value="no"
                v-model="question.checked"
              />
              <label
                class="form-check-label"
                :for="'question_' + question.id + '_no'"
              >
                Não
              </label>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>
