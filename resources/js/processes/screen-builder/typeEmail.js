import globalProperties from "@processmaker/screen-builder/src/global-properties";
import {FormBuilderControls} from "@processmaker/screen-builder";

const RichTextControl = FormBuilderControls.find(control => control.rendererBinding === "FormHtmlEditor");

const TableControl = FormBuilderControls.find(control => control.rendererBinding === "FormMultiColumn");

const FormRecordList = FormBuilderControls.find(control => control.rendererBinding === "FormRecordList");

// Remove editable inspector props
FormRecordList.control.inspector = FormRecordList.control.inspector.filter(prop => prop.field !== "editable" && prop.field !== "form");

let emailControls = [
  RichTextControl,
  TableControl,
  FormRecordList,
];

ProcessMaker.EventBus.$on("screen-builder-init", (manager) => {
  emailControls.forEach((item) => {
    item.control.inspector.push(...globalProperties[0].inspector);
    manager.type = 'email';
    manager.addControl(
      item.control,
      item.rendererComponent,
      item.rendererBinding,
      item.builderComponent,
      item.builderBinding
    );
  });
});
