<template>
    <div>
        <vue-form-renderer @submit="previewSubmit" v-model="formData" :config="config" />
    </div>
</template>

<script>
import Vue from 'vue'
import VueFormRenderer from "@processmaker/vue-form-builder/src/components/vue-form-renderer";
import FormText from "@processmaker/vue-form-builder/src/components/renderer/form-text";
import FormMultiColumn from "@processmaker/vue-form-builder/src/components/renderer/form-multi-column";
import FormRecordList from "@processmaker/vue-form-builder/src/components/renderer/form-record-list";
import Vuetable from "vuetable-2/src/components/Vuetable";
import VuetablePagination from "vuetable-2/src/components/VuetablePagination";

Vue.component('Vuetable', Vuetable);
Vue.component('VuetablePagination', VuetablePagination);
Vue.component('VueFormRenderer', VueFormRenderer);
Vue.component('FormText', FormText);
Vue.component('FormMultiColumn', FormMultiColumn);
Vue.component('FormRecordList', FormRecordList);

export default {
    props: ['config', 'formData'],
    data() {
        return {
        };
    },
    methods: {
        previewSubmit() {
        }
    }
}
</script>