import emailSend from './connectors/email/send/index';
let nodeTypes = [
    emailSend,
];
window.ProcessMaker.EventBus.$on('modeler-init', ({ registerNode, registerBpmnExtension })  => {
    /* Register basic node types */
    for (const node of nodeTypes) {
        registerNode(node);
    }
});
