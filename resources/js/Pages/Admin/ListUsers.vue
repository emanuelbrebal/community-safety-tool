
<script setup>
import AdminLayout from "@l/AdminLayout.vue";
import { useForm, router } from "@inertiajs/vue3";
import "@css/usersDashboard.css";
import UpdateUser from "../User/UpdateUser.vue";

defineOptions({ layout: AdminLayout });

defineProps({
  users: Array,
  answers: Array,
});

const form = useForm({
  id: "",
});

const navigation = {
  updateUser: (id) => router.visit(route("redirectUpdateUser", id)),
  banUser: (id) => form.post(route("banUser", id)),
  unbanUser: (id) => form.post(route("unbanUser", id)),
};
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
                    <h1
                      class="modal-title fs-5"
                      :id="'label_modal_address_' + user.id"
                    >
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
                    <p>
                      <strong>CEP:</strong>
                      {{ user.address?.zip_code || "Não informado" }}
                    </p>
                    <p>
                      <strong>Rua:</strong>
                      {{ user.address?.public_place || "Não informado" }}
                    </p>
                    <p>
                      <strong>Número:</strong>
                      {{ user.address?.number || "Não informado" }}
                    </p>
                    <p>
                      <strong>Bairro:</strong>
                      {{ user.address?.district || "Não informado" }}
                    </p>
                    <p>
                      <strong>Município:</strong>
                      {{ user.address?.municipality || "Não informado" }}
                    </p>
                    <p>
                      <strong>Estado:</strong>
                      {{ user.address?.state || "Não informado" }}
                    </p>
                    <p>
                      <strong>Comunidade:</strong>
                      {{
                        user.address?.community?.community || "Não informado"
                      }}
                    </p>
                  </div>
                  <div class="modal-footer">
                    <button
                      type="button"
                      class="btn btn-secondary"
                      data-bs-dismiss="modal"
                    >
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
                    <h1
                      class="modal-title fs-5"
                      :id="'label_modal_housing_profile_' + user.id"
                    >
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
                    <div
                      v-for="answer in answers.filter(
                        (a) => a.user_id === user.id
                      )"
                      :key="answer.id"
                    >
                      <h5 v-if="answer.question?.section_id">
                        {{ answer.question.section_id.section_title }}
                      </h5>
                      <p>
                        {{ answer.question.id }}. {{ answer.question.question }}
                      </p>
                      <p>
                        Resposta:
                        <strong>{{ answer.check ? "Sim" : "Não" }}.</strong>
                      </p>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button
                      type="button"
                      class="btn btn-secondary"
                      data-bs-dismiss="modal"
                    >
                      Fechar
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </td>
          <td>
            <div class="organiza_btns">
              <button
                class="btn btn-primary"
                data-bs-toggle="modal"
                :data-bs-target="'#modal_update_user_' + user.id"
              >
                Editar
              </button>
              <div
                class="modal fade"
                :id="'modal_update_user_' + user.id"
                tabindex="-1"
                :aria-labelledby="'label_modal_update_user_' + user.id"
                aria-hidden="true"
              >
                <div class="modal-dialog">
                  <div class="modal-content modal-update-users">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5">
                        Editar usuário: {{ user.first_name }}
                      </h1>
                    </div>
                    <UpdateUser 
                      :user = "user"
                    />
                  </div>
                </div>
              </div>
              <button
                class="btn"
                :class="user.active ? 'btn-danger' : 'btn-success'"
                data-bs-toggle="modal"
                :data-bs-target="'#modal_delete_user_' + user.id"
              >
                {{ user.active ? "Banir" : "Desbanir" }}
              </button>
              <div
                class="modal fade"
                :id="'modal_delete_user_' + user.id"
                tabindex="-1"
                :aria-labelledby="'label_modal_delete_user_' + user.id"
                aria-hidden="true"
              >
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5">
                        Banir usuário: {{ user.first_name }}
                      </h1>
                      <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                      ></button>
                    </div>
                    <div class="modal-body">
                      Tem certeza que deseja prosseguir com o banimento da conta
                      de <strong>{{ user.first_name }}</strong
                      >?
                    </div>
                    <div class="modal-footer">
                      <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                      >
                        Fechar
                      </button>
                      <div v-if="user.active">
                        <form>
                          <button
                            type="button"
                            class="btn btn-danger"
                            @click="navigation.banUser(user.id)"
                            data-bs-dismiss="modal"
                          >
                            Banir
                          </button>
                        </form>
                      </div>
                      <div v-if="!user.active">
                        <form>
                          <button
                            type="button"
                            class="btn btn-success"
                            @click="navigation.unbanUser(user.id)"
                            data-bs-dismiss="modal"
                          >
                            Desbanir
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
