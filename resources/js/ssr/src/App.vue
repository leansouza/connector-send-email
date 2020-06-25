<template>
    <div>
        <vue-form-renderer @submit="previewSubmit" v-model="formData" :config="modifiedConfig()" />
    </div>
</template>

<script>
import Vue from 'vue'
import { VueFormRenderer } from "@processmaker/screen-builder";
import FormHtmlEditorStatic from '../../processes/screen-builder/FormHtmlEditorStatic';
import Vuex from 'vuex';

Vue.use(Vuex);
Vue.component('FormHtmlEditorStatic', FormHtmlEditorStatic);
Vue.component('vue-form-renderer', VueFormRenderer);

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
                    if (item.container) {
                        item.items.forEach((containerItem, containerIndex) => {
                            if (Array.isArray(containerItem)) {
                            // Multicolumn

                            containerItem.forEach((childItem, childIndex) => {
                                if (childItem.component == 'FormHtmlViewer') {
                                    this.config[pageIndex].items[itemIndex].items[containerIndex][childIndex].component = 'FormHtmlEditorStatic';
                                }
                            });
                            
                            } else {
                                // Loops
                                this.config[pageIndex].items[itemIndex].items[containerIndex].component = 'FormHtmlEditorStatic';
                            }
                        });
                    } else if (item.component == 'FormHtmlViewer') {
                        this.config[pageIndex].items[itemIndex].component = 'FormHtmlEditorStatic';
                    } else if (item.component == 'FormRecordList') {
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