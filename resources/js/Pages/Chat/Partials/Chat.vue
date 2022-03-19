<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3'
import Dropdown from '@/Components/Dropdown'
import DropdownButton from '@/Components/DropdownButton'
import ElasticTextArea from '@/Components/ElasticTextArea'
import ModalConfirm from '@/Components/ModalConfirm'

import { ref } from 'vue'
const props = defineProps({
    chat: Object,
})
const chatEdit = ref(props.chat)
const show = ref(false)
const showModalDelete = ref(false)
const dateFormat = (dateString) => {
    const d = new Date(dateString)
    return d.toLocaleString('ja-JP')
}

const onSubmit = async () => {
    const response = await axios.post(route('chats.update', props.chat), {
        _method: 'patch',
        content: chatEdit.value.content
    })
    chatEdit.value = response.data
    show.value = false
}
const onDelete = async () => {
    const response = await axios.post(route('chats.destroy', props.chat), {
        _method: 'delete'
    })
    chatEdit.value.deleted = true
}

</script>
<template>
    <div class="p-2 md:py-3 md:px-4 border-t flex" v-if="!chatEdit.deleted">
        <div class="w-10">
            <img class="h-10 h-10 whitespace-nowrap overflow-hidden text-xs rounded" :src="chat.user.gravatar_url" size="64" :alt="chat.user.name + 'のアイコン'">
        </div>
        <div class="chat-container pl-3">
            <div class="flex items-center justify-between">
                <div class="flex">
                    <span class="text-sm font-bold">{{ chat.user.name }}</span>
                    <span class="ml-3 text-xs text-gray-600">{{ dateFormat(chat.created_at) }}</span>
                </div>
                <div>
                    <Dropdown>
                        <template #trigger><button class="px-3 py-1 mr-2 rounded hover:bg-gray-100 text-gray-400 hover:text-orange-500"><i class="fa fa-ellipsis-v"></i></button></template>
                        <template #content>
                            <DropdownButton @click="show=true">
                                編集
                            </DropdownButton>
                            <DropdownButton @click="showModalDelete=true">
                                削除
                            </DropdownButton>
                        </template>
                    </Dropdown>
                </div>
            </div>
            <div v-if="!show">
                <div class="mt-2 markdown-body" v-html="chatEdit.content_html"></div>
                <div v-if="chatEdit.is_edited" class="mt-1 text-xs text-gray-500">（編集済み）</div>
            </div>
            <form v-else class="py-3" @submit.prevent="onSubmit()">
                <div class="p-1 border border-gray-300 rounded">
                    <ElasticTextArea :autofocus="true" :autoadjust="true" v-model="chatEdit.content" placeholder="メッセージを入力" />
                    <div class="p-2">
                        <button class="btn-success" type="submit">送信</button>
                        <button type="button" class="btn-white ml-2" @click="show=false">キャンセル</button>
                    </div>
                </div>
            </form>
            <ModalConfirm 
                :show="showModalDelete"
                title="この投稿を削除しますか？"
                :message="chat.content"
                @confirm="onDelete"
                @close="showModalDelete=false"
            />
        </div>
    </div>
    
</template>
<style scoped>
.chat-container {
    width: calc(100% - 2.5rem);
}
</style>