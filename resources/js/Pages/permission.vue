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
                            <div class="row">
                                <div class="col-6">
                                    <h6 class="text-white text-capitalize ps-3">
                                        Permission table
                                    </h6>
                                </div>
                                <div class="col-6 d-flex justify-content-end" v-if="!data.update_permission">
                                    <button type="button" class="btn btn-info" @click=update_permission_btn>
                                        Update
                                    </button>
                                </div>
                            </div>
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
                                            permissions, category_name
                                        ) in data.role_permissions"
                                        :key="category_name"
                                    >
                                        <td>
                                            <b>{{ category_name }}</b>
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
                                            <template
                                            v-for="(
                                            permission, index
                                            ) in permissions"
                                            :key="index"
                                            >
                                            <template 
                                            v-for="(
                                            permission_role, index
                                            ) in permission.roles"
                                            :key="index"
                                            >
                                            <div v-if="permission_role.id == role.id">
                                                <template v-if="data.update_permission">
                                                        <div class="form-check">
                                                            <input class="form-check-input"
                                                             name="permission_checkbox" 
                                                             type="checkbox" 
                                                             :value=permission.id 
                                                             :id=permission_role.id 
                                                             :checked="permission_role.has_permission" >
                                                        </div>
                                                </template>
                                                <template v-else >
                                                    <template v-if="permission_role.has_permission">
                                                        <i class="fa-solid fa-check text-success"></i> 
                                                    </template>
                                                    <template v-else>
                                                        <i class="fa-solid fa-xmark text-danger"></i> 
                                                    </template>
                                                </template>
                                            </div>
                                            </template>
                                            
                                            </template>
                                        </td>
                                    </tr>
                                </tbody>
                                
                            </table>
                            <div v-if="data.update_permission" class="d-flex justify-content-end me-3">
                                <button type="button" class="btn btn-info" @click="update_permission">Save</button>
                            </div> 
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
    update_permission: false,
    permission_object: Array,
    errors: {},
});

const props = defineProps({
    roles:Object,
    role_permissions: Object,
});

onMounted(() => {
    // console.log(data.role_permissions);
});

function update_permission(){
    update_permission_btn()
    var permissions = document.getElementsByName('permission_checkbox');
    Object.entries(permissions).forEach(([key, element]) => {
    console.log(element);
        
    })  
    // console.log(data.role_permissions.Broker[0].roles);
}

function update_permission_btn(){
    data.update_permission = !data.update_permission;
}
</script>
