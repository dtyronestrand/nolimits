<script setup lang="ts">
import { defineAsyncComponent } from "vue";

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
    };
    medias: {
        image?: Model.MediaWithRoles | null; // Made image optional to prevent errors if not present
    };
    id?: string | number; // Optional: if childs have unique IDs for keys
};
const props = defineProps<Props>();
</script>
<template>
    <div v-if="block.content.type === 'profile'">
        <h1
            v-if="block.content?.heading"
            class="text-7xl font-bold text-center text-(--color-text-primary) mb-10"
        >
            {{ block.content.heading }}
        </h1>
        <div
            class="flex flex-col md:flex-row justify-evenly gap-8 items-center"
        >
            <!-- Assuming this container was intended -->

            <!-- Loop through each child to create a card -->
            <div
                v-if="block.childs && block.childs.length > 0"
                class="profile-card"
                v-for="(child, index) in block.childs"
                :key="child.id || child.content?.title || index"
            >
                <div class="profile-content">
                    <div class="img8x">
                        <!-- Image for the current child -->
                        <img
                            v-if="child.medias?.image?.desktop?.src"
                            :src="child.medias.image.desktop.src"
                            :alt="child.content?.title || 'Card Image'"
                            class="rounded-2xl"
                        />
                    </div>
                    <!-- Content for the current child -->
                    <div>
                        <h2
                            v-if="child.content?.title"
                            class="font-extrabold text-3xl"
                        >
                            {{ child.content.title }}
                        </h2>
                        <p
                            v-if="child.content?.details"
                            class="font-semibold text-sm"
                        >
                            {{ child.content.details }}
                        </p>
                    </div>
                </div>
            </div>
            <div
                v-else-if="!block.childs || block.childs.length === 0"
                class="text-center text-gray-500"
            >
                <p>No cards to display.</p>
            </div>
        </div>
    </div>
    <div v-else-if="block.content.type === 'scroll'"><</div>
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
