!function(e){var t={};function n(r){if(t[r])return t[r].exports;var o=t[r]={i:r,l:!1,exports:{}};return e[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{configurable:!1,enumerable:!0,get:r})},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=0)}({"/SML":function(e,t,n){var r=n("VU/8")(n("ruc3"),n("08Ds"),!1,function(e){n("xMWd")},"data-v-aa450374",null);e.exports=r.exports},0:function(e,t,n){e.exports=n("ARlc")},"08Ds":function(e,t){e.exports={render:function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("div",{staticClass:"form-group"},[n("label",[e._v(e._s(e.$t("Email")))]),e._v(" "),n("input",{directives:[{name:"model",rawName:"v-model",value:e.config.email,expression:"config.email"}],staticClass:"form-control",domProps:{value:e.config.email},on:{input:function(t){t.target.composing||e.$set(e.config,"email",t.target.value)}}}),e._v(" "),n("small",{staticClass:"form-text text-muted"},[e._v(e._s(e.$t("Recipient's email address")))])]),e._v(" "),n("div",{staticClass:"form-group"},[n("label",[e._v(e._s(e.$t("Name")))]),e._v(" "),n("input",{directives:[{name:"model",rawName:"v-model",value:e.config.targetName,expression:"config.targetName"}],staticClass:"form-control",domProps:{value:e.config.targetName},on:{input:function(t){t.target.composing||e.$set(e.config,"targetName",t.target.value)}}}),e._v(" "),n("small",{staticClass:"form-text text-muted"},[e._v(e._s(e.$t("Recipient's name")))])]),e._v(" "),n("div",{staticClass:"form-group"},[n("label",[e._v(e._s(e.$t("Subject")))]),e._v(" "),n("input",{directives:[{name:"model",rawName:"v-model",value:e.config.subject,expression:"config.subject"}],staticClass:"form-control",domProps:{value:e.config.subject},on:{input:function(t){t.target.composing||e.$set(e.config,"subject",t.target.value)}}}),e._v(" "),n("small",{staticClass:"form-text text-muted"},[e._v(e._s(e.$t("Email subject")))])]),e._v(" "),n("modeler-screen-select",{attrs:{label:e.$t("Email body"),helper:e.$t("What Screen Should Be Used For Sending This Email"),params:{type:"EMAIL"}},model:{value:e.config.screenRef,callback:function(t){e.$set(e.config,"screenRef",t)},expression:"config.screenRef"}})],1)},staticRenderFns:[]}},"3PPD":function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r=n("l9F9"),o=n.n(r);t.default={extends:ProcessMaker.nodeTypes.get("processmaker-modeler-task").component,methods:{handleClick:function(){this.$parent.loadInspector("processmaker-communication-email-send",this.node.definition,this)}},mounted:function(){this.shape.attr("image/xlink:href",o.a)}}},"5wd8":function(e,t,n){var r=n("VU/8")(n("3PPD"),n("eU0j"),!1,null,null,null);e.exports=r.exports},ARlc:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r=n("5wd8"),o=n.n(r),i=n("/SML"),a=n.n(i),s=[{id:"processmaker-communication-email-send",component:o.a,bpmnType:"bpmn:ServiceTask",control:!0,category:"Communication",icon:n("KZCc"),implementation:"processmaker-communication-email-send",label:"Send Email",definition:function(e){return e.create("bpmn:ServiceTask",{name:"Send Email",implementation:"processmaker-communication-email-send",config:JSON.stringify({email:"",targetName:"",subject:"",template:"welcome"})})},diagram:function(e){return e.create("bpmndi:BPMNShape",{bounds:e.create("dc:Bounds",{height:76,width:116})})},inspectorHandler:function(e,t,n){for(var r in e)t[r]!=e[r]&&(t[r]="config"===r?JSON.stringify(e[r]):e[r]);n.updateShape()},inspectorConfig:[{name:"Send Email",items:[{component:"FormText",config:{label:"Send Email",fontSize:"2em"}},{component:a.a,config:{name:"id"}}]}]}];window.ProcessMaker.EventBus.$on("modeler-init",function(e){var t=e.registerNode,n=(e.registerBpmnExtension,e.registerInspectorExtension,!0),r=!1,o=void 0;try{for(var i,a=s[Symbol.iterator]();!(n=(i=a.next()).done);n=!0){t(i.value)}}catch(e){r=!0,o=e}finally{try{!n&&a.return&&a.return()}finally{if(r)throw o}}})},"FZ+f":function(e,t){e.exports=function(e){var t=[];return t.toString=function(){return this.map(function(t){var n=function(e,t){var n=e[1]||"",r=e[3];if(!r)return n;if(t&&"function"==typeof btoa){var o=(a=r,"/*# sourceMappingURL=data:application/json;charset=utf-8;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(a))))+" */"),i=r.sources.map(function(e){return"/*# sourceURL="+r.sourceRoot+e+" */"});return[n].concat(i).concat([o]).join("\n")}var a;return[n].join("\n")}(t,e);return t[2]?"@media "+t[2]+"{"+n+"}":n}).join("")},t.i=function(e,n){"string"==typeof e&&(e=[[null,e,""]]);for(var r={},o=0;o<this.length;o++){var i=this[o][0];"number"==typeof i&&(r[i]=!0)}for(o=0;o<e.length;o++){var a=e[o];"number"==typeof a[0]&&r[a[0]]||(n&&!a[2]?a[2]=n:n&&(a[2]="("+a[2]+") and ("+n+")"),t.push(a))}},t}},KZCc:function(e,t){e.exports="/vendor/processmaker/connectors/email/fonts/icon.svg?0652bcbfde0ba1266dc69fed99fb8bda"},SZJr:function(e,t,n){(e.exports=n("FZ+f")(!1)).push([e.i,"",""])},"VU/8":function(e,t){e.exports=function(e,t,n,r,o,i){var a,s=e=e||{},c=typeof e.default;"object"!==c&&"function"!==c||(a=e,s=e.default);var u,l="function"==typeof s?s.options:s;if(t&&(l.render=t.render,l.staticRenderFns=t.staticRenderFns,l._compiled=!0),n&&(l.functional=!0),o&&(l._scopeId=o),i?(u=function(e){(e=e||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(e=__VUE_SSR_CONTEXT__),r&&r.call(this,e),e&&e._registeredComponents&&e._registeredComponents.add(i)},l._ssrRegister=u):r&&(u=r),u){var f=l.functional,d=f?l.render:l.beforeCreate;f?(l._injectStyles=u,l.render=function(e,t){return u.call(t),d(e,t)}):l.beforeCreate=d?[].concat(d,u):[u]}return{esModule:a,exports:s,options:l}}},eU0j:function(e,t){e.exports={render:function(){var e=this.$createElement;return(this._self._c||e)("div")},staticRenderFns:[]}},l9F9:function(e,t){e.exports="/vendor/processmaker/connectors/email/fonts/marker.svg?77d195e690c50759d71166456c5093c2"},rjj0:function(e,t,n){var r="undefined"!=typeof document;if("undefined"!=typeof DEBUG&&DEBUG&&!r)throw new Error("vue-style-loader cannot be used in a non-browser environment. Use { target: 'node' } in your Webpack config to indicate a server-rendering environment.");var o=n("tTVk"),i={},a=r&&(document.head||document.getElementsByTagName("head")[0]),s=null,c=0,u=!1,l=function(){},f=null,d="data-vue-ssr-id",p="undefined"!=typeof navigator&&/msie [6-9]\b/.test(navigator.userAgent.toLowerCase());function m(e){for(var t=0;t<e.length;t++){var n=e[t],r=i[n.id];if(r){r.refs++;for(var o=0;o<r.parts.length;o++)r.parts[o](n.parts[o]);for(;o<n.parts.length;o++)r.parts.push(g(n.parts[o]));r.parts.length>n.parts.length&&(r.parts.length=n.parts.length)}else{var a=[];for(o=0;o<n.parts.length;o++)a.push(g(n.parts[o]));i[n.id]={id:n.id,refs:1,parts:a}}}}function v(){var e=document.createElement("style");return e.type="text/css",a.appendChild(e),e}function g(e){var t,n,r=document.querySelector("style["+d+'~="'+e.id+'"]');if(r){if(u)return l;r.parentNode.removeChild(r)}if(p){var o=c++;r=s||(s=v()),t=_.bind(null,r,o,!1),n=_.bind(null,r,o,!0)}else r=v(),t=function(e,t){var n=t.css,r=t.media,o=t.sourceMap;r&&e.setAttribute("media",r);f.ssrId&&e.setAttribute(d,t.id);o&&(n+="\n/*# sourceURL="+o.sources[0]+" */",n+="\n/*# sourceMappingURL=data:application/json;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(o))))+" */");if(e.styleSheet)e.styleSheet.cssText=n;else{for(;e.firstChild;)e.removeChild(e.firstChild);e.appendChild(document.createTextNode(n))}}.bind(null,r),n=function(){r.parentNode.removeChild(r)};return t(e),function(r){if(r){if(r.css===e.css&&r.media===e.media&&r.sourceMap===e.sourceMap)return;t(e=r)}else n()}}e.exports=function(e,t,n,r){u=n,f=r||{};var a=o(e,t);return m(a),function(t){for(var n=[],r=0;r<a.length;r++){var s=a[r];(c=i[s.id]).refs--,n.push(c)}t?m(a=o(e,t)):a=[];for(r=0;r<n.length;r++){var c;if(0===(c=n[r]).refs){for(var u=0;u<c.parts.length;u++)c.parts[u]();delete i[c.id]}}}};var h,b=(h=[],function(e,t){return h[e]=t,h.filter(Boolean).join("\n")});function _(e,t,n,r){var o=n?"":r.css;if(e.styleSheet)e.styleSheet.cssText=b(t,o);else{var i=document.createTextNode(o),a=e.childNodes;a[t]&&e.removeChild(a[t]),a.length?e.insertBefore(i,a[t]):e.appendChild(i)}}},ruc3:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default={props:["value"],data:function(){return{config:{email:"",targetName:"",subject:"",screenRef:""}}},watch:{config:{deep:!0,handler:function(){this.updateConfig()}},value:function(){this.loadConfig()}},computed:{},methods:{loadConfig:function(){var e=this,t=this.$parent.$parent.highlightedNode.definition,n=JSON.parse(_.get(t,"config"));Object.keys(n).forEach(function(t){Vue.set(e.config,t,n[t])})},updateConfig:function(){var e=this.$parent.$parent.highlightedNode.definition;Vue.set(e,"config",JSON.stringify(this.config))}},mounted:function(){this.loadConfig()}}},tTVk:function(e,t){e.exports=function(e,t){for(var n=[],r={},o=0;o<t.length;o++){var i=t[o],a=i[0],s={id:e+":"+o,css:i[1],media:i[2],sourceMap:i[3]};r[a]?r[a].parts.push(s):n.push(r[a]={id:a,parts:[s]})}return n}},xMWd:function(e,t,n){var r=n("SZJr");"string"==typeof r&&(r=[[e.i,r,""]]),r.locals&&(e.exports=r.locals);n("rjj0")("34fb0ace",r,!0,{})}});