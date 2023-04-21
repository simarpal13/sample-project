<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeButton from "@/Components/Button.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { Inertia, Link } from "@inertiajs/inertia";
import { ref, watch } from "vue";

const props = defineProps({
    errors: Object,
    categories: Object,
    subcategories: Object,
    product: Object,
});

const form = useForm({
    category_id: props.product[0].category.id,
    subcategory_id: props.product[0].subcategory.id,
    product_id: props.product[0].id,
    name: props.product[0].name,
    price: props.product[0].price,
    discount: props.product[0].discount,
    description: props.product[0].description,
});

const subcat = ref(null);
let getSubcategory = (event) => {
    if (event.target.value !== "") {
        Inertia.visit(
            route("edit.product", {
                product_id: form.product_id,
                category_id: event.target.value,
            }),
            {
                only: ["subcategories"],
                preserveState: true,
                preserveScroll: true,
                onSuccess: page => {
                    console.log(props.subcategories);
                },
                onFinish: page => {

                }
            }
        );
    }
};

const submit = () => {
    form.put(route("update.product"), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>

    <Head title="Edit Product" />
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Product
            </h2>
        </template>
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div class="w-full max-w-lg mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <form @submit.prevent="submit" class="w-full max-w-lg">
                    <div v-if="$page.props.flash.errormsg" class="mt-4 text-red-400">
                        {{ $page.props.flash.errormsg }}
                    </div>
                    <div v-if="$page.props.flash.successmsg" class="mt-4 text-green-400">
                        {{ $page.props.flash.successmsg }}
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <BreezeLabel for="category_id" value="Category Name" />
                            <select @change="getSubcategory" id="category_id" v-model="form.category_id"
                                class="block mt-1 w-full">
                                <option value="">Select Category</option>
                                <option v-for="category in categories" :value="category.id">
                                    {{ category.name }}
                                </option>
                            </select>
                            <div v-if="errors.category_id" class="text-red-400">
                                {{ errors.category_id }}
                            </div>
                        </div>

                        <div class="w-full md:w-1/2 px-3">
                            <BreezeLabel for="subcategory_id" value="Subcategory Name" />
                            <select ref="subcat" v-model="form.subcategory_id" id="subcategory_id"
                                class="block mt-1 w-full">

                                <!-- <option selected value="">Select Subcategory</option> -->
                                <option v-for="subcategory in subcategories" :value="subcategory.id">
                                    {{ subcategory.name }}
                                </option>
                            </select>
                            <div v-if="errors.subcategory_id" class="text-red-400">
                                {{ errors.subcategory_id }}
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <BreezeLabel for="product_name" value="Product Name" />
                            <BreezeInput id="product_name" type="text" class="mt-1 block w-full" v-model="form.name"
                                required autofocus />
                            <div v-if="errors.name" class="text-red-400">
                                {{ errors.name }}
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <BreezeLabel for="price" value="Price" />
                            <BreezeInput id="price" type="text" class="mt-1 block w-full" v-model="form.price" required
                                autofocus />
                            <div v-if="errors.price" class="text-red-400">
                                {{ errors.price }}
                            </div>
                        </div>

                        <div class="w-full md:w-1/2 px-3">
                            <BreezeLabel for="discount" value="Discount" />
                            <BreezeInput id="discount" type="text" class="mt-1 block w-full" v-model="form.discount"
                                required autofocus />
                            <div v-if="errors.discount" class="text-red-400">
                                {{ errors.discount }}
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <BreezeLabel for="description" value="Description" />
                            <textarea v-model="form.description" id="description"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                cols="30" rows="10"></textarea>
                            <div v-if="errors.description" class="text-red-400">
                                {{ errors.description }}
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Edit Product
                            </BreezeButton>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
