Ext.onReady(function() {
    Ext.apply(TYPO3.Components.PageTree.Actions, {
        hideInMenu: function(node, tree) { 
            TYPO3.hideShow.Menue.hideShow(node.attributes.nodeData, '1', function(response) {
                this.updateNode(node, node.isExpanded(), response);
            }, this);
        },
        showInMenu: function(node, tree) { 
            TYPO3.hideShow.Menue.hideShow(node.attributes.nodeData, '0', function(response) {
                this.updateNode(node, node.isExpanded(), response);
            }, this);
        },  
        standardPage: function(node, tree) { 
            TYPO3.hideShow.Menue.switchPage(node.attributes.nodeData, '1', function(response) {
                this.updateNode(node, node.isExpanded(), response);
            }, this);
        },  
        backendPage: function(node, tree) { 
            TYPO3.hideShow.Menue.switchPage(node.attributes.nodeData, '6', function(response) {
                this.updateNode(node, node.isExpanded(), response);
            }, this);
        },  
        shortcutPage: function(node, tree) { 
            TYPO3.hideShow.Menue.switchPage(node.attributes.nodeData, '4', function(response) {
                this.updateNode(node, node.isExpanded(), response);
            }, this);
        },  
        mountPage: function(node, tree) { 
            TYPO3.hideShow.Menue.switchPage(node.attributes.nodeData, '7', function(response) {
                this.updateNode(node, node.isExpanded(), response);
            }, this);
        },  
        urlPage: function(node, tree) { 
            TYPO3.hideShow.Menue.switchPage(node.attributes.nodeData, '3', function(response) {
                this.updateNode(node, node.isExpanded(), response);
            }, this);
        },            
        storageFolder: function(node, tree) { 
            TYPO3.hideShow.Menue.switchPage(node.attributes.nodeData, '254', function(response) {
                this.updateNode(node, node.isExpanded(), response);
            }, this);
        }, 
        trashPage: function(node, tree) { 
            TYPO3.hideShow.Menue.switchPage(node.attributes.nodeData, '255', function(response) {
                this.updateNode(node, node.isExpanded(), response);
            }, this);
        },    
        menuPage: function(node, tree) { 
            TYPO3.hideShow.Menue.switchPage(node.attributes.nodeData, '199', function(response) {
                this.updateNode(node, node.isExpanded(), response);
            }, this);
        }        
    });
});