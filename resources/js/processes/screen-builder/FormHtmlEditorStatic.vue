<template>
  <div>
    <span v-html="rendered"></span>
  </div>
</template>

<script>
import Mustache from 'mustache';
 
export default {
  name: 'FormHtmlEditorStatic',
  props: ['content', 'validationData'],
  components: {
  },
  mounted() {
  },
  data() {
    return {
    };
  },
  computed: {
    rendered() {
      if (!this.validationData) {
        return this.content;
      }

      try {
        return Mustache.render(this.content, this.validationData);
      } catch (error) {
        return this.content;
      }
    }
  }
};
</script>
