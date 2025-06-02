<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { computed, watch, ref } from 'vue';

defineOptions({ layout: MainLayout });

const props = defineProps({
  incidents: Array,
  urgencies: Array,
});



const form = useForm({
  title: "",
  message: "",
  incident_id: "",
  urgency_id: "",
  anonymous: "",
  public_place: "",
  number: "",
  complement: "",
  image: null,
  incident_time: "",
  incident_date: ""
});

const submit = () => {
  form.post(route("createPublication")
  );
};

watch(() => form.incident_id, (newIncidentId => {
    const selectedIncident = props.incidents.find(i => i.id === newIncidentId);
    if(selectedIncident && selectedIncident.urgency){
        form.urgency_id = selectedIncident.urgency.id;
    }
    else {
        form.urgency_id = '';
    }  
}));

const selectedUrgencyName = computed(() => {
  const incident = props.incidents.find(i => i.id === form.incident_id);
  return incident?.urgency?.urgency || '';
});

const imageUrl = ref(null);
function handleFileUpload(event) {
    const file = event.target.files[0];
    if (file && file.type.startsWith('image/')) {
        form.image = file;
        imageUrl.value = URL.createObjectURL(file)
    }
}
</script>

<template>
  <div class="">
    <form class="px-4 py-3" @submit.prevent="submit" enctype="multipart/form-data">
      <div class="row mb-3">
        <h3>Conte a todos o que aconteceu!</h3>
        <div class="col-md-4">
            <label for="first_name">Título da publicação:</label>
            <input type="text" class="form-control" v-model="form.title" required />
        </div>
      </div>
      <div class="mb-3 row">
          <div class="col-md-4">
             <label for="image">Tem imagens?</label>
             <input type="file" class="form-control" accept="image/png, image/jpeg, image/jpg"
             @change="handleFileUpload">
         </div>
        <div class="col-md-4">
            <label for="cpf">Tipo do Ocorrido:</label>
            <select class="form-select" v-model="form.incident_id" id="incident_id">
                <option disabled value="">Selecione...</option>
                <option :value="incident.id" v-for="incident in incidents" :key="incident.id">
                    {{ incident.incident }}
                </option>
            </select>
        </div>
        
        <div class="col-md-2">
            <label for="email">Urgência:</label>
            <input type="text" class="form-control" :value="selectedUrgencyName" disabled>
        </div>
        </div>
        <div class="col">
            <label for="email">O que aconteceu?</label>
            <textarea rows="5" class="form-control" v-model="form.message"></textarea>
        </div>

      <hr />
        <div class="row mb-3">
            <h3>Onde aconteceu?</h3>
            <div class="col">
                <label for="public_place">Logradouro do ocorrido</label>
                <input type="text" class="form-control" v-model="form.public_place" required />
            </div>
            <div class="col-md-2">
                <label for="public_place">Número</label>
                <input type="text" class="form-control" v-model="form.number" required />
            </div>
        </div>
        <div class="mb-3">
            <label for="public_place">Ponto de referência</label>
            <input type="text" class="form-control" v-model="form.complement" required />
        </div>
    
        <div class="mb-3 row">
            <div class="col-md-2">
                <label for="public_place">Data do ocorrido</label>
                <input type="date" class="form-control" v-model="form.incident_date" required />
            </div>
            <div class="col-md-2">
                <label for="public_place">Hora do ocorrido</label>
                <input type="time" class="form-control" v-model="form.incident_time" required />
            </div>
        </div>

        <div class="col">
            <br>
            <label for="anonymous">Deseja que sua publicação seja anônima?</label>
            <input type="checkbox" class="form-check-input" v-model="form.anonymous"/>
        </div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
        <button class="btn btn-success" type="submit">
            Publicar
        </button>
    </div>
    </form>
  </div>
</template>
