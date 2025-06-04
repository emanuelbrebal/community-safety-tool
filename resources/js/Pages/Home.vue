<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";

defineOptions({ layout: MainLayout });

const props = defineProps({
  user: Object,
  user_id: Number,
  admin: Object, 
  admin_community_id: Number,
  publications: Array,
  publicationMedia: Object,
  community: String
});

const form = useForm();

const redirectCreatePublication = () => {
  form.get(window.route("redirectCreatePublication"));
};

const navigation = {
  redirectUpdatePublication: (id) =>
    router.visit(window.route("redirectUpdatePublication", id)),
  deactivatePublication: (id) =>
    form.post(window.route("deactivatePublication", id)),
  reactivatePublication: (id) =>
    form.post(window.route("reactivatePublication", id)),
};
</script>

<template>
  <div class="container publication mb-3 d-grid justify-content-center">
    <h4>Conte a todos o que está acontecendo em {{ props.community }}</h4>
    <button
      class="btn btn-success me-2 btn-publicate"
      @click="redirectCreatePublication"
    >
      Criar Publicação
    </button>
  </div>

  <div
    class="container publication mb-3 d-grid justify-content-center"
    v-if="props.publications.length === 0"
  >
    <h3>A comunidade está segura! Bom trabalho!</h3>
  </div>

  <div
    class="container publication mb-3"
    v-for="publication in publications"
    :key="publication.id"
  >
    <div class="user-infos row mb-5">
      <div class="d-flex justify-content-between" id="author-content">
        <div class="profile-pic">
          <img
            v-if="!publication.anonymous"
            :src="`/storage/${publication.user.profile_picture}`"
            alt="Foto de perfil do autor da publicação"
            class="img-fluid author-profile-picture"
          />
          <img
            v-if="publication.anonymous"
            :src="`/storage/img/profile-picture-placeholder.png`"
            alt="Foto de perfil do autor da publicação"
            class="img-fluid author-profile-picture"
          />

          <div class="">
            Autor:
            {{
              publication.anonymous
                ? "Anônimo"
                : publication.user?.first_name ?? "Anônimo"
            }}

            <br />

            Endereço do Autor:
            {{
              publication.anonymous
                ? "Não identificado"
                : publication.address.public_place +
                  ", " +
                  publication.address.number
            }}
          </div>
        </div>

        <div class="">
          <div>
            <div class="d-flex justify-content-between publication-date">
              Data de publicação:
              {{ new Date(publication.created_at).toLocaleDateString("pt-BR") }}
              <button
                class="button-three-dots"
                data-bs-toggle="modal"
                :data-bs-target="'#modal_options_' + publication.id"
                @click.prevent
                v-if="publication.user_id == user_id || publication.community_id == admin_community_id"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="20"
                  height="20"
                  viewBox="0 0 20 20"
                >
                  <path
                    fill="currentColor"
                    d="M10.001 7.8a2.2 2.2 0 1 0 0 4.402A2.2 2.2 0 0 0 10 7.8zm0-2.6A2.2 2.2 0 1 0 9.999.8a2.2 2.2 0 0 0 .002 4.4m0 9.6a2.2 2.2 0 1 0 0 4.402a2.2 2.2 0 0 0 0-4.402"
                  />
                </svg>
              </button>

              <div
                class="modal fade"
                :id="'modal_options_' + publication.id"
                tabindex="-1"
                :aria-labelledby="'modal_options_' + publication.id"
                aria-hidden="true"
              >
                <div class="modal-dialog">
                  <div class="modal-content modal-update-users">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5">
                        Opções da publicação: {{ publication.title }}
                      </h1>
                    </div>
                    <div class="modal-body modal-options-publication">
                      <button
                        type="button"
                        class="btn btn-primary"
                        @click="
                          navigation.redirectUpdatePublication(publication.id)
                        "
                        data-bs-dismiss="modal"
                      >
                        Editar Publicação
                      </button>
                      <div v-if="publication.active">
                        <form>
                          <button
                            type="button"
                            class="btn btn-danger"
                            @click="
                              navigation.deactivatePublication(publication.id)
                            "
                            data-bs-dismiss="modal"
                          >
                            Desativar Publicação
                          </button>
                        </form>
                      </div>
                      <div v-if="!publication.active">
                        <form>
                          <button
                            type="button"
                            class="btn btn-success"
                            @click="
                              navigation.reactivatePublication(publication.id)
                            "
                            data-bs-dismiss="modal"
                          >
                            Reativar Publicação
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div>
              Hora de publicação:
              {{
                new Date(publication.created_at).toLocaleTimeString("pt-BR", {
                  hour: "2-digit",
                  minute: "2-digit",
                })
              }}
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="publication-content">
      <div class="row mb-3">
        <div class="col-md-8">
          Título:
          {{ publication.title }}
        </div>

        <div class="col-md-4">
          <div class="row urgency-box">
            Ocorrido: {{ publication.incident.incident }}
            <div class="urgency" :class="publication.urgency.color">
              Urgência:
              {{ publication.urgency.urgency }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-if="publication.media && publication.media.length">
      <div class="mb-3 media-content"
      >
        <img 
        v-for="(media, index) in publication.media"
        :key="index"
          :src="`/storage/${media.path}`"
          alt="Imagem da publicação"
          class="img-fluid media-preview"
        />
      </div>
    </div>

    <div
      v-if="publication.address"
      class="mb-3 content"
      id="publication_address"
    >
      <div class="row">
        <div class="col-md-8">
          Logradouro do ocorrido:
          {{ publication.address.public_place }}
        </div>
        <div class="col-md-4">
          Número:
          {{ publication.address.number }}
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          Ponto de referência:
          {{ publication.address.complement }}
        </div>
      </div>
      <div class="col-md-12">
        <span>Quando aconteceu?</span>
        No dia:
          {{ new Date(publication.incident_date).toLocaleDateString("pt-BR") }},
        na hora:
          {{ publication.incident_time }}
       

      </div>
    </div>
    <div class="mb-3 content">
      {{ publication.message }}
    </div>
  </div>
</template>
