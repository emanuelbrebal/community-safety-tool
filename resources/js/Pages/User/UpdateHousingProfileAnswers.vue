<script setup>
import { useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";
import MainLayout from "@/Layouts/MainLayout.vue";

defineOptions({ layout: MainLayout });

const props = defineProps({
  user_id: Number,
  housing_profile_answers: Object,
  housing_profile_questions: Object,
});

onMounted(() => {
  Object.values(props.housing_profile_questions).forEach((questions) => {
    questions.forEach((q) => {
      form.housing_questions[q.id] = null;
    });
  });

  Object.entries(props.housing_profile_answers).forEach(
    ([questionId, answer]) => {
      form.housing_questions[Number(questionId)] = answer;
    }
  );
});

const form = useForm({
  housing_questions: {},
});

const submit = (id) => {
  form.post(route("updateUserHousingProfileAnswers", id));
};
</script>

<template>
  <div>
    <h3 class="px-4 py-3">Editar Perfil de Moradia</h3>
    <form>
      <div class="grid-profile">
        <div
          v-for="(questions, sectionTitle) in housing_profile_questions"
          :key="sectionTitle"
        >
          <h4 class="mt-4">
            {{ questions[0].section_id + ". " + sectionTitle }}
          </h4>

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
                :value="true"
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
                :value="false"
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
      <div class="d-flex justify-content-center">
        <button type="button" class="btn btn-primary" @click="submit(user_id)">
          Editar Perfil de Moradia
        </button>
      </div>
    </form>
  </div>
</template>
