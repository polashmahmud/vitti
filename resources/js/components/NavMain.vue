<script setup lang="ts">
import {
    SidebarGroup,
    SidebarGroupLabel,
    SidebarMenu,
} from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import NavMenuItem from '@/components/NavMenuItem.vue';

defineProps<{
    items: NavItem[];
}>();
</script>

<template>
    <SidebarGroup class="px-2 py-0">
        <SidebarGroupLabel>Platform</SidebarGroupLabel>
        <SidebarMenu>
            <NavMenuItem v-for="item in items" :key="item.title" :item="item" :level="0" />
        </SidebarMenu>
    </SidebarGroup>
</template>
