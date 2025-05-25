<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { router } from "@inertiajs/vue3";
import "@css/updateUser.css";
import "@css/usersDashboard.css";

defineOptions({ layout: MainLayout });

const props = defineProps({
    user: Object
})

const navigation = {
  updateUser: (id) =>router.visit(route('redirectUpdatePersonalInformation', id)),
  updateUserAddress: (id) =>router.visit(route('redirectUpdateUserAddress', id)),
  updateUserHousingProfile: (id) => router.visit(route('redirectUpdateUserHousingProfile', id)),
};
</script>

<template> 
    <div class="update-user-component">
        <button class="btn btn-primary" @click="navigation.updateUser(user.id)" data-bs-dismiss="modal">
            Editar Informações Pessoais
        </button>
        <button class="btn btn-primary" @click="navigation.updateUserAddress(user.id)" data-bs-dismiss="modal">
            Editar Endereço
        </button>
        <button class="btn btn-primary" @click="navigation.updateUserHousingProfile(user.id)" data-bs-dismiss="modal">
            Editar Perfil de Moradia
        </button>
    </div>
</template>