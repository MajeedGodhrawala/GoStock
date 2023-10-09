<template>
    <section>
        <div class="page-header min-vh-75">
            <div class="container">
                <div class="row">
                    <div
                        class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto"
                    >
                        <div class="card card-plain mt-8">
                            <div
                                class="alert blur shadow border-radius-md alert-secondary text-center me-2 d-flex align-items-center justify-content-center"
                                role="alert"
                                v-if="data.errors.hasOwnProperty('login_error')"
                            >
                                <strong class="text-danger opacity-7">
                                    <i class="fa fa-ban opacity-10  text-danger me-1"></i>
                                    {{ data.errors.login_error }}!
                                </strong>
                            </div>
                            <div
                                class="card-header pb-0 text-left bg-transparent"
                            >
                                <h3
                                    class="font-weight-bolder text-info text-gradient"
                                >
                                    Welcome back
                                </h3>
                                <p class="mb-0">
                                    Enter your email or phone number and
                                    password to sign in
                                </p>
                            </div>
                            <div class="card-body">
                                <label>Email</label>
                                <div class="mb-3">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Email Address Or Phone Number"
                                        v-model="
                                            data.formData.email_phonenumber
                                        "
                                        :class="
                                            data.errors.hasOwnProperty(
                                                'email_phonenumber'
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
                                                'email_phonenumber'
                                            )
                                        "
                                    >
                                        {{ data.errors.email_phonenumber }}
                                    </div>
                                </div>
                                <label>Password</label>
                                <div class="mb-3">
                                    <input
                                        type="password"
                                        class="form-control"
                                        placeholder="Password"
                                        v-model="data.formData.password"
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
                                        {{ data.errors.password }}
                                    </div>
                                </div>
                                <div class="form-check form-switch">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        id="rememberMe"
                                        checked=""
                                    />
                                    <label
                                        class="form-check-label"
                                        for="rememberMe"
                                        >Remember me</label
                                    >
                                </div>
                                <div class="text-center">
                                    <button
                                        type="button"
                                        @click="submitForm"
                                        class="btn bg-gradient-info w-100 mt-4 mb-0"
                                    >
                                        Sign in
                                    </button>
                                </div>
                            </div>
                            <div
                                class="card-footer text-center pt-0 px-lg-2 px-1"
                            >
                                <p class="mb-4 text-sm mx-auto">
                                    Don't have an account?
                                    <a
                                        href="register"
                                        class="text-info text-gradient font-weight-bold"
                                        >Sign up</a
                                    >
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div
                            class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8"
                        >
                            <div
                                class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                style="
                                    background-image: url('../img/curved-images/curved6.jpg');
                                "
                            ></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup>
import { reactive } from "vue";

const data = reactive({
    formData: {
        email_phonenumber: "1234567890",
        password: "12345678",
    },
    errors: {},
});

function submitForm() {
    data.errors = {};
    axios
        .post("loginUser", data.formData)
        .then(function (response) {
            if (response.data.login_error) {
                data.errors = response.data;
            }
            if (response.data.success) {
                window.location.href = "dashboard";
            }
        })
        .catch(function (error) {
            // handle error
            data.errors = error.response.data.errors;
        });
}
</script>
