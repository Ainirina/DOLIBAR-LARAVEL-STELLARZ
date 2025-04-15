<script setup>
import { Head, Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import ToggleDarkMode from '@/Components/ToggleDarkMode.vue';

import { onMounted, ref } from "vue";
import gsap from "gsap";
import Propriete from '@/Components/Propriete.vue';
import Legende from '@/Components/Legende.vue';
import MediaItem from '@/Components/MediaComponent.vue';

const mediaItems = ref([
  {
    type: 'image',
    source: '/img/y.png',
    alt: 'Description image 1'
  },
  {
    type: 'image',
    source: '/img/z.png',
    alt: 'Description image 2'
  },
  {
    type: 'image',
    source: '/img/w.png',
    alt: 'Description image 3'
  },
//   {
//     type: 'video',
//     source: '/video/video.mp4',
//     alt: 'Description vidéo'
//   }
]);

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});


</script>

<template>

    <Head title="Welcome" />

    <div
        class="sm:flex sm:justify-center sm:flex-col sm:items-center min-h-screen bg-[--Black] bg-center selection:bg-gray-300 selection:text-[#F4F4F4]">


        <Menubar class="fixed inset-0 z-50 text-sm w-full bg-none p-7 h-24 blur-xs ">

            <template #start>
                <div class="flex items-center gap-8 mx-10 mr-auto">
                    <Link href="/"
                        class="font-medium  text-[--White] hover:text-[--Primary] hover:text-base  transition">ACCUEIL
                    </Link>
                    <Link href="/galerie"
                        class="font-medium  text-[--White] hover:text-[--Primary] hover:text-base  transition">
                    GALERIE
                    </Link>
                    <Link href="/collection"
                        class="font-medium  text-[--White] hover:text-[--Primary] hover:text-base  transition">
                    COLLECTION</Link>
                </div>
                <div class="absolute left-1/2 transform -translate-x-1/2">
                    <ApplicationLogo class="h-12 text-[--Primary]  w-100" />
                </div>
            </template>

            <template #end>
                <div class="flex items-center mx-10 gap-8 ml-auto">
                    <Link href="/a-propos"
                        class="font-medium  text-[--White] hover:text-[--Primary] hover:text-base transition">À
                    PROPOS
                    </Link>
                    <Link href="/contact"
                        class="font-medium  text-[--White] hover:text-[--Primary] hover:text-base transition">
                    CONTACTEZ-NOUS</Link>
                    <div v-if="canLogin">
                        <Link v-if="$page.props.auth.user" :href="route('home')"
                            class="font-medium  text-[--White] hover:text-[--Primary] hover:text-base transition">
                        ACHETER</Link>
                        <template v-else>
                            <Link :href="route('login')"
                                class="font-medium  text-[--White] hover:text-[--Primary] hover:text-base transition">
                            CONNEXION</Link>

                            <Link v-if="canRegister" :href="route('register')"
                                class="font-medium  text-[--White] hover:text-[--Primary] hover:text-base transition">
                            INSCRIPTION</Link>
                        </template>

                    </div>
                </div>
            </template>
        </Menubar>





        <ScrollPanel class="mt-[145px] h-[4600px]">



            <div class="ml-10 relative grid grid-flow-row-dense grid-cols-3 mt-10">
                <div class=" flex-col justify-start">
                    <h1 class="text-7xl font-bold text-[--White]  mb-4">STELLAR Z</h1>
                    <p class="pl-2 pr-5 text-sm text-[--Black03] mb-8 ">
                        Conçu pour les passionnés d'aventure et les assoiffés de performance. Défiez les limites,
                        maîtrisez tous
                        les terrains.
                    </p>
                    <button type="button"
                        class="ml-2 px-5 py-2 bg-[--Primary] hover:bg-[--Black] hover:text-[--Primary] text-[--White] hover:text-[--Primary] font-medium transition-all duration-200 hove:border-solid hover:border-2 hover:border-[--Primary] "
                        disabled>
                        essayez-le
                    </button>

                </div>

                <div class="space-y-2 col-span-2 ml-[550px] mr-[50px] mt-5">
                    <Propriete nom="15%" valeur="plus puissant" />
                    <Propriete nom="5kg" valeur="ultra lèger" />
                    <Propriete nom="12" valeur="vitesse" />
                </div>

            </div>
            <div class="fixed inset-0 felx align-items-center ml-[140px] mr-30 mt-[100px] items-center justify-center bg-transparent "
                style="position: fixed; z-index: -1;">
                <img src="/img/bike.png" alt="Stellar Z Bike" class="max-h-[110vh] object-contain" />
            </div>
            <div class="felx align-items-center ml-[275px] mr-30 -mt-[300px] items-center justify-center bg-transparent "
                style="position: relative; z-index: -2;">
                <img src="img/star.png" alt="star" class="object-contain" />
            </div>
            <div class="relative">

                <h1 class="text-[209px] font-bold text-[--Black03] mb-4 blur-xs opacity-50">PUISSANCE</h1>
                <h1 class="text-[283px] -mt-[380px] font-bold text-[--White] mb-4 relative z-10">a propos</h1>

            </div>


            <div class="relative z-50 mt-20 p-8 ">
                <img src="img/LEGENDE.png" alt="star" class="-ml-[30px] max-h-[70vh] object-contain" />

            </div>

            <div class="relative bg-[--Black]">

                <h1 class="text-[235px] mt-[250px]  font-bold text-[--Black03] mb-4 blur-xs opacity-50">LEGERETE</h1>
                <h1 class="text-[345px] -mt-[440px] font-bold text-[--White] mb-4 relative z-10">galerie</h1>

            </div>
            <div class="relative -mt-[125px] w-full px-10 h-[80vh]">
                <Carousel :value="mediaItems" :numVisible="1" :numScroll="1" :circular="false" :autoplayInterval="0"
                    :showIndicators="true" :showNavigators="true" class="custom-carousel"  caption="Ceci est une légende pour l’image.">
                    <template #item="slotProps">
                        <div class="flex items-center justify-center h-full w-full">
                            <MediaItem :type="slotProps.data.type" :source="slotProps.data.source"
                                :alt="slotProps.data.alt" class="max-h-[80vh] w-full object-contain" />
                        </div>
                    </template>

                    <template #indicator="props">
                        <button class="w-3 h-3 mx-1 rounded-full transition-all duration-300"
                            :class="{'bg-[--Primary]': props.index === props.active, 'bg-[--White] opacity-30': props.index !== props.active}"
                            @click="props.onClick(props.index)" />
                    </template>

                    <template #previousicon>
                        <div
                            class="p-carousel-prev bg-[rgba(13,13,13,0.5)] hover:bg-[--Primary] rounded-full w-10 h-10 flex items-center justify-center transition-all duration-300">
                            <i class="pi pi-chevron-left text-[--White]"></i>
                        </div>
                    </template>

                    <template #nexticon>
                        <div
                            class="p-carousel-next bg-[rgba(13,13,13,0.5)] hover:bg-[--Primary] rounded-full w-10 h-10 flex items-center justify-center transition-all duration-300">
                            <i class="pi pi-chevron-right text-[--White]"></i>
                        </div>
                    </template>
                </Carousel>
            </div>
            <div class="relative bg-[--Black]" >

                <h1 class="text-[255px] -mt-[150px]  font-bold text-[--Black03] mb-4 blur-xs opacity-50">ROBUSTE</h1>
                <h1 class="text-[315px] -mt-[440px] font-bold text-[--White] mb-4 relative z-10">contact</h1>

                </div>
                <div class="relative z-50 -mt-[175px] p-8 ">
                <img src="img/1.png" alt="star" class="-ml-[30px] max-h-[100vh] object-contain" />
                <img src="img/2.png" alt="star" class="-ml-[30px] -mb-[35px]  max-h-[120vh] object-contain" />

            </div>
            <footer>
                    <img src="img/3.png" alt="star" class="-ml-[30px] max-h-[100vh] object-contain" />

                </footer>
        </ScrollPanel>
    </div>



</template>

<style scoped>
.bg-none {
    background: #0D0D0D;
    border: none;
    /* padding: 40px; */
}
.custom-carousel :deep(.p-carousel-content) {
  @apply h-full;
}

.custom-carousel :deep(.p-carousel-item) {
  @apply flex items-center justify-center h-full;
}

/* Video specific styling */
video.media-content {
  @apply bg-black;
}
</style>
