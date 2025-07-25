<template>
    <div class="w-full mt-5 grid auto-rows-max grid-cols-4 carousel">
        <div class="col-span-2">
            <h1 class="text-7xl text center">Technique Videos</h1>
        </div>
        <div
            class="vid col-span-1"
            v-for="video in $page.props.videos"
            :key="video.id"
        >
            <a
                :href="`https://www.youtube.com/embed/${
                    getThumbnail(video.url).videoId
                }`"
                target="slider1"
            >
                <img
                    :src="`https://img.youtube.com/vi/${
                        getThumbnail(video.url).videoId
                    }/hqdefault.jpg`"
                />
            </a>
            <p>{{ video.title }}</p>
        </div>
        <div class="col-span-4 h-auto">
            <iframe
                src=""
                allowfullscreen
                frameborder="0"
                name="slider1"
            ></iframe>
        </div>
    </div>
</template>
<script setup lang="ts">
import Programs from "@/Layouts/Programs.vue";

defineOptions({
    layout: Programs,
});

function getThumbnail(url) {
    const match = url.match(/watch\?v=(.*?)(&|$)/);
    const videoId = match ? match[1] : null;
    return {
        videoId,
    };
}
</script>
<style scoped>
.vid {
    background-color: rgba(from var(--color-surface-70) R G B / 0.5);

    border-radius: 1em;
}

.carousel {
    padding: 0.3em 0.3em 0;

    text-align: center;
}

.carousel > div:not(:last-child) {
    position: relative;
    margin-bottom: 0.3em;
}
.carousel > div:last-child {
    min-height: 400px;
    aspect-ratio: initial;
    position: relative;
}
.carousel iframe {
    width: 100%;
    height: 100%;
}
.carousel span {
    display: inline-block;
    word-spacing: 1em; /* расстояние между картинками */

    /* прокрутка миниатюр при необходимости */
    overflow: auto;
    white-space: nowrap;
    word-wrap: normal;
}
.carousel a {
    position: relative;
    display: inline-block;
    max-width: 360px; /* максимальная ширина миниатюр */
    width: 75%; /* ширина миниатюр */
    border: 1px solid blue; /* рамка вокруг миниатюр */
    opacity: 0.7;
    text-decoration: none;
}
.carousel a:visited,
.carousel a:nth-of-type(1) {
    border-color: #555; /* рамка вокруг миниатюр просмотренных видео */
}
.carousel a:hover {
    opacity: 1;
}
.carousel a:not(:active):focus {
    pointer-events: none;
}
.carousel a::before {
    content: "";
    position: absolute;
    top: 0em;
    right: 0em;
    bottom: 0em;
    left: 0em;
    background: rgba(0, 0, 1, 0.1);
    transition: background 0s 9999999s;
}
.carousel a:nth-of-type(1)::before {
    background: rgba(255, 255, 254, 0.7);
}
.carousel span:active a::before {
    background: rgba(0, 0, 0, 0);
    transition: background 0s;
}
.carousel span:active a:active::before {
    background: rgba(255, 255, 255, 0.7);
    transition: background 0s;
}
.carousel img {
    max-width: 100%;
    vertical-align: middle; /* убрать нижний отступ до рамки под картинкой */
}
</style>
