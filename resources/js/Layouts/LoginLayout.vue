<script setup>
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import { useForm } from '@inertiajs/vue3';
import '@css/flashMessages.css';

const page = usePage();

const success = computed(() => page.props.flash?.success || null);
const error = computed(() => page.props.flash?.error || null);

defineEmits(['register', 'list']);

const form = useForm();

</script>

<template>
    <main class="main-bg">
      <div v-if="success" class="alert alert-success" role="alert">
        {{ success }}
      </div>
      <div v-if="error" class="alert alert-danger" role="alert">
        {{ error }}
      </div>

      <div class="container">
        <slot />
      </div>
    </main>

</template>
