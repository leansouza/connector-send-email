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

      <b-collapse id="configuration" visible>
        <div class="form-group pl-4 pr-4 pt-3 pb-3 border-bottom m-0">
          <label>{{ $t('Subject') }}</label>
          <input v-model="config.subject" class="form-control">
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
            label=""
            :helper="$t('What Screen Should Be Used For Sending This Email')"
            :params='{type:"EMAIL"}'
            v-model='config.screenRef'>
          </modeler-screen-select>
        </div>

        <div class="form-group pl-4 pr-4 pt-3 pb-3 border-bottom m-0">
          <label>{{ $t('Recipients') }}</label>
          <label>{{ $t('(Select all that apply)') }}</label>
          <user-group-select
            label=""
            class="p-0"
            v-bind:multiple="true"
            v-model="usersGroupsSelected"
          >
          </user-group-select>
        </div>

        <div class="form-group pl-4 pr-4 pt-3 pb-3 border-bottom m-0">
          <add-input
            class="p-0"
            :label="$t('Add additional emails')"
            :placeholder="$t('enter email')"
            v-model="config.addEmails"
          ></add-input>
        </div>

      </b-collapse>


    </b-card-body>
  </b-card>

</template>


<script>
  import AddInput from "./AddInput";
  export default {
    components: {AddInput},
    props: ["value"],
    data() {
      return {
        showConfiguration: false,
        assignedUsers: [],
        assignedGroups: [],
        usersGroupsSelected: [],
        config: {
          subject: '',
          type: 'screen',
          textBody: '',
          screenRef: '',
          email: '',
          targetName: '',
          addEmails: []
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
            this.assignedUsers = this.usersGroupsSelected.users;
          }
          if (this.usersGroupsSelected && this.usersGroupsSelected.groups) {
            this.assignedGroups = this.usersGroupsSelected.groups;
          }
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
        let assignedUsers = _.get(node, 'assignedUsers');
        let assignedGroups = _.get(node, 'assignedGroups');

        Vue.set(this.usersGroupsSelected, 'users', assignedUsers ? assignedUsers.split(',') : []);
        Vue.set(this.usersGroupsSelected, 'groups', assignedGroups ? assignedGroups.split(',') : []);

        Object.keys(config).forEach(key => {
          Vue.set(this.config, key, config[key]);
        });
      },
      updateConfig() {
        const node = this.$parent.$parent.highlightedNode.definition;
        Vue.set(node, 'config', JSON.stringify(this.config));
        Vue.set(node, 'assignedUsers', this.assignedUsers.join());
        Vue.set(node, 'assignedGroups', this.assignedGroups.join());
      },
    },
    mounted() {
      this.loadConfig();
    }
  };
</script>

<style lang="scss" scoped>
</style>
