<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem, } from '@/components/ui/sidebar';
import { dashboard } from '@/routes';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { BookOpen, Folder, LayoutGrid, Menu, SquareTerminal } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
        isActive: true,
    },
    {
        title: 'Projects',
        href: '#',
        icon: SquareTerminal,
        items: [
            {
                title: 'All Projects',
                href: '#',
            },
            {
                title: 'Development',
                href: '#',
                items: [
                    {
                        title: 'Frontend',
                        href: '#',
                        items: [
                            {
                                title: 'React',
                                href: '#',
                            },
                            {
                                title: 'Vue',
                                href: '#',
                            },
                        ],
                    },
                    {
                        title: 'Backend',
                        href: '#',
                        items: [
                            {
                                title: 'Laravel',
                                href: '#',
                            },
                            {
                                title: 'Node.js',
                                href: '#',
                            },
                        ],
                    },
                ],
            },
            {
                title: 'Archived',
                href: '#',
            },
        ],
    },
    {
        title: 'Menu Management',
        href: '/menu-management',
        icon: Menu,
    },
];

const footerNavItems: NavItem[] = [
    {
        title: 'Github Repo',
        href: 'https://github.com/laravel/vue-starter-kit',
        icon: Folder,
    },
    {
        title: 'Documentation',
        href: 'https://laravel.com/docs/starter-kits#vue',
        icon: BookOpen,
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                        <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
