<script setup>
import Modal from '@/Components/Modal'
import { ref } from 'vue'
const props = defineProps({
    channel: Object, 
    show: Boolean
})
const emits = defineEmits(['close']);

</script>

<template>
    <Modal :show="show" @close="$emit('close')">
        <template #header>{{ channel.name }}</template>
        <template #content>
            <dl>
                <dt>チャンネルの説明</dt>
                <dd>{{ channel.description }}</dd>
                <dt>管理者</dt>
                <dd>{{ channel.user.name }}</dd>
            </dl>
        </template>
        <template #footer>
        </template>
    </Modal>
</template>

<style scoped>

dt {
    font-size: .9rem;
    margin-bottom: 5px;
    color: #777;
}
dd {
    margin-bottom: 15px;
}
</style>