export default {
    data() {
        return {
            highlightedNode: null,
            highlightedNodePath: '',
        }
    },
    created() {
        let i = 1;
        let ref = this.$parent;

        while(typeof ref.highlightedNode === 'undefined' && i < 10) {
            ref = ref.$parent;
            i++;
        }
        if (typeof ref.highlightedNode === 'undefined') {
            throw "highlighted node not found in 10 parent levels";
        }

        this.highlightedNode = ref.highlightedNode;
        this.highlightedNodePath = '$parent.'.repeat(i) + 'highlightedNode';
    },
};