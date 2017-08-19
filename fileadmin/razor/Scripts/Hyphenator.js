var hyphenatorSettings = {
  useCSS3hyphenation: true,
  selectorfunction: function () {
    return $("h1, h2, h3, h4, h5, h6").get();
  }
};

Hyphenator.config(hyphenatorSettings);
Hyphenator.run();
