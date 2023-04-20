(function() {
  "use strict";
  function isUrl(value) {
    const pattern = /^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:/?#[\]@!\$&'\(\)\*\+,;=.]+$/g;
    const regex = new RegExp(pattern);
    return !value || value.match(regex);
  }
  function matchProvider(value, provider) {
    const patterns = {
      "youtube": /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/,
      "vimeo": /vimeo\.com\/([0-9]+)/,
      "flickr": /^.*(flickr\.com)\/(.*)/,
      "soundcloud": /^.*(soundcloud\.com|snd\.sc)\/(.*)/,
      "twitter": /^.*(twitter\.com)\/(.*)/,
      "instagram": /^.*(instagram\.com)\/(.*)/
    };
    const patternKeys = Object.keys(patterns);
    if (patternKeys.indexOf(provider) == -1)
      return false;
    return value.match(patterns[provider]);
  }
  var render$1 = function() {
    var _vm = this;
    var _h = _vm.$createElement;
    var _c = _vm._self._c || _h;
    return _c("k-field", _vm._b({ staticClass: "k-embed-field k-url-field k-field", attrs: { "input": _vm._uid } }, "k-field", _vm.$props, false), [_vm.hasMedia ? _c("div", { staticClass: "preview", attrs: { "data-provider": _vm.providerName } }, [_c("div", { staticClass: "preview-content", domProps: { "innerHTML": _vm._s(_vm.media.code) } }), _c("div", { staticClass: "preview-background" })]) : _vm._e(), _c("k-input", _vm._g(_vm._b({ ref: "input", attrs: { "id": _vm._uid, "value": _vm.inputValue, "media": _vm.media, "theme": "field" }, on: { "setMedia": _vm.setMedia, "startLoading": _vm.startLoading } }, "k-input", _vm.$props, false), _vm.$listeners), [_c("div", { staticClass: "k-embed-infos", attrs: { "slot": "icon" }, slot: "icon" }, [_c("div", { staticClass: "k-embed-status" }, [_vm.loading ? _c("span", { staticClass: "k-embed-status-loading" }, [_c("span", { staticClass: "loader" })]) : _vm.hasMedia ? _c("span", { staticClass: "k-embed-status-synced" }, [_vm._v(_vm._s(_vm.$t("embed.synced")) + " "), _c("span", { staticClass: "checkmark" })]) : _vm.syncFailed ? _c("span", { staticClass: "k-embed-status-failed" }, [_vm._v(_vm._s(_vm.$t("embed.failed")) + " "), _c("span", { staticClass: "cross" })]) : _vm._e()]), _vm.link ? _c("k-button", { staticClass: "k-input-icon-button", attrs: { "icon": _vm.icon, "link": _vm.inputValue, "tooltip": _vm.$t("open"), "tabindex": "-1", "target": "_blank", "rel": "noopener" } }) : _vm._e()], 1)])], 1);
  };
  var staticRenderFns$1 = [];
  render$1._withStripped = true;
  var embedField_vue_vue_type_style_index_0_lang = "";
  function normalizeComponent(scriptExports, render2, staticRenderFns2, functionalTemplate, injectStyles, scopeId, moduleIdentifier, shadowMode) {
    var options = typeof scriptExports === "function" ? scriptExports.options : scriptExports;
    if (render2) {
      options.render = render2;
      options.staticRenderFns = staticRenderFns2;
      options._compiled = true;
    }
    if (functionalTemplate) {
      options.functional = true;
    }
    if (scopeId) {
      options._scopeId = "data-v-" + scopeId;
    }
    var hook;
    if (moduleIdentifier) {
      hook = function(context) {
        context = context || this.$vnode && this.$vnode.ssrContext || this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext;
        if (!context && typeof __VUE_SSR_CONTEXT__ !== "undefined") {
          context = __VUE_SSR_CONTEXT__;
        }
        if (injectStyles) {
          injectStyles.call(this, context);
        }
        if (context && context._registeredComponents) {
          context._registeredComponents.add(moduleIdentifier);
        }
      };
      options._ssrRegister = hook;
    } else if (injectStyles) {
      hook = shadowMode ? function() {
        injectStyles.call(this, (options.functional ? this.parent : this).$root.$options.shadowRoot);
      } : injectStyles;
    }
    if (hook) {
      if (options.functional) {
        options._injectStyles = hook;
        var originalRender = options.render;
        options.render = function renderWithStyleInjection(h, context) {
          hook.call(context);
          return originalRender(h, context);
        };
      } else {
        var existing = options.beforeCreate;
        options.beforeCreate = existing ? [].concat(existing, hook) : [hook];
      }
    }
    return {
      exports: scriptExports,
      options
    };
  }
  const __vue2_script$2 = {
    extends: "k-url-field",
    data() {
      return {
        media: Object,
        loading: false
      };
    },
    props: {
      provider: String
    },
    created() {
      if (this.value && this.value.media && this.hasLength(this.value.media)) {
        this.media = this.value.media;
      }
    },
    watch: {
      inputValue() {
        if (this.value && this.value.media && this.hasLength(this.value.media)) {
          this.media = this.value.media;
        } else {
          this.media = {};
        }
      }
    },
    computed: {
      hasMedia() {
        return this.hasLength(this.media) && this.media.code;
      },
      providerName() {
        return this.hasMedia && this.media.providerName ? this.media.providerName.toLowerCase() : null;
      },
      syncFailed() {
        return this.inputValue != "" && this.isValidUrl(this.inputValue) && !this.hasMedia;
      },
      inputValue() {
        return this.value && this.value.input ? this.value.input : "";
      }
    },
    methods: {
      setMedia(media) {
        this.media = media;
        this.stopLoading();
      },
      hasLength(obj) {
        return Object.keys(obj).length;
      },
      startLoading() {
        this.loading = true;
      },
      stopLoading() {
        this.loading = false;
      },
      isValidUrl(value) {
        if (!isUrl(value))
          return false;
        if (this.provider && !matchProvider(value, this.provider))
          return false;
        return true;
      }
    }
  };
  const __cssModules$2 = {};
  var __component__$2 = /* @__PURE__ */ normalizeComponent(__vue2_script$2, render$1, staticRenderFns$1, false, __vue2_injectStyles$2, null, null, null);
  function __vue2_injectStyles$2(context) {
    for (let o in __cssModules$2) {
      this[o] = __cssModules$2[o];
    }
  }
  __component__$2.options.__file = "src/components/embedField.vue";
  var embedField = /* @__PURE__ */ function() {
    return __component__$2.exports;
  }();
  const __vue2_script$1 = {
    extends: "k-url-input",
    props: {
      provider: String,
      media: Object
    },
    mounted() {
      this.loadEmbedScripts();
    },
    methods: {
      onInput(value) {
        if (value == "" || !this.isValidUrl(value)) {
          this.media = {};
          this.emitInput(value);
          return false;
        }
        this.$emit("startLoading");
        this.$api.get("kirby-embed/get-data", { url: value }).then((response) => {
          if (response["status"] == "success" && response["data"]) {
            if (response["data"]["providerName"] == "Vimeo") {
              let iframe = response["data"]["code"];
              iframe = this.htmlToElement(iframe);
              iframe.setAttribute("referrerpolicy", "strict-origin-when-cross-origin");
              response["data"]["code"] = iframe.outerHTML;
            }
            this.media = response["data"];
          } else {
            this.media = {};
          }
          this.emitInput(value);
        }).catch((error) => {
          this.media = {};
          this.emitInput(value);
        });
      },
      emitInput(value) {
        this.$emit("input", { input: value, media: this.media });
        this.$emit("setMedia", this.media);
        this.loadEmbedScripts();
      },
      loadEmbedScripts() {
        if (window.twttr) {
          window.twttr.widgets.load();
        } else if (this.media && Object.keys(this.media).length && this.media.providerName.toLowerCase() == "twitter") {
          const embed = document.createElement("script");
          embed.src = "https://platform.twitter.com/widgets.js";
          document.body.appendChild(embed);
        }
        if (window.instgrm) {
          window.instgrm.Embeds.process();
        } else if (this.media && Object.keys(this.media).length && this.media.providerName.toLowerCase() == "instagram") {
          const embed = document.createElement("script");
          embed.src = "https://www.instagram.com/embed.js";
          document.body.appendChild(embed);
        }
      },
      isValidUrl(value) {
        if (!isUrl(value))
          return false;
        if (this.provider && !matchProvider(value, this.provider))
          return false;
        return true;
      },
      htmlToElement(html) {
        let template = document.createElement("template");
        html = html.trim();
        template.innerHTML = html;
        return template.content.firstChild;
      }
    }
  };
  let __vue2_render, __vue2_staticRenderFns;
  const __cssModules$1 = {};
  var __component__$1 = /* @__PURE__ */ normalizeComponent(__vue2_script$1, __vue2_render, __vue2_staticRenderFns, false, __vue2_injectStyles$1, null, null, null);
  function __vue2_injectStyles$1(context) {
    for (let o in __cssModules$1) {
      this[o] = __cssModules$1[o];
    }
  }
  __component__$1.options.__file = "src/components/embedInput.vue";
  var embedInput = /* @__PURE__ */ function() {
    return __component__$1.exports;
  }();
  var render = function() {
    var _vm = this;
    var _h = _vm.$createElement;
    var _c = _vm._self._c || _h;
    return _c("div", { staticClass: "k-embed-field-preview" }, [_c("div", { staticClass: "k-structure-table-text" }, [_vm._v(_vm._s(_vm.url) + " "), _vm.synced ? _c("span", { staticClass: "k-embed-field-preview-icon" }, [_vm._v("\u2713")]) : _vm._e()])]);
  };
  var staticRenderFns = [];
  render._withStripped = true;
  const __vue2_script = {
    props: {
      value: String
    },
    computed: {
      url() {
        return this.value.input.replace(/^\/\/|^.*?:\/\//, "");
      },
      synced() {
        return Object.keys(this.value.media).length;
      }
    }
  };
  const __cssModules = {};
  var __component__ = /* @__PURE__ */ normalizeComponent(__vue2_script, render, staticRenderFns, false, __vue2_injectStyles, null, null, null);
  function __vue2_injectStyles(context) {
    for (let o in __cssModules) {
      this[o] = __cssModules[o];
    }
  }
  __component__.options.__file = "src/components/embedPreview.vue";
  var embedPreview = /* @__PURE__ */ function() {
    return __component__.exports;
  }();
  panel.plugin("sylvainjule/embed", {
    fields: {
      embed: embedField
    },
    components: {
      "k-embed-input": embedInput,
      "k-embed-field-preview": embedPreview
    }
  });
})();
