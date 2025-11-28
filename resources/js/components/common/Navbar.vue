<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { LogOut, Moon, Settings, User } from 'lucide-vue-next';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar'
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuLabel, DropdownMenuSeparator, DropdownMenuTrigger, } from '@/components/ui/dropdown-menu'
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
            <DropdownMenu>
                <DropdownMenuTrigger>
                    <Avatar>
                        <AvatarImage src="https://github.com/shadcn.png" />
                        <AvatarFallback>CN</AvatarFallback>
                    </Avatar>
                </DropdownMenuTrigger>
                <DropdownMenuContent :side-offset="10">
                    <DropdownMenuLabel>My Account</DropdownMenuLabel>
                    <DropdownMenuSeparator />
                    <DropdownMenuItem>
                        <User class="size-[1.2rem]" />
                        Profile
                    </DropdownMenuItem>
                    <DropdownMenuItem>
                        <Settings class="size-[1.2rem]" />
                        Settings
                    </DropdownMenuItem>
                    <DropdownMenuItem variant="destructive">
                        <LogOut class="size-[1.2rem]" />
                        Logout
                    </DropdownMenuItem>
                </DropdownMenuContent>
            </DropdownMenu>
        </div>
    </nav>
</template>
