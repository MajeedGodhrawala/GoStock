<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li v-if="data.current_page != 1" class="page-item">
                <a class="page-link" @click="changePage((data.current_page - 1))">
                    <span class="material-icons"> keyboard_arrow_left </span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <template v-for="page in data.pages">
                <li class="page-item" 
                :class = "(page == data.current_page)?' active':''"
                @click="changePage(page)">
                    <a class="page-link text-info">{{ page }}</a>
                </li>
            </template>
            <li v-if="data.current_page != data.pages" class="page-item">
                <a class="page-link" @click="changePage((data.current_page + 1))">
                    <span class="material-icons"> keyboard_arrow_right </span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
</template>
<script setup>
import { reactive } from "vue";

const data = reactive({
    pages: Number,
    current_page:1,
    errors: {},
});

const props = defineProps({});

function setPagination(pages) {
    data.pages = pages;
}

function changePage(page) {
    data.current_page = page;
    emit("changePage", page);
}

defineExpose({
    setPagination,
});

const emit = defineEmits(["changePage"]);
</script>
