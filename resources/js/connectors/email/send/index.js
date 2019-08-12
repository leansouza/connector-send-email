
import component from './component.vue';
import inspector from './inspector.vue';

const implementation = 'connector-send-email/processmaker-communication-email-send';
const nodeId = 'processmaker-communication-email-send';

export default  {
    // Component properties
    id: nodeId,
    component: component,
    bpmnType: 'bpmn:ServiceTask',
    control: true,
    category: 'Communication',
    icon: require('./icon.svg'),
    implementation,
    label: 'Send Email',
    /**
     * BPMN definition
     */
    definition: function(moddle) {
        return moddle.create('bpmn:ServiceTask', {
            name: 'Send Email',
            implementation,
            config: JSON.stringify({ email: '', targetName: '', subject: '', template: 'welcome' }),
        });
    },
    /**
     * BPMN definition (diagram)
     */
    diagram: function(moddle) {
        return moddle.create('bpmndi:BPMNShape', {
            bounds: moddle.create('dc:Bounds', {
                height: 76,
                width: 116,
            }),
        });
    },
    /**
     * Inspector handler
     */
    inspectorHandler: function(value, definition, component) {
        // Go through each property and rebind it to our data
        for (var key in value) {
            // Only change if the value is different
            if (definition[key] != value[key]) {
                definition[key] = key === 'config' ? JSON.stringify(value[key]) : value[key];
            }
        }
        component.updateShape();
    },
    /**
     * Inspector definition
     */
    inspectorConfig: [
        {
            name: 'Send Email',
            items: [
                {
                    component: inspector,
                    config: {
                        name: 'id',
                    },
                },
            ],
        },
    ],
};
