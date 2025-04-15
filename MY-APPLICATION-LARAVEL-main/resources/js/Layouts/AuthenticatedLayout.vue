<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import ToggleDarkMode from '@/Components/ToggleDarkMode.vue';

const showSidebar = ref(false);
const isDarkMode = ref(false);

const logout = () => {
    router.post(route('logout')); // Inertia gère la déconnexion avec une requête POST
};

const menuItems = ref([
    { label: 'stellar', icon: 'pi pi-home', command: () => router.visit(route('home')) },
    { label: 'facture', icon: 'pi pi-home', command: () => router.visit(route('factures.index')) },
    { label: 'mes commande', icon: 'pi pi-home', command: () => router.visit(route('orders.index')) },
    // { label: 'Blog', icon: 'pi pi-home', command: () => router.visit(route('home')) },

]);

const userMenu = ref([
    { label: 'Profile', icon: 'pi pi-user', command: () => router.visit(route('profile.edit')) },
    { label: 'Deconnexion', icon: 'pi pi-sign-out', command: logout },
]);
</script>

<template>
    <div>
        <div class="sm:flex sm:justify-center sm:flex-col sm:items-center min-h-screen bg-[--Black] bg-center selection:bg-gray-300 selection:text-[--White]">
            <nav class=" bg-[--Black] h-14 fixed top-[-1rem] w-full z-40">
                <div class=" bg-[--Black] text-[--White] mx-auto flex justify-center flex-col px-4 sm:px-6">
                    <Link :href="'/'" class="flex relative top-[2.9rem] items-center justify-center">
                                    <ApplicationLogo class="h-9 w-auto text-[--Primary]" />
                    </Link>
                    <Menubar class="text-[--White] menu-bar " :model="menuItems">
                        <template #item="{ item, props, hasSubmenu, root }">
                            <a v-ripple v-bind="props.action"
                            class="menu-item"

                            style="color: #F4F4F4">
                                <span class="item-label">{{ item.label }}</span>
                                <Badge v-if="item.badge"
                                    :class="{ 'ml-auto': !root, 'ml-2': root }"
                                    :value="item.badge"
                                    class=""
                                    />
                                <span v-if="item.shortcut"
                                    class="ml-auto "
                                    style="color: #F4F4F4">
                                    {{ item.shortcut }}
                                </span>
                                <i v-if="hasSubmenu"
                                :class="['pi ml-auto arrow-icon',
                                        { 'pi-angle-down': root,
                                            'pi-angle-right': !root }]"
                                style="color: #F4F4F4"></i>
                            </a>
                        </template>
                            <template #end>
                                <div class="flex items-center gap-1">
                                    <Button
                                        :icon="'pi pi-heart'"
                                        style="color: #F4F4F4"
                                        class="p-button-rounded p-button-text"
                                        severity="contrast"
                                        @click="router.visit(route('like.show'))"
                                    />
                                    <Button
                                        :icon="'pi pi-shopping-bag'"
                                        style="color: #F4F4F4"
                                        class="p-button-rounded p-button-text"
                                        severity="contrast"
                                        @click="router.visit(route('cart.show'))"
                                    />
                                    <SplitButton
                                        :label="$page.props.auth.user.name"
                                        :model="userMenu"
                                        class="text-light custom-splitbutton"
                                        @click="router.visit(route('profile.edit'))"
                                        dropdownIcon="pi pi-user"
                                        style="color: #F4F4F4"
                                    >
                                        <template #icon>
                                            <i class="pi pi-user" style="color: #F4F4F4"></i>
                                        </template>
                                    </SplitButton>

                                </div>
                            </template>
           </Menubar>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="fixed w-full h-full top-14 left-0 p-5" v-if="$slots.header">
                <div class="max-w-7xl flex justify-center mx-auto py-1 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>

            </header>

            <!-- Page Content -->
            <main class="fixed w-full h-full top-12 left-0 p-5">

                <ScrollPanel
                        style="width: 100%; height: 100%"
                        :dt="{
                            bar: {
                                background: '{primary.color}'
                            }
                        }"
                    >
                            <slot />
                </ScrollPanel>
            </main>
        </div>
    </div>
</template>

<style lang="scss" scoped>
.text-light {
    color: #F4F4F4 !important;
}

/* Style pour les items du menu déroulant */
.p-menu .p-menuitem-text,
.p-menu .p-menuitem-icon {
    color: #F4F4F4 !important;
}
.menu-item {




    &:hover {
        color: var(--Primary) !important;
        background: #0D0D0D !important;

        .item-label,
        .arrow-icon,
        .shortcut {
            color: var(--Primary) !important;
        }

        .menu-badge {
            background-color: #0D0D0D !important;
            color: #0D0D0D !important;
        }
    }


}

.shortcut {
    transition: all 0.2s ease;
    border-color: rgba(244, 244, 244, 0.1) !important;
}

.menu-badge {
    // transition: all 0.2s ease;
}
.menu-bar {
    background-color: #0D0D0D;
    border: none;

    /* Style pour les items du menu principal - Hover en --Primary */
    .p-menuitem-link {
        color: #F4F4F4;

        &:not(.p-disabled):hover {
            background: transparent !important;
            color: var(--Primary) !important;

            .p-menuitem-text,
            .p-menuitem-icon {
                color: var(--Primary) !important;
            }
        }

        &:focus {
            box-shadow: none !important;
        }
    }

    /* Style pour le menu déroulant du SplitButton */
    .p-splitbutton .p-menu {
        background: #1A1A1A;
        border: 1px solid #333;

        .p-menuitem-link:hover {
            background: transparent !important;
            color: var(--Primary) !important;

            .p-menuitem-text,
            .p-menuitem-icon {
                color: var(--Primary) !important;
            }
        }
    }
}

/* Style spécifique pour le hover des boutons */
.p-button-text:not(.p-disabled):hover {
    background: transparent !important;
    color: var(--Primary) !important;
}
</style>
