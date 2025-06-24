<script setup lang="ts">
import Head from "../Components/Theme/Head.vue";
import { defineAsyncComponent, onMounted, onUnmounted, ref } from "vue";
import Default from "../Layouts/Default.vue";
import { useForm } from "@inertiajs/vue3";
import IconButton from "../Components/Theme/UI/IconButton.vue";
import InputError from "../Components/InputError.vue";
interface Props {
    item: Model.page;
}

const props = defineProps<Props>();
const form = useForm({
    first_name: "",
    last_name: "",
    email: "",
    phone: "",
    subject: "",
    message: "",
});
const submit = () => {
    form.post(route("contact"), {
        onFinish: () => {
            form.reset("message");
        },
    });
};
// Update the import path below to match the actual file location and casing
const BlockCommonHero = defineAsyncComponent(
    () => import("../Components/Theme/Block/Common/Hero.vue")
);
const BlockCommonSlider = defineAsyncComponent(
    () => import("../Components/Theme/Block/Common/Slider.vue")
);
</script>
<template>
    <Head :item="props.item"></Head>
    <Default>
        <div
            v-if="
                props.item?.blocks &&
                Array.isArray(props.item.blocks) &&
                props.item.blocks.length > 0
            "
            class="w-full flex flex-col grow"
        >
            <!-- Added grow to allow this div to expand vertically -->
            <div
                v-for="(block, index) in props.item.blocks"
                :key="block.id || index"
            >
                <!-- It's good practice to use block.id if available for the key -->
                <BlockCommonHero
                    v-if="block.type === 'common-hero'"
                    :block="block"
                ></BlockCommonHero>
                <BlockCommonSlider
                    v-if="block.type === 'common-slider'"
                    :block="block"
                ></BlockCommonSlider>
            </div>
        </div>
        <div class="flex flex-row w-full">
            <div
                class="flex flex-col h-[1] w-[40%] bg-(--color-primary-500) text-(--color-text-primary) p-10 border-2 border-(--color-tertiary-500) shadow-lg"
            >
                <h2 class="text-5xl mb-8 text-center">Find Your Move!</h2>
                <img src="/assets/images/image-2.png" />
                <IconButton
                    type="button"
                    class="mt-6 mb-10 p-2 bg-(--color-tertiary-500) text-neutral-900 hover:text-(--color-tertiary-500) hover:border-4 hover:border-(--color-tertiary-500) rounded-lg]"
                    href="/programs"
                    >Explore Our Programs</IconButton
                >
            </div>
            <form
                @submit.prevent="submit"
                class="bg-[var(--color-primary-500)] px-20 text-lg flex align-center justify-center border-2 border-[var(--color-tertiary-500)] shadow-lg"
            >
                <div class="flex flex-row justify-content-center">
                    <div class="flex flex-col">
                        <h2
                            class="text-(--color-text-primary) text-5xl text-center pt-4 mb-6"
                        >
                            Have a Question? <br />Contact Us
                        </h2>
                        <div class="flex flex-row gap-4 mt-4 mb-3">
                            <div class="flex flex-col">
                                <label
                                    for="first_name"
                                    class="text-(--color-text-primary)"
                                    >First Name</label
                                >
                                <input
                                    type="text"
                                    id="first_name"
                                    v-model="form.first_name"
                                    class="col-span-1 border-2 border-(--color-tertiary-500)"
                                />
                            </div>
                            <div class="flex flex-col">
                                <label
                                    for="last_name"
                                    class="text-(--color-text-primary)"
                                    >Last Name</label
                                >
                                <input
                                    type="text"
                                    id="last_name"
                                    v-model="form.last_name"
                                    class="border-2 border-(--color-tertiary-500)"
                                />
                            </div>
                        </div>
                        <div class="flex flex-row gap-4 mb-3">
                            <div class="flex flex-col">
                                <label
                                    for="email"
                                    class="text-(--color-text-primary)"
                                    >Email</label
                                >
                                <input
                                    type="email"
                                    id="email"
                                    v-model="form.email"
                                    class="border-2 border-(--color-tertiary-500)"
                                />
                            </div>
                            <div class="flex flex-col">
                                <label
                                    for="phone"
                                    class="text-(--color-text-primary)"
                                    >Phone</label
                                >
                                <input
                                    type="tel"
                                    id="phone"
                                    v-model="form.phone"
                                    class="border-2 border-(--color-tertiary-500)"
                                />
                            </div>
                        </div>
                        <label for="subject" class="text-(--color-text-primary)"
                            >Subject</label
                        >
                        <input
                            type="text"
                            id="subject"
                            v-model="form.subject"
                            class="border-2 border-(--color-tertiary-500)"
                        />

                        <label for="message" class="text-(--color-text-primary)"
                            >Message</label
                        >
                        <textarea
                            id="message"
                            v-model="form.message"
                            class="border-2 border-(--color-tertiary-500)"
                        ></textarea>
                        <button
                            type="submit"
                            class="mt-6 mb-10 p-2 bg-[var(--color-tertiary-500)] text-neutral-900 hover:text-[var(--color-tertiary-500)] hover:bg-transparent hover:border-4 hover:border-[var(--color-tertiary-500)] rounded-lg"
                        >
                            Submit
                        </button>
                        <InputError
                            :message="form.errors.message"
                            class="mt-2"
                        />
                    </div>
                </div>
            </form>

            <div
                class="flex justify-center flex-col h-[1] bg-(--color-primary-500) text-(--color-text-primary) p-10 border-2 border-(--color-tertiary-500) shadow-lg"
            >
                <h2 class="text-5xl text-balance mb-4 text-center">
                    Ready to Start Your Journey?
                </h2>
                <IconButton
                    type="button"
                    class="mt-6 mb-10 p-2 bg-(--color-tertiary-500) text-neutral-900 hover:text-(--color-tertiary-500) hover:border-4 hover:border-(--color-tertiary-500) rounded-lg"
                    href="/register"
                    >Sign Up</IconButton
                >
            </div>
        </div>
    </Default>
</template>
