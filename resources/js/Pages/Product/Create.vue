<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeButton from '@/Components/Button.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { Inertia, Link } from '@inertiajs/inertia';
import { ref, watch } from 'vue';

const props = defineProps({
    errors: Object,
    categories: Object,
    subcategories: Object,
})

const form = useForm({
    category_id: '',
    subcategory_id: '',
    name: '',
    price: '',
    discount: '',
    image: '',
    description: ''
});

let getSubcategory = (event) => {
    if (event.target.value !== "") {
        Inertia.visit(
            route('create.product', {
                category_id: event.target.value
            }), {
            only: ['subcategories'],
            preserveState: true,
            preserveScroll: true,
        }
        );
    }
}

const submit = () => {
    form.post(route('store.product'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>

    <Head title="Add Product" />
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add Product
            </h2>
        </template>
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <form @submit.prevent="submit">
                    <div v-if="$page.props.flash.errormsg" class="mt-4 text-red-400">
                        {{ $page.props.flash.errormsg }}
                    </div>

                    <div v-if="$page.props.flash.successmsg" class="mt-4 text-green-400">
                        {{ $page.props.flash.successmsg }}
                    </div>

                    <div class="mt-4">
                        <BreezeLabel for="category_id" value="Category Name" />
                        <select @change="getSubcategory" v-model="form.category_id" id="category_id"
                            class="block mt-1 w-full">
                            <option value="">Select Category</option>
                            <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                        </select>
                        <div v-if="errors.category_id" class="text-red-400">
                            {{ errors.category_id }}
                        </div>
                    </div>

                    <div class="mt-4">
                        <BreezeLabel for="subcategory_id" value="Subcategory Name" />
                        <select v-model="form.subcategory_id" id="subcategory_id" class="block mt-1 w-full">
                            <option value="">Select Sategory</option>
                            <option v-for="subcategory in subcategories" :value="subcategory.id">{{ subcategory.name }}
                            </option>
                        </select>
                        <div v-if="errors.subcategory_id" class="text-red-400">
                            {{ errors.subcategory_id }}
                        </div>
                    </div>

                    <div class="mt-4">
                        <BreezeLabel for="product_name" value="Product Name" />
                        <BreezeInput id="product_name" type="text" class="mt-1 block w-full" v-model="form.name"
                            required autofocus />
                        <div v-if="errors.name" class="text-red-400">
                            {{ errors.name }}
                        </div>
                    </div>
                    <div class="mt-4">
                        <BreezeLabel for="discount" value="Discount" />
                        <BreezeInput id="discount" type="text" class="mt-1 block w-full" v-model="form.discount"
                            required autofocus />
                        <div v-if="errors.discount" class="text-red-400">
                            {{ errors.discount }}
                        </div>
                    </div>
                    <div class="mt-4">
                        <BreezeLabel for="price" value="Price" />
                        <BreezeInput id="price" type="text" class="mt-1 block w-full" v-model="form.price" required
                            autofocus />
                        <div v-if="errors.price" class="text-red-400">
                            {{ errors.price }}
                        </div>
                    </div>
                    <div class="mt-4">
                        <BreezeLabel for="image" value="Image" />
                        <input id="image" type="file" class="mt-1 block w-full" required
                            @input="form.image = $event.target.files[0]" />
                        <div v-if="errors.image" class="text-red-400">
                            {{ errors.image }}
                        </div>
                    </div>
                    <div class="mt-4">
                        <BreezeLabel for="description" value="Description" />
                        <textarea v-model="form.description" id="description"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            cols="30" rows="10"></textarea>
                        <div v-if="errors.description" class="text-red-400">
                            {{ errors.description }}
                        </div>
                    </div>
                    <div class="mt-4">
                        <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
                            Add Product
                        </BreezeButton>
                    </div>
                </form>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
