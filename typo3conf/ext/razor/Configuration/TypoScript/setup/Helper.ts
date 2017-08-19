# # Add default class to lists [BEGIN]

lib.parseFunc_RTE {
	externalBlocks := addToList(ul,li)
	externalBlocks {
		ul.stripNL = 1
		ul.callRecursive = 1
		ul.callRecursive.tagStdWrap.HTMLparser = 1
		ul.callRecursive.tagStdWrap.HTMLparser.tags.ul {
			fixAttrib.class.default = list
		}

		ol.stripNL = 1
		ol.callRecursive = 1
		ol.callRecursive.tagStdWrap.HTMLparser = 1
		ol.callRecursive.tagStdWrap.HTMLparser.tags.ol {
			fixAttrib.class.default = list
		}
	}
}

# # Add default class to lists [END]

# # Blockquotes [BEGIN]

lib.parseFunc_RTE {
  externalBlocks {
    blockquote {
      callRecursive {
        tagStdWrap {
          HTMLparser {
            tags {
              blockquote {
                overrideAttribs =
              }
            }
          }
        }
      }
    }
  }
}

# # Blockquotes [END]