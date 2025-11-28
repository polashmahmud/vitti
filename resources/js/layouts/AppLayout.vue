<script setup lang="ts">
import AppSidebar from '@/components/common/AppSidebar.vue';
import Navbar from '@/components/common/Navbar.vue';

</script>

<template>
    <div class="flex">
        <AppSidebar />
        <main class="w-full">
            <Navbar />
            <div class="px-4">
                <slot />
            </div>
        </main>
    </div>
</template>
