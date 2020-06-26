(function (global, factory) {
  if (typeof define === "function" && define.amd) {
    define("/Site", ["exports", "jquery", "Base", "Menubar", "Sidebar", "PageAside"], factory);
  } else if (typeof exports !== "undefined") {
    factory(exports, require("jquery"), require("Base"), require("Menubar"), require("Sidebar"), require("PageAside"));
  } else {
    var mod = {
      exports: {}
    };
    factory(mod.exports, global.jQuery, global.Base, global.SectionMenubar, global.SectionSidebar, global.SectionPageAside);
    global.Site = mod.exports;
  }
})(this, function (_exports, _jquery, _Base2, _Menubar, _Sidebar, _PageAside) {
  "use strict";

  Object.defineProperty(_exports, "__esModule", {
    value: true
  });
  _exports.run = run;
  _exports.getInstance = getInstance;
  _exports.Site = _exports.default = void 0;
  _jquery = babelHelpers.interopRequireDefault(_jquery);
  _Base2 = babelHelpers.interopRequireDefault(_Base2);
  _Menubar = babelHelpers.interopRequireDefault(_Menubar);
  _Sidebar = babelHelpers.interopRequireDefault(_Sidebar);
  _PageAside = babelHelpers.interopRequireDefault(_PageAside);
  var DOC = document;
  var $DOC = (0, _jquery.default)(document);
  var $BODY = (0, _jquery.default)('body');

  var Site =
  /*#__PURE__*/
  function (_Base) {
    babelHelpers.inherits(Site, _Base);

    function Site() {
      babelHelpers.classCallCheck(this, Site);
      return babelHelpers.possibleConstructorReturn(this, babelHelpers.getPrototypeOf(Site).apply(this, arguments));
    }

    babelHelpers.createClass(Site, [{
      key: "initialize",
      value: function initialize() {
        this.startLoading();
        this.initializePluginAPIs();
        this.initializePlugins();
        this.initComponents();
      }
    }, {
      key: "process",
      value: function process() {
        this.polyfillIEWidth();
        this.initBootstrap();
        this.setupMenubar();
        this.setupFullScreen();
        this.setupMegaNavbar();
        this.setupWave();
        this.setupNavbarCollpase(); // Dropdown menu setup
        // ===================

        this.$el.on('click', '.dropdown-menu-media', function (e) {
          e.stopPropagation();
        });
      }
    }, {
      key: "_getDefaultMeunbarType",
      value: function _getDefaultMeunbarType() {
        return 'hide';
      }
    }, {
      key: "menubarType",
      value: function menubarType(type) {
        (0, _jquery.default)('[data-toggle="menubar"]').each(function () {
          var $this = (0, _jquery.default)(this);
          var $hamburger = (0, _jquery.default)(this).find('.hamburger');

          if ($hamburger.length > 0) {
            $hamburger.toggleClass('hided', !(type === 'open'));
          } else {
            $this.toggleClass('hided', !(type === 'open'));
          }
        });
      }
    }, {
      key: "initComponents",
      value: function initComponents() {
        this.menubar = new _Menubar.default({
          $el: (0, _jquery.default)('.site-menubar')
        });
        this.sidebar = new _Sidebar.default();
        var $aside = (0, _jquery.default)('.page-aside');

        if ($aside.length > 0) {
          this.aside = new _PageAside.default({
            $el: $aside
          });
          this.aside.run();
        }

        this.menubar.run();
        this.sidebar.run();
      }
    }, {
      key: "getCurrentBreakpoint",
      value: function getCurrentBreakpoint() {
        var bp = Breakpoints.current();
        return bp ? bp.name : 'lg';
      }
    }, {
      key: "initBootstrap",
      value: function initBootstrap() {
        // Tooltip setup
        // =============
        $DOC.tooltip({
          selector: '[data-tooltip=true]',
          container: 'body'
        });
        (0, _jquery.default)('[data-toggle="tooltip"]').tooltip();
        (0, _jquery.default)('[data-toggle="popover"]').popover();
      }
    }, {
      key: "polyfillIEWidth",
      value: function polyfillIEWidth() {
        if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
          var msViewportStyle = DOC.createElement('style');
          msViewportStyle.appendChild(DOC.createTextNode('@-ms-viewport{width:auto!important}'));
          DOC.querySelector('head').appendChild(msViewportStyle);
        }
      }
    }, {
      key: "setupFullScreen",
      value: function setupFullScreen() {
        if (typeof screenfull !== 'undefined') {
          $DOC.on('click', '[data-toggle="fullscreen"]', function () {
            if (screenfull.enabled) {
              screenfull.toggle();
            }

            return false;
          });

          if (screenfull.enabled) {
            DOC.addEventListener(screenfull.raw.fullscreenchange, function () {
              (0, _jquery.default)('[data-toggle="fullscreen"]').toggleClass('active', screenfull.isFullscreen);
            });
          }
        }
      }
    }, {
      key: "setupMegaNavbar",
      value: function setupMegaNavbar() {
        $DOC.on('click', '.navbar-mega .dropdown-menu', function (e) {
          e.stopPropagation();
        }).on('show.bs.dropdown', function (e) {
          var $target = (0, _jquery.default)(e.target);
          var $trigger = e.relatedTarget ? (0, _jquery.default)(e.relatedTarget) : $target.children('[data-toggle="dropdown"]');
          var animation = $trigger.data('animation');

          if (animation) {
            var $menu = $target.children('.dropdown-menu');
            $menu.addClass("animation-".concat(animation)).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
              $menu.removeClass("animation-".concat(animation));
            });
          }
        }).on('shown.bs.dropdown', function (e) {
          var $menu = (0, _jquery.default)(e.target).find('.dropdown-menu-media > .list-group');

          if ($menu.length > 0) {
            var api = $menu.data('asScrollable');

            if (api) {
              api.update();
            } else {
              $menu.asScrollable({
                namespace: 'scrollable',
                contentSelector: '> [data-role=\'content\']',
                containerSelector: '> [data-role=\'container\']'
              });
            }
          }
        });
      }
    }, {
      key: "setupMenubar",
      value: function setupMenubar() {
        var _this = this;

        (0, _jquery.default)(document).on('click', '[data-toggle="menubar"]', function () {
          var type = _this.menubar.type;

          switch (type) {
            case 'open':
              type = 'hide';
              break;

            case 'hide':
              type = 'open';
              break;
            // no default
          }

          _this.menubar.change(type);

          _this.menubarType(type);

          return false;
        });
        (0, _jquery.default)(document).on('collapsed.site.menu expanded.site.menu', function () {
          var type = _this.menubar.type;

          if (type === 'open' && _this.menubar && _this.menubar.scrollable) {
            _this.menubar.scrollable.update();
          }
        });
        Breakpoints.on('change', function () {
          _this.menubar.type = _this._getDefaultMeunbarType();

          _this.menubar.change(_this.menubar.type);
        });
      }
    }, {
      key: "setupNavbarCollpase",
      value: function setupNavbarCollpase() {
        (0, _jquery.default)(document).on('click', '[data-target=\'#site-navbar-collapse\']', function (e) {
          var $trigger = (0, _jquery.default)(this);
          var isClose = $trigger.hasClass('collapsed');
          $BODY.addClass('site-navbar-collapsing');
          $BODY.toggleClass('site-navbar-collapse-show', !isClose);
          setTimeout(function () {
            $BODY.removeClass('site-navbar-collapsing');
          }, 350);
        });
      }
    }, {
      key: "setupWave",
      value: function setupWave() {
        if (typeof Waves !== 'undefined') {
          Waves.init();
          Waves.attach('.site-menu-item > a', ['waves-classic']);
          Waves.attach('.site-navbar .navbar-toolbar a', ['waves-light', 'waves-round']);
          Waves.attach('.btn', ['waves-classic']);
        }
      }
    }, {
      key: "startLoading",
      value: function startLoading() {
        if (typeof _jquery.default.fn.animsition === 'undefined') {
          return false;
        } // let loadingType = 'default';


        $BODY.animsition({
          inClass: 'fade-in',
          inDuration: 800,
          loading: true,
          loadingClass: 'loader-overlay',
          loadingParentElement: 'html',
          loadingInner: "\n      <div class=\"loader-content\">\n        <div class=\"loader-index\">\n          <div></div>\n          <div></div>\n          <div></div>\n          <div></div>\n          <div></div>\n          <div></div>\n        </div>\n      </div>",
          onLoadEvent: true
        });
      }
    }]);
    return Site;
  }(_Base2.default);

  _exports.Site = Site;
  var instance = null;

  function getInstance() {
    if (!instance) {
      instance = new Site();
    }

    return instance;
  }

  function run() {
    var site = getInstance();
    site.run();
  }

  var _default = Site;
  _exports.default = _default;
});