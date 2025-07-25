<template>
    <section class="flex flex-col items-center pt-16 justify-center">
        <h1 class="text-7xl font-bold text-[var(--color-text-primary)] mb-4">
            Website Guide
        </h1>
        <img
            src="/assets/images/Z2sbZpbqstJ980jJ_NLMAF_LOGO_2shues_smallcropped.jpeg"
            alt="No Limits Martial Arts and Fitness Logo"
            class="w-48 h-48 mb-4 rounded-full"
        />
    </section>

    <section class="w-full mt-20 max-w-xl mx-auto">
        <!-- Tab Buttons -->
        <nav class="p-2 rounded-t-lg">
            <div class="flex justify-center space-x-4">
                <button
                    :class="[
                        'px-4 py-2 text-[var(--color-text-primary)] font-semibold border-b-4 border-[var(--color-primary-base)] hover:text-[var(--color-base-900)] hover:bg-[var(--color-primary-base)] focus:outline-none tab-button',
                        { active: activeTab === 'tab1' },
                    ]"
                    @click="activeTab = 'tab1'"
                >
                    Creating and Editing Content
                </button>
                <button
                    :class="[
                        'px-4 py-2 text-[var(--color-text-primary)] font-semibold border-b-4 border-[var(--color-primary-base)] hover:text-[var(--color-base-900)] hover:bg-[var(--color-primary-base)] focus:outline-none tab-button',
                        { active: activeTab === 'tab2' },
                    ]"
                    @click="activeTab = 'tab2'"
                >
                    User Mangement
                </button>
                <button
                    :class="[
                        'px-4 py-2 text-[var(--color-text-primary)] font-semibold border-b-4 border-[var(--color-primary-base)] hover:text-[var(--color-base-900)] hover:bg-[var(--color-primary-base)] focus:outline-none tab-button',
                        { active: activeTab === 'tab3' },
                    ]"
                    @click="activeTab = 'tab3'"
                >
                    Tab 3
                </button>
            </div>
        </nav>
    </section>
    <div
        v-show="activeTab === 'tab1'"
        class="p-4 tab-content bg-[var(--color-surface-70)] shadow-md rounded-lg"
    >
        <h2 class="text-2xl font-semibold mb-2 text-blue-700">Tab 1 Content</h2>
        <p>
            Vestibulum condimentum imperdiet velit nec ornare. Nullam lobortis
            urna posuere quam porta consequat. Donec commodo diam lectus, sit
            amet tempor dolor scelerisque eget. Vestibulum at lectus dui.
            Maecenas consectetur tempor ipsum non porttitor. Cras accumsan
            mattis aliquam. Fusce eleifend maximus elit facilisis condimentum.
            Mauris non risus sed ligula convallis fermentum.
            <br />
            Quisque eu purus nunc. Ut eget ligula ac lorem laoreet scelerisque
            in ut nulla. Quisque volutpat elit eget tellus pharetra, vel
            sollicitudin velit scelerisque. Vivamus ac libero eu nunc congue
            malesuada eu vitae est.
        </p>
    </div>
    <div
        v-show="activeTab === 'tab2'"
        class="p-4 tab-content bg-[var(--color-surface-70)) shadow-md rounded-lg"
    >
        <h2
            class="text-2xl font-semibold mb-2 text-[var(--color-text-primary)]"
        >
            Tab 2 Content
        </h2>
        <p>
            Phasellus eget euismod libero, nec ullamcorper justo. Phasellus eget
            euismod libero, nec ullamcorper justo. Phasellus eget euismod
            libero, nec ullamcorper justo. Etiam eget augue in ante gravida
            facilisis.
        </p>
    </div>
    <div
        v-show="activeTab === 'tab3'"
        class="p-4 tab-content bg-white shadow-md rounded-lg"
    >
        <h2 class="text-2xl font-semibold mb-2 text-blue-700">Tab 3 Content</h2>
        <p>Tab 3 content goes here.</p>
    </div>
</template>
<script setup lang="ts">
import { ref } from "vue";

const activeTab = ref("tab1");
</script>
<style>
.tab-button.active {
    background-color: var(--color-surface-70);
    border-color: var(--color-secondary-500);
    color: var(--color-text-primary);
}

.tab-content {
    background-color: var(--color-surface-70);
}
</style>
