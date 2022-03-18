<script setup>
import { onMounted, ref } from 'vue';

defineProps(['modelValue', 'processing', 'placeholder']);

const emits = defineEmits(['update:modelValue']);

const textarea = ref(null)

onMounted(() => {
    if (textarea.value.hasAttribute('autofocus')) {
        textarea.value.focus();
    }
    if (textarea.value.hasAttribute('autoadjust')) {
        adjustHeight()
    }
});

let ch = 0
const initHeight = () => {
    textarea.value.style.height = "auto"
    ch = textarea.value.clientHeight
    
}
const adjustHeight = () => {
    textarea.value.style.height = ch + 'px';
    let sh = textarea.value.scrollHeight;
    textarea.value.style.height = sh < 256 ? sh + 'px' : '256px';
}
const updateValue = (e) => {
    emits('update:modelValue', e.target.value)
    adjustHeight()
}
const focus = () => {
    textarea.value.focus()
}
defineExpose({
    initHeight,
    focus,
});
</script>

<template>
    
    <textarea
        ref="textarea" 
        @input="updateValue($event)"
        :value="modelValue"
        class="w-full border-0 rounded bg-none focus:outline-none focus:ring-none text-sm" 
        rows="1" 
        :placeholder="placeholder"
    >
    </textarea>

</template>
