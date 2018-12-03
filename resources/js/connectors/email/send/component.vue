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
  mounted() {
    this.shape = new decoratedShape();
    let bounds = this.node.diagram.bounds;
    this.shape.position(bounds.x, bounds.y);
    this.shape.resize(bounds.width, bounds.height);
    this.shape.attr({
      body: {
        rx: 8,
        ry: 8,
      },
      label: {
        text: joint.util.breakText(this.node.definition.get('name'), { width: bounds.width }),
        fill: 'black',
      },

      image: { 'xlink:href': require('./icon.svg') }
    });
    this.shape.on('change:position', (element, position) => {
      this.node.diagram.bounds.x = position.x;
      this.node.diagram.bounds.y = position.y;
      // This is done so any flows pointing to this task are updated
      this.$emit(
        'move',
        {
          x: bounds.x,
          y: bounds.y,
        },
        element
      );
    });
    this.shape.addTo(this.graph);
    this.shape.component = this;
    this.$parent.nodes[this.id].component = this;
  },
};
</script>
