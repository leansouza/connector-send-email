<template>
  <div>
  </div>
</template>

<script>
import { task } from '@processmaker/modeler';
export default {
  extends: task.component,
  methods: {
    handleClick() {
      this.$parent.loadInspector('processmaker-communication-email-send', this.node.definition, this);
    },
  },
};
</script>
