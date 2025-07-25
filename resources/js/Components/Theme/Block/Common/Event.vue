<template>
    <div class="panel">
        <h2>{{ block.content.heading }}</h2>

        <img
            v-if="block.medias.image"
            :src="block.medias.image.desktop.src"
            alt="Event Image"
            class="w-full h-auto rounded-lg mb-4"
        />
        <div class="card__text">
            <p>{{ block.content.details }}</p>
        </div>
        <p>{{ block.content.date }}</p>
    </div>
</template>
<script setup lang="ts">
import { ref, computed } from "vue";
import { Link } from "@inertiajs/vue3";
defineOptions({
    name: "BlockCommonEvent",
});
interface Props {
    block: Model.Block & PropsBlock;
}
type PropsBlock = {
    content: {
        heading?: string | null;
        details?: string | null;
        date?: string | null;
    };
    medias: {
        image?: Model.Media | Model.MediaWithRoles | null;
    };
};
const props = defineProps<Props>();
</script>
<style scoped>
.panel {
    background-image: linear-gradient(
        to bottom right,
        rgba(from var(--color-surface-base) r g b / 0.3) 0%,
        rgba(from var(--color-primary-300) r g b / 0.1) 100%
    );
    backdrop-filter: blur(10px);
    border-radius: 12px;
    width: 320px;
    border-top: 1px solid rgba(from var(--color-primary-base) r g b / 0.7);
    border-left: 1px solid rgba(from var(--color-primary-base) r g b / 0.7);
    padding: 50px;
    box-shadow: rgba(from var(--color-surface-base) r g b / 0.5) -20px -20px
            45px inset,
        rgba(from var(--color-primary-300) r g b / 0.5) 10px 10px 20px,
        rgba(from var(--color-primary-100) r g b / 0.5) 5px 5px 10px;
    position: relative;
}

.penl::before {
    content: "";
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: linear-gradient(
        135deg,
        rgba(from var(--color-secondary-500) r g b / 0) 0%,
        rgba(from var(--color-secondary-300) r g b / 0.05) 40%,
        rgba(from var(--color-secondary-100) r g b / 0) 40%
    );
    pointer-events: none;
}

.card__text {
    font-size: 1.25em;
    line-height: 1.45;
    opacity: 1;
    margin-bottom: 2em;
}

h2 {
    font-size: 2em;
    font-weight: 1000;
    margin-top: 0;
    margin-bottom: 0.5em;
}
</style>
