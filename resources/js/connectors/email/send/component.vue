<template>
  <div>
  </div>
</template>

<script>
/**
 * A new control based on a Task node.
 *
 */
export default {
  extends: ProcessMaker.nodeTypes.get('processmaker-modeler-task').component,
  methods: {
    /**
     * Define the task marker
     */
    getMarker() {
      return { 'xlink:href': require('./marker.svg') };
    },
    /**
     * Define the inspector loaded when nthe control is selected
     */
    handleClick() {
      this.$parent.loadInspector('processmaker-communication-email-send', this.node.definition, this);
    },
  },
};
</script>
