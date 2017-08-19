Ext.onReady(function() {
  Ext.apply(TYPO3.Components.PageTree.Actions, {
    newsPage: function(node, tree) {
      TYPO3.razor.Menue.switchPage(node.attributes.nodeData, '115', function(response) {
        this.updateNode(node, node.isExpanded(), response);
      }, this);
    }
  });
});