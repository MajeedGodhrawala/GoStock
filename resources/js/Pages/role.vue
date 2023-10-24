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
                        Role
                    </li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Role</h6>
            </nav>
        </template>
        <!-- Breadcrumb End -->
        <section>
            <div class="row">
                <div class="col-md-12 mb-lg-0 mb-4">
                    <div class="card mt-3">
                        <div
                            class="card-header p-0 position-relative mt-n4 mx-3 z-index-2"
                        >
                            <div
                                class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-2"
                            >
                                <div class="row">
                                    <div
                                        class="col-6 d-flex align-items-center"
                                    >
                                        <h6
                                            class="text-white text-capitalize ps-3"
                                        >
                                            Roles
                                        </h6>
                                    </div>
                                    <div
                                        class="col-6 align-items-center text-end"
                                    >
                                        <button
                                            class="btn bg-gradient-dark mb-0"
                                            v-if="has_permission('add_role')"
                                            type="button"
                                            @click="create"
                                        >
                                            <i class="material-icons text-sm"
                                                >add</i
                                            >&nbsp;&nbsp;Add New Role
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-3">
                            <div class="form-check form-switch">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="flexSwitchCheckDefault"
                                    v-model="data.table"
                                />
                                <label
                                    v-if="data.table"
                                    class="form-check-label"
                                    for="flexSwitchCheckDefault"
                                    >Table</label
                                ><label
                                    v-else="data.table"
                                    class="form-check-label"
                                    for="flexSwitchCheckDefault"
                                    >List</label
                                >
                            </div>
                            <div class="row">
                                <div
                                    v-if="data.table"
                                    class="card-body pt-4 p-3"
                                >
                                    <div class="table-responsive p-0">
                                        <table
                                            class="table align-items-center mb-0"
                                        >
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                                    >
                                                        Index
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"
                                                    >
                                                        Name
                                                    </th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                                    >
                                                        Display Name
                                                    </th>
                                                    <th
                                                        v-if="
                                                            has_permission(
                                                                'delete_role'
                                                            ) ||
                                                            has_permission(
                                                                'edit_role'
                                                            )
                                                        "
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                                    >
                                                        Option
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr
                                                    v-for="(
                                                        data, index
                                                    ) in data.roleData"
                                                    :key="data.id"
                                                >
                                                    <td>
                                                        <p
                                                            class="text-xs font-weight-bold mb-0"
                                                        >
                                                            {{ index + 1 }}
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p
                                                            class="text-xs font-weight-bold mb-0"
                                                        >
                                                            {{ data.name }}
                                                        </p>
                                                    </td>
                                                    <td
                                                        class="align-middle text-center text-sm"
                                                    >
                                                        <p
                                                            class="text-xs font-weight-bold mb-0"
                                                        >
                                                            {{
                                                                data.display_name
                                                            }}
                                                        </p>
                                                    </td>
                                                    <td
                                                        class="align-middle"
                                                        v-if="
                                                            has_permission(
                                                                'delete_role'
                                                            ) ||
                                                            has_permission(
                                                                'edit_role'
                                                            )
                                                        "
                                                    >
                                                        <div
                                                            class="ms-auto text-center"
                                                        >
                                                            <button
                                                                class="btn btn-link text-danger text-gradient px-3 mb-0"
                                                                v-if="
                                                                    has_permission(
                                                                        'delete_role'
                                                                    )
                                                                "
                                                                @click="
                                                                    deleteRoleData(
                                                                        data.id,
                                                                        data.display_name
                                                                    )
                                                                "
                                                            >
                                                                <i
                                                                    class="material-icons text-sm me-2"
                                                                    >delete</i
                                                                >Delete
                                                            </button>
                                                            <button
                                                                class="btn btn-link text-dark px-3 mb-0"
                                                                v-if="
                                                                    has_permission(
                                                                        'edit_role'
                                                                    )
                                                                "
                                                                @click="
                                                                    editRoleData(
                                                                        data
                                                                    )
                                                                "
                                                            >
                                                                <i
                                                                    class="material-icons text-sm me-2"
                                                                    >edit</i
                                                                >Edit
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div
                                    v-else="data.table"
                                    class="card-body pt-4 p-3"
                                >
                                    <ul class="list-group">
                                        <li
                                            class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg"
                                            v-for="(
                                                data, index
                                            ) in data.roleData"
                                            :key="data.id"
                                        >
                                            <div class="d-flex flex-column">
                                                <h6 class="mb-3 text-sm">
                                                    {{ data.display_name }}
                                                </h6>
                                                <span class="mb-2 text-xs"
                                                    >Name :
                                                    <span
                                                        class="text-dark font-weight-bold ms-sm-2"
                                                        >{{ data.name }}</span
                                                    ></span
                                                >
                                            </div>
                                            <div class="ms-auto text-end">
                                                <button
                                                    class="btn btn-link text-danger text-gradient px-3 mb-0"
                                                    v-if="
                                                        has_permission(
                                                            'delete_role'
                                                        )
                                                    "
                                                    @click="
                                                        deleteRoleData(
                                                            data.id,
                                                            data.display_name
                                                        )
                                                    "
                                                >
                                                    <i
                                                        class="material-icons text-sm me-2"
                                                        >delete</i
                                                    >Delete
                                                </button>
                                                <button
                                                    class="btn btn-link text-dark px-3 mb-0"
                                                    v-if="
                                                        has_permission(
                                                            'edit_role'
                                                        )
                                                    "
                                                    @click="editRoleData(data)"
                                                >
                                                    <i
                                                        class="material-icons text-sm me-2"
                                                        >edit</i
                                                    >Edit
                                                </button>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <role-form ref="role_form" @getRoleData="getRoleData"></role-form>
    </Layout>
</template>

<script setup>
import Layout from "@/components/App/Layout.vue";
import { Head } from "@inertiajs/inertia-vue3";
import roleForm from "../components/App/roleForm.vue";
import { has_permission } from "../appExternal";

import { reactive, onMounted, ref } from "vue";

const data = reactive({
    roleData: {},
    errors: {},
    table: false,
});

const props = defineProps({});

const role_form = ref(null);

onMounted(() => {
    getRoleData();
});

function getRoleData() {
    axios
        .post("get-role-data")
        .then(function (response) {
            if (response.data.role_data) {
                data.roleData = response.data.role_data;
            }
        })
        .catch(function (error) {
            console.log(error);
        });
}

function deleteRoleData(id, display_name) {
    Swal.fire({
        title: "Are you sure?",
        text: "Do You Want To Delete " + display_name + " Record",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            axios
                .post("delete/" + id)
                .then(function (response) {
                    if (response.data.delete) {
                        Swal.fire("Deleted!", response.data.delete, "success");
                        getRoleData();
                    }
                })
                .catch(function (error) {
                    if (error.message) {
                        errorAlert(error.message);
                    }
                });
        }
    });
}

function errorAlert(error) {
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: error,
    });
}

function create() {
    role_form.value.clearForm();
    role_form.value.openModel();
}

function editRoleData(data) {
    role_form.value.editRoleData(data);
}
</script>
