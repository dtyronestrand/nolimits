<script setup lang="ts">
import { ref, onMounted, onUnmounted, computed, nextTick } from 'vue';

defineOptions({
    name: 'BlockCommonSlider',
});

interface Props {
    block: Model.Block & PropsBlock;
}

type PropsChildBlock = {
    content: {
        heading?: string;
        details?: string;
        link_url?: string;
        link_text?: string;
    };
    medias: {
        image?: MeadiaWithRoles | null;
    };

};

type PropsBlock = {
    childs: PropsChildBlock[]; // childs should be an array of slide data
};

const props = defineProps<Props>();

const sliderRef = ref<HTMLElement | null>(null);
const slidesRef = ref<HTMLElement[]>([]);
const slideBGsRef = ref<HTMLElement[]>([]);
const controlLeftRef = ref<HTMLElement | null>(null);
const controlRightRef = ref<HTMLElement | null>(null);
const paginationRef = ref<HTMLElement | null>(null);

const curSlide = ref(0);
const numOfSlides = computed(() => (props.block.childs ? props.block.childs.length - 1 : -1));
const animating = ref(false);
const diff = ref(0);
let autoSlideTimeout: number | undefined = undefined;

const animTime = 500;
const autoSlideDelay = 6000; // Time for auto-sliding

const manageControls = () => {
    if (controlLeftRef.value) {
        controlLeftRef.value.classList.toggle("inactive", curSlide.value === 0);
    }
    if (controlRightRef.value) {
        controlRightRef.value.classList.toggle("inactive", curSlide.value === numOfSlides.value);
    }
};

const autoSlide = () => {
    clearTimeout(autoSlideTimeout);
    if (props.block.childs.length <= 1) return; // Don't autoSlide if 0 or 1 slide
    autoSlideTimeout = window.setTimeout(() => {
        curSlide.value = (curSlide.value + 1) % (numOfSlides.value + 1);
        changeSlides();
    }, autoSlideDelay);
};

const changeSlides = (instant = false) => {
    if (!sliderRef.value || numOfSlides.value < 0) return;

    if (!instant) {
        animating.value = true;
        manageControls();
        sliderRef.value.classList.add("animating");
        void sliderRef.value.offsetWidth; // Force reflow

        setTimeout(() => {
            if (sliderRef.value) sliderRef.value.classList.remove("animating");
            animating.value = false;
        }, animTime);
    }

    clearTimeout(autoSlideTimeout);

    sliderRef.value.style.transform = `translate3d(${-curSlide.value * 100}%, 0, 0)`;
    slideBGsRef.value.forEach(bg => {
        if (bg) bg.style.transform = `translate3d(${curSlide.value * 50}%, 0, 0)`;
    });

    diff.value = 0;
    autoSlide();
};

const navigateLeft = () => {
    if (animating.value || curSlide.value <= 0) return;
    curSlide.value--;
    changeSlides();
};

const navigateRight = () => {
    if (animating.value || curSlide.value >= numOfSlides.value) return;
    curSlide.value++;
    changeSlides();
};

let startX = 0;
let isDragging = false;

const onDragStart = (event: MouseEvent | TouchEvent) => {
    if (animating.value || props.block.childs.length <= 1) return;
    isDragging = true;
    clearTimeout(autoSlideTimeout);
    startX = event.type.startsWith('touch') ? (event as TouchEvent).touches[0].pageX : (event as MouseEvent).pageX;
    diff.value = 0;

    document.addEventListener('mousemove', onDragMove, { passive: true });
    document.addEventListener('touchmove', onDragMove, { passive: true });
    document.addEventListener('mouseup', onDragEnd);
    document.addEventListener('touchend', onDragEnd);

    if (sliderRef.value) sliderRef.value.style.transition = 'none';
    slideBGsRef.value.forEach(bg => { if (bg) bg.style.transition = 'none'; });
};

