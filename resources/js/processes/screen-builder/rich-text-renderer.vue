<template>
  <div class="here">
    <span v-html="content"></span>
  </div>
</template>

<script>
export default {
  name: 'RichTextRenderer',
  props: ['label', 'fields', 'value', 'editable', 'content', 'form'],
  components: {
  },
  mounted() {
  },
  data() {
    return {
    };
  },
};
</script>
