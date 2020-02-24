export default {
    computed: {
        modeler() {
            return this.$root.$children[0].$refs.modeler;
        },
        highlightedNode() {
            return this.modeler.highlightedNodes[0];
        },
        definition() {
            return this.highlightedNode.definition;
        },
        nodeId() {
            return this.highlightedNode._modelerId;
        }
    }
}
