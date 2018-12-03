import emailSend from './connectors/email/send/index';
let nodeTypes = [
    emailSend,
];
ProcessMaker.EventBus.$on('modeler-init', function(modeler) {
    for (var node of nodeTypes) {
        modeler.registerNode(node, () => node.id);
    }
});
