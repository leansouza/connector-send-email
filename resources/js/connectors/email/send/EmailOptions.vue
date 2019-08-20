<template>
    <div class="email-options">
   
        <div class="form-group pl-4 pr-4 pt-3 pb-3 border-bottom m-0">
          <label>{{ $t('Subject') }}</label>
          <input v-model="config.subject" :placeholder="$t('RE:')" class="form-control">
          <small class="form-text text-muted">{{ $t('Email subject') }}</small>
        </div>

        <div class="form-group pl-4 pr-4 pt-3 pb-3 border-bottom m-0">
          <label>{{ $t('Body') }}</label>
          <select class="form-control" v-model="config.type">
            <option value="text">{{ $t('Plain Text') }}</option>
            <option value="screen">{{ $t('Display Screen') }}</option>
          </select>

          <textarea class="form-control mt-3" v-show="config.type === 'text'" v-model="config.textBody" rows="5">
          </textarea>

          <modeler-screen-select
            class="p-0"
            v-show="config.type === 'screen'"
            :helper="$t('What Screen Should Be Used For Sending This Email')"
            :params='{type:"EMAIL"}'
            v-model='config.screenRef'>
          </modeler-screen-select>
        </div>

        <div class="form-group pl-4 pr-4 pt-3 pb-3 m-0 border-bottom">
          <label>{{ $t('Recipients') }}</label>
          <user-group-select
            class="p-0 mb-0"
            v-bind:multiple="true"
            v-model="usersGroupsSelected"
          >
          </user-group-select>
          <small class="form-text text-muted">{{ $t('(Select all that apply)') }}</small>

           <add-input
            class="p-0"
            :label="$t('Add additional emails')"
            :placeholder="$t('enter email')"
            v-model="config.addEmails"
          ></add-input>
        </div>

    </div>

</template>

<script>
  import AddInput from "./AddInput";
  import UserGroupSelect from "./UserGroupSelect";

  export default {
    components: {
      AddInput,
      UserGroupSelect
    },
    props: ["value", "node", "defaultSubject"],
   data() {
      return {
        showConfiguration: false,
        usersGroupsSelected: [],
        config: {
          subject: '',
          type: 'screen',
          textBody: '',
          screenRef: '',
          email: '',
          targetName: '',
          addEmails: [],
          users : [],
          groups : [],
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
      usersGroupsSelected: {
        deep: true,
        handler() {
          if (this.usersGroupsSelected && this.usersGroupsSelected.users) {
            this.config.users = this.usersGroupsSelected.users;
          }
          if (this.usersGroupsSelected && this.usersGroupsSelected.groups) {
            this.config.groups = this.usersGroupsSelected.groups;
          }
          this.updateConfig();
        }
      },
      node() {
        this.loadConfig();
      }
    },
    computed: {},
    methods: {
      loadConfig() {
        if (this.node.$type == 'bpmn:Task') {
          this.config.subject = this.$t('RE: ') + this.node.name;
        } 
        const config = JSON.parse(_.get(this.node, 'config'));

        Object.keys(config).forEach(key => {
          Vue.set(this.config, key, config[key]);
        });
        
        Vue.set(this.node, 'usersGroupsSelected', {'users': config.users, 'groups': config.groups});
        
      },
      updateConfig() {
        if (this.node.$type == 'bpmn:Task') {
          this.$root.$emit('update-config', this.config);
        }
        Vue.set(this.node, 'config', JSON.stringify(this.config));
      },
    },
    mounted() {
      this.loadConfig(); 
    }
  };
</script>

<style lang="scss" scoped>
.email-options {
    div.card {
        padding: 0!important;
    }
}
</style>
