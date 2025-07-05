<template>
    <Default>
    <h1 class="text-7xl text-center mb-12">News and Events</h1>
    <div class="grid grid-cols-4 place-items-center gap-1">
    <div v-for="item in props.News" :key="item.id">
    <div v-if="item?.blocks && Array.isArray(item.blocks) && item.blocks.length > 0" >
    <div v-for="(block, index) in item.blocks" :key="block.id || index">
    <BlockCommonNews v-if="block.type === 'common-news'" :block="block" />
        <BlockCommonEvent v-if="block.type === 'common-event'" :block="block" />
    </div>
    </div>
    </div>
</div>
 
    </Default>
</template>
<script setup lang="ts">
import { defineAsyncComponent } from 'vue'
import Default from '../../Layouts/Default.vue';
interface Props {
    News: Model.News[] 
}
const props = defineProps<Props>();

const BlockCommonImage = defineAsyncComponent(() => import('../../Components/Theme/Block/Common/Image.vue'));
const BlockCommonNews = defineAsyncComponent(() => import('../../Components/Theme/Block/Common/News.vue'));
const BlockCommonEvent = defineAsyncComponent(() => import('../../Components/Theme/Block/Common/Event.vue'));
</script>

