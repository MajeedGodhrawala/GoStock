<style>
.file_class {
    display: none;
}

.avatar:hover .profilepic__content {
    opacity: 1;
}

.avatar:hover .profilepic__image {
    opacity: 0.5;
}

.profilepic__image {
    object-fit: cover;
    opacity: 1;
    transition: opacity 0.2s ease-in-out;
}

.profilepic__content {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: white;
    opacity: 0;
    transition: opacity 0.2s ease-in-out;
}

.profilepic__icon {
    color: white;
    padding-bottom: 8px;
}

.fas {
    font-size: 20px;
}

.profilepic__text {
    text-transform: uppercase;
    font-size: 9px;
    width: 50%;
    text-align: center;
}
</style>
<template>
    <Head title="Profile" />
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
                        Profile
                    </li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Profile</h6>
            </nav>
        </template>
        <!-- Breadcrumb End -->
        <section>
            <div class="container-fluid px-2 px-md-4">
                <div
                    class="page-header min-height-300 border-radius-xl mt-4"
                    style="
                        background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');
                    "
                >
                    <span class="mask bg-gradient-primary opacity-6"></span>
                </div>
                <div class="card card-body mx-3 mx-md-4 mt-n6">
                    <div class="row gx-4">
                        <div class="col-auto">
                            <div
                                class="avatar avatar-xl position-relative"
                                @click="uploadProfileImg"
                            >
                                <img
                                    :src="data.userData.profile_img"
                                    alt="profile_image"
                                    class="w-100 border-radius-lg shadow-sm profilepic__image"
                                />
                                <div
                                    class="avatar avatar-xl profilepic__content"
                                >
                                    <span class="profilepic__icon"
                                        ><i class="fas fa-camera"></i
                                    ></span>
                                    <input
                                        id="fileInput"
                                        type="file"
                                        class="position-absolute file_class"
                                        v-on:change="getFileInputValue"
                                    />
                                    <span class="profilepic__text"
                                        >Edit Profile</span
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="col-auto my-auto">
                            <div class="h-100">
                                <h5 class="mb-1">
                                    {{ user.first_name + " " + user.last_name }}
                                </h5>
                                <p class="mb-0 font-weight-bold text-sm">
                                    {{ user.email }}
                                </p>
                            </div>
                        </div>
                        <div
                            class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3"
                        >
                            <div class="nav-wrapper position-relative end-0">
                                <ul
                                    class="nav nav-pills nav-fill p-1"
                                    role="tablist"
                                >
                                    <li class="nav-item">
                                        <a
                                            class="nav-link mb-0 px-0 py-1 active"
                                            data-bs-toggle="tab"
                                            href="javascript:;"
                                            role="tab"
                                            aria-selected="true"
                                        >
                                            <i
                                                class="material-icons text-lg position-relative"
                                                >home</i
                                            >
                                            <span class="ms-1">App</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a
                                            class="nav-link mb-0 px-0 py-1"
                                            data-bs-toggle="tab"
                                            href="javascript:;"
                                            role="tab"
                                            aria-selected="false"
                                        >
                                            <i
                                                class="material-icons text-lg position-relative"
                                                >email</i
                                            >
                                            <span class="ms-1">Messages</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a
                                            class="nav-link mb-0 px-0 py-1"
                                            data-bs-toggle="tab"
                                            href="javascript:;"
                                            role="tab"
                                            aria-selected="false"
                                        >
                                            <i
                                                class="material-icons text-lg position-relative"
                                                >settings</i
                                            >
                                            <span class="ms-1">Settings</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-flex align-items-center">
                                    <p class="mb-0 text-bold text-info">
                                        Edit Profile
                                    </p>
                                    <button
                                        @click="editProfile"
                                        class="btn btn-info btn-sm ms-auto"
                                    >
                                        Save Profile
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="text-uppercase text-sm text-normal">
                                    User Information
                                </p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label
                                                for="example-text-input"
                                                class="form-control-label"
                                                >First Name</label
                                            >
                                            <input
                                                class="form-control"
                                                type="text"
                                                v-model="
                                                    data.userData.first_name
                                                "
                                                :class="
                                                    data.errors.hasOwnProperty(
                                                        'first_name'
                                                    )
                                                        ? 'is-invalid'
                                                        : ''
                                                "
                                            />
                                            <div
                                                id="validationServer03Feedback"
                                                class="invalid-feedback"
                                                v-if="
                                                    data.errors.hasOwnProperty(
                                                        'first_name'
                                                    )
                                                "
                                            >
                                                {{ data.errors.first_name[0] }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label
                                                for="example-text-input"
                                                class="form-control-label"
                                                >Last Name</label
                                            >
                                            <input
                                                class="form-control"
                                                type="email"
                                                v-model="
                                                    data.userData.last_name
                                                "
                                                :class="
                                                    data.errors.hasOwnProperty(
                                                        'last_name'
                                                    )
                                                        ? 'is-invalid'
                                                        : ''
                                                "
                                            />
                                            <div
                                                id="validationServer03Feedback"
                                                class="invalid-feedback"
                                                v-if="
                                                    data.errors.hasOwnProperty(
                                                        'last_name'
                                                    )
                                                "
                                            >
                                                {{ data.errors.last_name[0] }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="horizontal dark" />
                                <p class="text-uppercase text-sm text-normal">
                                    Contact Information
                                </p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label
                                                for="example-text-input"
                                                class="form-control-label"
                                                >Email</label
                                            >
                                            <input
                                                class="form-control"
                                                type="email"
                                                v-model="data.userData.email"
                                                :class="
                                                    data.errors.hasOwnProperty(
                                                        'email'
                                                    )
                                                        ? 'is-invalid'
                                                        : ''
                                                "
                                            />
                                            <div
                                                id="validationServer03Feedback"
                                                class="invalid-feedback"
                                                v-if="
                                                    data.errors.hasOwnProperty(
                                                        'email'
                                                    )
                                                "
                                            >
                                                {{ data.errors.email[0] }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label
                                                for="example-text-input"
                                                class="form-control-label"
                                                >Phone Number</label
                                            >
                                            <input
                                                class="form-control"
                                                type="text"
                                                v-model="
                                                    data.userData.phone_number
                                                "
                                                :class="
                                                    data.errors.hasOwnProperty(
                                                        'phone_number'
                                                    )
                                                        ? 'is-invalid'
                                                        : ''
                                                "
                                            />
                                            <div
                                                id="validationServer03Feedback"
                                                class="invalid-feedback"
                                                v-if="
                                                    data.errors.hasOwnProperty(
                                                        'phone_number'
                                                    )
                                                "
                                            >
                                                {{
                                                    data.errors.phone_number[0]
                                                }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label
                                                for="example-text-input"
                                                class="form-control-label"
                                                >Country</label
                                            >
                                            <input
                                                class="form-control"
                                                type="text"
                                                v-model="data.userData.country"
                                                :class="
                                                    data.errors.hasOwnProperty(
                                                        'country'
                                                    )
                                                        ? 'is-invalid'
                                                        : ''
                                                "
                                            />
                                            <div
                                                id="validationServer03Feedback"
                                                class="invalid-feedback"
                                                v-if="
                                                    data.errors.hasOwnProperty(
                                                        'country'
                                                    )
                                                "
                                            >
                                                {{ data.errors.country[0] }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label
                                                for="example-text-input"
                                                class="form-control-label"
                                                >State</label
                                            >
                                            <input
                                                class="form-control"
                                                type="text"
                                                v-model="data.userData.state"
                                                :class="
                                                    data.errors.hasOwnProperty(
                                                        'state'
                                                    )
                                                        ? 'is-invalid'
                                                        : ''
                                                "
                                            />
                                            <div
                                                id="validationServer03Feedback"
                                                class="invalid-feedback"
                                                v-if="
                                                    data.errors.hasOwnProperty(
                                                        'state'
                                                    )
                                                "
                                            >
                                                {{ data.errors.state[0] }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="horizontal dark" />
                                <p class="text-uppercase text-sm text-normal">
                                    Change Password
                                </p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label
                                                for="example-text-input"
                                                class="form-control-label"
                                                >Password</label
                                            >
                                            <input
                                                class="form-control"
                                                type="password"
                                                v-model="data.userData.password"
                                                :class="
                                                    data.errors.hasOwnProperty(
                                                        'password'
                                                    )
                                                        ? 'is-invalid'
                                                        : ''
                                                "
                                            />
                                            <div
                                                id="validationServer03Feedback"
                                                class="invalid-feedback"
                                                v-if="
                                                    data.errors.hasOwnProperty(
                                                        'password'
                                                    )
                                                "
                                            >
                                                {{ data.errors.password[0] }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label
                                                for="example-text-input"
                                                class="form-control-label"
                                                >Confirm Password</label
                                            >
                                            <input
                                                class="form-control"
                                                type="password"
                                                v-model="
                                                    data.userData
                                                        .confirm_password
                                                "
                                                :class="
                                                    data.errors.hasOwnProperty(
                                                        'confirm_password'
                                                    )
                                                        ? 'is-invalid'
                                                        : ''
                                                "
                                            />
                                            <div
                                                id="validationServer03Feedback"
                                                class="invalid-feedback"
                                                v-if="
                                                    data.errors.hasOwnProperty(
                                                        'confirm_password'
                                                    )
                                                "
                                            >
                                                {{
                                                    data.errors
                                                        .confirm_password[0]
                                                }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-profile">
                            <img
                                :src="data.userData.profile_img"
                                class="card-img-top"
                            />
                            <div class="row justify-content-center">
                                <div class="col-4 col-lg-4 order-lg-2">
                                    <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                                        <a href="javascript:;">
                                            <img
                                                :src="data.userData.profile_img"
                                                class="rounded-circle img-fluid border border-2 border-white"
                                            />
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3"
                            >
                                <div class="d-flex justify-content-between">
                                    <a
                                        href="javascript:;"
                                        class="btn btn-sm btn-info mb-0 d-none d-lg-block"
                                        >Connect</a
                                    >
                                    <a
                                        href="javascript:;"
                                        class="btn btn-sm btn-info mb-0 d-block d-lg-none"
                                        ><i class="ni ni-collection"></i
                                    ></a>
                                    <a
                                        href="javascript:;"
                                        class="btn btn-sm btn-dark float-right mb-0 d-none d-lg-block"
                                        >Message</a
                                    >
                                    <a
                                        href="javascript:;"
                                        class="btn btn-sm btn-dark float-right mb-0 d-block d-lg-none"
                                        ><i class="ni ni-email-83"></i
                                    ></a>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col">
                                        <div
                                            class="d-flex justify-content-center"
                                        >
                                            <div class="d-grid text-center">
                                                <span
                                                    class="text-lg font-weight-bolder"
                                                    >22</span
                                                >
                                                <span class="text-sm opacity-8"
                                                    >Friends</span
                                                >
                                            </div>
                                            <div
                                                class="d-grid text-center mx-4"
                                            >
                                                <span
                                                    class="text-lg font-weight-bolder"
                                                    >10</span
                                                >
                                                <span class="text-sm opacity-8"
                                                    >Photos</span
                                                >
                                            </div>
                                            <div class="d-grid text-center">
                                                <span
                                                    class="text-lg font-weight-bolder"
                                                    >89</span
                                                >
                                                <span class="text-sm opacity-8"
                                                    >Comments</span
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <h5>
                                        Mark Davis<span
                                            class="font-weight-light"
                                            >, 35</span
                                        >
                                    </h5>
                                    <div class="h6 font-weight-300">
                                        <i class="ni location_pin mr-2"></i
                                        >Bucharest, Romania
                                    </div>
                                    <div class="h6 mt-4">
                                        <i
                                            class="ni business_briefcase-24 mr-2"
                                        ></i
                                        >Solution Manager - Creative Tim Officer
                                    </div>
                                    <div>
                                        <i class="ni education_hat mr-2"></i
                                        >University of Computer Science
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Edit Profile Modal Start -->
        <div
            class="modal fade"
            id="exampleModal"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                            Modal title
                        </h1>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">...</div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            Close
                        </button>
                        <button type="button" class="btn btn-primary">
                            Save changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Edit Profile Modal End -->
    </layout>
</template>

<script setup>
import layout from "@/components/App/layout.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { reactive } from "vue";

const data = reactive({
    userData: props.user,
    profile_img: props.user.profile_img,
    errors: {},
});

const props = defineProps({
    user: Object,
});

function editProfile() {
    data.errors = {};
    data.userData.profile_img = data.profile_img;
    axios
        .post("editProfile", data.userData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        })
        .then(function (response) {
            if (response.data.updated) {
                data.want_change_password = false;
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: response.data.updated,
                    showConfirmButton: false,
                    timer: 900,
                });

                data.userData = response.data.new_data;
            }
        })
        .catch(function (error) {
            // handle error
            data.errors = error.response.data.errors;
        });
}

function uploadProfileImg() {
    document.getElementById("fileInput").click();
}

const getFileInputValue = (event) => {
    const file = event.target.files[0];
    data.profile_img = file;
};
</script>
