<template>
        <Head :item="item"></Head>
       


    <h1 >
        <TextGenerate
            :words="words"
            :duration="2.5"
            class="text-[var(--color-text-primary)] mb-12 mt-12  text-5xl md:text-7xl "
        />
    </h1>
    <div class="section-dots">
  <span
    v-for="(headline, idx) in headlines"
    :key="idx"
    :class="['dot', { active: currentSection === idx }]"
  ></span>
</div>
    <section
        v-for="(headline, index) in headlines"
        :key="index"
        class="hero mb-8"
    >
        <div class="hero-inner" :id="'section-' + index">
            <figure
                :style="{ backgroundImage: 'url(' + headline.image + ')' }"
                class="hero__image"
            ></figure>
            <div class="headline-stack">
  
                <h2
                    class="hero__title"
                    :class="{ 'is-hidden': descriptionActive[index] }"
                    ref="titleRefs"
                >
                    {{ headline.title }}
                </h2>
                <div
                    class="hero__description-container"
                    :class="{ 'is-active': descriptionActive[index] }"
                    :ref="(el) => (horizontalRefs[index] = el)"
                >
                    <div class="ct">
                        <p class="hero__description">
                            {{ headline.description }}
                        </p>
                    </div>
                </div>
            </div>
            </div>
     
    </section>
    <section class="content">
        <article class="content-inner">
            <h2 class="content__title">
                Taekwondo is More Than Just a Martial Art
                <span v-if="$page.props.auth.user && $page.props.auth.user.profile">
                    {{ $page.props.auth.user.profile.tkd_member ? 'Member' : 'Non-Member' }}
                </span>
            </h2>
            <p class="text-2xl">
                Originating in Korea over 2,000 years ago, Taekwondo is a
                martial art that combines combat techniques, self-defense,
                sport, and exercise. The name "Taekwondo" is derived from the
                Korean words "Tae" (foot), "Kwon" (fist), and "Do" (way of
                life). This powerful yet graceful martial art is known for its
                high-flying kicks, swift strikes, and dynamic movements. But
                taekwondo is so much more, with regular practice, it can improve
                your overall health and well-being. Our Taekwondo classes are
                designed for students of all ages, from young children to
                adults. Whether you are a beginner looking to learn the basics
                or an experienced practitioner aiming to refine your skills, our
                expert instructors will guide you every step of the way.
            </p>
        </article>
        <article class="content__inner">
            <h2 class="content__title mt-12">
                Why Choose Our Taekwondo Classes?
            </h2>
            <p class="text-2xl">
                Our Taekwondo classes offer a unique blend of physical fitness,
                mental discipline, and self-defense skills. Here are some of the
                key benefits you can expect:
            </p>
            <div class="flex content-center ml-8 justify-center">
            <ul class="flex flex-1 gap-8 p-8 md:p-16 ">
            <li class="relative px-5 pt-10 pb-2 flex flex-col justify-start items-center bg- border-2 border-[var(--color-accent)] rounded-xl text-[var(--color-text-primary)] max-w-[30rem] bg-[var(--color-primary-800)]">
             <span class="absolute -top-6 p-3 border-2 border-[var(--color-accent)] rounded-full  bg-[var(--color-primary-800)]">
             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd"><path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="M12 2a9 9 0 0 1 9 9c0 3.074-1.676 5.59-3.442 7.395a20.4 20.4 0 0 1-2.876 2.416l-.426.29l-.2.133l-.377.24l-.336.205l-.416.242a1.87 1.87 0 0 1-1.854 0l-.416-.242l-.52-.32l-.192-.125l-.41-.273a20.6 20.6 0 0 1-3.093-2.566C4.676 16.589 3 14.074 3 11a9 9 0 0 1 9-9m0 2a7 7 0 0 0-7 7c0 2.322 1.272 4.36 2.871 5.996a18 18 0 0 0 2.222 1.91l.458.326q.222.155.427.288l.39.25l.343.209l.289.169l.455-.269l.367-.23q.293-.186.627-.417l.458-.326a18 18 0 0 0 2.222-1.91C17.728 15.361 19 13.322 19 11a7 7 0 0 0-7-7m0 3a4 4 0 1 1 0 8a4 4 0 0 1 0-8m0 2a2 2 0 1 0 0 4a2 2 0 0 0 0-4"/></g></svg>
             </span>
                <h3 class="my-1 text-[var(--color-text-primary)] uppercase tracking-wide border-b border-[var(--color-accent)] pb-2">
                Flexible Location
            </h3>
           <p class="pl-2 py-4 text-balance text-md">
            With location in Beaverdam, VA and J Sargeat Reynolds Community College*. We believe in bringing the fitness to you. Contact us, to learn about bringing our classes to your business, organization, or community.</p>
            </li>
            <li class="col-span-4 sm:col-span-2 lg:col-span-1 relative px-5 pt-10 pb-2 flex flex-col justify-start items-center bg- border-2 border-[var(--color-accent)] rounded-xl text-[var(--color-text-primary)] max-w-[30rem] bg-[var(--color-primary-800)]">
             <span class="absolute -top-6 p-3 border-2 border-[var(--color-accent)] rounded-full  bg-[var(--color-primary-800)]">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none"><path d="M0 0h24v24H0z"/><path fill="currentColor" d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2m0 2a8 8 0 1 0 0 16a8 8 0 0 0 0-16m0 2a1 1 0 0 1 .993.883L13 7v1h2a1 1 0 0 1 .117 1.993L15 10h-5a.5.5 0 0 0-.09.992L10 11h4a2.5 2.5 0 0 1 .164 4.995L14 16h-1v1a1 1 0 0 1-1.993.117L11 17v-1H9a1 1 0 0 1-.117-1.993L9 14h5a.5.5 0 0 0 .09-.992L14 13h-4a2.5 2.5 0 0 1-.164-4.995L10 8h1V7a1 1 0 0 1 1-1"/></g></svg>
            </span>
          <h3 class="my-1 text-[var(--color-text-primary)] uppercase tracking-wide border-b border-[var(--color-accent)] pb-2">Affordable</h3>
       <p class="py-4 pl-2 text-balance text-md">
            Whether you pay per class or monthly in advance, our rates are designed to make fitness accessible to everyone.
            </p>
            </li>
                <li class="relative px-5 pt-10 pb-2 flex flex-col justify-start items-center bg- border-2 border-[var(--color-accent)] rounded-xl text-[var(--color-text-primary)] max-w-[30rem] bg-[var(--color-primary-800)]">
             <span class="absolute -top-6 p-3 border-2 border-[var(--color-accent)] rounded-full  bg-[var(--color-primary-800)]">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd"><path d="m12.594 23.258l-.012.002l-.071.035l-.02.004l-.014-.004l-.071-.036q-.016-.004-.024.006l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.016-.018m.264-.113l-.014.002l-.184.093l-.01.01l-.003.011l.018.43l.005.012l.008.008l.201.092q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.003-.011l.018-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="M12 12c1.873 0 3.57.62 4.815 1.487c1.183.825 2.185 2.051 2.185 3.37c0 .724-.309 1.324-.796 1.77c-.458.421-1.056.694-1.672.88C15.301 19.88 13.68 20 12 20s-3.301-.12-4.532-.493c-.616-.186-1.214-.459-1.673-.88C5.31 18.182 5 17.582 5 16.858c0-1.319 1.002-2.545 2.185-3.37C8.43 12.62 10.127 12 12 12m0 2c-1.44 0-2.743.48-3.67 1.127c-.989.69-1.33 1.392-1.33 1.73c0 .304.352.494.672.614l.205.07l.17.052c.94.284 2.32.407 3.953.407c1.508 0 2.799-.105 3.728-.344l.304-.087l.19-.06c.343-.117.778-.314.778-.652s-.341-1.04-1.33-1.73C14.744 14.481 13.44 14 12 14m7-1c1.044 0 1.992.345 2.693.833c.64.447 1.307 1.19 1.307 2.096c0 1.335-1.297 1.813-2.463 1.98l-.3.037l-.289.025l-.138.008c.122-.345.19-.72.19-1.122a3.8 3.8 0 0 0-.107-.888c.386-.03.703-.08.939-.151c.104-.032.01-.13-.1-.215l-.107-.078l-.076-.051a2.7 2.7 0 0 0-.995-.418c-.38-.76-.964-1.418-1.586-1.943A4.8 4.8 0 0 1 19 13M5 13q.537.002 1.032.113c-.622.525-1.206 1.183-1.586 1.943a2.7 2.7 0 0 0-.995.418l-.128.088c-.127.092-.276.22-.155.256c.236.071.553.122.94.151a3.7 3.7 0 0 0-.108.888c0 .402.068.777.19 1.122l-.28-.02l-.296-.03c-1.202-.147-2.614-.607-2.614-2c0-.905.666-1.649 1.307-2.096A4.76 4.76 0 0 1 5 13m13.5-6a2.5 2.5 0 1 1 0 5a2.5 2.5 0 0 1 0-5m-13 0a2.5 2.5 0 1 1 0 5a2.5 2.5 0 0 1 0-5M12 3a4 4 0 1 1 0 8a4 4 0 0 1 0-8m6.5 6a.5.5 0 1 0 0 1a.5.5 0 0 0 0-1m-13 0a.5.5 0 1 0 0 1a.5.5 0 0 0 0-1M12 5a2 2 0 1 0 0 4a2 2 0 0 0 0-4"/></g></svg>
            </span>
            <h3 class="my-1 text-[var(--color-text-primary)] uppercase tracking-wide border-b border-[var(--color-accent)] pb-2">
            Made for Everyone</h3>
         <p class="py-4 text-balance pl-2 text-md">
            Encorporating best practice in martial arts with the science of teacching and learning, our classess meet you where you are and help you to grow to where you want to be.
            </p>
            </li>
            </ul>
            </div>
        </article>
