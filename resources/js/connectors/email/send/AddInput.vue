<template>
  <div class="form-group border-0 inspector-font-size">
    <form-checkbox
      class="form-control border-0 inspector-font-size"
      :label="label"
      :checked="selected"
      v-model="selected">
    </form-checkbox>

    <template v-if="selected">
      <div class="form-control p-0 border-0">
        <button @click="addRow" class="btn btn-sm btn-secondary float-right">
          <i class="fas fa-plus"></i>
        </button>
      </div>

      <template v-for="(row, index) in rows">
        <div class="input-group border-0">

          <input type="text" class="form-control" :placeholder="placeholder" v-model="row.email"
                 aria-describedby="index" @change="updateConfig">
          <div class="input-group-prepend">
            <span class="input-group-text border-0" id="index">
              <a @click="remove(index)">
                <i class="fas fa-trash-alt"></i>
              </a>
            </span>
          </div>
        </div>
      </template>
    </template>
  </div>

</template>


<script>
  export default {
    props: {
      value: {
        type: Array,
        default: []
      },
      label: {
        type: String,
        default: ''
      },
      placeholder: {
        type: String,
        default: ''
      }
    },
    data() {
      return {
        selected: false,
        rows: []

      };
    },
    watch: {
      value: {
        deep: true,
        handler() {
          this.selected = false;
          if (this.rows.length === 0 && this.value) {
            this.value.map(item => {
              this.rows.push({email: item});
            })
          }
          if (this.rows.length > 0) {
            this.selected = true;
          }
        }
      },
    },
    computed: {},
    methods: {
      addRow() {
        this.rows.push({email: ""});
      },
      remove(index) {
        this.rows.splice(index, 1);
        this.updateConfig()
      },
      updateConfig() {
        let data = [];
        if (this.selected) {
          this.rows.map(item => {
            data.push(item.email);
          })
        }
        this.$emit("input", data);
      }
    },
    mounted() {
    }
  };
</script>

<style lang="scss" scoped>
</style>
