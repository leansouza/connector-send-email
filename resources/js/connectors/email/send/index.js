
import component from './component.vue';

const implementation = 'processmaker-communication-email-send';
const nodeId = 'processmaker-communication-email-send';

export default  {
    id: nodeId,
    component: component,
    bpmnType: 'bpmn:ServiceTask',
    control: true,
    category: 'Communication',
    icon: require('./icon.svg'),
    label: 'Send Email',
    definition: function(moddle) {
        return moddle.create('bpmn:ServiceTask', {
            name: 'Send Email',
            implementation,
        });
    },
    diagram: function(moddle) {
        return moddle.create('bpmndi:BPMNShape', {
            bounds: moddle.create('dc:Bounds', {
                height: 80,
                width: 100,
            }),
        });
    },
    inspectorHandler: function(value, definition, component) {
        // Go through each property and rebind it to our data
        for (var key in value) {
            // Only change if the value is different
            if (definition[key] != value[key]) {
                definition[key] = value[key];
            }
        }
        component.updateShape();
    },
    inspectorConfig: [
        {
            name: 'Send Email',
            items: [
                {
                    component: 'FormText',
                    config: {
                        label: 'Send Email',
                        fontSize: '2em',
                    },
                },
                {
                    component: 'FormInput',
                    config: {
                        label: 'Email',
                        helper: "Recipient's Email",
                        name: 'config.email',
                    },
                },
                {
                    component: 'FormInput',
                    config: {
                        label: 'Name',
                        helper: "recipient's name",
                        name: 'config.targetName',
                    },
                },
                {
                    component: 'FormInput',
                    config: {
                        label: 'Subject',
                        helper: 'Subject of the message',
                        name: 'config.targetName',
                    },
                },
                {
                    component: 'FormInput',
                    config: {
                        label: 'Template',
                        helper: 'Template of the message',
                        name: 'config.template',
                    },
                },
            ],
        },
    ],
};
