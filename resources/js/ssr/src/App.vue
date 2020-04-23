<template>
    <div>
        <vue-form-renderer @submit="previewSubmit" v-model="formData" :config="modifiedConfig()" />
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
        },
    
        modifiedConfig() {
            this.config.forEach((page, pageIndex) => {
                page.items.forEach((item, itemIndex) => {
                    if (item.component == 'FormRecordList') {
                        const optionsList = item.config.fields.optionsList;
                        this.config[pageIndex].items[itemIndex].config.fields = optionsList;
                        this.config[pageIndex].items[itemIndex].component = 'FormRecordListStatic'; 
                    }
                });
            });
            
            return this.config;
        }
    }
}
</script>