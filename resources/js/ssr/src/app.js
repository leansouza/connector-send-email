import Vue from 'vue'
import App from './App.vue'
import renderVueComponentToString from 'vue-server-renderer/basic';

const app = new Vue({
  el: '#app',
  
  render: h => h(App, {
    props: {
      config: context.config,
      formData: context.data
    },
  })
});

renderVueComponentToString(app, (err, html) => {
  if (err) {
    throw err
  }
  context.output(html);
})