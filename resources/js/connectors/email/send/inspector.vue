<template>
  <b-card no-body class="p-0 h-100 border-0 rounded-0">
    <b-card-body class="p-0 h-100 overflow-auto">

      <button
        v-b-toggle.configuration
        variant="outline"
        class="accordion-button text-left card-header d-flex align-items-center w-100 border-right-0 border-left-0 border-top-0"
        @click="showConfiguration = !showConfiguration"
      >
        <i class="fas fa-cog mr-2"/>
        {{ $t('Configuration' ) }}
        <i
          class="fas fa-angle-down ml-auto"
          :class="{ 'fas fa-angle-right' : showConfiguration }"></i>
      </button>
     
      <div class="form-group pl-4 pr-4 pt-3 pb-3 border-bottom m-0">
        <label>{{ $t('Name') }}</label>
        <input v-model="definition.name" name="name" placeholder type="text" class="form-control"/>
        <small class="form-text text-muted">{{ $t('Enter the name of this element') }}</small>
      </div>

      <email-options v-model="emailOptionsConfig" :node="node()"></email-options>
    </b-card-body>
  </b-card>

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
