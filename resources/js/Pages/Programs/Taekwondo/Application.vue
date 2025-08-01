<template>
    <h1 class="text-7xl text-center pt-10 pb-10">Taekwondo Participant Application</h1>
    <AuthenticationCardLogo class="mb-10" />
    <div class="mx-20 min-h-screen">
<form class="grid grid-cols-2 gap-4 bg-[var(--color-surface-base)] p-6 rounded-xl " @submit.prevent="form.post('/programs/taekwondo/apply')">
<div class="col-span-1 ">
<InputLabel for ="first_name" value="First Name" />
<TextInput id="first_name" v-model="form.first_name" type="text" class="mt-1 block w-full" />
<InputError :message="form.errors.first_name" class="mt-2" />
</div>
<div class="col-span-1">
<InputLabel for ="last_name" value="Last Name"  />
<TextInput id="last_name" v-model="form.last_name" type="text" class="mt-1 block w-full" />
<InputError :message="form.errors.last_name" class="mt-2"/>
</div>
<div class="col-span-1">
<InputLabel for="age" value="Age" class="mt-4" />
<NumericInput id="age" v-model="form.age" type="number" class="mt-1 block w-full" />
<InputError :message="form.errors.age" class="mt-2" />
</div>
<div class="col-span-2">
<InputLabel for="address" value="Address" class="mt-4" />
<TextInput id="address" v-model="form.address" type="text" class="mt-1 block w-full" />
<InputError :message="form.errors.address" class="mt-2" />
</div>
<div class="col-span-1">
<InputLabel for="city" value="City" class="mt-4" />
<TextInput id="city" v-model="form.city" type="text" class="mt-1 block w-full" />
<InputError :message="form.errors.city" class="mt-2" />
</div>
<div class="col-span-1">
<InputLabel for="state" value="State" class="mt-4" />
<TextInput id="state" v-model="form.state" type="text" class="mt-1 block w-full" />
<InputError :message="form.errors.state" class="mt-2" />
</div>
<div class="col-span-1">
<InputLabel for="zip" value="Zip Code" class="mt-4" />
<TextInput id="zip" v-model="form.zip" type="text" class="mt-1 block w-full" />
<InputError :message="form.errors.zip" class="mt-2"/>
</div>
<div class="col-span-1">
<InputLabel for="phone" value="Phone Number" class="mt-4" />
<TextInput id="phone" v-model="form.phone" type="text" class="mt-1 block w-full" />
<InputError :message="form.errors.phone" class="mt-2"/>
</div>
<div class="col-span-1">
<InputLabel for="experience" value="Previous Taekwondo Experience" class="mt-4" />
<select id="experience" v-model="form.experience.has_experience" class="mt-1 block w-full border-[var(--color-secondary-base)] focus:border-[var(--color-primary-base)] focus:ring-i[var(--color-primary-base)] text-[var(--color-text-dark)] rounded-md shadow-xs">
    <option value="false">No</option>
    <option value="true">Yes</option>
</select>
<InputError :message="form.errors.experience" class="mt-2"/>
</div>
<div class="col-span-1 " :class="{'opacity-0': form.experience.has_experience === 'false'}">
<InputLabel for="experience.current_level" value="Current Belt and Gup" class="mt-4" />
<TextInput id="experience.current_level" v-model="form.experience.current_level" type="text" class="mt-1 block w-full" />
<InputError :message="form.errors['experience.current_level']" class="mt-2"/>
</div>
<div class="col-span-1">
<InputLabel for="class_type" value="Preferred Class Type" class="mt-4" />
<select id="class_type" v-model="form.class_type" class="mt-1 block">
<option value="">Choose one</option>
<option value="weekly">One class a week</option>
<option value="twice-weekly">Two classes a week</option>
<option value="private">Private lessons</option>
<option value="group">Group classes (private location)</option>
</select>
</div>
<div class="col-span-1 pl-5">
<input type="checkbox" id="waiver" v-model="form.waiver" />
<label for="waiver" class="ml-2 text-[var(--color-text-primary)] mr-5">I agree to the waiver and terms of participation</label>
<InputError :message="form.errors.waiver" class="mt-2" />

<input type="submit" value="Submit Application" class="mr-80 bg-[var(--color-primary-base)] text-[var(--color-text-dark)] font-bold py-2 px-4 rounded hover:bg-[var(--color-primary-dark)] transition duration-300 cursor-pointer mt-6" />
</div>
</form>
    </div>
</template>
<script setup>
import { useForm } from '@inertiajs/vue3'
import TextInput from '../../../Components/TextInput.vue'
import InputLabel from '../../../Components/InputLabel.vue'
import NumericInput from '../../../Components/NumericInput.vue'
import InputError from '../../../Components/InputError.vue'
import Default from '../../../Layouts/Default.vue'
import AuthenticationCardLogo from '../../../Components/AuthenticationCardLogo.vue'
defineOptions({
    layout: Default
})

const form = useForm({
    first_name: '',
    last_name: '',
    age: undefined,
    address: '',
    city: '',
    state: '',
    zip: '',
    phone: '',
    experience: {
        has_experience: 'false',
        current_level: '',
    },
    class_type: '',
    waiver: false,

})
</script>
