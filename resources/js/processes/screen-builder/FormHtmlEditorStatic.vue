<template>
  <div>
    <span v-html="rendered"></span>
  </div>
</template>

<script>
import Mustache from 'mustache';
 
export default {
  name: 'FormHtmlEditorStatic',
  props: ['content', 'validationData','renderVarHtml'],
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
        if (this.renderVarHtml) {
          let escape = Mustache.escape;
          Mustache.escape = function (text) {
            return text;
          };
          let render = Mustache.render(this.content, this.validationData);
          Mustache.escape = escape;
          return render;
        }

        return Mustache.render(this.content, this.validationData);
      } catch (error) {
        return this.content;
      }
    }
  }
};
</script>
