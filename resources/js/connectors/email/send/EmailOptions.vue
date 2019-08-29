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
            ref="userGoupSelect"
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
    props: ["value"],
    data() {
      return {
        showConfiguration: false,
        usersGroupsSelected: { users: [], groups: [] },
        config: {
          subject: '',
          type: 'screen',
          textBody: '',
          screenRef: '',
          email: '',
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
          this.$emit('input', this.config);
        }
      },
      usersGroupsSelected: {
        deep: true,
        handler() {
          this.config.users = this.usersGroupsSelected.users;
          this.config.groups = this.usersGroupsSelected.groups;
        }
      },
      value: {
        immediate: true,
        handler() {
          Vue.set(this, 'config', this.value);
          Vue.set(this, 'usersGroupsSelected', {'users': this.config.users, 'groups': this.config.groups});
        }
      },
    },
    computed: {},
    methods: {},
  };
</script>

<style lang="scss" scoped>
.email-options {
    div.card {
        padding: 0!important;
    }
}
</style>
