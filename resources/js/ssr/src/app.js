import Vue from 'vue'
import App from './App.vue'
import renderVueComponentToString from 'vue-server-renderer/basic'
import FormHtmlEditorStatic from '../../processes/screen-builder/FormHtmlEditorStatic'
Vue.component('FormHtmlEditorStatic', FormHtmlEditorStatic);

const app = new Vue({
  el: '#app',
  
  render: h => h(App, {
    props: {
      config: context.config,
      formData: context.data
    },
  })
})

renderVueComponentToString(app, (err, html) => {
  if (err) {
    throw err
  }
  console.log('[BEGIN-SSR]' + html + '[END-SSR]');
})