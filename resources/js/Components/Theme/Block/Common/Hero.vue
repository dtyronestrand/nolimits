<script setup lang="ts">
import IconButton from "../../UI/IconButton.vue";
import { Link } from "@inertiajs/vue3";
import { ref, computed } from "vue";

defineOptions({
    name: "BlockCommonHero",
});

interface Props {
    block: Model.Block & PropsBlock;
}

type PropsBlock = {
    content: {
        button_text?: string;
        button_url?: string;
        heading?: string;
        details?: string;
    };
    medias: {
        // Updated to reflect that 'image' is an object where keys are strings (e.g., "1", "2")
        image?: Record<string, Model.MediaWithRoles | null> | null;
    };
};

defineProps<Props>();
</script>
<template>
    <div v-if="block.content.variant === 'default'" class="hero">
        <img :src="block.medias?.image?.desktop?.src" />
        <div class="content">
            <h1>{{ block.content?.heading || "Default Heading" }}</h1>
            <p>{{ block.content?.details || "Default details paragraph." }}</p>

            <IconButton
                v-if="block.content?.button_url && block.content?.button_text"
                :href="block.content.button_url"
                class="py-3 w-1/6 mx-auto mt-8 mb-4 bg-(--color-accent) text-neutral-900 font-medium rounded-full hover:bg-transparent hover:border-(--color-tertiary-500) hover:text-(--color-text-primary) transition-colors"
            >
                {{ block.content.button_text }}
            </IconButton>

            <Link
                href="/login"
                aria-label=""
                class="px-8 text-neutral-100 font-bold hover:text-(--color-accent-800) text-2xl transition-colors"
                >Already started your journey? Login!</Link
            >
        </div>
    </div>
    <div v-else-if="block.content.variant === 'banner'" class="banner">
        <div class="inner">
            <div class="left">
                <h1>{{ block.content.heading }}</h1>
                <p v-html="block.content.text"></p>
            </div>
            <div class="right">
                <img
                    :src="
                        block.medias?.image?.desktop?.src ||
                        '/assets/images/default-banner-image.png'
                    "
                    alt="Banner Image"
                />
            </div>
        </div>
    </div>
</template>
<style scoped>
@reference "../../../../../css/app.css";
.banner {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 50vh;
    margin-bottom: 10rem;
    margin-top: 5rem;
}
.inner {
    display: grid;
    grid-template-columns: 4fr 1fr 4fr;
    grid-template-rows: 1fr 6fr 1fr;
    gap: 0px 0px;
    grid-auto-flow: row;
    max-width: 1000px;
    width: 90%;
    margin: 0 auto;
}
.left {
    grid-area: 1 / 1 / 3 / 3;
    border: 10px solid var(--color-accent);
    padding: 30px;
    background-color: rgba(from var(--color-primary-500) R G B / 0.8);
    backdrop-filter: blur(10px);
    @apply rounded-lg text-[var(--color-text-primary)];
    position: relative;
}
.left h1 {
    text-transform: uppercase;
    font-size: clamp(20px, 5vw, 40px);
    font-weight: 700;
    @apply text-balance;
}
.left p {
    margin-top: 25px;
    margin-bottom: 50px;
    font-size: 18px;
}

.right {
    grid-area: 2 / 2 / 4 / 4;
    border: 10px solid var(--color-accent);
    z-index: -1;
    position: relative;
}

.right img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* LEFT AND RIGHT BANDS */
.left::before,
.right::before {
    content: "";
    position: absolute;
    top: 50%;
    height: 50%;
    width: 50vw;
    background: var(--color-accent);
}
.left::before {
    left: 0;
    transform: translateY(-50%) translateX(-100%);
}
.right::before {
    right: 0;
    transform: translateY(-50%) translateX(100%);
}

@media screen and (max-width: 450px) {
    .banner .inner {
        grid-template-rows: 6fr 1fr 6fr;
    }
    .left {
        grid-area: 1 / 1 / 3 / 4;
    }
    .right {
        grid-area: 2 / 1 / 4 / 4;
    }
}
.hero {
    display: grid;
    grid-template-areas: "hero";
}
/* place all content into the 'hero' grid-area */
.hero > * {
    grid-area: hero;
}

.hero img {
    max-width: 100%;
    filter: brightness(0.75) saturate(1.5);
}
.content {
    /* position content above the image */
    position: relative;
    align-self: center;
    color: #fff;
    text-align: center;
    background-color: rgba(from var(--color-primary-500) R G B / 0.7);
    backdrop-filter: blur(10px);
    @apply py-6 text-balance rounded-lg;
    width: 75%;
    margin: 0 auto;
    margin-top: 10rem;
}
/* responsive h3 and p */
.content h1 {
    place-self: center;
    font-size: clamp(2rem, 10vw, 3rem);
    text-align: center;
    text-decoration: underline;
    text-decoration-thickness: 3px;
    text-underline-offset: 35%;
}
.content p {
    font-weight: 400;
    font-size: clamp(1.2rem, 6vw, 2rem);
}
</style>
