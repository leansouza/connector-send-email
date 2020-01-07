<template>
  <div>
    <email-options v-model="emailOptionsConfig" :node="node()"></email-options>
  </div>
</template>

<script>
  import EmailOptions from "./EmailOptions";
  import helper from '../../../helper';

  export default {
    components: {
      EmailOptions
    },
    mixins: [helper],
    props: ["value"],
    methods: {
      node() {  
        return this.highlightedNode.definition;
      }, 
      loadConfig() {
        if (_.get(this.node(), 'config')) {
          this.emailOptionsConfig = JSON.parse(_.get(this.node(), 'config'));
        }
      },
    },
    watch: {
      emailOptionsConfig: {
        deep: true,
        handler()  {
          Vue.set(this.node(), 'config',  JSON.stringify(this.emailOptionsConfig));
        }
      }
    },
    data() {
      return {
        showConfiguration: false,
        emailOptionsConfig: null, // will be set on init in EmailOptions.vue, no need to duplicate here
      }
    },
    mounted() {
      this.loadConfig();
    }
  };
</script>

<style lang="scss" scoped>
</style>
