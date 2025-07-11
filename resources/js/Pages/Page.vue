<script setup lang="ts">
import Head from '../Components/Theme/Head.vue';
import WordList from '../Components/Theme/UI/WordList.vue';
import {defineAsyncComponent} from 'vue';
import Default from '../Layouts/Default.vue';
defineOptions({
    layout: Default,
});

interface Props {
    item: Model.Page
    locale: string 
}

const props = defineProps<Props>();
const BlockCommonHero = defineAsyncComponent(() => import('../Components/Theme/Block/Common/Hero.vue'));
const BlockCommonCards = defineAsyncComponent(() => import('../Components/Theme/Block/Common/Cards.vue'));
</script>
<template>
<Head :item="props.item" :locale="props.locale"></Head>


    <div v-if="props.item?.blocks && Array.isArray(props.item.blocks) && props.item.blocks.length > 0" class="w-full flex flex-col grow">
        <div v-for="(block, index) in props.item.blocks" :key="block.id || index">
            <BlockCommonHero v-if="block.type === 'common-hero'" :block="block"></BlockCommonHero>
            <BlockCommonCards v-if="block.type === 'common-cards'" :block="block"></BlockCommonCards>

        </div>
    </div>
    
</template>