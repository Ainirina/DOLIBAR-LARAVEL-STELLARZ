<script setup>
const props = defineProps({
  titre: {
    type: String,
    required: true
  },
  valeur: {
    type: String,
    required: true
  }
});
</script>

<template>
  <div class="w-full py-2">
    <p class="text-base text-[--White] text-start">

     <b class="text-[--Primary]">{{ titre }} : </b>{{ valeur }}
    </p>
  </div>
</template>
