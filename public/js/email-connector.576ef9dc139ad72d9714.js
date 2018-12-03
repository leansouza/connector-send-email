/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/@processmaker/modeler/src/assets/toolpanel/task.svg":
/***/ (function(module, exports) {

module.exports = "/vendor/processmaker/connectors/email/fonts/vendor/@processmaker/modeler/src/toolpanel/task.svg?e7419065b0c99c6c96817165a9a5a7ce";

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/js/connectors/email/send/component.vue":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__processmaker_modeler_src_assets_toolpanel_task_svg__ = __webpack_require__("./node_modules/@processmaker/modeler/src/assets/toolpanel/task.svg");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__processmaker_modeler_src_assets_toolpanel_task_svg___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__processmaker_modeler_src_assets_toolpanel_task_svg__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__shape_js__ = __webpack_require__("./resources/js/shape.js");
//
//
//
//
//


//import crownConfig from '@/mixins/crownConfig';



var taskHeight = 80;

var labelPadding = 15;
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['graph', 'node', 'nodes', 'id'],
  //mixins: [crownConfig],
  data: function data() {
    return {
      shape: null,
      definition: null,
      crownConfig: [{
        icon: __WEBPACK_IMPORTED_MODULE_0__processmaker_modeler_src_assets_toolpanel_task_svg___default.a,
        clickHandler: this.addSequence
      }]
    };
  },

  methods: {
    getShape: function getShape() {
      return this.shape;
    },
    updateShape: function updateShape() {
      var bounds = this.node.diagram.bounds;
      this.shape.position(bounds.x, bounds.y);
      this.shape.resize(bounds.width, bounds.height);
      this.shape.attr({
        body: {},
        label: {
          text: joint.util.breakText(this.node.definition.get('name'), {
            width: bounds.width
          }),
          fill: 'black'
        },
        image: { 'xlink:href': 'http://placehold.it/16x16' }
      });
      var name = this.node.definition.get('name');
      var labelText = joint.util.breakText(name, { width: bounds.width });
      /* Update shape height if label text overflows */
      this.shape.attr('label/text', labelText);
      var shapeView = this.shape.findView(this.paper);
      var labelHeight = shapeView.selectors.label.getBBox().height;

      var _shape$size = this.shape.size(),
          height = _shape$size.height;

      if (labelHeight + labelPadding !== height) {
        bounds.height = Math.max(labelHeight + 15, taskHeight);
        this.shape.resize(bounds.width, bounds.height);
      }
      // Alert anyone that we have moved
    },
    handleClick: function handleClick() {
      this.$parent.loadInspector('processmaker-communication-email-send', this.node.definition, this);
    }
  },
  mounted: function mounted() {
    var _this = this;

    this.shape = new __WEBPACK_IMPORTED_MODULE_1__shape_js__["a" /* default */]();
    var bounds = this.node.diagram.bounds;
    this.shape.position(bounds.x, bounds.y);
    this.shape.resize(bounds.width, bounds.height);
    this.shape.attr({
      body: {
        rx: 8,
        ry: 8
      },
      label: {
        text: joint.util.breakText(this.node.definition.get('name'), { width: bounds.width }),
        fill: 'black'
      },

      image: { 'xlink:href': __webpack_require__("./resources/js/connectors/email/send/icon.svg") }
    });
    this.shape.on('change:position', function (element, position) {
      _this.node.diagram.bounds.x = position.x;
      _this.node.diagram.bounds.y = position.y;
      // This is done so any flows pointing to this task are updated
      _this.$emit('move', {
        x: bounds.x,
        y: bounds.y
      }, element);
    });
    this.shape.addTo(this.graph);
    this.shape.component = this;
    this.$parent.nodes[this.id].component = this;
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/component-normalizer.js":
/***/ (function(module, exports) {

// this module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle

module.exports = function normalizeComponent (
  rawScriptExports,
  compiledTemplate,
  scopeId,
  cssModules
) {
  var esModule
  var scriptExports = rawScriptExports = rawScriptExports || {}

  // ES6 modules interop
  var type = typeof rawScriptExports.default
  if (type === 'object' || type === 'function') {
    esModule = rawScriptExports
    scriptExports = rawScriptExports.default
  }

  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (compiledTemplate) {
    options.render = compiledTemplate.render
    options.staticRenderFns = compiledTemplate.staticRenderFns
  }

  // scopedId
  if (scopeId) {
    options._scopeId = scopeId
  }

  // inject cssModules
  if (cssModules) {
    var computed = Object.create(options.computed || null)
    Object.keys(cssModules).forEach(function (key) {
      var module = cssModules[key]
      computed[key] = function () { return module }
    })
    options.computed = computed
  }

  return {
    esModule: esModule,
    exports: scriptExports,
    options: options
  }
}


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-85ab7812\"}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/js/connectors/email/send/component.vue":
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div')
},staticRenderFns: []}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-85ab7812", module.exports)
  }
}

/***/ }),

