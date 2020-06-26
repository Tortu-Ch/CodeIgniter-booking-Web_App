import $ from 'jquery'
import Plugin from 'Plugin'

const NAME = 'formatter'

class Formatter extends Plugin {
  getName() {
    return NAME
  }

  static getDefaults() {
    return {
      persistent: true
    }
  }

  render() {
    if (!$.fn.formatter) {
      return
    }

    const browserName = navigator.userAgent.toLowerCase()

    let ieOptions

    if (/msie/i.test(browserName) && !/opera/.test(browserName)) {
      ieOptions = {
        persistent: false
      }
    } else {
      ieOptions = {}
    }

    const $el = this.$el

    const options = this.options

    if (options.pattern) {
      options.pattern = options.pattern.replace(/\[\[/g, '{{').replace(/\]\]/g, '}}')
    }
    $el.formatter(options)
  }
}

Plugin.register(NAME, Formatter)

export default Formatter
