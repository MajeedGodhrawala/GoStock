<style>
.select {
    position: relative;
    min-width: 30px;
}
.select select {
    -webkit-appearance: none;
    padding: 7px 40px 7px 12px;
    width: 100%;
    border: 1px solid #e8eaed;
    border-radius: 5px;
    cursor: pointer;
    font-family: inherit;
    font-size: 14px;
    transition: all 150ms ease;
}
.select select:required:invalid {
    color: #5a667f;
}
.select select option {
    color: #223254;
}
.select select option[value=""][disabled] {
    display: none;
}
.select select:focus {
    outline: none;
    border-color: #07f;
    box-shadow: 0 0 0 2px rgba(0, 119, 255, 0.2);
}
.select select:hover + svg {
    stroke: #07f;
}
</style>
<template>
    <Head title="Broker" />
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
                        Broker
                    </li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Broker</h6>
            </nav>
        </template>
        <!-- Breadcrumb End -->
        <section>
            <div class="row">
                <div class="col-lg-8">
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
                                                    Brokers
                                                </h6>
                                            </div>
                                            <div
                                                class="col-6 align-items-center text-end"
                                            >
                                                <button
                                                    v-if="
                                                        has_permission(
                                                            'add_broker'
                                                        )
                                                    "
                                                    class="btn bg-gradient-dark mb-0"
                                                    type="button"
                                                    @click="addNewBroker"
                                                >
                                                    <i
                                                        class="material-icons text-sm"
                                                        >add</i
                                                    >&nbsp;&nbsp;Add New Broker
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-md-auto">
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
                                        </div>
                                        <div class="col-md-auto">
                                            <label class="select" for="slct">
                                                <select
                                                    id="slct"
                                                    required="required"
                                                    v-model="data.per_page"
                                                    @change="changePerpage"
                                                >
                                                    <option value="5">5</option>
                                                    <option value="10">
                                                        10
                                                    </option>
                                                    <option value="15">
                                                        15
                                                    </option>
                                                    <option value="25">
                                                        25
                                                    </option>
                                                    <option value="50">
                                                        50
                                                    </option>
                                                </select>
                                            </label>
                                        </div>
                                        <div class="col">
                                            <div
                                                class="ms-md-auto pe-md-3 d-flex align-items-end"
                                            >
                                                <div
                                                    class="input-group input-group-outline"
                                                >
                                                    <input
                                                        type="text"
                                                        placeholder="Search"
                                                        class="form-control"
                                                        @input="
                                                            searchData(
                                                                $event.target
                                                                    .value
                                                            )
                                                        "
                                                    />
                                                </div>
                                            </div>
                                        </div>
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
                                                                Email
                                                            </th>
                                                            <th
                                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                                            >
                                                                Phone Number
                                                            </th>
                                                            <th
                                                                v-if="
                                                                    has_permission(
                                                                        'delete_broker'
                                                                    ) ||
                                                                    has_permission(
                                                                        'edit_broker'
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
                                                            ) in data.brokerData"
                                                            :key="data.id"
                                                        >
                                                            <td>
                                                                <p
                                                                    class="text-xs font-weight-bold mb-0"
                                                                >
                                                                    {{
                                                                        index +
                                                                        1
                                                                    }}
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p
                                                                    class="text-xs font-weight-bold mb-0"
                                                                >
                                                                    {{
                                                                        data.broker_name
                                                                    }}
                                                                </p>
                                                            </td>
                                                            <td
                                                                class="align-middle text-center text-sm"
                                                            >
                                                                <p
                                                                    class="text-xs font-weight-bold mb-0"
                                                                >
                                                                    {{
                                                                        data.broker_email
                                                                    }}
                                                                </p>
                                                            </td>
                                                            <td
                                                                class="align-middle text-center"
                                                            >
                                                                <p
                                                                    class="text-xs font-weight-bold mb-0"
                                                                >
                                                                    {{
                                                                        data.broker_phone_number
                                                                    }}
                                                                </p>
                                                            </td>
                                                            <td
                                                                v-if="
                                                                    has_permission(
                                                                        'delete_broker'
                                                                    ) ||
                                                                    has_permission(
                                                                        'edit_broker'
                                                                    )
                                                                "
                                                                class="align-middle"
                                                            >
                                                                <div
                                                                    class="ms-auto text-end"
                                                                >
                                                                    <button
                                                                        class="btn btn-link text-danger text-gradient px-3 mb-0"
                                                                        v-if="
                                                                            has_permission(
                                                                                'delete_broker'
                                                                            )
                                                                        "
                                                                        @click="
                                                                            deleteBrokerData(
                                                                                data.id,
                                                                                data.broker_name
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
                                                                                'edit_broker'
                                                                            )
                                                                        "
                                                                        @click="
                                                                            editBrokerData(
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
                                                    ) in data.brokerData"
                                                    :key="data.id"
                                                >
                                                    <div
                                                        class="d-flex flex-column"
                                                    >
                                                        <h6
                                                            class="mb-3 text-sm"
                                                        >
                                                            {{
                                                                data.broker_name
                                                            }}
                                                        </h6>
                                                        <span
                                                            class="mb-2 text-xs"
                                                            >Broker Email :
                                                            <span
                                                                class="text-dark font-weight-bold ms-sm-2"
                                                                >{{
                                                                    data.broker_email
                                                                }}</span
                                                            ></span
                                                        >
                                                        <span
                                                            class="mb-2 text-xs"
                                                            >Broker Phone
                                                            Number:
                                                            <span
                                                                class="text-dark ms-sm-2 font-weight-bold"
                                                                >{{
                                                                    data.broker_phone_number
                                                                }}</span
                                                            ></span
                                                        >
                                                    </div>
                                                    <div
                                                        class="ms-auto text-end"
                                                    >
                                                        <button
                                                            class="btn btn-link text-danger text-gradient px-3 mb-0"
                                                            v-if="
                                                                has_permission(
                                                                    'delete_broker'
                                                                )
                                                            "
                                                            @click="
                                                                deleteBrokerData(
                                                                    data.id,
                                                                    data.broker_name
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
                                                                    'edit_broker'
                                                                )
                                                            "
                                                            @click="
                                                                editBrokerData(
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
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <nav aria-label="Page navigation example">
                                    <ul
                                        class="pagination justify-content-center"
                                    >
                                        <li
                                            class="page-item"
                                            v-for="page in data.pages"
                                            @click="changePage(page)"
                                        >
                                            <a class="page-link">{{ page }}</a>
                                        </li>
                                        <!-- <li class="page-item disabled">
                                            <a
                                                class="page-link"
                                                href="javascript:;"
                                                tabindex="-1"
                                            >
                                                <span class="material-icons">
                                                    keyboard_arrow_left
                                                </span>
                                                <span class="sr-only"
                                                    >Previous</span
                                                >
                                            </a>
                                        </li>
                                        <li class="page-item">
                                            <a
                                                class="page-link"
                                                href="javascript:;"
                                                >1</a
                                            >
                                        </li>
                                        <li class="page-item active">
                                            <a
                                                class="page-link"
                                                href="javascript:;"
                                                >2</a
                                            >
                                        </li>
                                        <li class="page-item">
                                            <a
                                                class="page-link"
                                                href="javascript:;"
                                                >3</a
                                            >
                                        </li>
                                        <li class="page-item">
                                            <a
                                                class="page-link"
                                                href="javascript:;"
                                            >
                                                <span class="material-icons">
                                                    keyboard_arrow_right
                                                </span>
                                                <span class="sr-only"
                                                    >Next</span
                                                >
                                            </a>
                                        </li> -->
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                    <h6 class="mb-0">Invoices</h6>
                                </div>
                                <div class="col-6 text-end">
                                    <button
                                        class="btn btn-outline-primary btn-sm mb-0"
                                    >
                                        View All
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3 pb-0">
                            <ul class="list-group">
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg"
                                >
                                    <div class="d-flex flex-column">
                                        <h6
                                            class="mb-1 text-dark font-weight-bold text-sm"
                                        >
                                            March, 01, 2020
                                        </h6>
                                        <span class="text-xs">#MS-415646</span>
                                    </div>
                                    <div
                                        class="d-flex align-items-center text-sm"
                                    >
                                        $180
                                        <button
                                            class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"
                                        >
                                            <i
                                                class="material-icons text-lg position-relative me-1"
                                                >picture_as_pdf</i
                                            >
                                            PDF
                                        </button>
                                    </div>
                                </li>
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg"
                                >
                                    <div class="d-flex flex-column">
                                        <h6
                                            class="text-dark mb-1 font-weight-bold text-sm"
                                        >
                                            February, 10, 2021
                                        </h6>
                                        <span class="text-xs">#RV-126749</span>
                                    </div>
                                    <div
                                        class="d-flex align-items-center text-sm"
                                    >
                                        $250
                                        <button
                                            class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"
                                        >
                                            <i
                                                class="material-icons text-lg position-relative me-1"
                                                >picture_as_pdf</i
                                            >
                                            PDF
                                        </button>
                                    </div>
                                </li>
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg"
                                >
                                    <div class="d-flex flex-column">
                                        <h6
                                            class="text-dark mb-1 font-weight-bold text-sm"
                                        >
                                            April, 05, 2020
                                        </h6>
                                        <span class="text-xs">#FB-212562</span>
                                    </div>
                                    <div
                                        class="d-flex align-items-center text-sm"
                                    >
                                        $560
                                        <button
                                            class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"
                                        >
                                            <i
                                                class="material-icons text-lg position-relative me-1"
                                                >picture_as_pdf</i
                                            >
                                            PDF
                                        </button>
                                    </div>
                                </li>
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg"
                                >
                                    <div class="d-flex flex-column">
                                        <h6
                                            class="text-dark mb-1 font-weight-bold text-sm"
                                        >
                                            June, 25, 2019
                                        </h6>
                                        <span class="text-xs">#QW-103578</span>
                                    </div>
                                    <div
                                        class="d-flex align-items-center text-sm"
                                    >
                                        $120
                                        <button
                                            class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"
                                        >
                                            <i
                                                class="material-icons text-lg position-relative me-1"
                                                >picture_as_pdf</i
                                            >
                                            PDF
                                        </button>
                                    </div>
                                </li>
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg"
                                >
                                    <div class="d-flex flex-column">
                                        <h6
                                            class="text-dark mb-1 font-weight-bold text-sm"
                                        >
                                            March, 01, 2019
                                        </h6>
                                        <span class="text-xs">#AR-803481</span>
                                    </div>
                                    <div
                                        class="d-flex align-items-center text-sm"
                                    >
                                        $300
                                        <button
                                            class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"
                                        >
                                            <i
                                                class="material-icons text-lg position-relative me-1"
                                                >picture_as_pdf</i
                                            >
                                            PDF
                                        </button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <broker-form
            ref="broker_form"
            @getBrokerData="getBrokerData"
        ></broker-form>
    </layout>
</template>

<script setup>
import layout from "@/components/App/layout.vue";
import { Head } from "@inertiajs/inertia-vue3";
import brokerForm from "../components/App/brokerForm.vue";
import { has_permission } from "../appExternal";

import { reactive, ref, onMounted, computed } from "vue";

const data = reactive({
    brokerData: Object,
    permissions: Object,
    errors: {},
    table: true,
    pages: 0,
    per_page: 5,
    current_page: 1,
    search:"",
});

const props = defineProps({
    user: Object,
});

const broker_form = ref(null);

onMounted(() => {
    getBrokerData();
});

function getBrokerData() {
    let pagination_data = {
        page: data.current_page,
        per_page: data.per_page,
        search : data.search,
    };
    axios
        .post("getBrokerData", pagination_data)
        .then(function (response) {
            if (response.data.broker_data) {
                data.brokerData = response.data.broker_data;
                data.pages = response.data.pages;
            }
        })
        .catch(function (error) {
            console.log(error);
        });
}

function deleteBrokerData(id, broker_name) {
    Swal.fire({
        title: "Are you sure?",
        text: "Do You Want To Delete " + broker_name + " Record",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            axios
                .post("deleteBrokerData/" + id)
                .then(function (response) {
                    if (response.data.delete) {
                        Swal.fire("Deleted!", response.data.delete, "success");
                        getBrokerData();
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

function changePerpage() {
    data.current_page = 1;
    getBrokerData();
}

function searchData(search) {
    if(search){
        data.current_page = 1;
        data.search = search;
    } else {
        data.search = "";
    }
    getBrokerData();
}

function changePage(page) {
    data.current_page = page;
    getBrokerData();
}

function addNewBroker() {
    broker_form.value.clearForm();
    broker_form.value.openModel(props.user.id);
}

function editBrokerData(data) {
    broker_form.value.editBrokerData(data);
}
</script>