/***/ "./resources/js/connectors/email/send/component.vue":
/***/ (function(module, exports, __webpack_require__) {

var Component = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")(
  /* script */
  __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/js/connectors/email/send/component.vue"),
  /* template */
  __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-85ab7812\"}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/js/connectors/email/send/component.vue"),
  /* scopeId */
  null,
  /* cssModules */
  null
)
Component.options.__file = "/Users/davidcallizaya/Netbeans/email-connector/resources/js/connectors/email/send/component.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] component.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-85ab7812", Component.options)
  } else {
    hotAPI.reload("data-v-85ab7812", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ "./resources/js/connectors/email/send/icon.svg":
/***/ (function(module, exports) {

module.exports = "/vendor/processmaker/connectors/email/fonts/icon.svg?3cee1ea7533194018f2ca582b93a9815";

/***/ }),

/***/ "./resources/js/connectors/email/send/index.js":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__component_vue__ = __webpack_require__("./resources/js/connectors/email/send/component.vue");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__component_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__component_vue__);



var implementation = 'processmaker-communication-email-send';
var nodeId = 'processmaker-communication-email-send';

/* harmony default export */ __webpack_exports__["a"] = ({
    id: nodeId,
    component: __WEBPACK_IMPORTED_MODULE_0__component_vue___default.a,
    bpmnType: 'bpmn:ServiceTask',
    control: true,
    category: 'Communication',
    icon: __webpack_require__("./node_modules/@processmaker/modeler/src/assets/toolpanel/task.svg"),
    label: 'Send Email',
    definition: function definition(moddle) {
        return moddle.create('bpmn:ServiceTask', {
            name: 'Send Email',
            implementation: implementation
        });
    },
    diagram: function diagram(moddle) {
        return moddle.create('bpmndi:BPMNShape', {
            bounds: moddle.create('dc:Bounds', {
                height: 80,
                width: 100
            })
        });
    },
    inspectorHandler: function inspectorHandler(value, definition, component) {
        // Go through each property and rebind it to our data
        for (var key in value) {
            // Only change if the value is different
            if (definition[key] != value[key]) {
                definition[key] = value[key];
            }
        }
        component.updateShape();
    },
    inspectorConfig: [{
        name: 'Send Email',
        items: [{
            component: 'FormText',
            config: {
                label: 'Send Email',
                fontSize: '2em'
            }
        }, {
            component: 'FormInput',
            config: {
                label: 'Email',
                helper: "Recipient's Email",
                name: 'config.email'
            }
        }, {
            component: 'FormInput',
            config: {
                label: 'Name',
                helper: "recipient's name",
                name: 'config.targetName'
            }
        }, {
            component: 'FormInput',
            config: {
                label: 'Subject',
                helper: 'Subject of the message',
                name: 'config.targetName'
            }
        }, {
            component: 'FormInput',
            config: {
                label: 'Template',
                helper: 'Template of the message',
                name: 'config.template'
            }
        }]
    }]
});

/***/ }),

/***/ "./resources/js/email-connector.js":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__connectors_email_send_index__ = __webpack_require__("./resources/js/connectors/email/send/index.js");

var nodeTypes = [__WEBPACK_IMPORTED_MODULE_0__connectors_email_send_index__["a" /* default */]];
window.ProcessMaker.EventBus.$on('modeler-init', function (_ref) {
    var registerNode = _ref.registerNode,
        registerBpmnExtension = _ref.registerBpmnExtension;

    /* Register basic node types */
    var _iteratorNormalCompletion = true;
    var _didIteratorError = false;
    var _iteratorError = undefined;

    try {
        for (var _iterator = nodeTypes[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
            var node = _step.value;

            registerNode(node);
        }
    } catch (err) {
        _didIteratorError = true;
        _iteratorError = err;
    } finally {
        try {
            if (!_iteratorNormalCompletion && _iterator.return) {
                _iterator.return();
            }
        } finally {
            if (_didIteratorError) {
                throw _iteratorError;
            }
        }
    }
});

/***/ }),

/***/ "./resources/js/shape.js":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
var decoratedRect = joint.shapes.standard.Rectangle.extend({

    markup: [{
        tagName: 'rect',
        selector: 'body'
    }, {
        tagName: 'text',
        selector: 'label'
    }, {
        tagName: 'image',
        selector: 'image'
    }],

    defaults: joint.util.deepSupplement({

        type: 'processmaker.connectors.DecoratedRect',
        size: { width: 100, height: 60 },
        attrs: {
            'image': { 'ref-x': 2, 'ref-y': 2, ref: 'rect', width: 16, height: 16 }
        }

    }, joint.shapes.standard.Rectangle.prototype.defaults)
});

/* harmony default export */ __webpack_exports__["a"] = (decoratedRect);

/***/ }),

/***/ 0:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./resources/js/email-connector.js");


/***/ })

/******/ });