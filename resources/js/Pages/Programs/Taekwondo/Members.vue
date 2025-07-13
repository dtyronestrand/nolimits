<template>
      <blockquote><p class="text-[var(--color-text-primary)]">Train with integrity, humility and heart</p></blockquote> 
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
 <h2 class="col-span-4 row-span-1 text-center mt-4 text-2xl">Requirements to Advance</h2>

<div class=" col-span-1 row-span-2 align-center ">
 <h3 v-if="poomsae && poomsae.length > 0" class="font-bold mt-8 mb-4 text-lg">Poomsae:</h3>
 <div v-for="item in poomsae" :key="item.id" >
 <input type="checkbox" :checked="item.completed" @change="updateRequirement(item.id, $event.target.checked)" /> <span class="ml-2 text-balance ">{{ item.requirement_name }}</span>
 </div>
</div>
<div class=" flex flex-col  row-span-2 align-center px-4 overflow-auto">
 <h3 v-if="ssd && ssd.length > 0" class="font-bold mb-4 mt-8 text-lg">Sparring/Self-Defense:</h3>
    <div v-for="item in ssd" :key="item.id" >
    <input type="checkbox" :checked="item.completed" @change="updateRequirement(item.id, $event.target.checked)" /> <span class="ml-2">{{ item.requirement_name }}</span>
    </div>
</div>
<div class=" flex flex-col row-span-2 align-center px-10 ">
    <h3 v-if="breaking && breaking.length > 0" class="font-bold  mb-4 mt-8 text-lg">Breaking:</h3>
    <div v-for="item in breaking" :key="item.id" >
    <input type="checkbox" :checked="item.completed" @change="updateRequirement(item.id, $event.target.checked)" /> <span class="ml-2">{{ item.requirement_name }}</span>
    </div>  
</div>
<div class=" flex flex-col row-span-2 align-center ">
    <h3 v-if="knowledge && knowledge.length > 0" class="font-bold mb-4 mt-8  text-lg">Knowledge:</h3>
    <div v-for="item in knowledge" :key="item.id">
    <input type="checkbox" :checked="item.completed" @change="updateRequirement(item.id, $event.target.checked)" /> <span class="ml-2">{{ item.requirement_name }}</span>
    </div>
</div>
<div class=" flex flex-col row-span-2 align-center ">
    <h3 v-if="other && other.length > 0" class="font-bold mb-4 mt-8 flex justify-center align-center text-lg">Other:</h3>
    <div v-for="item in other" :key="item.id" >
    <input type="checkbox" :checked="item.completed" @change="updateRequirement(item.id, $event.target.checked)" /> <span class="ml-2">{{ item.requirement_name }}</span>
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
        

</template>
<script setup lang="ts">
import Programs from '@/Layouts/Programs.vue';
import Default from '@/Layouts/Default.vue';
import { computed, ref } from 'vue';
import { usePage, router } from '@inertiajs/vue3';

const page = usePage();
defineOptions({
    layout: Default
})
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
const nextBelt = computed(() => {
    const currentPosition = page.props.auth.user.profile.current_belt_data?.position;
    if (!currentPosition) return 'No Next Belt';
    
    const next = belts.find(belt => belt.id === currentPosition + 1);
    return next ? next.name : 'No Next Belt';
});
const getCurrentPath = computed(() => {
    return page.url.split("?")[0];
});
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


</script>
<style scoped>
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