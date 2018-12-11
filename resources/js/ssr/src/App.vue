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

Vue.component('VueFormRenderer', VueFormRenderer);
Vue.component('FormText', FormText);
Vue.component('FormMultiColumn', FormMultiColumn);

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