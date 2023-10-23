<template>
    <Head title="Unauthenticat" />
    <layout>
        <!-- Breadcrumb Start -->
        <template #breadcrumb>
            <nav aria-label="breadcrumb">
                <ol
                    class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5"
                >
                    <li class="breadcrumb-item text-sm">
                        <a class="opacity-5 text-dark" href="javascript:;"
                            >Pages</a
                        >
                    </li>
                    <li
                        class="breadcrumb-item text-sm text-dark active"
                        aria-current="page"
                    >
                        Unauthenticat
                    </li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Unauthenticat</h6>
            </nav>
        </template>
        <!-- Breadcrumb End -->
    </layout>
</template>

<script setup>
import layout from "@/components/App/layout.vue";
import { Head } from "@inertiajs/inertia-vue3";

import { reactive } from "vue";

const data = reactive({});

</script>
