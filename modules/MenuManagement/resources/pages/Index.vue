<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Switch } from '@/components/ui/switch';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm, router } from '@inertiajs/vue3';
import {
    Plus, Save, LayoutDashboard, Users, Settings, FileText, Home, Mail, Calendar, Star,
    Shield, Lock, CreditCard, ShoppingCart, BarChart, PieChart, Activity,
    Globe, Server, Database, Ban, Bell, Book, Box, Briefcase, Camera, Check,
    ChevronDown, ChevronRight, Circle, Clipboard, Clock, Cloud, Code, Cog,
    Command, Compass, Copy, Cpu, Database as DatabaseIcon, Delete, Disc,
    DollarSign, Download, Edit, Eye, EyeOff, File, Filter, Flag, Folder,
    Gift, Grid, HardDrive, Hash, Heart, Image, Inbox, Info, Key, Layers,
    Layout, LifeBuoy, Link, List, Loader, LogOut, Map, MapPin, Maximize,
    Menu, MessageCircle, MessageSquare, Mic, Minimize, Minus, Monitor,
    Moon, MoreHorizontal, MoreVertical, MousePointer, Move, Music, Navigation,
    Package, Paperclip, Pause, PenTool, Phone, Play, Power, Printer, Radio,
    RefreshCw, Repeat, RotateCcw, RotateCw, Rss, Save as SaveIcon, Scissors,
    Search, Send, Share, Share2, ShieldOff, Sidebar, Slash, Sliders, Smartphone,
    Smile, Speaker, Square, Sun, Table, Tag, Target, Terminal, Thermometer,
    ThumbsDown, ThumbsUp, ToggleLeft, ToggleRight, Trash, Trash2,
    TrendingDown, TrendingUp, Triangle, Truck, Tv, Type, Umbrella, Unlock,
    Upload, User, UserCheck, UserMinus, UserPlus, UserX, Video, Voicemail,
    Volume, Volume1, Volume2, VolumeX, Watch, Wifi, WifiOff, Wind, X,
    XCircle, XOctagon, XSquare, Zap, ZapOff, ZoomIn, ZoomOut
} from 'lucide-vue-next';
import { ref, computed, watch } from 'vue';
import MenuDraggableList from '../components/MenuDraggableList.vue';
import { toast } from 'vue-sonner';

