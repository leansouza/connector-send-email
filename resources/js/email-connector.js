import emailSend from './connectors/email/send/index';
import EmailNotificationInspector from './connectors/email/send/Notification';

window.Vue.component('EmailNotificationInspector', EmailNotificationInspector);

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
      component: 'FormAccordion',
      name: "",
      container: true,
      config: {
        initiallyOpen: false,
        label: 'Email Notifications',
        icon: 'paper-plane',
        name: '',
      },
      items: [
        {
          component: 'EmailNotificationInspector',
          config: { label: '', helper: '', name: ''},
        },
      ]
    }

    let task = ProcessMaker.nodeTypes.get('processmaker-modeler-task')
    registerInspectorExtension(task, config);

});