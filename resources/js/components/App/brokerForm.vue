<template>
    <!-- Add New Broker Modal -->
    <div
        class="modal fade"
        id="BrokerForm"
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
                        Broker
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
                            Broker Information
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label
                                        for="example-text-input"
                                        class="form-control-label"
                                        >Broker Name</label
                                    >
                                    <input
                                        class="form-control"
                                        type="text"
                                        v-model="data.formData.broker_name"
                                        :class="
                                            data.errors.hasOwnProperty(
                                                'broker_name'
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
                                                'broker_name'
                                            )
                                        "
                                    >
                                        {{ data.errors.broker_name[0] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark" />
                        <p class="text-uppercase text-sm text-normal">
                            Broker Contact Information
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
                                        v-model="data.formData.broker_email"
                                        :class="
                                            data.errors.hasOwnProperty(
                                                'broker_email'
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
                                                'broker_email'
                                            )
                                        "
                                    >
                                        {{ data.errors.broker_email[0] }}
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
                                            data.formData.broker_phone_number
                                        "
                                        :class="
                                            data.errors.hasOwnProperty(
                                                'broker_phone_number'
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
                                                'broker_phone_number'
                                            )
                                        "
                                    >
                                        {{ data.errors.broker_phone_number[0] }}
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
        user_id: "",
        broker_name: "",
        broker_email: "",
        broker_phone_number: "",
    },
    errors: {},
    myModal: null,
});

const props = defineProps({});

onMounted(() => {
    data.myModal = new bootstrap.Modal("#BrokerForm", {
        keyboard: false,
    });
});

function openModel(userId) {
    data.errors = {};
    data.formData.user_id = userId;
    data.myModal.show();
}

function hideModel() {
    data.myModal.hide();
}

function clearForm() {
    data.formData = {
        id: "",
        user_id: "",
        broker_name: "",
        broker_email: "",
        broker_phone_number: "",
    };
}

function editBrokerData(brokerData) {
    // data.formData = brokerData;
    data.formData.id = brokerData.id;
    data.formData.user_id = brokerData.user_id;
    data.formData.broker_name = brokerData.broker_name;
    data.formData.broker_email = brokerData.broker_email;
    data.formData.broker_phone_number = brokerData.broker_phone_number;

    openModel(brokerData.user_id);
}

function submitForm() {
    let url = data.formData.id
        ? "brokerCreateOrUpdate/" + data.formData.id
        : "brokerCreateOrUpdate";

    axios
        .post(url, data.formData)
        .then(function (response) {
            if (response.data.success) {
                hideModel();
                emit("getBrokerData");
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
            if(error.response.data.errors){
                data.errors = error.response.data.errors;
            } else if(error.message){
                errorAlert(error.message)
            }
        });
}

function errorAlert(error){
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: error,
        })
}

defineExpose({
    openModel,
    clearForm,
    editBrokerData,
});

const emit = defineEmits(["getBrokerData"]);
</script>
