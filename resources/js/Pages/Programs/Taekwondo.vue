<template>
        <Head :item="item"></Head>
              
        <div v-if="$page.props.auth.user !== null && tkdMember" class="flex w-full h-screen">
        <div class="grid-background"><div class="background-grid">
        </div>
        <Default>
                <div class="app max-w-[90vw] max-h-[860px] h-[90vh] mx-auto pb-10 flex flex-col overflow-hidden relative w-full rounded-[14px] backdrop-blur-[20px] ">
                <div class="flex grow-1 overflow-hidden ">
                <div class="basis-[240px] border-r-1 border-[var(--color-accent)] p-[26px] overflow-auto shrink-0 max-[945px]:hidden">
                 <div class="mt-[20px]  flex flex-col justify-center title rounded-2xl w-full ">
                 <div class="mb-[14px] text-center p-5">No Limits Martial Arts and Fitness</div>
   <img class="w-[75px] h-[75px] rounded-[50%] object-cover  border-2 border-[var(--color-accent)] ml-[22px]" src="page.props.auth.user.profile_photo_url" alt="page.props.auth.user.name">
   <div class="mt-12 ">
   <a href="/programs/taekwondo/videos" >Videos</a>
   
   </div>
                </div>
                                 </div>
                                    <div class=" w-full mt-5 grid grid-rows-4 grid-cols-4 " >
                                    <div class="ml-5 mr-2 text-4xl title col-span-2 p-5 rounded-2xl" >
                                    <h1 >Taekwondo</h1>
                                      <h2 class="text-2xl">{{ page.props.auth.user.profile.name }}</h2>
                                    </div>
 <div class="col-span-1 row-span-1 p-5 mr-2 rounded-2xl title">
   <h2 class="text-center mb-2 text-2xl">Current Belt </h2>
   <p class="text-lg leading-tight text-center">{{ page.props.auth.user.profile.current_belt_data.name }}</p>
</div>
 <div class="col-span-1 row-span-1 mr-5  p-5 rounded-2xl title">
   <h2 class="text-center mb-2 text-2xl">Next Belt</h2>
   <p class="text-lg text-center leading-tight">
{{ nextBelt }}
   </p>
</div>
   <div class="  col-span-1  ml-5 mt-2 p-5 rounded-2xl title ">
   <h2 class="text-center mb-2 text-2xl">School Motto</h2>
   <p class="text-lg leading-tight">Train with integrity, humility and heart. 
</p>
   </div>
<div class="col-span-3 mr-5 row-span-3 ml-2 mt-2 p-5 grid grid-cols-4 grid-rows-4 rounded-2xl title">
 <h2 class="col-span-4 row-span-1 mt-4 text-2xl">Requirements</h2>

<div class=" col-span-1 row-span-2 align-center ">
 <h3 v-if="poomsae && poomsae.length > 0" class="font-bold mt-8 mb-4 text-lg">Poomsae:</h3>
 <div v-for="item in poomsae" :key="item.id" >
 <Input type="checkbox" v-model="item.completed" /> <span class="ml-2 text-balance ">{{ item.requirement_name }}</span>
 </div>
</div>
<div class=" flex flex-col  row-span-2 align-center px-4 overflow-auto">
 <h3 v-if="ssd && ssd.length > 0" class="font-bold mb-4 mt-8 text-lg">Sparring/Self-Defense:</h3>
    <div v-for="item in ssd" :key="item.id" >
    <Input type="checkbox" v-model="item.completed" /> <span class="ml-2">{{ item.requirement_name }}</span>
    </div>
</div>
<div class=" flex flex-col row-span-2 align-center px-10 ">
    <h3 v-if="breaking && breaking.length > 0" class="font-bold  mb-4 mt-8 text-lg">Breaking:</h3>
    <div v-for="item in breaking" :key="item.id" >
    <Input type="checkbox" v-model="item.completed" /> <span class="ml-2">{{ item.requirement_name }}</span>
    </div>  
</div>
<div class=" flex flex-col row-span-2 align-center ">
    <h3 v-if="knowledge && knowledge.length > 0" class="font-bold mb-4 mt-8  text-lg">Knowledge:</h3>
    <div v-for="item in knowledge" :key="item.id">
    <Input type="checkbox" v-model="item.completed" /> <span class="ml-2">{{ item.requirement_name }}</span>
    </div>
</div>
<div class=" flex flex-col row-span-2 align-center ">
    <h3 v-if="other && other.length > 0" class="font-bold mb-4 mt-8 flex justify-center align-center text-lg">Other:</h3>
    <div v-for="item in other" :key="item.id" >
    <Input type="checkbox" v-model="item.completed" /> <span class="ml-2">{{ item.requirement_name }}</span>
    </div>  
    </div>
<div class="grid grid-cols-2 col-span-4 grid-rows-4 grid-flow-row">
   <h3 class="text-lg font-bold mb-2 col-span-4 row-span-1">Progress to Next Belt</h3>
   <div class="w-full bg-gray-200 col-span-4 row-span-2 rounded-full h-6 mb-4 relative">
     <div class="bg-[var(--color-accent)] h-6 rounded-full transition-all duration-300 flex items-center justify-center text-xs text-white font-medium" :style="{ width: progressPercentage + '%' }">
       <span v-if="progressPercentage > 20">{{ completedRequirements }}/{{ allRequirements.length }} ({{ progressPercentage }}%)</span>
     </div>
     <div v-if="progressPercentage <= 20" class="absolute inset-0 flex items-center justify-center text-xs text-gray-600">
       {{ completedRequirements }}/{{ allRequirements.length }} ({{ progressPercentage }}%)
     </div>
   </div>
  <div class="col-span-1 row-span-1">
   <a 
     :href="canApplyToTest ? '/testing-app' : '#'"
     :class="[
       'px-6 py-2 rounded-lg text-white font-medium transition-all',
       canApplyToTest ? 'bg-[var(--color-accent)] hover:bg-[var(--color-accent-dark)] cursor-pointer' : 'bg-gray-400 cursor-not-allowed'
     ]"
     :disabled="!canApplyToTest"
   >
     Apply to Test
   </a>
  </div>
 </div>


 </div>

 
 <!-- Progress Bar and Test Button -->
 


 





   <div class="col-span-1 row-span-3 ml-5 mt-2 p-5 rounded-2xl title">
   <h2 class="text-center mb-2 text-2xl">Student Oath</h2>
   <p class="text-lg leading-tight text-balance ">		
