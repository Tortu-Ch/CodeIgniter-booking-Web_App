import BaseApp from 'BaseApp'

class AppContacts extends BaseApp {
  initialize() {
    super.initialize()

    this.$actionBtn = $('.site-action')
    this.$actionToggleBtn = this.$actionBtn.find('.site-action-toggle')
    this.$addMainForm = $('#addUserForm').modal({
      show: false
    })
    this.$content = $('#contactsContent')

    // states
    this.states = {
      checked: false
    }
  }
  process() {
    super.process()

    this.setupActionBtn()
    this.bindListChecked()
    this.handlSlidePanelContent()
  }

  listChecked(checked) {
    const api = this.$actionBtn.data('actionBtn')
    if (checked) {
      api.show()
    } else {
      api.hide()
    }

    this.states.checked = checked
  }

  setupActionBtn() {
    this.$actionToggleBtn.on('click', (e) => {
      if (!this.states.checked) {
        this.$addMainForm.modal('show')
        e.stopPropagation()
      }
    })
  }

  bindListChecked() {
    this.$content.on('asSelectable::change', (e, api, checked) => {
      this.listChecked(checked)
    })
  }

  handlSlidePanelContent() {
    $(document).on('click', '[data-toggle=edit]', function () {
      const $button = $(this)

      const $panel = $button.parents('.slidePanel')
      const $form = $panel.find('.user-info')

      $button.toggleClass('active')
      $form.toggleClass('active')
    })

    $(document).on('change', '.user-info .form-group', (e) => {
      const $input = $(this).find('input')

      const $span = $(this).siblings('span')
      $span.html($input.val())
    })
  }
}

let instance = null

function getInstance() {
  if (!instance) {
    instance = new AppContacts()
  }

  return instance
}

function run() {
  const app = getInstance()
  app.run()
}

export default AppContacts
export {
  AppContacts,
  run,
  getInstance
}
