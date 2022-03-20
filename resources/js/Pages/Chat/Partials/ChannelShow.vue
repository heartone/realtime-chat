<script setup>
import Modal from '@/Components/Modal'
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
                <dd>
                    <div v-if="!channel.description" class="py-2 text-sm text-gray-600">説明はありません</div>
                    <div v-else class="markdown-body" v-html="channel.description_html"></div>
                </dd>
                <dt>管理者</dt>
                <dd>
                    {{ channel.owner.name }}
                </dd>
            </dl>
            
        </template>
        <template #footer>
            
        </template>
    </Modal>
    
</template>
<style scoped>
dt {
    margin-bottom: 8px;
    font-size: .9rem;
    color: #777;
}
dd {
    margin-bottom: 20px;
}
</style>