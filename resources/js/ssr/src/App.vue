<template>
    <div>
        <vue-form-renderer @submit="previewSubmit" v-model="formData" :config="config" />
        <!-- ['config', 'data', 'page', 'computed', 'customCss', 'mode'] -->
    </div>
</template>

<script>
import Vue from 'vue'
import { VueFormRenderer } from "@processmaker/screen-builder";

Vue.component('VueFormRenderer', VueFormRenderer);

import Vuex from 'vuex';
Vue.use(Vuex);
const store = new Vuex.Store({ modules: {} });

Vue.mixin({
    store,
    methods: {
        '$t'() {}
    }
})

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