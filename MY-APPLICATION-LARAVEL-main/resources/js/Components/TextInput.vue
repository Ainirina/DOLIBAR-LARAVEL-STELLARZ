<script setup>
import { onMounted, ref } from 'vue';

const props = defineProps({
    modelValue: String,
    type: String, // Added type prop to determine input type
});

const emit = defineEmits(['update:modelValue']);

const modelValue = ref(props.modelValue);
const input = ref(null);

onMounted(() => {
    if (input.value?.$el?.hasAttribute('autofocus')) {
        input.value.$el.focus();
    }
});

defineExpose({ focus: () => input.value?.$el.focus() });
</script>

<template>
    <Password
        v-if="type === 'password'"
        v-model="modelValue"
        toggleMask
        @input="emit('update:modelValue', $event.target.value)"
    />
    <InputText
        v-else
        v-model="modelValue"
        @input="emit('update:modelValue', $event.target.value)"
        ref="input"
    />
</template>