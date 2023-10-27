<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li v-if="current_page != 1" class="page-item">
                <button class="page-link" @click="changePage(current_page - 1)">
                    <span class="material-icons"> keyboard_arrow_left </span>
                    <span class="sr-only">Previous</span>
                </button>
            </li>
            <template v-for="page in pages">
                <li
                    class="page-item"
                    :class="page == current_page ? ' active' : ''"
                    @click="changePage(page)"
                >
                    <button class="page-link text-info">{{ page }}</button>
                </li>
            </template>
            <li v-if="current_page != pages" class="page-item">
                <button class="page-link" @click="changePage(current_page + 1)">
                    <span class="material-icons"> keyboard_arrow_right </span>
                    <span class="sr-only">Next</span>
                </button>
            </li>
        </ul>
    </nav>
</template>
<script setup>
import { reactive, onMounted } from "vue";

const data = reactive({
    errors: {},
});

const props = defineProps({
    pages: Number,
    current_page: Number,
});

function changePage(page) {
    emit("changePage", page);
}

defineExpose({});

const emit = defineEmits(["changePage"]);
</script>
