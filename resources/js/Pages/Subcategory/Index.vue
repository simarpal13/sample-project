<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
  subcategories: Object
})


const destroy = (id) => {
    if(confirm('Are you sure?')){
        Inertia.delete(route('remove.subcategory', id))
    }
};
</script>

<template>
    <Head title="Subcategories" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Subcategories
            </h2>
        </template>
        <div class=" flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div class=" mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div v-if="$page.props.flash.successmsg" class="mt-4 text-green-400">
                    {{ $page.props.flash.successmsg }}
                </div>
                    
                <table class="table-fixed">
                    <thead class="bg-dark text-black">
                        <tr>
                            <th class="px-4 py-2">Category</th>
                            <th class="px-4 py-2">Subcategory</th>
                            <th class="px-4 py-2">Delete</th>
                            <th class="px-4 py-2">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(subcategory, index) in subcategories.data">
                            <td class="border px-4 py-2">{{ subcategory.category.name }}</td>
                            <td class="border px-4 py-2">{{ subcategory.name }}</td>
                            <td class="border px-4 py-2">
                            <button @click="destroy(subcategory.id)" type="button" class="px-2 py-1 bg-red-600 text-white rounded font-bold uppercase">
                                delete
                            </button>
                            </td>
                            <td class="border px-4 py-2">
                            <Link :href="route('edit.subcategory', [subcategory.id])" class="px-2 py-1 bg-blue-600 text-white rounded font-bold uppercase">
                                    Edit
                                </Link>
                            </td>
                    </tr>
                    </tbody>
                </table>
                
                <div v-if="subcategories.links.length > 3">
                    <div class="flex flex-wrap mb-1 mt-6 items-center">
                        <template v-for="(link, key) in subcategories.links">
                            <div v-if="link.url === null" :key="key" class="mb-1 mr-1 px-4 py-3 text-gray-400 text-sm leading-4 border rounded" v-html="link.label" />
                            <Link v-else :key="`link-${key}`" class="mb-1 mr-1 px-4 py-3 focus:text-indigo-500 text-sm leading-4 hover:bg-white border focus:border-indigo-500 rounded" :class="{ 'bg-white': link.active }" :href="link.url" v-html="link.label" />
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
