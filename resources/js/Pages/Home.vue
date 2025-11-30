<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
</script>

<template>

    <Head title="Home" />
    <AppLayout>
        <div class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-4 gap-4">
            <div class="bg-primary-foreground p-4 rounded-lg lg:col-span-2 xl:col-span-1 2xl:col-span-2">1</div>
            <div class="bg-primary-foreground p-4 rounded-lg">2</div>
            <div class="bg-primary-foreground p-4 rounded-lg">3</div>
            <div class="bg-primary-foreground p-4 rounded-lg">4</div>
            <div class="bg-primary-foreground p-4 rounded-lg lg:col-span-2 xl:col-span-1 2xl:col-span-2">5</div>
            <div class="bg-primary-foreground p-4 rounded-lg">6</div>
        </div>
    </AppLayout>
</template>
