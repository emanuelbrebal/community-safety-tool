<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";

defineOptions({ layout: MainLayout });

const props = defineProps({
  incidents: Array,
  urgencies: Array,
  publication: Object,
  publication_address: Object,
  publication_media: Object,
});

const form = useForm({
  title: "",
  message: "",
  anonymous: "",
  public_place: "",
  number: "",
  complement: "",
  image: null,
  incident_time: "",
  incident_date: "",
});

onMounted(() => {
  form.title = props.publication.title;
  form.message = props.publication.message;
  form.anonymous = props.publication.anonymous;
  form.public_place = props.publication_address.public_place;
  form.number = props.publication_address.number;
  form.complement = props.publication_address.complement;
  form.image = props.publication_media;
  form.incident_date = props.publication.incident_date;
  form.incident_time = props.publication.incident_time;
});


const submit = (id) => {
  form.post(route("updatePublication", id));
};

const imageUrl = ref(null);
function handleFileUpload(event) {
  const file = event.target.files[0];
  if (file && file.type.startsWith("image/")) {
    form.image = file;
    imageUrl.value = URL.createObjectURL(file);
  }
}
</script>

<template>
  <div class="">
    <form
      class="px-4 py-3"
      @submit="submit(publication.id)"
      enctype="multipart/form-data"
    >
      <div class="row mb-3">
        <h3>Edição da publicação</h3>
        <div class="col-md-4">
          <label for="title">Título da publicação:</label>
          <input type="text" class="form-control" v-model="form.title" />
        </div>
        <div class="col-md-4">
          <label for="incident">Tipo do Ocorrido:</label>
          <p>{{ publication.incident.incident }}</p>
        </div>

        <div class="col-md-2">
          <label for="urgency">Urgência:</label>
          <p>{{ publication.urgency.urgency }}</p>
        </div>
      </div>
      <div class="mb-3 row">
        <div class="col-md-4">
          <label for="image">Tem imagens?</label>
          <input
            type="file"
            class="form-control"
            accept="image/png, image/jpeg, image/jpg"
            @change="handleFileUpload"
          />
        </div>
        <div class="col-md-8 media-show">
          <img
            v-if="props.publication.media"
            :src="`/storage/${props.publication.media.path}`"
            alt="Foto de perfil do autor da publicação"
            class="img-fluid media-preview-update"
          />
          <img
            v-else
            src="/public/storage/img/profile-picture-placeholder.png"
            alt="Foto de perfil padrão"
            class="img-fluid media-preview-update"
          />
        </div>
      </div>

      <div class="col">
        <label for="message">O que aconteceu?</label>
        <textarea
          rows="5"
          class="form-control"
          v-model="form.message"
        ></textarea>
      </div>

      <hr />
      <div class="row mb-3">
        <h3>Onde aconteceu?</h3>
        <div class="col">
          <label for="public_place">Logradouro do ocorrido</label>
          <input type="text" class="form-control" v-model="form.public_place" />
        </div>
        <div class="col-md-2">
          <label for="number">Número</label>
          <input type="text" class="form-control" v-model="form.number" />
        </div>
      </div>
      <div class="mb-3">
        <label for="complement">Ponto de referência</label>
        <input type="text" class="form-control" v-model="form.complement" />
      </div>

      <div class="mb-3 row">
        <div class="col-md-2">
          <label for="incident_date">Data do ocorrido</label>
          <input
            type="date"
            class="form-control"
            v-model="form.incident_date"
          />
        </div>
        <div class="col-md-2">
          <label for="incident_time">Hora do ocorrido</label>
          <input
            type="time"
            class="form-control"
            v-model="form.incident_time"
          />
        </div>
      </div>

      <div class="col">
        <br />
        <label for="anonymous">Deseja que sua publicação seja anônima?</label>
        <input
          type="checkbox"
          class="form-check-input"
          v-model="form.anonymous"
        />
      </div>
      <div class="d-grid gap-2 d-md-flex justify-content-md-center">
        <button class="btn btn-success" type="submit">Publicar</button>
      </div>
    </form>
  </div>
</template>