I will come to each class with an open mind and loving spirit.
I will honor martial arts tradition, unaffected by the expectations of others.
I will set goals and work hard to achieve them.
My only limitation is myself.
</p>
 </div>
 
   </div>
   </div>
 </div>
               
        </Default>
        </div>
        </div>
<div v-else><Default>
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
  
     
   
    </Default></div>
</template>
<script setup lang="ts">
import Head from '@/Components/Theme/Head.vue';
import { computed, onMounted, onBeforeUnmount , defineAsyncComponent, ref} from 'vue';
import Default from '../../Layouts/Default.vue';
import TextGenerate from '@/Components/Theme/UI/TextGenerate.vue';

import {usePage} from "@inertiajs/vue3";
interface Props {
    item: Model.Page
}
const belts = [
    {id: 1, name: 'No Belt'},
    {id: 2, name: 'White'},
    {id: 3, name: 'Yellow'},
    {id: 4, name: 'Orange'},
    {id: 5, name: 'Green'},
    {id: 6, name: 'Blue'},
    {id: 7, name: 'Purple'},
    {id: 8, name: 'Brown'},
    {id: 9, name: 'Red'},
    {id: 10, name: 'Red / Black stripe'},
    {id: 11, name: 'Black'},
]

const props = defineProps<Props>();
const page = usePage();
const tkdMember = computed(()=>{
    if (page.props.auth.user.profile.programs.map((program)=>program.title).includes('Taekwondo')) {
        return true;
    } else {
        return false;
    }
})
const nextBelt = computed(() => {
    const currentPosition = page.props.auth.user.profile.current_belt_data?.position;
    if (!currentPosition) return 'No Next Belt';
    
    const next = belts.find(belt => belt.id === currentPosition + 1);
    console.log('Next Belt:', next.name);
    return next ? next.name : 'No Next Belt';
});
const poomsae = computed(() => {
    return page.props.auth.user.profile.current_belt_data?.requirements?.filter(requirement => requirement.requirement_type === 'poomsae') || [];
});

const ssd = computed(() => {
    return page.props.auth.user.profile.current_belt_data?.requirements?.filter(requirement => requirement.requirement_type === 'sparring_self-defense') || [];
});

const breaking = computed(() => {
    return page.props.auth.user.profile.current_belt_data?.requirements?.filter(requirement => requirement.requirement_type === 'breaking') || [];
});

const knowledge = computed(() => {
    return page.props.auth.user.profile.current_belt_data?.requirements?.filter(requirement => requirement.requirement_type === 'knowledge') || [];
});

const other = computed(() => {
    return page.props.auth.user.profile.current_belt_data?.requirements?.filter(requirement => requirement.requirement_type === 'other') || [];
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


const BlockCommonHeading = defineAsyncComponent(
    () => import("../../Components/Theme/Block/Common/Heading.vue")
);
const BlockCommonText = defineAsyncComponent(
    () => import("../../Components/Theme/Block/Common/Text.vue")
);
const BlockCommonBento = defineAsyncComponent(
    () => import("../../Components/Theme/Block/Common/Bento.vue")
);
const BlockCommonHero = defineAsyncComponent(
    () => import("../../Components/Theme/Block/Common/Hero.vue")
);
const BlockCommonFeature = defineAsyncComponent(
    () => import("../../Components/Theme/Block/Common/Feature.vue")
);

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
    background-color: rgba(from var(--color-primary-900) R G B / 0.3);
    backdrop-filter: blur(20px) saturate(150%);
}

.title{
    background-color: rgba(from var(--color-primary-500) R G B / 0.2);
    backdrop-filter: blur(10px) saturate(150%);
    -webkit-backdrop-filter: blur(10px);
}

.grid-background {
    height: 125%;
    background: radial-gradient(ellipse at bottom, #5091DD 0%, #030617 100%);
    position: relative;
}

.background-grid {
    width: 100%;
    height: 1px;
    box-shadow: 0px 0px #030617, 0px 0px #030617, 0px 3px #030617, 0px 6px #030617, 0px 9px #030617, 0px 12px #030617, 0px 15px #030617, 0px 18px #030617, 0px 21px #030617, 0px 24px #030617, 0px 27px #030617, 0px 30px #030617, 0px 33px #030617, 0px 36px #030617, 0px 39px #030617, 0px 42px #030617, 0px 45px #030617, 0px 48px #030617, 0px 51px #030617, 0px 54px #030617, 0px 57px #030617, 0px 60px #030617, 0px 63px #030617, 0px 66px #030617, 0px 69px #030617, 0px 72px #030617, 0px 75px #030617, 0px 78px #030617, 0px 81px #030617, 0px 84px #030617, 0px 87px #030617, 0px 90px #030617, 0px 93px #030617, 0px 96px #030617, 0px 99px #030617;
}



</style>
