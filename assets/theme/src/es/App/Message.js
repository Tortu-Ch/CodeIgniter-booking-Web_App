import Site from 'Site'

class ChatsWrap {
  constructor($el) {
    this.$el = $el
    this.$historyBtn = $('#historyBtn')
    this.scrollChatsToBottom()

    $(window).on('resize', () => {
      this.scrollChatsToBottom()
    })
  }
  scrollChatsToBottom() {
    const $el = this.$el
    const chatsWrapH = $el.height()
    const chatsH = $('.chats', $el).outerHeight()
    const historyBtnH = this.$historyBtn.outerHeight()

    $el.scrollTop(chatsH + historyBtnH - chatsWrapH)
  }
}

class AppMessage extends Site {
  initialize() {
    super.initialize()

    this.newChatLists = []
    this.$chatsWrap = $('.app-message-chats')
    this.chatApi = new ChatsWrap(this.$chatsWrap)

    this.$textArea = $('.message-input textarea')
    this.$textareaWrap = $('.app-message-input')

    this.$msgEdit = $('.message-input>.form-control')
    this.$sendBtn = $('.message-input-btn')

    // states
    this.states = {
      chatListsLength: 0
    }
  }

  process() {
    super.process()

    this.steupMessage()
    this.setupTextarea()
  }

  chatListsLength(length) {
    if (this.newChatLists[length - 1]) {
      const $newMsg = $(
        `<div class='chat-content'><p>${this.newChatLists[length - 1]}</p></div>`
      )

      $('.chat').last().find('.chat-body').append($newMsg)
      this.$msgEdit.attr('placeholder', '')
      this.$msgEdit.val('')
    } else {
      this.$msgEdit.attr('placeholder', 'type text here...')
    }

    this.chatApi.scrollChatsToBottom()

    this.states.chatListsLength = length
  }

  setupTextarea() {
    autosize($('.message-input textarea'))

    this.$textArea.on('autosize:resized', () => {
      this.$chatsWrap.css('height', `calc(100% - ${this.$textareaWrap.outerHeight()}px)`)
      this.triggerResize()
    })
  }

  steupMessage() {
    this.$sendBtn.on('click', () => {
      let num = this.states.chatListsLength
      this.newChatLists.push(this.getMsg())
      this.chatListsLength(++num)
    })
  }

  getMsg() {
    return this.$msgEdit.val()
  }
}

let instance = null

function getInstance() {
  if (!instance) {
    instance = new AppMessage()
  }
  return instance
}

function run() {
  const app = getInstance()
  app.run()
}

export default AppMessage
export {
  AppMessage,
  run,
  getInstance
}
