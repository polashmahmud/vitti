<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Badge } from '@/components/ui/badge';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Switch } from '@/components/ui/switch';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm, router } from '@inertiajs/vue3';
import { ChevronRight, Edit, Plus, Trash2 } from 'lucide-vue-next';
import { ref, computed } from 'vue';

interface Menu {
    id: number;
    title: string;
    url: string | null;
    icon: string | null;
    order: number;
    is_active: boolean;
    children: Menu[];
}

interface Props {
    menuList: Menu[];
}

const props = defineProps<Props>();

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

const isCreateDialogOpen = ref(false);
const isEditDialogOpen = ref(false);
const editingMenu = ref<Menu | null>(null);

const form = useForm({
    parent_id: null as number | null,
    title: '',
    url: '',
    icon: '',
    order: 0,
    is_active: true,
});

const allMenus = computed(() => {
    const flattenMenus = (menus: Menu[], level = 0): any[] => {
        return menus.reduce((acc: any[], menu) => {
            acc.push({ ...menu, level });
            if (menu.children && menu.children.length > 0) {
                acc.push(...flattenMenus(menu.children, level + 1));
            }
            return acc;
        }, []);
    };
    return flattenMenus(props.menuList);
});

const openCreateDialog = () => {
    form.reset();
    isCreateDialogOpen.value = true;
};

const openEditDialog = (menu: Menu) => {
    editingMenu.value = menu;
    form.parent_id = menu.parent_id;
    form.title = menu.title;
    form.url = menu.url || '';
    form.icon = menu.icon || '';
    form.order = menu.order;
    form.is_active = menu.is_active;
    isEditDialogOpen.value = true;
};

const createMenu = () => {
    form.post('/menu-management', {
        onSuccess: () => {
            isCreateDialogOpen.value = false;
            form.reset();
        },
    });
};

const updateMenu = () => {
    if (!editingMenu.value) return;

    form.put(`/menu-management/${editingMenu.value.id}`, {
        onSuccess: () => {
            isEditDialogOpen.value = false;
            form.reset();
            editingMenu.value = null;
        },
    });
};

const deleteMenu = (id: number) => {
    if (confirm('Are you sure you want to delete this menu?')) {
        router.delete(`/menu-management/${id}`);
    }
};
</script>

