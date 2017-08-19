window.cookieconsent.initialise({
  revokable: {revokable},
  revokeBtn: '<div class="cc-revoke {{classes}}""><f:translate key="LLL:fileadmin/razor/Language/razor.xlf:cookieRevoke" /></div>',

  content: {
    message: '<f:translate key="LLL:fileadmin/razor/Language/razor.xlf:cookieMessage" />',
    dismiss: '<f:translate key="LLL:fileadmin/razor/Language/razor.xlf:cookieDismiss" />',
    link: '<f:translate key="LLL:fileadmin/razor/Language/razor.xlf:cookieLink" />',
    href: '<f:translate key="LLL:fileadmin/razor/Language/razor.xlf:cookieHref" />'
  },

  palette:{
    popup: {
      background: "<f:format.raw />{palette.popup.background}",
      text: "{palette.popup.text}"
    },

    button: {
      background: "<f:format.raw />{palette.button.background}",
      text: "{palette.button.text}"
    },
  },
});
