<template>
    <Head :item="item"></Head>

    <h1>
        <TextGenerate
            :words="words"
            :duration="2.5"
            class="text-[var(--color-text-primary)] mb-12 pt-12 text-5xl md:text-7xl"
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
                <span
                    v-if="
                        $page.props.auth.user && $page.props.auth.user.profile
                    "
                >
                    {{
                        $page.props.auth.user.profile.tkd_member
                            ? "Member"
                            : "Non-Member"
                    }}
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
                Learn More About Taekwondo at No Limits Martial Arts and Fitness
            </h2>
            <div v-if="item?.blocks && Array.isArray(item.blocks) && item.blocks.length > 0">
                <div v-for="(block, index) in item.blocks" :key="index">
                    <BlockCommonCards
                        v-if="block.type === 'common-cards'"
                        :block="block"
                    />
                </div>
            </div>
     
   
        </article>
        <article class="w-1/4 mx-auto pt-20 pb-20">
        <h2 class="text-center text-3xl pb-5">Ready to Get Started?</h2>
     <SignUpButton />


        </article>
    </section>



</template>
<script setup lang="ts">
import Head from "@/Components/Theme/Head.vue";
import { computed, onMounted, defineAsyncComponent, onBeforeUnmount, ref } from "vue";
import TextGenerate from "@/Components/Theme/UI/TextGenerate.vue";
import {Link} from "@inertiajs/vue3";
import IconButton from "@/Components/Theme/UI/IconButton.vue";
import { usePage, router } from "@inertiajs/vue3";
import Default from "@/Layouts/Default.vue";
import SignUpButton from "@/Components/SignUpButton.vue";
import ButtonLink from "@/Components/ButtonLink.vue";
defineOptions({
    layout: Default,
});
interface Props {
    item: Model.Page;
}

const props = defineProps<Props>();
const page = usePage();
const tkdMember = computed(() => {
    if (
        page.props.auth.user.profile.programs
            .map((program) => program.title)
            .includes("Taekwondo")
    ) {
        return true;
    } else {
        return false;
    }
});
const BlockCommonCards = defineAsyncComponent(() =>
    import("@/Components/Theme/Block/Common/Cards.vue")
);

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
        .filter(([id, requirement]) => requirement.type === "poomsae")
        .map(([id, requirement]) => ({ ...requirement, id }));
});

const ssd = computed(() => {
    const progress = page.props.auth.user.profile.requirements_progress;
    if (!progress) return [];
    return Object.entries(progress)
        .filter(
            ([id, requirement]) => requirement.type === "sparring_self-defense"
        )
        .map(([id, requirement]) => ({ ...requirement, id }));
});

const breaking = computed(() => {
    const progress = page.props.auth.user.profile.requirements_progress;
    if (!progress) return [];
    return Object.entries(progress)
        .filter(([id, requirement]) => requirement.type === "breaking")
        .map(([id, requirement]) => ({ ...requirement, id }));
});

const knowledge = computed(() => {
    const progress = page.props.auth.user.profile.requirements_progress;
    if (!progress) return [];
    return Object.entries(progress)
        .filter(([id, requirement]) => requirement.type === "knowledge")
        .map(([id, requirement]) => ({ ...requirement, id }));
});

const other = computed(() => {
    const progress = page.props.auth.user.profile.requirements_progress;
    if (!progress) return [];
    return Object.entries(progress)
        .filter(([id, requirement]) => requirement.type === "other")
        .map(([id, requirement]) => ({ ...requirement, id }));
});

const allRequirements = computed(() => {
    return [
        ...poomsae.value,
        ...ssd.value,
        ...breaking.value,
        ...knowledge.value,
        ...other.value,
    ];
});

const completedRequirements = computed(() => {
    return allRequirements.value.filter((req) => req.completed).length;
});

const progressPercentage = computed(() => {
    const total = allRequirements.value.length;
    return total > 0
        ? Math.round((completedRequirements.value / total) * 100)
        : 0;
});

const canApplyToTest = computed(() => {
    return progressPercentage.value === 100;
});

const updateRequirement = (requirementId: string, completed: boolean) => {
    console.log("Updating requirement:", requirementId, completed);
    console.log("Type of requirementId:", typeof requirementId);
    console.log("Sample item from poomsae:", poomsae.value[0]);

    if (!requirementId) {
        console.error("No requirement ID provided");
        return;
    }

    router.put(
        `/profile/${page.props.auth.user.profile.id}/requirements`,
        {
            requirement_id: String(requirementId),
            completed: completed,
        },
        {
            preserveState: true,
            preserveScroll: true,
            onError: (errors) => {
                console.error("Update failed:", errors);
            },
            onSuccess: () => {
                console.log("Update successful");
            },
        }
    );
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
        if (
            !found &&
            rect.top < windowHeight * 0.6 &&
            rect.bottom > windowHeight * 0.4
        ) {
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
    background: linear-gradient(
        334deg,
        var(--color-base-500),
        var(--color-base-700),
        var(--color-base-900)
    );
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

    color: var(--color-surface-base);
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
    height: 60vh;
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
.app {
    background-color: rgba(from var(--color-surface-70) R G B / 0.5);
    backdrop-filter: blur(20px) saturate(150%);
    padding-bottom: 2rem;
}

.title {
    background-color: rgba(from var(--color-surface-70) R G B / 0.5);
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
    background: var(--color-surface-base);
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
    background: var(--color-surface-base);
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