<article class="w-1/4 mx-auto">
<IconButton href="/programs/taekwondo/application">Sign Up</IconButton>
</article>
    </section>

    <div
        v-if="
            item?.blocks && Array.isArray(item.blocks) && item.blocks.length > 0
        "
    >
        <div v-for="(block, index) in item.blocks" :key="index">
            <BlockCommonText
                v-if="block.type === 'common-text'"
                :block="block"
            ></BlockCommonText>
            
        </div>
        
        </div>
  
     
   
 
</template>
<script setup lang="ts">
import Head from '@/Components/Theme/Head.vue';
import { computed, onMounted, onBeforeUnmount ,  ref} from 'vue';
import TextGenerate from '@/Components/Theme/UI/TextGenerate.vue';


import IconButton from '@/Components/Theme/UI/IconButton.vue';
import {usePage, router} from "@inertiajs/vue3";
import Default from '@/Layouts/Default.vue';

defineOptions({
    layout: Default
})
interface Props {
    item: Model.Page
}

const props = defineProps<Props>();
const page = usePage();
const tkdMember = computed(()=>{
    if (page.props.auth.user.profile.programs.map((program)=>program.title).includes('Taekwondo')) {
        return true;
    } else {
        return false;
    }
})



const isLinkActive = (linkUrl) => {
    const currentPathValue = getCurrentPath.value;
    if (linkUrl === "/") {
        return currentPathValue === "/";
    }
    return currentPathValue === linkUrl;
};
const poomsae = computed(() => {
    const progress = page.props.auth.user.profile.requirements_progress;
    if (!progress) return [];
    return Object.entries(progress)
        .filter(([id, requirement]) => requirement.type === 'poomsae')
        .map(([id, requirement]) => ({ ...requirement, id }));
});

