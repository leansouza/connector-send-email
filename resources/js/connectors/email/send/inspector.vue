<template>
    <div>
        <div class="form-group">
            <label>{{ $t('Email') }}</label>
            <input v-model="config.email" class="form-control">
            <small class="form-text text-muted">{{ $t('Recipient\'s email address') }}</small>
        </div>
        <div class="form-group">
            <label>{{ $t('Name') }}</label>
            <input v-model="config.targetName" class="form-control">
            <small class="form-text text-muted">{{ $t('Recipient\'s name') }}</small>
        </div>
        <div class="form-group">
            <label>{{ $t('Subject') }}</label>
            <input v-model="config.subject" class="form-control">
            <small class="form-text text-muted">{{ $t('Email subject') }}</small>
        </div>
        <modeler-screen-select :label="$t('Email body')"
                               :helper="$t('What Screen Should Be Used For Sending This Email')"
                               :params='{type:"EMAIL"}'
                               v-model='config.screenRef'>
        </modeler-screen-select>
    </div>
</template>


<script>
  export default {
    props: ["value"],
    data() {
      return {
        config: {
          email: '',
          targetName: '',
          subject: '',
          screenRef: '',
        },
      };
    },
    watch: {
      config: {
        deep: true,
        handler() {
          this.updateConfig();
        }
      },
      value() {
        this.loadConfig();
      },
    },
    computed: {},
    methods: {
      loadConfig() {
        const node = this.$parent.$parent.highlightedNode.definition;
        const config = JSON.parse(_.get(node, 'config'));
        Object.keys(config).forEach(key => {
          Vue.set(this.config, key, config[key]);
        });
      },
      updateConfig() {
        const node = this.$parent.$parent.highlightedNode.definition;
        Vue.set(node, 'config', JSON.stringify(this.config));
      },
    },
    mounted() {
      this.loadConfig();
    }
  };
</script>

<style lang="scss" scoped>
</style>
