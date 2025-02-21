<script lang="ts" setup>
import Modal from '@/Components/Modal.vue';
import { defineExpose, ref } from 'vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';

// Props still optional if you use them for verification or status.
defineProps<{
    mustVerifyEmail?: boolean;
    status?: string;
}>();

// Local state to track if Modal is visible
const showModal = ref(false);

// Methods to open/close the modal
function openModal() {
    showModal.value = true;
}

function closeModal() {
    showModal.value = false;
}

// Expose the openModal so the parent can call editProfile.value.openModal()
defineExpose({
    openModal,
});
</script>

<template>
    <!-- Use your existing Modal component.
         It expects :show and @close. -->
    <Modal :show="showModal" @close="closeModal">
        <!-- The Profile content you want displayed in the modal -->
        <div class="p-6">
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Profile
            </h2>

            <!-- Add your forms below, exactly as you had them -->
            <div class="mt-4 space-y-6">
                <!-- Update Profile Information -->
                <div class="bg-white p-4 shadow sm:rounded-lg dark:bg-gray-800">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    />
                </div>

                <!-- Update Password -->
                <div class="bg-white p-4 shadow sm:rounded-lg dark:bg-gray-800">
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <!-- Delete User Form -->
                <div class="bg-white p-4 shadow sm:rounded-lg dark:bg-gray-800">
                    <DeleteUserForm class="max-w-xl" />
                </div>
            </div>
        </div>
    </Modal>
</template>
