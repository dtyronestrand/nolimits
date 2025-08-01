<template>
    <div class="grid grid-cols-4 gap-4 pb-10">
    <h1 class="col-span-4 text-7xl text-center pt-10">Taekwondo at No Limits</h1>
    <div v-if="props.item.blocks && Array.isArray(props.item.blocks) && props.item.blocks.length > 0" class="col-span-4 w-full flex flex-col grow">
        <div v-for="(block, index) in props.item.blocks" :key="block.id || index" >
        <figure class=" flex w-sm h-sm object-scale-down  py-4  mx-auto">
            <img class="rounded-full flex-1"v-if="block.type === 'common-image'" :src="block.medias.common_image.desktop.src" >
        </figure>
        </div>
</div>
<TKDNav/>
    <div v-if="props.item.blocks && Array.isArray(props.item.blocks) && props.item.blocks.length > 0" class="col-span-3 grid grid-cols-3 bento gap-4 pr-10">
        <template v-for="(block, index) in props.item.blocks" :key="block.id || index">
            <BlockCommonBento v-if="block.type === 'common-bento'" :block="block"></BlockCommonBento>
        </template>
    </div>
    </div>
</template>
<script setup lang="ts">
import{defineAsyncComponent} from 'vue';
import Default from '@/Layouts/Default.vue';
import TKDNav from '@/Components/TKDNav.vue';
defineOptions({
    layout: Default,
});

interface Props {
    item: Model.Page
    locale: string 
}

const props = defineProps<Props>();
const BlockCommonText= defineAsyncComponent(() => import('@/Components/Theme/Block/Common/Text.vue'));
const BlockCommonBento= defineAsyncComponent(() => import('@/Components/Theme/Block/Common/Bento.vue'));
const BlockCommonImage= defineAsyncComponent(() => import('@/Components/Theme/Block/Common/Image.vue'));
</script>
<style scoped>
.bento{
    grid-template-rows: auto;
}
table {
    width: 100%;
}

table, th, td{
    border: 1px solid var(--color-secondary-base);
    border-collapse: collapse;
}
</style>