<template>
    <Head title="Permission" />
    <Layout>
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
                        Permission
                    </li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Permission</h6>
            </nav>
        </template>
        <!-- Breadcrumb End -->
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div
                        class="card-header p-0 position-relative mt-n4 mx-3 z-index-2"
                    >
                        <div
                            class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3"
                        >
                            <h6 class="text-white text-capitalize ps-3">
                                Permission table
                            </h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder opacity-9"
                                        >
                                            Permission
                                        </th>
                                        <th
                                            v-for="(
                                                role, index
                                            ) in data.roles"
                                            :key="role.id"
                                            class="text-uppercase text-secondary text-xs font-weight-bolder opacity-9 ps-2"
                                        >
                                            {{ role.display_name }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(
                                            permissions, index
                                        ) in data.role_permissions"
                                        :key="index"
                                    >
                                        <td>
                                            <b>{{ index }}</b>
                                            <div
                                            v-for="(
                                            permission, index
                                            ) in permissions"
                                            :key="index"
                                            >
                                                {{ permission.display_name }}
                                        </div>
                                        </td>
                                        <td 
                                        v-for="(
                                                role, index
                                            ) in data.roles"
                                            :key="role.id"
                                        >
                                            <div
                                            v-for="(
                                            permission, index
                                            ) in permissions"
                                            :key="index"
                                            >
                                            <div 
                                            v-for="(
                                            role, index
                                            ) in permission.roles"
                                            :key="index"
                                            >
                                            {{ role.has_permission }}
                                            
                                            </div>
                                            <!-- <div>
                                                <i class="fa-solid fa-check"></i> 
                                            </div>
                                            <div>
                                                <i class="fa-solid fa-xmark"></i> 
                                            </div> -->
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import Layout from "@/components/App/Layout.vue";
import { Head } from "@inertiajs/inertia-vue3";

import { reactive , onMounted } from "vue";

const data = reactive({
    roles : props.roles,
    role_permissions: props.role_permissions,
    showPermission: false,
    errors: {},
});

const props = defineProps({
    roles:Object,
    role_permissions: Object,
});

onMounted(() => {
    console.log(data.role_permissions);
});
</script>
