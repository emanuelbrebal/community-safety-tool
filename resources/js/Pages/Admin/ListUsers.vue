
<script setup>
import MainLayout from "@l/MainLayout.vue";
import "@css/usersDashboard.css"

defineOptions({ layout: MainLayout });

defineProps({ 
  users: Array,
  answers: Array
});

</script>

<template>
  <div class="container">
    <h2 class="text-xl font-semibold mb-4">Listagem de usuários</h2>

    <table class="table">
      <thead>
        <tr>
          <th scope="col">Nome</th>
          <th scope="col">Endereço</th>
          <th scope="col">Perfil de Moradia</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" :key="user.id">
          <td>{{ user.first_name }}</td>
          <td>
            <button
              class="btn btn-info"
              data-bs-toggle="modal"
              :data-bs-target="'#modal_address_' + user.id"
              @click.prevent
            >
              Ver <span id="addressSpan"> Endereço</span>
            </button>

            <!-- modal -->
            <div
              class="modal fade"
              :id="'modal_address_' + user.id"
              tabindex="-1"
              :aria-labelledby="'label_modal_address_' + user.id"
              aria-hidden="true"
            >
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" :id="'label_modal_address_' + user.id">
                      Endereço de {{ user.first_name }}
                    </h1>
                    <button
                      type="button"
                      class="btn-close"
                      data-bs-dismiss="modal"
                      aria-label="Close"
                    ></button>
                  </div>
                  <div class="modal-body">
                    <p><strong>CEP:</strong> {{ user.address?.zip_code || 'Não informado' }}</p>
                    <p><strong>Rua:</strong> {{ user.address?.public_place || 'Não informado' }}</p>
                    <p><strong>Número:</strong> {{ user.address?.number || 'Não informado' }}</p>
                    <p><strong>Bairro:</strong> {{ user.address?.district || 'Não informado' }}</p>
                    <p><strong>Município:</strong> {{ user.address?.municipality || 'Não informado' }}</p>
                    <p><strong>Estado:</strong> {{ user.address?.state || 'Não informado' }}</p>
                    <p><strong>Comunidade:</strong> {{ user.address?.community?.community || 'Não informado' }}</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                      Fechar
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </td>

          <td>
            <button
              class="btn btn-info"
              data-bs-toggle="modal"
              :data-bs-target="'#modal_housing_profile_' + user.id"
            >
              Ver <span id="housingProfileSpan"> Perfil de Moradia</span>
            </button>

            <!-- modal -->
            <div
              class="modal fade"
              :id="'modal_housing_profile_' + user.id"
              tabindex="-1"
              :aria-labelledby="'label_modal_housing_profile_' + user.id"
              aria-hidden="true"
            >
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" :id="'label_modal_housing_profile_' + user.id">
                      Perfil de Moradia de {{ user.first_name }}
                    </h1>
                    <button
                      type="button"
                      class="btn-close"
                      data-bs-dismiss="modal"
                      aria-label="Close"
                    ></button>
                  </div>
                  <div class="modal-body">
                    <div v-for="answer in answers.filter(a => a.user_id === user.id)" :key="answer.id">
                      <h5 v-if="answer.question?.section_id">{{ answer.question.section_id.section_title }}</h5>
                      <p>{{ answer.question.id }}. {{ answer.question.question }}</p>
                      <p> Resposta: <strong>{{ answer.check? 'Sim' : 'Não' }}.</strong></p>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                      Fechar
                    </button>
                  </div>
                </div>
              </div>
            </div>

          </td>
          <td>
            <div class="organiza_btns">
              <button class="btn btn-primary">Editar</button>
              <button class="btn btn-danger">Excluir</button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