<template>

    <Head title="Menu Management" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="space-y-6 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold tracking-tight">Menu Management</h2>
                    <p class="text-muted-foreground">Manage your application menus</p>
                </div>

                <Dialog v-model:open="isCreateDialogOpen">
                    <DialogTrigger as-child>
                        <Button @click="openCreateDialog">
                            <Plus class="mr-2 h-4 w-4" />
                            Create Menu
                        </Button>
                    </DialogTrigger>
                    <DialogContent class="sm:max-w-[525px]">
                        <DialogHeader>
                            <DialogTitle>Create Menu</DialogTitle>
                            <DialogDescription>
                                Add a new menu item to your application.
                            </DialogDescription>
                        </DialogHeader>
                        <div class="grid gap-4 py-4">
                            <div class="grid gap-2">
                                <Label for="title">Title</Label>
                                <Input id="title" v-model="form.title" placeholder="Dashboard" />
                            </div>
                            <div class="grid gap-2">
                                <Label for="url">URL</Label>
                                <Input id="url" v-model="form.url" placeholder="/dashboard" />
                            </div>
                            <div class="grid gap-2">
                                <Label for="icon">Icon</Label>
                                <Input id="icon" v-model="form.icon" placeholder="LayoutGrid" />
                            </div>
                            <div class="grid gap-2">
                                <Label for="parent">Parent Menu</Label>
                                <Select v-model="form.parent_id">
                                    <SelectTrigger>
                                        <SelectValue placeholder="None (Root Level)" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectItem :value="null">None (Root Level)</SelectItem>
                                        <SelectItem v-for="menu in allMenus" :key="menu.id" :value="menu.id">
                                            {{ '—'.repeat(menu.level) }} {{ menu.title }}
                                        </SelectItem>
                                    </SelectContent>
                                </Select>
                            </div>
                            <div class="grid gap-2">
                                <Label for="order">Order</Label>
                                <Input id="order" v-model.number="form.order" type="number" />
                            </div>
                            <div class="flex items-center space-x-2">
                                <Switch id="is_active" v-model:checked="form.is_active" />
                                <Label for="is_active">Active</Label>
                            </div>
                        </div>
                        <DialogFooter>
                            <Button variant="outline" @click="isCreateDialogOpen = false">Cancel</Button>
                            <Button @click="createMenu" :disabled="form.processing">Create</Button>
                        </DialogFooter>
                    </DialogContent>
                </Dialog>
            </div>

            <Card>
                <CardHeader>
                    <CardTitle>Menus</CardTitle>
                    <CardDescription>A list of all menus in your application</CardDescription>
                </CardHeader>
                <CardContent>
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead>Title</TableHead>
                                <TableHead>URL</TableHead>
                                <TableHead>Icon</TableHead>
                                <TableHead>Order</TableHead>
                                <TableHead>Status</TableHead>
                                <TableHead class="text-right">Actions</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <template v-for="menu in allMenus" :key="menu.id">
                                <TableRow>
                                    <TableCell class="font-medium">
                                        <span :style="{ marginLeft: `${menu.level * 24}px` }">
                                            <ChevronRight v-if="menu.level > 0" class="inline h-4 w-4 mr-1" />
                                            {{ menu.title }}
                                        </span>
                                    </TableCell>
                                    <TableCell>{{ menu.url || '—' }}</TableCell>
                                    <TableCell>{{ menu.icon || '—' }}</TableCell>
                                    <TableCell>{{ menu.order }}</TableCell>
                                    <TableCell>
                                        <Badge :variant="menu.is_active ? 'default' : 'secondary'">
                                            {{ menu.is_active ? 'Active' : 'Inactive' }}
                                        </Badge>
                                    </TableCell>
                                    <TableCell class="text-right">
                                        <div class="flex justify-end gap-2">
                                            <Button size="icon" variant="ghost" @click="openEditDialog(menu)">
                                                <Edit class="h-4 w-4" />
                                            </Button>
                                            <Button size="icon" variant="ghost" @click="deleteMenu(menu.id)">
                                                <Trash2 class="h-4 w-4 text-destructive" />
                                            </Button>
                                        </div>
                                    </TableCell>
                                </TableRow>
                            </template>
                            <TableRow v-if="allMenus.length === 0">
                                <TableCell colspan="6" class="text-center text-muted-foreground">
                                    No menus found. Create your first menu to get started.
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </CardContent>
            </Card>

            <!-- Edit Dialog -->
            <Dialog v-model:open="isEditDialogOpen">
                <DialogContent class="sm:max-w-[525px]">
                    <DialogHeader>
                        <DialogTitle>Edit Menu</DialogTitle>
                        <DialogDescription>
                            Update the menu item details.
                        </DialogDescription>
                    </DialogHeader>
                    <div class="grid gap-4 py-4">
                        <div class="grid gap-2">
                            <Label for="edit-title">Title</Label>
                            <Input id="edit-title" v-model="form.title" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="edit-url">URL</Label>
                            <Input id="edit-url" v-model="form.url" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="edit-icon">Icon</Label>
                            <Input id="edit-icon" v-model="form.icon" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="edit-parent">Parent Menu</Label>
                            <Select v-model="form.parent_id">
                                <SelectTrigger>
                                    <SelectValue placeholder="None (Root Level)" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem :value="null">None (Root Level)</SelectItem>
                                    <SelectItem v-for="menu in allMenus.filter(m => m.id !== editingMenu?.id)"
                                        :key="menu.id" :value="menu.id">
                                        {{ '—'.repeat(menu.level) }} {{ menu.title }}
                                    </SelectItem>
                                </SelectContent>
                            </Select>
                        </div>
                        <div class="grid gap-2">
                            <Label for="edit-order">Order</Label>
                            <Input id="edit-order" v-model.number="form.order" type="number" />
                        </div>
                        <div class="flex items-center space-x-2">
                            <Switch id="edit-is_active" v-model:checked="form.is_active" />
                            <Label for="edit-is_active">Active</Label>
                        </div>
                    </div>
                    <DialogFooter>
                        <Button variant="outline" @click="isEditDialogOpen = false">Cancel</Button>
                        <Button @click="updateMenu" :disabled="form.processing">Update</Button>
                    </DialogFooter>
                </DialogContent>
            </Dialog>
        </div>
    </AppLayout>
</template>
