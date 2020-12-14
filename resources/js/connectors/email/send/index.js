
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
    label: window.ProcessMaker.i18n.t('Send Email'),
    /**
     * BPMN definition
     */
    definition: function(moddle) {
        return moddle.create('bpmn:ServiceTask', {
            name: window.ProcessMaker.i18n.t('Send Email'),
            implementation,
            config: JSON.stringify({ type: 'text', subject: '', textBody: '', screenRef: null, users: [], groups: [] }),
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
    inspectorHandler(value, node, setNodeProp) {
        // Go through each property and rebind it to our data
        for (const key in value) {
            if (node.definition[key] === value[key]) {
                continue;
            }

            if (node[key] = key === 'config') {
                setNodeProp(node, key, JSON.stringify(value[key]));
            } else {
                setNodeProp(node, key, value[key]);
            }
        }
    },
    /**
     * Inspector definition
     */
    inspectorConfig: [
        {
            name: 'Send Email',
            items: [
                {
                    component: 'FormAccordion',
                    container: true,
                    config: {
                        initiallyOpen: true,
                        label: 'Configuration',
                        icon: 'cog',
                        name: 'inspector-accordion',
                    },
                    items: [
                        {
                            component: inspector,
                            config: {
                                name: '',
                            },
                        },
                    ],
                },
                {
                    component: 'FormAccordion',
                    container: true,
                    config: {
                        initiallyOpen: false,
                        label: 'Advanced',
                        icon: 'cogs',
                        name: 'inspector-accordion',
                    },
                    items: [
                        {
                            component: 'FormInput',
                            config: {
                                label: 'Node Identifier',
                                helper: 'Enter the id that is unique from all other elements in the diagram',
                                name: 'id',
                                validation: 'required|regex:/^[a-zA-Z][^\\s][a-zA-Z0-9_-]+$/',
                            },
                        },
                    ],
                },
            ],
        },
    ],
};
