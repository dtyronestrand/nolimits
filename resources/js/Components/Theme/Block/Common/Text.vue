<template>
    <div class=" mr-10 pr-20 pl-20 bg-[var(--color-surface-70)] rounded-lg flex flex-col gap-4 items-center  pt-10">
        <h2 class="text-5xl pb-10" v-if="block.content.title">{{ block.content.title }}</h2>
        <div v-if="block.content.text" v-html="block.content.text" class="flex flex-col gap-4  w-full [&_p]:text-xl [&_p]:leading-relaxed"></div>
    </div>
</template>

<script setup lang="ts">
defineOptions({
    name: 'BlockCommonText',
})

interface Props {
    block: Model.Block & PropsBlock
}

type PropsBlock = {
    content: {
        title?: string;
        text?: string;
    }
}

defineProps<Props>()
</script>
