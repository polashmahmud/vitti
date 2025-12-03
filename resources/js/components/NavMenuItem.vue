<script setup lang="ts">
import {
    SidebarMenuButton,
    SidebarMenuItem,
    SidebarMenuSub,
    SidebarMenuSubButton,
    SidebarMenuSubItem,
} from '@/components/ui/sidebar';
import {
    Collapsible,
    CollapsibleContent,
    CollapsibleTrigger,
} from '@/components/ui/collapsible';
import { urlIsActive } from '@/lib/utils';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { ChevronRight } from 'lucide-vue-next';

defineProps<{
    item: NavItem;
    level?: number;
}>();

const page = usePage();
</script>

<template>
    <Collapsible as-child :default-open="item.isActive" class="group/collapsible">
        <SidebarMenuItem>
            <!-- Menu with children -->
            <CollapsibleTrigger v-if="item.items" as-child>
                <SidebarMenuButton :tooltip="item.title">
                    <component :is="item.icon" v-if="item.icon" />
                    <span>{{ item.title }}</span>
                    <ChevronRight
                        class="ml-auto transition-transform duration-200 group-data-[state=open]/collapsible:rotate-90" />
                </SidebarMenuButton>
            </CollapsibleTrigger>

            <!-- Menu without children -->
            <SidebarMenuSubButton v-else-if="level && level > 0" as-child :is-active="urlIsActive(item.href, page.url)">
                <Link :href="item.href">
                <component :is="item.icon" v-if="item.icon" />
                <span>{{ item.title }}</span>
                </Link>
            </SidebarMenuSubButton>

            <SidebarMenuButton v-else as-child :is-active="urlIsActive(item.href, page.url)" :tooltip="item.title">
                <Link :href="item.href">
                <component :is="item.icon" v-if="item.icon" />
                <span>{{ item.title }}</span>
                </Link>
            </SidebarMenuButton>

            <!-- Recursive nested items -->
            <CollapsibleContent v-if="item.items">
                <SidebarMenuSub>
                    <SidebarMenuSubItem v-for="subItem in item.items" :key="subItem.title">
                        <!-- Recursive call for nested items -->
                        <NavMenuItem v-if="subItem.items" :item="subItem" :level="(level || 0) + 1" />
                        <!-- Leaf node -->
                        <SidebarMenuSubButton v-else as-child :is-active="urlIsActive(subItem.href, page.url)">
                            <Link :href="subItem.href">
                            <span>{{ subItem.title }}</span>
                            </Link>
                        </SidebarMenuSubButton>
                    </SidebarMenuSubItem>
                </SidebarMenuSub>
            </CollapsibleContent>
        </SidebarMenuItem>
    </Collapsible>
</template>
