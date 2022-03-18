<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3'
import Dropdown from '@/Components/Dropdown'
import DropdownButton from '@/Components/DropdownButton'
import ChatEditForm from './ChatEditForm'
import { ref } from 'vue'
const props = defineProps({
    chat: Object,
})
const emits = defineEmits(['onSubmit'])

const show = ref()
const dateFormat = (dateString) => {
    const d = new Date(dateString)
    return d.toLocaleString('ja-JP')
}

</script>
<template>
    <div>
        <img class="h-10 h-10 whitespace-nowrap overflow-hidden text-xs rounded" :src="chat.user.gravatar_url" :alt="chat.user.name + 'のアイコン'">
    </div>
    <div class="w-full pl-3">
        <div class="flex items-center justify-between">
            <div class="flex">
                <span class="text-sm font-bold">{{ chat.user.name }}</span>
                <span class="ml-3 text-xs text-gray-600">{{ dateFormat(chat.created_at) }}</span>
            </div>
            <div>
                <Dropdown>
                    <template #trigger><button class="px-2"><i class="fa fa-ellipsis-v"></i></button></template>
                    <template #content>
                        <DropdownButton @click="show=true">
                            編集
                        </DropdownButton>
                    </template>
                </Dropdown>
            </div>
        </div>
        <div v-if="!show" class="mt-2 markdown-body" v-html="chat.content_html"></div>
        <ChatEditForm v-if="show" @close="show=false" @onSubmit="onSubmit" :chat="chat" />
    </div>
</template>