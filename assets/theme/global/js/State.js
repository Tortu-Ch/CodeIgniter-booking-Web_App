(function (global, factory) {
  if (typeof define === "function" && define.amd) {
    define("/State", ["exports", "jquery"], factory);
  } else if (typeof exports !== "undefined") {
    factory(exports, require("jquery"));
  } else {
    var mod = {
      exports: {}
    };
    factory(mod.exports, global.jQuery);
    global.State = mod.exports;
  }
})(this, function (_exports, _jquery) {
  "use strict";

  Object.defineProperty(_exports, "__esModule", {
    value: true
  });
  _exports.default = void 0;
  _jquery = babelHelpers.interopRequireDefault(_jquery);

  var State =
  /*#__PURE__*/
  function () {
    function State(states) {
      babelHelpers.classCallCheck(this, State);
      this._states = Object.assign({}, states);
      this._values = {};
      this._relations = {};
      this._callbacks = {};

      this._define();
    }

    babelHelpers.createClass(State, [{
      key: "_define",
      value: function _define() {
        var _this = this;

        var self = this;
        var keys = Object.keys(this._states);
        var obj = {};
        var tmpRelations = [];
        var composites = [];

        var _loop = function _loop(i, l) {
          var key = keys[i];
          var value = _this._states[key];

          if (typeof value !== 'function') {
            Object.defineProperty(obj, key, {
              set: function set() {
                return false;
              },
              get: function get() {
                tmpRelations.push(key);
                return self._states[key];
              },
              enumerable: true,
              configurable: true
            });
            _this._values[key] = _this._states[key];
            _this._relations[key] = [];
          } else {
            composites.push(key);
          }
        };

        for (var i = 0, l = keys.length; i < l; i++) {
          _loop(i, l);
        }

        var _loop2 = function _loop2(i, l) {
          var key = composites[i];
          Object.defineProperty(obj, key, {
            set: function set() {
              return false;
            },
            get: function get() {
              var value = self._states[key].call(obj);

              self._addRelation(key, tmpRelations);

              tmpRelations = [];
              self._values[key] = value;
              return value;
            },
            enumerable: true,
            configurable: true
          });
        };

        for (var i = 0, l = composites.length; i < l; i++) {
          _loop2(i, l);
        }
      }
    }, {
      key: "_compare",
      value: function _compare(state) {
        if (this._states[state] !== this._values[state]) {
          var value = this._values[state];
          this._values[state] = this._states[state];

          this._dispatch(state, value, this._states[state]);

          this._compareComposite(state);
        }
      }
    }, {
      key: "_compareComposite",
      value: function _compareComposite(state) {
        var relations = this.getRelation(state);

        if (relations && relations.length > 0) {
          for (var i = 0, l = relations.length; i < l; i++) {
            var _state = relations[i];

            var value = this._states[_state]();

            if (value !== this._values[_state]) {
              this._dispatch(_state, this._values[_state], value);

              this._values[_state] = value;
            }
          }
        }
      }
    }, {
      key: "_addRelation",
      value: function _addRelation(state, relations) {
        for (var i = 0, l = relations.length; i < l; i++) {
          var pros = relations[i];

          this._relations[pros].push(state);
        }
      }
    }, {
      key: "_dispatch",
      value: function _dispatch(state, origValue, newValue) {
        if (this._callbacks[state]) {
          this._callbacks[state].fire([newValue, origValue]);
        }
      }
    }, {
      key: "getRelation",
      value: function getRelation(state) {
        return this._relations[state].length > 0 ? this._relations[state] : null;
      }
    }, {
      key: "on",
      value: function on(state, callback) {
        if (typeof state === 'function') {
          callback = state;
          state = 'all';
        }

        if (!this._callbacks[state]) {
          this._callbacks[state] = _jquery.default.Callbacks();
        }

        this._callbacks[state].add(callback);
      }
    }, {
      key: "off",
      value: function off(state, callback) {
        if (this._callbacks[state]) {
          this._callbacks[state].remove(callback);
        }
      }
    }, {
      key: "set",
      value: function set(state, value) {
        var isDeep = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;
        console.log('set state [state] : ', state);
        console.log('set state [value] : ', value);

        if (typeof state === 'string' && typeof value !== 'undefined' && typeof this._states[state] !== 'function') {
          this._states[state] = value;

          if (!isDeep) {
            this._compare(state);
          }
        } else if (babelHelpers.typeof(state) === 'object') {
          for (var key in state) {
            if (typeof state[key] !== 'function') {
              this.set(key, state[key], true);
            }
          }

          for (var _key in state) {
            if (typeof state[_key] !== 'function') {
              this._compare(_key);
            }
          }
        }

        return this._states[state];
      }
    }, {
      key: "get",
      value: function get(state) {
        if (state) {
          return this._values[state];
        }

        return this._values;
      }
    }]);
    return State;
  }();

  var _default = State;
  _exports.default = _default;
});