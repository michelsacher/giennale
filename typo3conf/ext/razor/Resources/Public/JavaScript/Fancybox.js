$.fancybox.defaults.hash = false;

$(".fancybox").fancybox({
  <f:format.raw />'speed': {speed},
  'loop': {loop},
  'opacity': '{opacity}',
  'margin': {margin},
  'gutter': {gutter},
  'infobar': {infobar},
  'buttons': {buttons},
  'slideShow': {slideShow},
  'fullScreen': {fullScreen},
  'thumbs': {thumbs},
  'closeBtn': {closeBtn},
  'smallBtn': '{smallBtn}',
  'baseClass': '{baseClass}',
  'slideClass': '{slideClass}',
  'touch': {touch},
  'keyboard': {keyboard},
  'focus': {focus},
  'closeClickOutside': {closeClickOutside},
  baseTpl : '<div class="fancybox-container" role="dialog" tabindex="-1">' +
        '<div class="fancybox-bg"></div>' +
        '<div class="fancybox-controls">' +
          '<div class="fancybox-infobar">' +
            '<button data-fancybox-previous class="fancybox-button fancybox-button--left" title="{f:translate(key: "LLL:fileadmin/razor/Language/razor.xlf:prevLabel")}"></button>' +
            '<div class="fancybox-infobar__body">' +
              '<span class="js-fancybox-index"></span>&nbsp;/&nbsp;<span class="js-fancybox-count"></span>' +
            '</div>' +
            '<button data-fancybox-next class="fancybox-button fancybox-button--right" title="{f:translate(key: "LLL:fileadmin/razor/Language/razor.xlf:nextLabel")}"></button>' +
          '</div>' +
          '<div class="fancybox-buttons">' +
            '<button data-fancybox-close class="fancybox-button fancybox-button--close" title="{f:translate(key: "LLL:fileadmin/razor/Language/razor.xlf:closeLabel")}"></button>' +
          '</div>' +
        '</div>' +
        '<div class="fancybox-slider-wrap">' +
          '<div class="fancybox-slider"></div>' +
        '</div>' +
        '<div class="fancybox-caption-wrap"><div class="fancybox-caption"></div></div>' +
      '</div>'
});
