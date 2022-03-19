<script setup>
import Modal from '@/Components/Modal'
import ChannelForm from './ChannelForm'
import ModalConfirm from '@/Components/ModalConfirm'
import { ref } from 'vue'
const props = defineProps({
    channel: Object, 
    show: Boolean
})
const emits = defineEmits(['close']);
const showEdit = ref(false)
const showDelete = ref(false)
const onClose = () => {
    showDelete.value = false
    emits('close')
}
</script>

<template>
    <Modal :show="show" @close="$emit('close')">
        <template #header>{{ channel.name }}</template>
        <template #content>
            <dl>
                <dt>チャンネルの説明</dt>
                <dd>
                    <div v-if="!channel.description" class="py-2 text-sm text-gray-600">説明はありません</div>
                    {{ channel.description }}
                </dd>
                <dt>管理者</dt>
                <dd>
                    {{ channel.user.name }}
                </dd>
            </dl>
            
        </template>
        <template #footer>
            <div class="flex items-center justify-between py-1">
                <div>
                    <button class="link text-sm" @click="showEdit=true" @close="showEdit=false">編集する</button>
                    <button class="link ml-5 text-sm" @click="showDelete=true" @close="showDelete=false">削除</button>
                </div>
                <button class="btn-white" @click="$emit('close')">閉じる</button>
                 
            </div>
        </template>
    </Modal>
    <ChannelForm v-if="channel" :channel="channel" :show="showEdit" @close="showEdit=false" />
    <ModalConfirm v-if="channel" :show="showDelete" @close="onClose()" method="delete" :url="route('channels.destroy', channel)" />
       
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