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
                                Authors table
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
                                            ) in data.roleData"
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
                                            permissions, category_name
                                        ) in data.permissionData"
                                        :key="category_name"
                                    >
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div
                                                    class="d-flex flex-column justify-content-center"
                                                >
                                                    <span
                                                        class="badge badge-sm bg-gradient-secondary"
                                                        >{{
                                                            category_name
                                                        }}</span
                                                    >
                                                </div>
                                            </div>
                                            <tr
                                                v-for="(
                                                    permission, index
                                                ) in permissions"
                                                :key="index"
                                            >
                                                <div
                                                    class="d-flex flex-column justify-content-center"
                                                >
                                                    <h6 class="mb-0 text-sm">
                                                        {{ permission.display_name }}
                                                    </h6>
                                                </div>
                                            </tr>
                                        </td>
                                        <td
                                            v-for="(
                                                role, index
                                            ) in data.roleData"
                                            :key="index"
                                        >
                                            {{ role.display_name }}
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

import { reactive } from "vue";

const data = reactive({
    roleData: props.roles,
    permissionData: props.permissions,
    role_permissionData: props.role_permisssion,
    showPermission: false,
    errors: {},
});

const props = defineProps({
    roles: Object,
    permissions: Object,
    role_permisssion: Object,
});
</script>
