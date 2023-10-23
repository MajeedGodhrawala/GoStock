<template>
    <!-- Add New Broker Modal -->
    <div
        class="modal fade"
        id="RoleForm"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5
                        class="modal-title font-weight-normal"
                        id="exampleModalLabel"
                    >
                        Role
                    </h5>
                    <button
                        type="button"
                        class="btn-close text-dark"
                        @click="hideModel()"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <p class="text-uppercase text-sm text-normal">
                            Role Information
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label
                                        for="example-text-input"
                                        class="form-control-label"
                                        >Name</label
                                    >
                                    <input
                                        class="form-control"
                                        type="text"
                                        v-model="data.formData.name"
                                        :class="
                                            data.errors.hasOwnProperty('name')
                                                ? 'is-invalid'
                                                : ''
                                        "
                                    />
                                    <div
                                        id="validationServer03Feedback"
                                        class="invalid-feedback"
                                        v-if="
                                            data.errors.hasOwnProperty('name')
                                        "
                                    >
                                        {{ data.errors.name[0] }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label
                                        for="example-text-input"
                                        class="form-control-label"
                                        >Display Name</label
                                    >
                                    <input
                                        class="form-control"
                                        type="text"
                                        v-model="data.formData.display_name"
                                        :class="
                                            data.errors.hasOwnProperty(
                                                'display_name'
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
                                                'display_name'
                                            )
                                        "
                                    >
                                        {{ data.errors.display_name[0] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn bg-gradient-secondary"
                        @click="hideModel()"
                    >
                        Close
                    </button>
                    <button
                        type="button"
                        @click="submitForm"
                        class="btn bg-gradient-primary"
                    >
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { reactive, ref, onMounted } from "vue";

const data = reactive({
    formData: {
        id: "",
        name: "",
        display_name: "",
    },
    errors: {},
    myModal: null,
});

const props = defineProps({});

onMounted(() => {
    data.myModal = new bootstrap.Modal("#RoleForm", {
        keyboard: false,
    });
});

function openModel() {
    data.myModal.show();
}

function hideModel() {
    data.myModal.hide();
}

function clearForm() {
    data.formData = {
        id: "",
        name: "",
        display_name: "",
    };
    data.errors = {};
}

function editRoleData(RoleData) {
    clearForm();
    data.formData = RoleData;
    openModel();
}

function submitForm() {
    let url = data.formData.id
        ? "roleCreateOrUpdate/" + data.formData.id
        : "roleCreateOrUpdate";

    axios
        .post(url, data.formData)
        .then(function (response) {
            if (response.data.success) {
                hideModel();
                emit("getRoleData");
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: response.data.success,
                    showConfirmButton: false,
                    timer: 900,
                });
            }
        })
        .catch(function (error) {
            if (error.response.data.errors) {
                data.errors = error.response.data.errors;
            } else if (error.message) {
                errorAlert(error.message);
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

defineExpose({
    openModel,
    clearForm,
    editRoleData,
});

const emit = defineEmits(["getRoleData"]);
</script>
