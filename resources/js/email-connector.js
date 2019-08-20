import emailSend from './connectors/email/send/index';
import Notification from './connectors/email/send/Notification';

window.Vue.component('EmailNotificationInspector', Notification);

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

    let config = {
      component: 'EmailNotificationInspector',
      name: 'email notification',
      container: true,
      config: {
        label: '',
        helper: '',
        name: '',
      },
    }

    let task = ProcessMaker.nodeTypes.get('processmaker-modeler-task')
    registerInspectorExtension(task, config);

});