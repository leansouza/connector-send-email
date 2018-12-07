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
});