const ssd = computed(() => {
    const progress = page.props.auth.user.profile.requirements_progress;
    if (!progress) return [];
    return Object.entries(progress)
        .filter(([id, requirement]) => requirement.type === 'sparring_self-defense')
        .map(([id, requirement]) => ({ ...requirement, id }));
});

const breaking = computed(() => {
    const progress = page.props.auth.user.profile.requirements_progress;
    if (!progress) return [];
    return Object.entries(progress)
        .filter(([id, requirement]) => requirement.type === 'breaking')
        .map(([id, requirement]) => ({ ...requirement, id }));
});

const knowledge = computed(() => {
    const progress = page.props.auth.user.profile.requirements_progress;
    if (!progress) return [];
    return Object.entries(progress)
        .filter(([id, requirement]) => requirement.type === 'knowledge')
        .map(([id, requirement]) => ({ ...requirement, id }));
});

const other = computed(() => {
    const progress = page.props.auth.user.profile.requirements_progress;
    if (!progress) return [];
    return Object.entries(progress)
        .filter(([id, requirement]) => requirement.type === 'other')
        .map(([id, requirement]) => ({ ...requirement, id }));
});

const allRequirements = computed(() => {
    return [...poomsae.value, ...ssd.value, ...breaking.value, ...knowledge.value, ...other.value];
});

const completedRequirements = computed(() => {
    return allRequirements.value.filter(req => req.completed).length;
});

const progressPercentage = computed(() => {
    const total = allRequirements.value.length;
    return total > 0 ? Math.round((completedRequirements.value / total) * 100) : 0;
});

