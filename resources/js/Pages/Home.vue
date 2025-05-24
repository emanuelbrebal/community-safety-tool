<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { useForm } from "@inertiajs/vue3";

defineOptions({ layout: MainLayout });

defineProps({
  user: Object,
  publications: Object,
  publicationMedia: Object,
});

const form = useForm();

const redirectCreatePublication = () => {
  form.get(route("redirectCreatePublication"));
};
</script>

<template>
  <div class="container publication mb-3 d-grid justify-content-center">
    <h4>Conte a todos o que está acontecendo!</h4>
    <button class="btn btn-success me-2" @click="redirectCreatePublication">
      Criar Publicação
    </button>
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
    <div
      v-if="publication.media"
      class="publication-content media-content d-flex justify-content-center mb-3"
    >
      <img
        v-if="publication.media"
        :src="`/storage/${publication.media.path}`"
        alt="Imagem da ocorrência"
        class="img-fluid rounded media"
      />
    </div>
    <div class="mb-3 content" id="publication_address">
      <div class="row">
        <div class="col-md-8">
          <span class="address">
            Logradouro do ocorrido:
            {{ publication.address.public_place }}
          </span>
        </div>
        <div class="col-md-4">
          <span class="address">
            Número:
            {{ publication.address.number }}
          </span>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <span class="address">
            Ponto de referência:
            {{ publication.address.complement }}
          </span>
        </div>
      </div>

      <div class="row">
        <div class="col-md-2 address">
          <span class="address">
            {{
              new Date(publication.incident_time).toLocaleTimeString("pt-BR", {
                hour: "2-digit",
                minute: "2-digit",
              })
            }}
          </span>
        </div>

        <div class="col-md-2">
          <span class="address">
            {{ new Date(publication.incident_date).toLocaleDateString("pt-BR") }}
          </span>
        </div>
      </div>
    </div>
    <div class="mb-3 content">
      {{ publication.message }}
    </div>
    <div class="buttons">
      <div class="row justify-content-between">
        <div class="col-md-2 fit-content">
          <button class="btn btn-secondary margin-buttons">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
            >
              <path
                fill="currentColor"
                d="m16.157 3.802l.686.406c2.029 1.202 3.043 1.803 3.6 2.792c.557.99.557 2.19.557 4.594v.812c0 2.403 0 3.605-.557 4.594s-1.571 1.59-3.6 2.791l-.686.407C14.128 21.399 13.114 22 12 22s-2.128-.6-4.157-1.802l-.686-.407c-2.029-1.2-3.043-1.802-3.6-2.791C3 16.01 3 14.81 3 12.406v-.812C3 9.19 3 7.989 3.557 7s1.571-1.59 3.6-2.792l.686-.406C9.872 2.601 10.886 2 12 2s2.128.6 4.157 1.802"
                opacity="0.5"
              />
              <path
                fill="currentColor"
                d="M12 6.25a.75.75 0 0 1 .75.75v6a.75.75 0 0 1-1.5 0V7a.75.75 0 0 1 .75-.75M12 17a1 1 0 1 0 0-2a1 1 0 0 0 0 2"
              />
            </svg>
            contador
          </button>

          <button class="btn btn-secondary">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
            >
              <g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                <path
                  d="M4 3a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h1v2a1 1 0 0 0 1.707.707L9.414 13H15a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1z"
                />
                <path
                  d="M8.023 17.215q.05-.046.098-.094L10.243 15H15a3 3 0 0 0 3-3V8h2a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-1v2a1 1 0 0 1-1.707.707L14.586 18H9a1 1 0 0 1-.977-.785"
                />
              </g>
            </svg>
            Comentar
          </button>
        </div>

        <div class="col-md-2 d-flex justify-content-end">
          <button class="btn btn-secondary">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
            >
              <path
                fill="currentColor"
                d="m21 12l-7-7v4C7 10 4 15 3 20c2.5-3.5 6-5.1 11-5.1V19z"
              />
            </svg>
            Compartilhar
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
