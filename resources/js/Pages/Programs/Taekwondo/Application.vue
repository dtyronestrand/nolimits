<template>
    <h1>Taekwondo Participant Application</h1>
<form>
<InputLabel for ="first_name" value="First Name" />
<TextInput id="first_name" v-model="form.first_name" type="text" class="mt-1 block w-full" />
<InputError :message="form.errors.first_name" class="mt-2" />
<InputLabel for ="last_name" value="Last Name" class="mt-4" />
<TextInput id="last_name" v-model="form.last_name" type="text" class="mt-1 block w-full" />
<InputError :message="form.errors.last_name" class="mt-2"/>
<InputLabel for="address" value="Address" class="mt-4" />
<TextInput id="address" v-model="form.address" type="text" class="mt-1 block w-full" />
<InputError :message="form.errors.address" class="mt-2" />
<InputLabel for="city" value="City" class="mt-4" />
<TextInput id="city" v-model="form.city" type="text" class="mt-1 block w-full" />
<InputError :message="form.errors.city" class="mt-2" />
<InputLabel for="state" value="State" class="mt-4" />
<TextInput id="state" v-model="form.state" type="text" class="mt-1 block w-full" />
<InputError :message="form.errors.state" class="mt-2" />
<InputLabel for="zip" value="Zip Code" class="mt-4" />
<TextInput id="zip" v-model="form.zip" type="text" class="mt-1 block w-full" />
<InputError :message="form.errors.zip" class="mt-2"/>
<InputLabel for="phone" value="Phone Number" class="mt-4" />
<TextInput id="phone" v-model="form.phone" type="text" class="mt-1 block w-full" />
<InputError :message="form.errors.phone" class="mt-2"/>

</form></template>