const canApplyToTest = computed(() => {
    return progressPercentage.value === 100;
});

const updateRequirement = (requirementId: string, completed: boolean) => {
    console.log('Updating requirement:', requirementId, completed);
    console.log('Type of requirementId:', typeof requirementId);
    console.log('Sample item from poomsae:', poomsae.value[0]);
    
    if (!requirementId) {
        console.error('No requirement ID provided');
        return;
    }
    
    router.put(`/profile/${page.props.auth.user.profile.id}/requirements`, {
        requirement_id: String(requirementId),
        completed: completed
    }, {
        preserveState: true,
        preserveScroll: true,
        onError: (errors) => {
            console.error('Update failed:', errors);
        },
        onSuccess: () => {
            console.log('Update successful');
        }
    });
};


const words = "What Can Taekwondo Do For You?";
const headlines = [
    {
        title: "Enhance Physical Fitness",
        description:
            "Improve your strength, flexibility, and endurance through dynamic workouts.",
        image: "/assets/images/physical.png",
    },
    {
        title: "Boost Mental Clarity",
        description:
            "Develop focus, discipline, and resilience, reducing stress and enhancing mental clarity.",
        image: "/assets/images/mental.jpg",
    },
    {
        title: "Build Self-Confidence",
        description:
            "Gain a sense of accomplishment and self-assurance as you progress through the ranks and achieve your goals.",
        image: "/assets/images/confidence.jpg",
    },
    {
        title: "Foster Community",
        description:
            "Join a supportive and welcoming community where you can make new friends and build lasting relationships",
        image: "/assets/images/community.jpg",
    },
];




// --- Horizontal scroll on vertical scroll logic ---
const horizontalRefs = ref<HTMLElement[]>([]);
const titleRefs = ref<HTMLElement[]>([]);
const descriptionActive = ref<boolean[]>([]);
const currentSection = ref(0);

function handleScroll() {
  let found = false;
  horizontalRefs.value.forEach((el, index) => {
    if (!el) return;
    const rect = el.getBoundingClientRect();
    const windowHeight = window.innerHeight;

    // Section is in view
    if (!found && rect.top < windowHeight * 0.6 && rect.bottom > windowHeight * 0.4) {
      currentSection.value = index;
      found = true;
    }

    if (rect.top < windowHeight * 0.5 && rect.bottom > windowHeight * 0.2) {
      descriptionActive.value[index] = true;
      const maxScroll = el.scrollWidth - el.clientWidth;
      const progress = Math.min(
        Math.max((windowHeight * 0.5 - rect.top) / rect.height, 0),
        1
      );
      el.scrollLeft = maxScroll * progress;
    } else {
      descriptionActive.value[index] = false;
    }
  });
}

onMounted(() => {
    // Initialize array
    descriptionActive.value = headlines.map(() => false);
    window.addEventListener("scroll", handleScroll, { passive: true });
});
onBeforeUnmount(() => {
    window.removeEventListener("scroll", handleScroll);
});

</script>

<style scoped>
.gradient {
    width: 100%;
    height: 100vh;
    background: linear-gradient(334deg, var(--color-base-500), var(--color-base-700), var(--color-base-900));
    background-size: 180% 190%;
    animation: gradient-animation 6s ease infinite;
}
@keyframes gradient-animation {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}
.section-dots {
  position: fixed;
  top: 50%;
  right: 2vw;
  transform: translateY(-50%);
  display: flex;
  flex-direction: column;
  gap: 1rem;
  z-index: 20;
  pointer-events: none;
}

