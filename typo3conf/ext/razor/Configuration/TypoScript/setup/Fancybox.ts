# # fancybox [BEGIN]

razor {
  fancybox {
    selector = {$razor.fancybox.selector}
  }
}

plugin.tx_vhs.settings.asset {
  razorFancyboxCss {
    name = razorFancyboxCss
    path = EXT:razor/Resources/Public/Bower/fancyBox/dist/jquery.fancybox.min.css
  }
}

plugin.tx_vhs.settings.asset {
  razorFancyboxJs {
    name = razorFancyboxJs
    path = EXT:razor/Resources/Public/Bower/fancyBox/dist/jquery.fancybox.min.js
  }
  razorFancyboxJsCustom {
    name = razorFancyboxJsCustom
    path = EXT:razor/Resources/Public/JavaScript/Fancybox.js
    fluid = 1
    variables {
      speed = {$razor.fancybox.speed}
      loop = {$razor.fancybox.loop}
      opacity = {$razor.fancybox.opacity}
      margin = {$razor.fancybox.margin}
      gutter = {$razor.fancybox.gutter}
      infobar = {$razor.fancybox.infobar}
      buttons = {$razor.fancybox.buttons}
      slideShow = {$razor.fancybox.slideShow}
      fullScreen = {$razor.fancybox.fullScreen}
      thumbs = {$razor.fancybox.thumbs}
      closeBtn = {$razor.fancybox.closeBtn}
      smallBtn = {$razor.fancybox.smallBtn}
      baseClass = {$razor.fancybox.baseClass}
      slideClass = {$razor.fancybox.slideClass}
      touch = {$razor.fancybox.touch}
      keyboard = {$razor.fancybox.keyboard}
      focus = {$razor.fancybox.focus}
      closeClickOutside = {$razor.fancybox.closeClickOutside}
    }
  }
}