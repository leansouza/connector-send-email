import emailSend from './connectors/email/send/index';
let nodeTypes = [
    emailSend,
];

/**
 * Initialize the connector.
 * 
 * Register the nodes it contains.
 */
window.ProcessMaker.EventBus.$on('modeler-init', ({ registerNode, registerBpmnExtension, registerInspectorExtension })  => {
    /* Register basic node types */
    for (const node of nodeTypes) {
        registerNode(node);
    }

    /* Register the inspector extensions for tasks */
    registerInspectorExtension(emailSend, {
        component: 'ModelerScreenSelect',
        config: {
            label: 'Screen For Input',
            helper: 'What Screen Should Be Used For Sending This Email',
            name: 'screenRef'
        }
    });
});
