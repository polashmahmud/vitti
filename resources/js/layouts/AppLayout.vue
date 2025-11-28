<script setup lang="ts">
import AppSidebar from '@/components/common/AppSidebar.vue';
import Navbar from '@/components/common/Navbar.vue';
import SidebarProvider from '@/components/ui/sidebar/SidebarProvider.vue';

</script>

<template>
    <div class="flex">
        <SidebarProvider>
            <AppSidebar />
            <main class="w-full">
                <Navbar />
                <div class="px-4">
                    <slot />
                </div>
            </main>
        </SidebarProvider>
    </div>
</template>