const iconOptions = [
    { name: 'LayoutDashboard', component: LayoutDashboard },
    { name: 'Users', component: Users },
    { name: 'Settings', component: Settings },
    { name: 'FileText', component: FileText },
    { name: 'Home', component: Home },
    { name: 'Mail', component: Mail },
    { name: 'Calendar', component: Calendar },
    { name: 'Star', component: Star },
    { name: 'Shield', component: Shield },
    { name: 'Lock', component: Lock },
    { name: 'CreditCard', component: CreditCard },
    { name: 'ShoppingCart', component: ShoppingCart },
    { name: 'BarChart', component: BarChart },
    { name: 'PieChart', component: PieChart },
    { name: 'Activity', component: Activity },
    { name: 'Globe', component: Globe },
    { name: 'Server', component: Server },
    { name: 'Database', component: Database },
    { name: 'Bell', component: Bell },
    { name: 'Book', component: Book },
    { name: 'Box', component: Box },
    { name: 'Briefcase', component: Briefcase },
    { name: 'Camera', component: Camera },
    { name: 'Check', component: Check },
    { name: 'Circle', component: Circle },
    { name: 'Clipboard', component: Clipboard },
    { name: 'Clock', component: Clock },
    { name: 'Cloud', component: Cloud },
    { name: 'Code', component: Code },
    { name: 'Cog', component: Cog },
    { name: 'Command', component: Command },
    { name: 'Compass', component: Compass },
    { name: 'Copy', component: Copy },
    { name: 'Cpu', component: Cpu },
    { name: 'Disc', component: Disc },
    { name: 'DollarSign', component: DollarSign },
    { name: 'Download', component: Download },
    { name: 'Edit', component: Edit },
    { name: 'Eye', component: Eye },
    { name: 'EyeOff', component: EyeOff },
    { name: 'File', component: File },
    { name: 'Filter', component: Filter },
    { name: 'Flag', component: Flag },
    { name: 'Folder', component: Folder },
    { name: 'Gift', component: Gift },
    { name: 'Grid', component: Grid },
    { name: 'HardDrive', component: HardDrive },
    { name: 'Hash', component: Hash },
    { name: 'Heart', component: Heart },
    { name: 'Image', component: Image },
    { name: 'Inbox', component: Inbox },
    { name: 'Info', component: Info },
    { name: 'Key', component: Key },
    { name: 'Layers', component: Layers },
    { name: 'Layout', component: Layout },
    { name: 'LifeBuoy', component: LifeBuoy },
    { name: 'Link', component: Link },
    { name: 'List', component: List },
    { name: 'Loader', component: Loader },
    { name: 'LogOut', component: LogOut },
    { name: 'Map', component: Map },
    { name: 'MapPin', component: MapPin },
    { name: 'Maximize', component: Maximize },
    { name: 'Menu', component: Menu },
    { name: 'MessageCircle', component: MessageCircle },
    { name: 'MessageSquare', component: MessageSquare },
    { name: 'Mic', component: Mic },
    { name: 'Minimize', component: Minimize },
    { name: 'Minus', component: Minus },
    { name: 'Monitor', component: Monitor },
    { name: 'Moon', component: Moon },
    { name: 'MoreHorizontal', component: MoreHorizontal },
    { name: 'MoreVertical', component: MoreVertical },
    { name: 'MousePointer', component: MousePointer },
    { name: 'Move', component: Move },
    { name: 'Music', component: Music },
    { name: 'Navigation', component: Navigation },
    { name: 'Package', component: Package },
    { name: 'Paperclip', component: Paperclip },
    { name: 'Pause', component: Pause },
    { name: 'PenTool', component: PenTool },
    { name: 'Phone', component: Phone },
    { name: 'Play', component: Play },
    { name: 'Power', component: Power },
    { name: 'Printer', component: Printer },
    { name: 'Radio', component: Radio },
    { name: 'RefreshCw', component: RefreshCw },
    { name: 'Repeat', component: Repeat },
    { name: 'RotateCcw', component: RotateCcw },
    { name: 'RotateCw', component: RotateCw },
    { name: 'Rss', component: Rss },
    { name: 'Scissors', component: Scissors },
    { name: 'Search', component: Search },
    { name: 'Send', component: Send },
    { name: 'Share', component: Share },
    { name: 'Share2', component: Share2 },
    { name: 'ShieldOff', component: ShieldOff },
    { name: 'Sidebar', component: Sidebar },
    { name: 'Slash', component: Slash },
    { name: 'Sliders', component: Sliders },
    { name: 'Smartphone', component: Smartphone },
    { name: 'Smile', component: Smile },
    { name: 'Speaker', component: Speaker },
    { name: 'Square', component: Square },
    { name: 'Sun', component: Sun },
    { name: 'Table', component: Table },
    { name: 'Tag', component: Tag },
    { name: 'Target', component: Target },
    { name: 'Terminal', component: Terminal },
    { name: 'Thermometer', component: Thermometer },
    { name: 'ThumbsDown', component: ThumbsDown },
    { name: 'ThumbsUp', component: ThumbsUp },
    { name: 'ToggleLeft', component: ToggleLeft },
    { name: 'ToggleRight', component: ToggleRight },
    { name: 'Trash', component: Trash },
    { name: 'Trash2', component: Trash2 },
    { name: 'TrendingDown', component: TrendingDown },
    { name: 'TrendingUp', component: TrendingUp },
    { name: 'Triangle', component: Triangle },
    { name: 'Truck', component: Truck },
    { name: 'Tv', component: Tv },
    { name: 'Type', component: Type },
    { name: 'Umbrella', component: Umbrella },
    { name: 'Unlock', component: Unlock },
    { name: 'Upload', component: Upload },
    { name: 'User', component: User },
    { name: 'UserCheck', component: UserCheck },
    { name: 'UserMinus', component: UserMinus },
    { name: 'UserPlus', component: UserPlus },
    { name: 'UserX', component: UserX },
    { name: 'Video', component: Video },
    { name: 'Voicemail', component: Voicemail },
    { name: 'Volume', component: Volume },
    { name: 'Volume1', component: Volume1 },
    { name: 'Volume2', component: Volume2 },
    { name: 'VolumeX', component: VolumeX },
    { name: 'Watch', component: Watch },
    { name: 'Wifi', component: Wifi },
    { name: 'WifiOff', component: WifiOff },
    { name: 'Wind', component: Wind },
    { name: 'X', component: X },
    { name: 'XCircle', component: XCircle },
    { name: 'XOctagon', component: XOctagon },
    { name: 'XSquare', component: XSquare },
    { name: 'Zap', component: Zap },
    { name: 'ZapOff', component: ZapOff },
    { name: 'ZoomIn', component: ZoomIn },
    { name: 'ZoomOut', component: ZoomOut },
];

