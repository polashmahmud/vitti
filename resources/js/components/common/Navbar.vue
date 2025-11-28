<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Moon } from 'lucide-vue-next';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar'
</script>

<template>
    <nav class="p-4 flex items-center justify-between">
        <!-- Left side -->
        <div>
            collapse Button
        </div>

        <!-- Right side -->
        <div class="flex items-center gap-4">
            <Link href="/">Home</Link>
            <Moon />
            <Avatar>
                <AvatarImage src="https://github.com/shadcn.png" />
                <AvatarFallback>CN</AvatarFallback>
            </Avatar>
        </div>
    </nav>
</template>
