<script setup lang="ts">
import { defineAsyncComponent } from "vue";
import { Link } from "@inertiajs/vue3";

defineOptions({
    name: "BlockCommonCards",
});

interface Props {
    block: Model.Block & PropsBlock;
}

type PropsBlock = {
    content: {
        heading?: string;
    };
    childs: PropsChildBlock[]; // Changed to an array of PropsChildBlock
};

type PropsChildBlock = {
    content: {
        title?: string;
        details?: string;
        button_text?: string;
        button_link?: string;
    };
    medias: {
        image?: Model.MediaWithRoles | null;
    };
    id?: string | number;
    type?: string;
};
const props = defineProps<Props>();
</script>
<template>
    <div v-if="block.childs && block.childs.length > 0" class="flex flex-col md:flex-row justify-evenly">
      
            <div v-for="(child, index) in block.childs" :key="child.id || index">
                <!-- Button Card -->

                <Link v-if="child.content?.type === 'button'" 
                    class="relative bg-[var(--color-surface-70)] block p-6 border-[var(--color-secondary-base)] rounded-lg min-w-lg mx-auto mt-6"
                    :href="child.content?.button_link || '#'">
                    <span class="absolute inset-x-0 bottom-0 h-2 bg-gradient-to-r from-[var(--color-primary-base)] via-[var(--color-secondary-30)] to-[var(--color-secondary-base)]"></span>
                    <div class="my-">
                        <h3 class="text-[var(--color-text-primary)] text-2xl font-bold pb-2">
                            {{ child.content?.title || 'Button Title' }}
                        </h3>
                        <p class="text-[var(--color-text-primary)] py-1 text-[1.2rem] pb-5">
                            {{ child.content?.details || 'Button Description' }}
                        </p>
                    </div>
                    <div class="flex justify-end">
                        <button class="px-2 py-1 text-[var(--color-text-primary)] border border-[var(--color-secondary-base)] font-semibold rounded hover:bg-[var(--color-primary-base)] hover:text-[var(--color-text-dark)]">
                            {{ child.content?.button_text }}
                        </button>
                    </div>
                </Link>
                 <div v-else-if="child.content?.type === 'profile'" class="profile-card">
                    <div class="profile-content">
                        <div class="img8x">
                            <img v-if="child.medias?.image?.desktop?.src"
                                :src="child.medias.image.desktop.src"
                                :alt="child.content?.title || 'Card Image'"
                                class="rounded-2xl" />
                        </div>
                        <div>
                            <h2 v-if="child.content?.title" class="font-extrabold text-3xl">
                                {{ child.content.title }}
                            </h2>
                            <p v-if="child.content?.details" class="font-semibold text-sm">
                                {{ child.content.details }}
                            </p>
                        </div>
                    </div>
                </div>
      <div v-else-if="child.content?.type === 'carousel'">
      
      </div>
              
            </div>
        </div>
    
</template>
<style scoped>
.profile {
    background-color: rgba(from var(--color-surface-base) R G B / 0.7);
    backdrop-filter: blur(10px);
}
.profile-card {
    position: relative;
    width: 300px;
    height: 400px;
    background: rgba(from var(--color-surface-70) R G B / 0.5);
    margin: 20px;
    box-shadow: 0 15px 35px rgba(from var(--color-primary-base) R G B / 0.5);
    border-radius: 15px;
    display: flex;
    justify-content: center;
    align-items: center;
    backdrop-filter: blur(10px);
}
.profile-card .profile-content {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    transition: 0.5s;
}
.profile-card .profile-content .img8x img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.profile-card .profile-content .img8x {
    position: relative;
    width: 150px;
    height: 150px;
    overflow: hidden;
}
</style>
