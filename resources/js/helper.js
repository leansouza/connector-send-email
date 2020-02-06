export default {
    computed: {
        modeler() {
            return this.$root.$children[0].$refs.modeler;
        },
        highlightedNode() {
            return this.modeler.highlightedNode;
        },
        definition() {
            return this.highlightedNode.definition;
        },
        nodeId() {
            return this.highlightedNode._modelerId;
        }
    }
}
