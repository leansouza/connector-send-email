import Vue from 'vue'
import App from './App.vue'
import renderVueComponentToString from 'vue-server-renderer/basic'

// This shouldn't have to be here.
import * as VueDeepSet from 'vue-deepset'
Vue.use(VueDeepSet);

if (typeof context == 'undefined') {
  throw new Error(
    "Global context is not defined. " +
    "Are you running this using the spatie/server-side-rendering package?"
  )
}

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
  console.log(html)
})