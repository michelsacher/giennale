# # RTE configuration [BEGIN]

RTE.default {
  contentCSS = fileadmin/razor/Styles/Rte.css
  
  # Markup options
  enableWordClean = 1
  removeTrailingBR = 1
  removeComments = 1
  removeTags = center, sdfield
  removeTagsAndContents = style,script
  
  showButtons (
    bold
    , italic
    , textstyle
    , textstylelabel
    , blockstyle
    , blockstylelabel
    , formatblock
    , left
    , outdent
    , indent
    , subscript
    , superscript
    , center
    , right
    , orderedlist
    , unorderedlist
    , insertcharacter
    , link
    , removeformat
    , insertcharacter
    , chMode
    , pastetoggle
  )

  hideButtons (
    fontstyle
    , fontsize
    , strikethrough
    , lefttoright
    , righttoleft
    , textcolor
    , bgcolor
    , textindicator
    , emoticon
    , user
    , spellcheck
    , inserttag
    , justifyfull
    , acronym
    , copy
    , cut
    , paste
    , undo
    , redo
    , showhelp
    , about
    , tableproperties
    , rowproperties
    , rowinsertabove
    , rowinsertunder
    , rowdelete
    , rowsplit
    , columninsertbefore
    , columninsertafter
    , columndelete
    , columnsplit
    , cellproperties
    , cellinsertbefore
    , cellinsertafter
    , celldelete
    , cellsplit
    , cellmerge
    , toggleborders
    , table,
    , findreplace
    , underline
    , image
  )
  
  toolbarOrder (
    blockstyle
    , formatblock
    , blockstylelabel
    , linebreak

    , textstyle
    , textstylelabel
    , linebreak

    , bold
    , italic
    
    , left
    , center
    , right
    , outdent
    , indent
    , subscript
    , superscript
    , orderedlist
    , unorderedlist
    , insertcharacter
    , link
    , removeformat
    , insertcharacter
    , chMode
    , pastetoggle
  )
  
  buttons.formatblock.removeItems (
    address
    , article
    , aside
    , div
    , footer
    , header
    , nav
    , p
    , h1
    , h2
    , h3
    , h4
    , h5
    , h6
    , pre
    , section
  )

  buttons.pastetoggle.setActiveOnRteOpen = 1
  buttons.pastetoggle.hidden = 1

  buttons.textstyle.tags.span.allowedClasses = small, big, text-lowercase, text-uppercase, text-capitalize

  buttons.link.properties.class.allowedClasses = 
  
  keepButtonGroupTogether = 1
  
  showStatusBar =  0
  
  inlineStyle.text-alignment (
    p.align-left, h1.align-left, h2.align-left, h3.align-left, h4.align-left, h5.align-left, h6.align-left, td.align-left { text-align: left; }
    p.align-center, h1.align-center, h2.align-center, h3.align-center, h4.align-center, h5.align-center, h6.align-center, td.align-center { text-align: center; }
    p.align-right, h1.align-right, h2.align-right, h3.align-right, h4.align-right, h5.align-right, h6.align-right, td.align-right { text-align: right; }
  )
  
  ignoreMainStyleOverride = 1
  
  proc {
    allowTags (
      , table ,tbody, tr, th, td,
      , h1, h2, h3, h4, h5, h6
      , p
      , br
      , span
      , ul, ol, li
      , re
      , blockquote
      , strong, em, b, i, u, sub, sup, strike
      , a
      , img
      , nobr, hr, tt, q, cite, abbr, acronym, center
    )
    
    denyTags = font
    
    dontConvBRtoParagraph = 1
    
    allowTagsOutside = 
    
    keepPDIVattribs = align,class,style,id
    
    classesParagraph = big, small, text-lowercase, text-uppercase, text-capitalize
    
    allowedClasses (
      align-left, align-center, align-right, big, small, text-lowercase, text-uppercase, text-capitalize
    )      
    
    # Generelle Einstellungen fÜr den HTML-Parser
    HTMLparser_rte {
      
      # tags die erlaubt/verboten sind
      allowTags < RTE.default.proc.allowTags
      denyTags < RTE.default.proc.denyTags
      
      removeComments = 1  
      keepNonMatchedTags = 0 
      keepNonMatchedTags = 1
    }
    
    entryHTMLparser_db = 1
    entryHTMLparser_db {
      allowTags < RTE.default.proc.allowTags
      denyTags < RTE.default.proc.denyTags
      
      noAttrib = b, i, u, strike, sub, sup, strong, em, quote, blockquote, cite, tt, br, center
      rmTagIfNoAttrib = span,div,font
      
      # htmlSpecialChars = 1
      
      tags {
        p.fixAttrib.align.unset >
        p.allowedAttribs = class,style,align
        
        div.fixAttrib.align.unset >
        
        hr.allowedAttribs = class
        
        b.remap = strong
        i.remap = em
        
        img >
      }
    }
    
    exitHTMLparser_db = 1
    exitHTMLparser_db {
      tags {
        b.remap = strong
        i.remap = em
      }
    }
    
  }
  
  showTagFreeClasses = 1
  
  hideTags = font
  
  hideTableOperationsInToolbar = 0
  keepToggleBordersInToolbar = 1
  
  disableSpacingFieldsetInTableOperations = 1
  disableAlignmentFieldsetInTableOperations=1
  disableColorFieldsetInTableOperations=1
  disableLayoutFieldsetInTableOperations=1
  disableBordersFieldsetInTableOperations=0
}

RTE.default.enableWordClean.HTMLparser < RTE.default.proc.entryHTMLparser_db

RTE.default.FE < RTE.default
RTE.default.FE.userElements >
RTE.default.FE.userLinks >

TCEFORM.tt_content.bodytext.RTEfullScreenWidth= 80% 

RTE {
  classesAnchor.default {
    page = 
    url = 
    file = 
    mail = 
  }

  classesAnchor {
    externalLink {
      altText =
      titleText =
    }
    externalLinkInNewWindow {
      altText =
      titleText =
    }
    internalLink {
      altText = 
      titleText = 
    }
    internalLinkInNewWindow {
      altText = 
      titleText = 
    }
    download {
      titleText =
      altText =
    }
    mail {
      titleText =
      altText =
    }
  }
}

# # RTE configuration [END]
