<template>
    <div class="grid grid-cols-4 gap-4 pb-10">
    <h1 class="text-7xl text-center py-10 col-span-4">About Taekwondo</h1>
    <TKDNav/>
        <div v-if="props.item.blocks && Array.isArray(props.item.blocks) && props.item.blocks.length > 0" class="col-span-3 grid grid-cols-3 bento gap-4 pr-10">
        <template v-for="(block, index) in props.item.blocks" :key="block.id || index">
            <BlockCommonBento v-if="block.type === 'common-bento'" :block="block"></BlockCommonBento>
        </template>
    </div>
    </div>
</template>
<script setup lang="ts">
import TKDNav from '../../../Components/TKDNav.vue';
import Default from '../../../Layouts/Default.vue';
import { defineAsyncComponent } from 'vue';
defineOptions({
    layout: Default
})

interface Props {
    item: Model.Page
    locale: string 
}

const BlockCommonBento = defineAsyncComponent(() => import('@/Components/Theme/Block/Common/Bento.vue'));
const props = defineProps<Props>();
</script>
<style scoped>
</style>