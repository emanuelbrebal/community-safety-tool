<script setup>

</script>
<template>
  <h3 class="px-4 py-3">Perfil de Moradia</h3>

  <div
    v-for="(questions, sectionTitle) in props.housing_profile_questions"
    :key="sectionTitle"
  >
    <h4 class="mt-4">{{ questions[0].section_id + ". " + sectionTitle }}</h4>

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
          value="true"
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
          value="false"
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
</template>
