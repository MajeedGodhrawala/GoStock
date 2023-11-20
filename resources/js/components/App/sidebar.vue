<template>
    <aside
        class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark"
        id="sidenav-main"
    >
        <div class="sidenav-header">
            <i
                class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true"
                id="iconSidenav"
            ></i>
            <a
                class="navbar-brand m-0"
                href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard "
                target="_blank"
            >
                <img
                    src="img/logo-ct.png"
                    class="navbar-brand-img h-100"
                    alt="main_logo"
                />
                <span class="ms-1 font-weight-bold text-white"
                    >Material Dashboard 2</span
                >
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2" />
        <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <Link
                        class="nav-link text-white active bg-gradient-primary"
                        id="Link_id"
                        href="dashboard"
                    >
                        <div
                            class="text-white text-center me-2 d-flex align-items-center justify-content-center"
                        >
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </Link>
                </li>
                <li class="nav-item" v-if="has_permission('view_broker')">
                    <Link
                        class="nav-link text-white"
                        id="Link_id"
                        href="broker"
                    >
                        <div
                            class="text-white text-center me-2 d-flex align-items-center justify-content-center"
                        >
                            <i class="material-icons opacity-10"
                                >receipt_long</i
                            >
                        </div>
                        <span class="nav-link-text ms-1">broker</span>
                    </Link>
                </li>
                <li class="nav-item mt-3">
                    <h6
                        class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8"
                    >
                        Account pages
                    </h6>
                </li>
                <li class="nav-item" v-if="has_permission('view_profile')">
                    <Link
                        class="nav-link text-white"
                        id="Link_id"
                        href="profile"
                    >
                        <div
                            class="text-white text-center me-2 d-flex align-items-center justify-content-center"
                        >
                            <i class="fa-solid fa-user opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </Link>
                </li>
                <li class="nav-item" v-if="has_permission('view_role')">
                    <Link class="nav-link text-white" id="Link_id" href="role">
                        <div
                            class="text-white text-center me-2 d-flex align-items-center justify-content-center"
                        >
                            <i class="fa-solid fa-user-plus opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Role</span>
                    </Link>
                </li>
                <li class="nav-item">
                    <Link
                        class="nav-link text-white"
                        id="Link_id"
                        href="permission"
                    >
                        <div
                            class="text-white text-center me-2 d-flex align-items-center justify-content-center"
                        >
                            <i class="fa-solid fa-user-lock opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Permission</span>
                    </Link>
                </li>
            </ul>
        </div>
        <div class="sidenav-footer position-absolute w-100 bottom-0">
            <div class="mx-3">
                <a
                    class="btn btn-outline-primary mt-4 w-100"
                    href="https://www.creative-tim.com/learning-lab/bootstrap/overview/material-dashboard?ref=sidebarfree"
                    type="button"
                    >Documentation</a
                >
                <a
                    class="btn bg-gradient-primary w-100"
                    href="https://www.creative-tim.com/product/material-dashboard-pro?ref=sidebarfree"
                    type="button"
                    >Upgrade to pro</a
                >
            </div>
        </div>
    </aside>
</template>
<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { onMounted } from "vue";
// import { has_permission } from "../appExternal.js";
import { has_permission } from "../../appExternal";

onMounted(() => {
    var links = document.querySelectorAll("#Link_id");

    for (let link of links) {
        if (location.href.split("/").pop() == link.getAttribute("href")) {
            link.classList.add("active");
            link.classList.add("bg-gradient-primary");
        } else {
            link.classList.remove("active");
            link.classList.remove("bg-gradient-primary");
        }
    }
});
</script>