const onDragMove = (event: MouseEvent | TouchEvent) => {
    if (!isDragging || !sliderRef.value) return;
    const x = event.type.startsWith('touch') ? (event as TouchEvent).touches[0].pageX : (event as MouseEvent).pageX;
    const winW = window.innerWidth;
    let currentDiff = (startX - x) / winW * 70;

    if ((curSlide.value === 0 && currentDiff < 0) || (curSlide.value === numOfSlides.value && currentDiff > 0)) {
        currentDiff /= 2;
    }
    diff.value = currentDiff;
    sliderRef.value.style.transform = `translate3d(${-curSlide.value * 100 - diff.value}%, 0, 0)`;
    slideBGsRef.value.forEach(bg => {
        if (bg) bg.style.transform = `translate3d(${curSlide.value * 50 + diff.value / 2}%, 0, 0)`;
    });
};

const onDragEnd = () => {
    if (!isDragging) return;
    isDragging = false;

    document.removeEventListener('mousemove', onDragMove);
    document.removeEventListener('touchmove', onDragMove);
    document.removeEventListener('mouseup', onDragEnd);
    document.removeEventListener('touchend', onDragEnd);

    if (sliderRef.value) sliderRef.value.style.transition = '';
    slideBGsRef.value.forEach(bg => { if (bg) bg.style.transition = ''; });

    if (animating.value) return;

    if (Math.abs(diff.value) < 8) {
        changeSlides(); // Snap back
    } else if (diff.value <= -8) {
        navigateLeft();
    } else if (diff.value >= 8) {
        navigateRight();
    }
    // diff.value is reset in changeSlides
};

const onPagiClick = (index: number) => {
    if (animating.value || curSlide.value === index) return;
    curSlide.value = index;
    changeSlides();
};

onMounted(async () => {
    if (!props.block.childs || props.block.childs.length === 0) return;
    await nextTick(); // Ensure refs are populated from v-for
    manageControls();
    autoSlide();
});

onUnmounted(() => {
    clearTimeout(autoSlideTimeout);
    document.removeEventListener('mousemove', onDragMove);
    document.removeEventListener('touchmove', onDragMove);
    document.removeEventListener('mouseup', onDragEnd);
    document.removeEventListener('touchend', onDragEnd);
});

</script>
<template>

  <h2 class="text-center bg-(--color-primary-500) text-[3rem] py-12 text-balance text-(--color-text-primary)">We Remove the Limits to a Healthier You!</h2> 

    <div class="slider-container" v-if="props.block.childs && props.block.childs.length > 0">
        <div ref="controlLeftRef" class="slider-control left inactive" @click="navigateLeft"></div>
        <div ref="controlRightRef" class="slider-control right" @click="navigateRight"></div>

        <ul class="slider-pagi" ref="paginationRef" v-if="props.block.childs.length > 1">
            <li
                v-for="(_, index) in props.block.childs"
                :key="`pagi-${index}`"
                :class="['slider-pagi__elem', { 'active': curSlide === index }]"
                @click="onPagiClick(index)"
            ></li>
        </ul>

        <div
            class="slider"
            ref="sliderRef"
            @mousedown.prevent="onDragStart"
            @touchstart.prevent="onDragStart"
        >
            <div
                v-for="(child, index) in props.block.childs"
                :key="`slide-${index}`"
                :class="['slide', `slide-${index}`, { 'active': curSlide === index }]"
                :ref="el => { if (el) slidesRef[index] = el as HTMLElement }"
            >
                <div
                    class="slide__bg"
                    :style="{ backgroundImage: child.medias?.image?.desktop?.src ? `url(${child.medias.image.desktop.src})` : '' }"
                    :ref="el => { if (el) slideBGsRef[index] = el as HTMLElement }"
                ></div>
                <div class="slide__content">
                    <svg class="slide__overlay" viewBox="0 0 720 405" preserveAspectRatio="xMaxYMax slice">
                        <path
                            class="slide__overlay-path"
                            d="M0,0 150,0 500,405 0,405"
                            :style="{ fill: child.settings?.overlay_color || '#e67e22' }"
                        />
                    </svg>
                    <div class="slide__text">
                        <h2
                            v-if="child.content?.heading"
                            class="slide__text-heading"
                        >{{ child.content.heading }}</h2>
                        <p
                            v-if="child.content?.text"
                            class="slide__text-desc"
                        >{{ child.content.text }}</p>
                        <a
                            v-if="child.content?.link_url && child.content?.link_text"
                            :href="child.content.link_url"
                            class="slide__text-link"
                        >{{ child.content.link_text }}</a>
                        <span
                            v-else-if="child.content?.link_text"
                            class="slide__text-link"
                        >{{ child.content.link_text }}</span> <!-- Fallback if only text is provided -->
                    </div>
                </div>
            </div>
        </div>
    </div>
 
