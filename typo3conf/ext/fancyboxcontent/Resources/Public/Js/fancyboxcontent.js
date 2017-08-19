$(".fancyboxcontent-<f:format.raw />{uid}").fancybox({
  <f:format.raw />{settings}
  ,baseTpl : '<div class="fancybox-container" role="dialog" tabindex="-1">' +
        '<div class="fancybox-bg"></div>' +
        '<div class="fancybox-controls">' +
          '<div class="fancybox-infobar">' +
            '<button data-fancybox-previous class="fancybox-button fancybox-button--left" title="{prev}"></button>' +
            '<div class="fancybox-infobar__body">' +
              '<span class="js-fancybox-index"></span>&nbsp;/&nbsp;<span class="js-fancybox-count"></span>' +
            '</div>' +
            '<button data-fancybox-next class="fancybox-button fancybox-button--right" title="{next}"></button>' +
          '</div>' +
          '<div class="fancybox-buttons">' +
            '<button data-fancybox-close class="fancybox-button fancybox-button--close" title="{close}"></button>' +
          '</div>' +
        '</div>' +
        '<div class="fancybox-slider-wrap">' +
          '<div class="fancybox-slider"></div>' +
        '</div>' +
        '<div class="fancybox-caption-wrap"><div class="fancybox-caption"></div></div>' +
      '</div>',
});
