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
        <button @click.prevent="addRow" class="btn btn-sm btn-secondary float-right">
          <i class="fas fa-plus"></i>
        </button>
      </div>

      <template v-for="(row, index) in rows">
        <div class="input-group border-0" :key="index">
          <input type="text" class="form-control" :placeholder="placeholder" v-model="rows[index]"
                 aria-describedby="index">
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
        default: () => []
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
        rows: [],
      };
    },
    watch: {
      value: {
        immediate: true,
        handler() {
          this.rows = this.value

          if (this.rows.length > 0) {
            this.selected = true;
          } else {
            this.selected = false;
          }
        }
      },
      selected() {
        if (!this.selected) {
          this.rows = [];
        } else {
          if (this.rows.length === 0) {
            // have an empty one ready when they check the box
            this.addRow();
          }
        }
      },
      rows: {
        handler() {
          this.$emit("input", this.rows);
        },
        deep: true,
      }
    },
    computed: {},
    methods: {
      addRow() {
        this.rows.push("");
      },
      remove(index) {
        this.$delete(this.rows, index)
      },
    },
  };
</script>

<style lang="scss" scoped>
</style>
