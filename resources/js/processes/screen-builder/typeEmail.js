/*import FormText from "@processmaker/screen-builder/src/components/renderer/form-text";
import FormMultiColumn from "@processmaker/screen-builder/src/components/renderer/form-multi-column";
import FormRecordList from "@processmaker/screen-builder/src/components/renderer/form-record-list";
import FormRecordListStatic from "@processmaker/screen-builder/src/components/renderer/form-record-list-static";*/

import {renderer, FormBuilderControls} from "@processmaker/screen-builder";

const {
  FormMultiColumn,
  FormText,
  FormRecordList,
  FormRecordListStatic,
} = renderer;

import {
  FormInput,
  FormSelect,
  FormTextArea,
  FormCheckbox,
  FormRadioButtonGroup,
  FormDatePicker,
  FormHtmlEditor,
} from "@processmaker/vue-form-elements";

import globalProperties from "@processmaker/screen-builder/src/global-properties";

const bgcolorProperty = {
  type: "ColorSelect",
  field: "bgcolor",
  config: {
    label: "Element Background color",
    helper: "Set the element's background color",
    options: [{
      value: 'alert alert-primary',
      content: 'primary'
    },
      {
        value: 'alert alert-secondary',
        content: 'secondary'
      },
      {
        value: 'alert alert-success',
        content: 'success'
      },
      {
        value: 'alert alert-danger',
        content: 'danger'
      },
      {
        value: 'alert alert-warning',
        content: 'warning'
      },
      {
        value: 'alert alert-info',
        content: 'info'
      },
      {
        value: 'alert alert-light',
        content: 'light'
      },
      {
        value: 'alert alert-dark',
        content: 'dark'
      },
    ]
  }
};
const colorProperty = {
  type: "ColorSelect",
  field: "color",
  config: {
    label: "Text color",
    helper: "Set the element's text color",
    options: [{
      value: 'text-primary',
      content: 'primary'
    },
      {
        value: 'text-secondary',
        content: 'secondary'
      },
      {
        value: 'text-success',
        content: 'success'
      },
      {
        value: 'text-danger',
        content: 'danger'
      },
      {
        value: 'text-warning',
        content: 'warning'
      },
      {
        value: 'text-info',
        content: 'info'
      },
      {
        value: 'text-light',
        content: 'light'
      },
      {
        value: 'text-dark',
        content: 'dark'
      },
    ]
  }
};