interface Menu {
    id: number;
    title: string;
    url: string | null;
    icon: string | null;
    order: number;
    is_active: boolean;
    children: Menu[];
    parent_id?: number | null;
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
const menus = ref<Menu[]>(JSON.parse(JSON.stringify(props.menuList)));

// Watch for prop changes to update local state
watch(() => props.menuList, (newVal) => {
    menus.value = JSON.parse(JSON.stringify(newVal));
}, { deep: true });

const form = useForm({
    parent_id: null as number | null,
    title: '',
    url: '',
    icon: '',
    order: 0,
    is_active: true,
});

// Helper to flatten menus for the parent selector
const allMenus = computed(() => {
    const flattenMenus = (menuItems: Menu[], level = 0): any[] => {
        return menuItems.reduce((acc: any[], menu) => {
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
    form.parent_id = menu.parent_id || null;
    form.title = menu.title;
    form.url = menu.url || '';
    form.icon = menu.icon || '';
    form.order = menu.order;
    form.is_active = Boolean(menu.is_active);
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

const saveOrder = () => {
    const flattenForSave = (items: Menu[], parentId: number | null = null): any[] => {
        let result: any[] = [];
        items.forEach((item, index) => {
            result.push({
                id: item.id,
                parent_id: parentId,
                order: index + 1,
            });
            if (item.children && item.children.length > 0) {
                result = result.concat(flattenForSave(item.children, item.id));
            }
        });
        return result;
    };

    const payload = flattenForSave(menus.value);

    router.post('/menu-management/update-order', { menus: payload }, {
        onSuccess: () => {
            toast.success('Menu order saved successfully');
        },
        onError: () => {
            toast.error('Failed to save menu order');
        }
    });
};
</script>

<template>

    <Head title="Menu Management" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="space-y-6 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold tracking-tight">Menu Management</h2>
                    <p class="text-muted-foreground">Manage your application menus. Drag and drop to reorder.</p>
                </div>

                <div class="flex gap-2">
                    <Button variant="outline" @click="saveOrder">
                        <Save class="mr-2 h-4 w-4" />
                        Save Order
                    </Button>
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
                                    <Label>Icon</Label>
                                    <div
                                        class="grid grid-cols-6 gap-2 p-2 border rounded-md max-h-[200px] overflow-y-auto">
                                        <div class="flex items-center justify-center p-2 rounded-md cursor-pointer hover:bg-accent transition-colors border"
                                            :class="{ 'bg-primary text-primary-foreground border-primary': !form.icon }"
                                            @click="form.icon = ''" title="No Icon">
                                            <Ban class="h-5 w-5" />
                                        </div>
                                        <div v-for="icon in iconOptions" :key="icon.name"
                                            class="flex items-center justify-center p-2 rounded-md cursor-pointer hover:bg-accent transition-colors border"
                                            :class="{ 'bg-primary text-primary-foreground border-primary': form.icon === icon.name }"
                                            @click="form.icon = icon.name" :title="icon.name">
                                            <component :is="icon.component" class="h-5 w-5" />
                                        </div>
                                    </div>
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
            </div>

            <Card>
                <CardHeader>
                    <CardTitle>Menus</CardTitle>
                    <CardDescription>Drag items to reorder or nest them.</CardDescription>
                </CardHeader>
                <CardContent>
                    <MenuDraggableList v-model="menus" @edit="openEditDialog" @delete="deleteMenu" />

                    <div v-if="menus.length === 0" class="text-center py-8 text-muted-foreground">
                        No menus found. Create your first menu to get started.
                    </div>
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
                            <Label>Icon</Label>
                            <div class="grid grid-cols-6 gap-2 p-2 border rounded-md max-h-[200px] overflow-y-auto">
                                <div class="flex items-center justify-center p-2 rounded-md cursor-pointer hover:bg-accent transition-colors border"
                                    :class="{ 'bg-primary text-primary-foreground border-primary': !form.icon }"
                                    @click="form.icon = ''" title="No Icon">
                                    <Ban class="h-5 w-5" />
                                </div>
                                <div v-for="icon in iconOptions" :key="icon.name"
                                    class="flex items-center justify-center p-2 rounded-md cursor-pointer hover:bg-accent transition-colors border"
                                    :class="{ 'bg-primary text-primary-foreground border-primary': form.icon === icon.name }"
                                    @click="form.icon = icon.name" :title="icon.name">
                                    <component :is="icon.component" class="h-5 w-5" />
                                </div>
                            </div>
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