</template>
<style scoped>


/*
html, body {
  font-size: 62.5%;
  height: 100%;
  overflow: hidden;
}
*/
/*
body {
  background: #000;
}

svg {
  display: block;
  overflow: visible;
}
*/

.slider-container {
  position: relative;
  /* height: 100%; */ /* Problematic if parent height is 'auto' */
 height:80vh; /* Example: Set to 70% of viewport height. Adjust as needed. */
  user-select: none;
  cursor: all-scroll;
}

.slider-control {
  z-index: 2;
  position: absolute;
  top: 0;
  width: 12%;
  height: 100%;
  transition: opacity 0.3s;
  will-change: opacity;
  overflow: hidden;
  opacity: 0;
}
.slider-control.inactive:hover {
  cursor: auto;
}
.slider-control:not(.inactive):hover {
  opacity: 1;
  cursor: pointer;
}
.slider-control.left {
  left: 0;
  background: linear-gradient(to right, rgba(0, 0, 0, 0.18) 0%, transparent 100%);
}
.slider-control.right {
  right: 0;
  background: linear-gradient(to right, transparent 0%, rgba(0, 0, 0, 0.18) 100%);
}

.slider-pagi {
  position: absolute;
  z-index: 3;
  left: 50%;
  bottom: 2rem;
  transform: translateX(-50%);
  font-size: 0;
  list-style-type: none;
}
.slider-pagi__elem {
  position: relative;
  display: inline-block;
  vertical-align: top;
  width: 2rem;
  height: 2rem;
  margin: 0 0.5rem;
  border-radius: 50%;
  border: 2px solid #fff;
  cursor: pointer;
}
.slider-pagi__elem:before {
  content: "";
  position: absolute;
  left: 50%;
  top: 50%;
  width: 1.2rem;
  height: 1.2rem;
  background: #fff;
  border-radius: 50%;
  transition: transform 0.3s;
  transform: translate(-50%, -50%) scale(0);
}
.slider-pagi__elem.active:before, .slider-pagi__elem:hover:before {
  transform: translate(-50%, -50%) scale(1);
}

.slider {
  z-index: 1;
  position: relative;
  height: 100%;
}
.slider.animating {
  transition: transform 0.5s;
  will-change: transform;
}
.slider.animating .slide__bg {
  transition: transform 0.5s;
  will-change: transform;
}