let initialControls = [
  {
    builderComponent: FormText,
    builderBinding: 'FormText',
    rendererComponent: FormText,
    rendererBinding: 'FormText',
    control: {
      label: 'Text',
      component: 'FormText',
      'editor-component': 'FormText',
      config: {
        icon: 'fas fa-align-justify',
        label: 'New Text',
        fontSize: '1em',
        fontWeight: 'normal',
        textAlign: 'left',
        verticalAlign: 'top',
        name: '',
      },
      inspector: [
        {
          type: 'FormTextArea',
          field: 'label',
          config: {
            rows: 5,
            label: 'Text Content',
            helper: 'The text to display',
          },
        },
        {
          type: 'FormMultiselect',
          field: 'fontWeight',
          config: {
            label: 'Font Weight',
            name: 'Font Weight',
            helper: 'The weight of the text',
            validation: 'required',
            options: [
              {
                value: 'normal',
                content: 'Normal',
              },
              {
                value: 'bold',
                content: 'Bold',
              },
            ],
          },
        },
        {
          type: 'FormMultiselect',
          field: 'textAlign',
          config: {
            label: 'Text Horizontal Alignment',
            name: 'Text Horizontal Alignment',
            helper: 'Horizontal alignment of the text',
            validation: 'required',
            options: [
              {
                value: 'center',
                content: 'Center',
              },
              {
                value: 'left',
                content: 'Left',
              },
              {
                value: 'right',
                content: 'Right',
              },
              {
                value: 'justify',
                content: 'Justify',
              },
            ],
          },
        },
        {
          type: 'FormMultiselect',
          field: 'verticalAlign',
          config: {
            label: 'Text Vertical Alignment',
            name: 'Text Vertical Alignment',
            helper: 'Vertical alignment of the text',
            validation: 'required',
            options: [
              {
                value: 'top',
                content: 'Top',
              },
              {
                value: 'middle',
                content: 'Middle',
              },
              {
                value: 'bottom',
                content: 'Bottom',
              },
            ],
          },
        },
        {
          type: 'FormMultiselect',
          field: 'fontSize',
          config: {
            label: 'Font Size',
            name: 'Font Size',
            helper: 'The size of the text in em',
            validation: 'required',
            options: [
              {
                value: '0.5em',
                content: '0.5',
              },
              {
                value: '1em',
                content: '1',
              },
              {
                value: '1.5em',
                content: '1.5',
              },
              {
                value: '2em',
                content: '2',
              },
            ],
          },
        },
        bgcolorProperty,
        colorProperty,
      ],
    },
  },
  {
    editorComponent: FormHtmlEditor,
    editorBinding: 'FormHtmlEditor',
    rendererComponent: FormHtmlEditor,
    rendererBinding: 'FormHtmlEditor',
    control: {
      label: 'Rich Text',
      component: 'FormHtmlEditor',
      'editor-component': 'FormHtmlEditor',
      config: {
        icon: 'fas fa-pencil-ruler',
        interactive: true,
        content: '<p>Rich text editor</p>',
      },
      inspector: [
        {
          type: 'FormTextArea',
          field: 'content',
          config: {
            rows: 5,
            label: 'Rich Text Content',
            helper: 'The HTML text to display',
            value: '',
          },
        },
        bgcolorProperty,
      ],
    },
  },
  {
    editorComponent: FormMultiColumn,
    editorBinding: 'FormMultiColumn',
    rendererComponent: FormMultiColumn,
    rendererBinding: 'FormMultiColumn',
    control: {
      label: 'Table',
      component: 'FormMultiColumn',
      'editor-component': 'MultiColumn',
      container: true,
      // Default items container
      items: [
        [],
        [],
      ],
      config: {
        icon: 'fas fa-table',
        options: [
          {
            value: '1',
            content: '6',
          },
          {
            value: '2',
            content: '6',
          },
        ],
      },
      inspector: [
        {
          type: 'ContainerColumns',
          field: 'options',
          config: {
            label: 'Column Widths',
          },
        },
        bgcolorProperty,
        colorProperty,
      ],
    },
  },
  {
    editorComponent: FormText,
    editorBinding: 'FormText',
    rendererComponent: FormRecordListStatic,
    rendererBinding: 'FormRecordList',
    control: {
      label: "Record List",
      component: 'FormRecordList',
      "editor-component": "FormText",
      config: {
        icon: 'fas fa-th-list',
        name: '',
        label: "New Record List",
        editable: false,
        fields: [],
        form: ''
      },
      inspector: [
        {
          type: "FormInput",
          field: "name",
          config: {
            label: "List Name",
            name: 'List Name',
            validation: 'required',
            helper: "The data name for this list"
          }
        },
        {
          type: "FormInput",
          field: "label",
          config: {
            label: "List Label",
            helper: "The label describes this record list"
          }
        },
        {
          type: "FormCheckbox",
          field: "editable",
          config: {
            label: "Editable?",
            helper: "Should records be editable/removable and can new records be added"
          }
        },
        {
          type: "OptionsList",
          field: "fields",
          config: {
            label: 'Fields List',
            helper: "List of fields to display in the record list"
          }
        },
        {
          type: "PageSelect",
          field: "form",
          config: {
            label: "Record Form",
            helper: "The form to use for adding/editing records"
          }
        },
        bgcolorProperty,
        colorProperty,
      ]
    },
  }
];


ProcessMaker.EventBus.$on('screen-builder-init', (manager) => {

  // Iterate through our initial config set, calling this.addControl
  initialControls.forEach(config => {
    //Load of additional properties for inspector
    config.control.inspector.push(...globalProperties[0].inspector);

    manager.addControl(
      config.control,
      config.rendererComponent,
      config.rendererBinding,
      config.builderComponent,
      config.builderBinding
    );
  });
});
