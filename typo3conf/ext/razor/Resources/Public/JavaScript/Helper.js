// Flash message
$(".typo3-message").prepend('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');

// News back link
if ($(".news-back-link").length > 0) {
  if(document.referrer.indexOf(window.location.hostname) != -1) {
    $(".news-back-link").attr("href","javascript:history.back();");
  }
}

// Defer videos
const deferVideos = function() {
  var vidDefer = document.getElementsByTagName('iframe');

  for (var i=0; i<vidDefer.length; i++) {
    if(vidDefer[i].getAttribute('data-src')) {
      vidDefer[i].setAttribute('src', vidDefer[i].getAttribute('data-src'));
    }
  }
}

window.onload = deferVideos;