.dot {
  width: 14px;
  height: 14px;
  border-radius: 50%;
  background: var(--color-base-100, #444);
  opacity: 0.4;
  transition: background 0.3s, opacity 0.3s, transform 0.3s;
}

.dot.active {
  background: var(--color-accent-500, #ffb300);
  opacity: 1;
  transform: scale(1.2);
}
p {
 
    line-height: 3rem;
    color: var(--color-text-primary);
}
figure {
    display: flex;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
}
.hero {
    position: relative;
    width: 100vw;
    height: 100vh;
}
.hero-inner {
    position: absolute;
    overflow: hidden;
    width: 100%;
    height: 100%;
    clip: rect(0, auto, auto, 0);
}
.headline-stack {
    position: relative;
    width: 100vw;
    height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    pointer-events: none;
    z-index: 3;
}
.hero__title {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    font-size: 8vw;
    letter-spacing: -0.125rem;
   
    color: var(--color-primary-500);
    text-shadow: 0 0 10px var(--color-accent-500);
    z-index: 2;
    pointer-events: none;
    margin-bottom: 4rem;
    opacity: 1;
    transform: none;
}
.hero__description-container {
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.5s, transform 0.5s;
    transform: translateY(40px);
    width: 100vw;
    display: flex;
    justify-content: center;
    align-items: center;
    background: none;
    position: relative;
    top: 0;
    left: 0;
    height: auto;
}
.hero__description-container.is-active {
    opacity: 1;
    pointer-events: auto;
    transform: translateY(0);
}
.ct {
    display: inline-block;
    min-width: 60vw;
    padding-left: 10vw;

    
}
.hero__description {
    font-size: 2.5rem;
    color: var(--color-secondary-200);
    display: inline-block;
    white-space: pre-wrap;
    margin: 0 auto;
    background: none;
}
.spane {
    width: 100vw;
    height:60vh;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    position: relative;
    z-index: 3;
}
.pane.an {
    overflow-x: auto;
    overflow-y: hidden;
    white-space: nowrap;
    width: 100vw;
    position: sticky;
    top: 30vh; /* Adjust as needed */
    background: var(--color-base-800, #181818);
    z-index: 2;
    padding: 2rem 0;
    margin-bottom: 8vh;
    scroll-behavior: smooth;
    border-radius: 1rem;
    box-shadow: 0 2px 24px 0 rgba(0, 0, 0, 0.12);
}
.content {
    position: relative;
    margin: 0 auto -5rem;
    padding: 3rem;
    border-bottom: 2px solid var(--color-accent-500);
    background-color: var(--color-base-800);
}
.content::before {
    content: "";
    display: block;
    position: absolute;
    top: -100px;
    left: 0;
    width: 100%;
    height: 100px;
    background-color: var(--color-base-800);
    clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
}
.content__Inner {
    margin: 0 auto;
    max-width: 700px;
}
.content__inner > * + * {
    margin-top: 1.5rem;
}
.content__title {
    font-size: 3rem;
    line-height: 1.25;
    letter-spacing: -0.125rem;
    text-align: center;
    color: var(--color-text-primary);
    margin-bottom: 2rem;
}
.app{
    background-color: rgba(from var(--color-primary-800) R G B / 0.5);
    backdrop-filter: blur(20px) saturate(150%);
    padding-bottom: 2rem;
}

.title{
    background-color: rgba(from var(--color-primary-800) R G B / 0.5);
    backdrop-filter: blur(10px) saturate(100%);
    -webkit-backdrop-filter: blur(10px);
}


icon {
    transition: var(--transition-medium);
    vertical-align: middle;
}

.chevron-icon {
    transition: transform var(--transition-medium);
}

.has-dropdown:hover .chevron-icon {
    transform: rotate(180deg);
}

/* Dropdown Menus */
.has-dropdown {
    position: relative;
}

.dropdown {
    position: absolute;
    top: calc(100% + 10px);
    left: 0;
    min-width: 220px;
    background: var(--color-primary-500);
    backdrop-filter: var(--glass-effect);
    -webkit-backdrop-filter: var(--glass-effect);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius);
    padding: 0.5rem;
    opacity: 0;
    visibility: hidden;
    transform: translateY(10px) scale(0.98);
    transition: all var(--transition-medium);
    box-shadow: 0 10px 30px var(--shadow-color);
    z-index: 100;
}

.has-dropdown:hover .dropdown {
    opacity: 1;
    visibility: visible;
    transform: translateY(0) scale(1);
}

.dropdown::before {
    content: "";
    position: absolute;
    top: -6px;
    left: 20px;
    width: 12px;
    height: 12px;
    background: var(--color-primary-500);
    border-left: 1px solid var(--border-color);
    border-top: 1px solid var(--border-color);
    transform: rotate(45deg);
    backdrop-filter: var(--glass-effect);
    -webkit-backdrop-filter: var(--glass-effect);
}

.dropdown li {
    list-style: none;
}

.dropdown a {
    color: var(--color-text-primary);
    text-decoration: none;
    padding: 0.7rem 1rem;
    display: block;
    border-radius: var(--border-radius);
    transition: all var(--transition-medium);
    margin-bottom: 2px;
}

.dropdown a:hover {
    background: rgba(244, 208, 63, 0.15);
    color: var(--color-secondary-500);
    transform: translateX(5px);
}


</style>