.slide {
  position: absolute;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
}
.slide.active .slide__overlay,
.slide.active .slide__text {
  opacity: 1;
  transform: translateX(0);
}
.slide__bg {
  position: absolute;
  top: 0;
  left: -50%;
  width: 100%; /* This might need to be 200% or more if left is -50% and you want full coverage + parallax */
  height: 100%;
  background-color:var(--color-secondary-500);
  background-size: cover;
  background-position: top right; 
  background-repeat:no-repeat;/* Ensure the image is centered */
  will-change: transform;
  /* transition: transform 0.5s; already handled by .slider.animating .slide__bg */
}
.slide:nth-child(1) {
  left: 0;
}
.slide:nth-child(1) .slide__bg {
  left: 0;
  background-image: url("https://i.imgur.com/igp9ZTZ.jpg");
}
/* .slide:nth-child(1) .slide__overlay-path {
  fill: #303030; // Now dynamic via :style
} */
@media (max-width: 991px) {
  .slide:nth-child(1) .slide__text {
    background-color: rgba(48, 48, 48, 0.7); /* Example with opacity */
  }
}
.slide:nth-child(2) {
  left: 100%;
}
.slide:nth-child(2) .slide__bg {
  left: -50%; /* This positions the background relative to the slide start */
  background-image: url("https://i.imgur.com/AxH0QU1.jpg");
}
/* .slide:nth-child(2) .slide__overlay-path {
  fill: #303030; // Now dynamic
} */
@media (max-width: 991px) {
  .slide:nth-child(2) .slide__text {
    background-color: rgba(48, 48, 48, 0.7);
  }
}
.slide:nth-child(3) {
  left: 200%;
}
.slide:nth-child(3) .slide__bg {
  left: -100%; /* Adjust if background images are wider */
  background-image: url("https://i.imgur.com/nHIM5ZD.jpg");
}
/* .slide:nth-child(3) .slide__overlay-path {
  fill: #303030; // Now dynamic
} */
@media (max-width: 991px) {
  .slide:nth-child(3) .slide__text {
    background-color: rgba(48, 48, 48, 0.7);
  }
}
.slide:nth-child(4) {
  left: 300%;
}
.slide:nth-child(4) .slide__bg {
  left: -150%; /* Adjust if background images are wider */
  background-image: url("https://i.imgur.com/NPvJcyJ.jpg");
}
/* .slide:nth-child(4) .slide__overlay-path {
  fill: #303030; // Now dynamic
} */
@media (max-width: 991px) {
  .slide:nth-child(4) .slide__text {
    background-color: rgba(48, 48, 48, 0.7);
  }
}
.slide__content {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
.slide__overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  height: 100%;
  min-height: 810px;
  transition: transform 0.5s 0.5s, opacity 0.2s 0.5s;
  will-change: transform, opacity;
  transform: translate3d(-20%, 0, 0);
  opacity: 0;
}
@media (max-width: 991px) {
  .slide__overlay {
    display: none;
  }
}
.slide__overlay path {
  opacity: 0.8;
}
.slide__text {
  position: absolute;
  width: 25%;
  bottom: 15%;
  left: 5%;
  color: var(--color-secondary-100);
  transition: transform 0.5s 0.8s, opacity 0.5s 0.8s;
  will-change: transform, opacity;
  transform: translateY(-50%);
  opacity: 0;
  font-family: 'Roboto', sans-serif; /* Apply to container */
}
@media (max-width: 991px) {
  .slide__text {
    left: 0;
    bottom: 0;
    width: 100%;
    height: 20rem;
    text-align: left;
    transform: translateY(50%);
    transition: transform 0.5s 0.5s, opacity 0.5s 0.5s;
    padding: 0 0.5rem;
  }
}
.slide__text-heading {
  /* font-family inherit from .slide__text */
  font-size: 5rem;
  margin-bottom: 1.6rem;
}
@media (max-width: 991px) {
  .slide__text-heading {
    line-height: 10rem;
    font-size: 3.5rem;
  }
}
.slide__text-desc {
  /* font-family inherit */
  font-size: 1.2rem;
  font-style: bold;
  margin-bottom: 1.5rem;
}
@media (max-width: 991px) {
  .slide__text-desc {
    display: none;
  }
}
.slide__text-link {
  z-index: 5;
  display: inline-block;
  position: relative;
  padding: 0.5rem;
  cursor: pointer;
  /* font-family inherit */
  font-size: 2.3rem;
  perspective: 1000px;
}
@media (max-width: 991px) {
  .slide__text-link {
    margin: -2rem 0 8rem;
  }
}
.slide__text-link:before {
  z-index: -1;
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: #000;
  transform-origin: 50% 100%;
  transform: rotateX(-85deg);
  transition: transform 0.3s;
  will-change: transform;
}
.slide__text-link:hover:before {
  transform: rotateX(0);
}
</style>