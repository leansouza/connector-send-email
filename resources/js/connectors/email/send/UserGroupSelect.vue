<template>
  <div class="form-group">
    <label>{{ $t(label) }}</label>
    <multiselect
      v-bind="$attrs"
      v-model="content"
      track-by="id"
      label="fullname"
      :class="{'border border-danger':error}"
      :loading="loading"
      :placeholder="$t('type here to search')"
      :options="options"
      :show-labels="false"
      :searchable="true"
      :internal-search="false"
      group-values="items"
      group-label="type"
      @open="load"
      @search-change="load">
      <template slot="noResult">
        {{ $t('No elements found. Consider changing the search query.') }}
      </template>
      <template slot="noOptions">
        {{ $t('No Data Available') }}
      </template>
    </multiselect>
    <small v-if="error" class="text-danger">{{ error }}</small>
    <small v-if="helper" class="form-text text-muted">{{ $t(helper) }}</small>
  </div>
</template>


<script>
  import Multiselect from "vue-multiselect";

  export default {
    inheritAttrs: false,
    props: ["value", "label", "helper", "params"],
    components: {
      Multiselect
    },
    data() {
      return {
        content: [],
        loading: false,
        options: [],
        error: ''
      };
    },
    computed: {
      node() {
        return this.$parent.$parent.highlightedNode.definition;
      }
    },
    watch: {
      content: {
        handler() {
          let selected = {};
          selected.users = [];
          selected.groups = [];
          this.content.forEach(item => {
            if (typeof item.id === 'number') {
              selected.users.push(item.id);
            } else {
              selected.groups.push(parseInt(item.id.substr(6)));
            }
          });
          this.$emit("input", selected);
        }
      },
      value: {
        immediate: true,
        handler() {
          // Load selected item.
          if (this.content.length === 0 && this.value && this.value.users && this.value.groups) {
            this.loading = true;
            ProcessMaker.apiClient
              .all(
                this.value.users.map(item => {
                  return ProcessMaker.apiClient.get('users/' + item);
                })
              )
              .then(items => {
                this.loading = false;
                items.map(item => {
                  this.content.push(item.data);
                })
              });

            ProcessMaker.apiClient
              .all(
                this.value.groups.map(item => {
                  return ProcessMaker.apiClient.get('groups/' + item);
                })
              )
              .then(items => {
                this.loading = false;
                items.map(item => {
                  this.content.push(this.formatGroup(item.data));
                })
              });
          }
        },
      }
    },
    methods: {
      load(filter) {
        this.loading = true;
        this.options = [];
        ProcessMaker.apiClient
          .get("users?order_direction=asc&status=active" + (typeof filter === 'string' ? '&filter=' + filter : ''))
          .then(response => {
            this.options.push({
              'type': this.$t('Users'),
              'items': response.data.data ? response.data.data : []
            });
            this.loadUsersAndGroups(filter)
          })
          .catch(err => {
            this.loading = false;
          });
      },
      loadUsersAndGroups(filter) {
        ProcessMaker.apiClient
          .get("groups?order_direction=asc&status=active" + (typeof filter === 'string' ? '&filter=' + filter : ''))
          .then(response => {
            let groups = response.data.data.map(item => {
              return this.formatGroup(item);
            });

            this.options.push({
              'type': this.$t('Groups'),
              'items': groups ? groups : []
            });
            this.loading = false;
          })
          .catch(err => {
            this.loading = false;
          });
      },
      formatGroup(item)
      {
        item.id = 'group-' + item.id;
        item.fullname = item.name;
        return item;

      },
    }
  };
</script>

<style lang="scss" scoped>
  @import "~vue-multiselect/dist/vue-multiselect.min.css";
</style>
