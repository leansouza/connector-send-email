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
        {{ $t('Configuration Send Email' ) }}
        <i
          class="fas fa-angle-down ml-auto"
          :class="{ 'fas fa-angle-right' : showConfiguration }"></i>
      </button>
      <email-options :value="value" :node="node()"></email-options>
    </b-card-body>
  </b-card>

</template>


<script>
  import EmailOptions from "./EmailOptions";

  export default {
    components: {
      EmailOptions
    },
    props: ["value"],
    methods: {
      node() {  
        return this.$parent.$parent.$parent.highlightedNode.definition;
      }, 
    },
    data() {
      return {
        showConfiguration: false,
      }
    },
  };
</script>

<style lang="scss" scoped>
</style>
