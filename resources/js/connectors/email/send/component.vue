<template>
  <div>
  </div>
</template>

<script>
import icon from './marker.svg';

/**
 * A new control based on a Task node.
 *
 */
export default {
  extends: ProcessMaker.nodeTypes.get('processmaker-modeler-task').component,
  methods: {
    /**
     * Define the inspector loaded when nthe control is selected
     */
    handleClick() {
      this.$parent.loadInspector('processmaker-communication-email-send', this.node.definition, this);
    },
  },
  mounted() {
    // Define the task marker
    this.shape.attr('image/xlink:href', icon);
  },
};
</script>
