<template>
    <modal :show="show" :max-width="maxWidth" :closeable="closeable" @close="close">
        <div class="">
            <div class="flex justify-between items-center px-5 py-3 border-b bg-gray-100">
                <div class="text-lg font-bold">
                    <slot name="header"></slot>
                </div>
                <div>
                    <button class="w-8 h-8 leading-1 border rounded bg-white text-sm text-gray-600 hover:bg-gray-200" @click="close()"><i class="fa fa-fw fa-times"></i></button>
                </div>
            </div>
            <div class="px-6 py-4">
                <slot name="content"></slot>
            </div>
        </div>
        <div class="px-6 py-2 bg-gray-100 text-right">
            <slot name="footer">
            </slot>
        </div>
    </modal>
</template>

<script>
    import { defineComponent } from 'vue'
    import Modal from './ModalBase.vue'
    
    export default defineComponent({
        emits: ['close'],

        components: {
            Modal,
        },
        props: {
            show: {
                default: false
            },
            maxWidth: {
                default: '2xl'
            },
            closeable: {
                default: true
            },
            closeButton: {
                default: true
            }
        },

        methods: {
            close() {
                this.$emit('close')
            },
        }
    })
</script>
