<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="sm:flex sm:justify-center sm:flex-col sm:items-center min-h-screen bg-[--Black] bg-center selection:bg-gray-300 selection:text-[#F4F4F4]">
        <div>
            <Link href="/">
                <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
            </Link>
        </div>

        <Card>
            <template #content>
                <div>
                    <slot />
                </div>
            </template>
        </Card>
    </div>
</template>
1
