export default {
    computed: {
        highlightedNode() {
            return this.$root.$children[0].$children[0].highlightedNode;
        },
        nodeId() {
            return this.highlightedNode.definition.id;
        }
    }
};