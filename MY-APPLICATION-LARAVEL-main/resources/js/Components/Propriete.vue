<script setup>
const props = defineProps({
  nom: String,
  valeur: String,
  alignement: {
    type: String,
    default: 'row'
  },
  withSeparator: { // Nouvelle prop pour contrôler la séparation
    type: Boolean,
    default: true
  }
});
</script>

<template>
  <div :class="[
    'w-full',
    withSeparator ? 'border-b border-[--Black03] pb-3 mb-3 last:border-b-0' : ''
  ]">
    <div :class="[
      'flex',
      alignement === 'col' ? 'flex-col space-y-2' : 'items-center justify-between'
    ]">
      <span class="font-medium text-3xl text-[--White]">
        {{ nom }}
      </span>
      <span class="text-2xl text-[--Black03] text-end">
        {{ valeur }}
      </span>
    </div>
  </div>
</template>
