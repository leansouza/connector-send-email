import {renderer, FormBuilderControls} from "@processmaker/screen-builder";
import FormHtmlEditorStatic from './FormHtmlEditorStatic'

const {
    FormRecordListStatic,
} = renderer;

const TableControl = FormBuilderControls.find(control => control.rendererBinding === 'FormMultiColumn');

const RichTextControl = FormBuilderControls.find(control => control.rendererBinding === 'FormHtmlEditor');
RichTextControl.control.component = 'FormHtmlEditorStatic';
RichTextControl.rendererBinding = 'FormHtmlEditorStatic';
RichTextControl.rendererComponent = Vue.component('FormHtmlEditorStatic', FormHtmlEditorStatic);

const FormRecordList = FormBuilderControls.find(control => control.rendererBinding === 'FormRecordList');
FormRecordList.control.component = 'FormRecordListStatic';
FormRecordList.rendererBinding = 'FormRecordListStatic';
FormRecordList.rendererComponent = Vue.component('FormRecordListStatic', FormRecordListStatic);

let emailControls = [
    RichTextControl,
    TableControl,
    FormRecordList,
];

ProcessMaker.EventBus.$on("screen-builder-init", (manager) => {
    for (let item of emailControls) {
        manager.type = 'email';
        manager.addControl(
           item.control,
           item.rendererComponent,
           item.rendererBinding,
           item.builderComponent,
           item.builderBinding
        );
    }
});