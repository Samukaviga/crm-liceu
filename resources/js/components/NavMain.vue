<script setup lang="ts">
import { ref } from 'vue'
import {
    SidebarGroup,
    SidebarGroupLabel,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar'
import { urlIsActive } from '@/lib/utils'
import { type NavItem } from '@/types'
import { Link, usePage } from '@inertiajs/vue3'

defineProps<{
    items: NavItem[]
}>()

const page = usePage()

/**
 * Controla quais menus estão abertos
 */
const openMenus = ref<Record<string, boolean>>({})

/**
 * Abre / fecha submenu ao clicar
 */
const toggleMenu = (key: string) => {
    openMenus.value[key] = !openMenus.value[key]
}

/**
 * Verifica se algum filho está ativo
 */
const isAnyChildActive = (children: NavItem[]) => {
    return children.some(
        child => child.href && urlIsActive(child.href, page.url)
    )
}

/**
 * Define se o menu deve estar aberto
 * - Manualmente
 * - Ou automaticamente se rota filha estiver ativa
 */
const isMenuOpen = (item: NavItem) => {
    return (
        openMenus.value[item.title] ||
        (item.children && isAnyChildActive(item.children))
    )
}
</script>

<template>
    <SidebarGroup class="px-2 py-0">
        <SidebarGroupLabel>Platform</SidebarGroupLabel>

        <SidebarMenu>
            <SidebarMenuItem
                v-for="item in items"
                :key="item.title"
            >
                <!-- ITEM SEM SUBMENU -->
                <SidebarMenuButton
                    v-if="!item.children"
                    as-child
                    :is-active="urlIsActive(item.href!, page.url)"
                    :tooltip="item.title"
                >
                    <Link :href="item.href!">
                        <component
                            v-if="item.icon"
                            :is="item.icon"
                        />
                        <span>{{ item.title }}</span>
                    </Link>
                </SidebarMenuButton>

                <!-- ITEM COM SUBMENU -->
                <div v-else class="space-y-1">
                    <SidebarMenuButton
                        :tooltip="item.title"
                        @click="toggleMenu(item.title)"
                    >
                        <component
                            v-if="item.icon"
                            :is="item.icon"
                        />
                        <span>{{ item.title }}</span>

                        <!-- SETA -->
                        <svg
                            class="ml-auto h-4 w-4 transition-transform duration-200"
                            :class="{ 'rotate-90': isMenuOpen(item) }"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M6 6L14 10L6 14V6Z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </SidebarMenuButton>

                    <!-- SUBITENS -->
                    <SidebarMenu
                        v-show="isMenuOpen(item)"
                        class="ml-6"
                    >
                        <SidebarMenuItem
                            v-for="child in item.children"
                            :key="child.title"
                        >
                            <SidebarMenuButton
                                as-child
                                :is-active="urlIsActive(child.href!, page.url)"
                            >
                                <Link :href="child.href!">
                                    <span>{{ child.title }}</span>
                                </Link>
                            </SidebarMenuButton>
                        </SidebarMenuItem>
                    </SidebarMenu>
                </div>
            </SidebarMenuItem>
        </SidebarMenu>
    </SidebarGroup>
</template>
