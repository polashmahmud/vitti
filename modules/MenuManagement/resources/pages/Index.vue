<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
    },
    {
        title: 'Menu Management',
        href: '/menu-management',
    }
];
</script>

<template>

    <Head title="Menu Management" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <!-- Content goes here -->
        </div>
    </AppLayout>
</template>
