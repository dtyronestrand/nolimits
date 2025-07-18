<script setup>
import { ref } from 'vue';
import { Link, router, useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    user: Object,
});

const form = useForm({
    _method: 'PUT',
    first_name: props.user.first_name,
    last_name: props.user.last_name,
    email: props.user.email,
    address: props.user.address || '',
    city: props.user.city || '',
    state: props.user.state || '',
    zip: props.user.zip || '',
    phone: props.user.phone || '',
    photo: null,
});

const verificationLinkSent = ref(null);
const photoPreview = ref(null);
const photoInput = ref(null);

const updateProfileInformation = () => {
    if (photoInput.value) {
        form.photo = photoInput.value.files[0];
    }

    form.post(route('user-profile-information.update'), {
        errorBag: 'updateProfileInformation',
        preserveScroll: true,
        onSuccess: () => clearPhotoFileInput(),
    });
};

const sendEmailVerification = () => {
    verificationLinkSent.value = true;
};

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (! photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};

const deletePhoto = () => {
    router.delete(route('current-user-photo.destroy'), {
        preserveScroll: true,
        onSuccess: () => {
            photoPreview.value = null;
            clearPhotoFileInput();
        },
    });
};

const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};
</script>

<template>
    <FormSection @submitted="updateProfileInformation">
        <template #title>
            <span class="text-[var(--color-text-primary)]">
            Profile Information
            </span>
        </template>

        <template class=#description>
            <span class="text-[var(--color-text-primary)]">
            Update your account's profile information and email address.
            </span>
        </template>

        <template #form>
            <!-- Profile Photo -->
            <div v-if="$page.props.jetstream.managesProfilePhotos" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input
                    id="photo"
                    ref="photoInput"
                    type="file"
                    class="hidden"
                    @change="updatePhotoPreview"
                >

                <InputLabel for="photo" value="Photo" />

                <!-- Current Profile Photo -->
                <div v-show="! photoPreview" class="mt-2">
                    <img :src="user.profile_photo_url" :alt="user.name" class="rounded-full size-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div v-show="photoPreview" class="mt-2">
                    <span
                        class="block rounded-full size-20 bg-cover bg-no-repeat bg-center"
                        :style="'background-image: url(\'' + photoPreview + '\');'"
                    />
                </div>

                <SecondaryButton class="mt-2 me-2" type="button" @click.prevent="selectNewPhoto">
                    Select A New Photo
                </SecondaryButton>

                <SecondaryButton
                    v-if="user.profile_photo_path"
                    type="button"
                    class="mt-2"
                    @click.prevent="deletePhoto"
                >
                    Remove Photo
                </SecondaryButton>

                <InputError :message="form.errors.photo" class="mt-2" />
            </div>

            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="first_name" value="First Name" />
                <TextInput
                    id="first_name"
                    v-model="form.first_name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="given-name"
                />
                <InputError :message="form.errors.first_name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="last_name" value="Last Name" />
                <TextInput
                    id="last_name"
                    v-model="form.last_name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="family-name"
                />
                <InputError :message="form.errors.last_name" class="mt-2" />
            </div>
            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autocomplete="username"
                />
                <InputError :message="form.errors.email" class="mt-2" />

                <div v-if="$page.props.jetstream.hasEmailVerification && user.email_verified_at === null">
                    <p class="text-sm mt-2">
                        Your email address is unverified.

                        <Link
                            :href="route('verification.send')"
                            method="post"
                            as="button"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            @click.prevent="sendEmailVerification"
                        >
                            Click here to re-send the verification email.
                        </Link>
                    </p>

                    <div v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">
                        A new verification link has been sent to your email address.
                    </div>
                </div>
                <div class="col-span-6 sm:col-span-4 mt-4">
                    <InputLabel for="address" value="Address" />
                    <TextInput
                        id="address"
                        v-model="form.address"
                        type="text"
                        class="mt-1 block w-full"
                        autocomplete="address-line1"
                    />
                    <InputError :message="form.errors.address" class="mt-2" />
                </div>
                <div class="col-span-2 sm:col-span-2 mt-4">
                <inputLabel for="city" value="City" />
                    <TextInput
                        id="city"
                        v-model="form.city"
                        type="text"
                        class="mt-1 block w-full"
                        autocomplete="address-level2"
                    />
                    <InputError :message="form.errors.city" class="mt-2" />
                
                </div>
                    <div class="col-span-2 sm:col-span-2 mt-4">
                    <InputLabel for="state" value="State" />
                    <TextInput
                        id="state"
                        v-model="form.state"
                        type="text"
                        class="mt-1 block w-full"
                        autocomplete="address-level1"
                    />
    </div>
    <div class="col-span-2 sm:col-span-2 mt-4">     
    
        <InputLabel for="zip" value="Zip Code" />
            <TextInput
                id="zip"
                v-model="form.zip"
                type="number"
                class="mt-1 block w-full"
                autocomplete="postal-code"
            />
            <InputError :message="form.errors.zip" class="mt-2" />
    </div>
            <div class="col-span-2 sm:col-span-2 mt-4">
                <InputLabel for="phone" value="Phone" />
                <TextInput
                    id="phone"
                    v-model="form.phone"
                    type="tel"
                    class="mt-1 block w-full"
                    autocomplete="tel"
                />
                <InputError :message="form.errors.phone" class="mt-2" />
                </div>
            </div>
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="me-3">
                Saved.
            </ActionMessage>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </PrimaryButton>
        </template>
    </FormSection>
</template>
