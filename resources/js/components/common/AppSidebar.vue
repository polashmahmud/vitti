<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Calendar, Home, Inbox, Search } from 'lucide-vue-next';
import { Sidebar, SidebarContent, SidebarFooter, SidebarGroup, SidebarGroupContent, SidebarGroupLabel, SidebarHeader, SidebarInset, SidebarMenu, SidebarMenuButton, SidebarMenuItem, SidebarProvider, SidebarRail, SidebarTrigger, } from '@/components/ui/sidebar'


const items = [
    {
        title: 'Home',
        href: '/',
        icon: Home
    },
    {
        title: 'Inbox',
        href: '#',
        icon: Inbox
    },
    {
        title: 'Calendar',
        href: '#',
        icon: Calendar
    },
    {
        title: 'Search',
        href: '#',
        icon: Search
    }
];
</script>

<template>
    <Sidebar>
        <SidebarHeader>
        </SidebarHeader>
        <SidebarContent>
            <SidebarGroup>
                <SidebarGroupLabel>Application</SidebarGroupLabel>
                <SidebarGroupContent>
                    <SidebarMenu>
                        <SidebarMenuItem v-for="item in items" :key="item.title">
                            <SidebarMenuButton as-child>
                                <Link :href="item.href">
                                <component :is="item.icon" />
                                <span>{{ item.title }}</span>
                                </Link>
                            </SidebarMenuButton>
                        </SidebarMenuItem>
                    </SidebarMenu>
                </SidebarGroupContent>
            </SidebarGroup>
        </SidebarContent>
        <SidebarFooter></SidebarFooter>
    </Sidebar>
</template>
