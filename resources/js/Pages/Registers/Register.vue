<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

defineOptions({ layout: MainLayout });

const props = defineProps({
  genders: Object,
  communities: Object,
  housing_profile_questions: Object,
});


const form = useForm({
  first_name: '',
  surname: '',
  cpf: '',
  gender_id: '',
  email: '',
  mobile_number: '',
  born_date: '',
  password: '',
  community_id: '',
  public_place: '',
  number: '',
  complement: '',
  zip_code: '',
  district: '',
  municipality: '',
  state: '',
  housing_questions: {}, 
  profile_picture: null
});

Object.values(props.housing_profile_questions).forEach((questions) => {
  questions.forEach((q) => {
    form.housing_questions[q.id] = null;
  })
})

const submit = () =>{
  form.post(route('createRegister'));
};

const imageUrl = ref(null);
function handleFileUpload(event) {
    const file = event.target.files[0];
    if (file && file.type.startsWith('image/')) {
        form.profile_picture = file;
        imageUrl.value = URL.createObjectURL(file)
    }
}
</script>

<template>
  <div class="">
    <h3 class="px-4 py-3">Cadastro Pessoal</h3>
    <form class="px-4 py-3" @submit.prevent="submit" enctype="multipart/form-data">
      <div class="col-md-4 mb-3">
             <label for="profile_picture">Foto de Perfil</label>
             <input type="file" class="form-control" accept="image/png, image/jpeg, image/jpg"
             @change="handleFileUpload">
         </div>
      <div class="row mb-3">
        <div class="col form-group">
          <label for="first_name">Primeiro nome:</label>
          <input type="text" class="form-control" v-model="form.first_name" required />
        </div>
        <div class="col form-group">
          <label for="surname">Sobrenome:</label>
          <input type="text" class="form-control" v-model="form.surname" required />
        </div>
      </div>
      <div class="mb-3 form-group">
        <label for="cpf">CPF:</label>
        <input type="text" class="form-control" v-model="form.cpf" required />
      </div>
      <div class="mb-3 form-group">
        <label for="gender_id">Gênero:</label>
        <select v-model="form.gender_id" class="form-control" id="gender_id" required>
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
        <input type="email" class="form-control" v-model="form.email" required />
      </div>
      <div class="mb-3 form-group">
        <label for="mobile_number">Número de celular:</label>
        <input type="text" class="form-control" v-model="form.mobile_number" max="11" required />
      </div>
      <div class="mb-3 form-group">
        <label for="born_date">Data de nascimento:</label>
        <input type="date" class="form-control" v-model="form.born_date" required />
      </div>
      <div class="mb-3 form-group">
        <label for="password">Senha:</label>
        <input type="password" class="form-control" v-model="form.password" required />
      </div>

      <hr />
      <h3 class="px-4 py-3">Cadastro de Endereço</h3>
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

        <div class="form-group row mb-3">
          <div class="col form-group">
            <label for="public_place">Logradouro:</label>
            <input
              type="text"
              class="form-control"
              v-model="form.public_place"
              required
            />
          </div>
          <div class="col form-group">
            <label for="number">Número:</label>
            <input type="text" class="form-control" v-model="form.number" required />
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
            <input
              type="text"
              class="form-control"
              v-model="form.zip_code"
              required
            />
          </div>
          <div class="col form-group">
            <label for="district">Bairro:</label>
            <input type="text" class="form-control" v-model="form.district" required />
          </div>
        </div>

        <div class="form-group row mb-3">
          <div class="col form-group">
            <label for="municipality">Município:</label>
            <input
              type="text"
              class="form-control"
              v-model="form.municipality"
              required
            />
          </div>
          <div class="col form-group">
            <label for="state">Estado:</label>
            <input type="text" class="form-control" v-model="form.state" required />
          </div>
        </div>

        <hr />
        <h3 class="px-4 py-3">Perfil de Moradia</h3>
      
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
                value= true
                v-model="form.housing_questions[question.id]"              
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
                value=false
                v-model="form.housing_questions[question.id]"
                
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
      <div class="">
        <button class="btn btn-primary" type="submit">
          Cadastrar
        </button>
      </div>
    </form>
  </div>
</template>
