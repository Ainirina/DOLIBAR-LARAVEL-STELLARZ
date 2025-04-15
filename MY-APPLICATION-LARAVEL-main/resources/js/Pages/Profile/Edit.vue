<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: Boolean,
    status: String,
});
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl leading-tight">Profile</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <Card class="p-4 sm:p-8 shadow">
                    <template #title>Profile Information</template>
                    <template #content>
                        <UpdateProfileInformationForm
                            :must-verify-email="mustVerifyEmail"
                            :status="status"
                            class="max-w-xl"
                        />
                    </template>
                </Card>

                <Card class="p-4 sm:p-8 shadow">
                    <template #title>Update Password</template>
                    <template #content>
                        <UpdatePasswordForm class="max-w-xl" />
                    </template>
                </Card>

                <Card class="p-4 sm:p-8 shadow">
                    <template #title>Delete Account</template>
                    <template #content>
                        <DeleteUserForm class="max-w-xl" />
                    </template>
                </Card>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
