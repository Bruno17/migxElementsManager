<?php

$gridactionbuttons['loadElements']['text'] = "'Load Elements'";
$gridactionbuttons['loadElements']['handler'] = 'this.loadElements';
$gridactionbuttons['loadElements']['scope'] = 'this';

$gridfunctions['this.loadElements'] = "
loadElements: function(btn,e) {
    var _this=this;
            MODx.Ajax.request({
                url: _this.config.url
                ,params: {
                    action: 'mgr/migxdb/process'
                    ,processaction: 'loadelements'                     
                    ,configs: _this.config.configs
                    ,resource_id: _this.config.resource_id
                    ,co_id: '[[+config.connected_object_id]]'                
                    ,reqConfigs: '[[+config.req_configs]]'
                }
                ,listeners: {
                    'success': {fn:function(r) {
                        _this.refresh();
                    },scope:_this}
                }
            });
          
    return true;
}
";

$gridactionbuttons['readElFiles']['text'] = "'Read Elements from Component'";
$gridactionbuttons['readElFiles']['handler'] = 'this.readElFiles';
$gridactionbuttons['readElFiles']['scope'] = 'this';

$gridfunctions['this.readElFiles'] = "
readElFiles: function() {
    Ext.Msg.prompt('Import configs from Package', 'Package:', function(btn, text) {
        if (btn == 'ok') {
            var package = text;
            var url = this.config.url;
            var configs = this.config.configs;
            MODx.Ajax.request({
                url: url,
                params: {
                    action: 'mgr/migxdb/process',
                    processaction: 'importfromfiles',
                    package: package,
                    configs: configs
                },
                listeners: {
                    'success': {
                        fn: this.refresh,
                        scope: this
                    }
                }
            });
        }
    },this);
}	
";

$gridcontextmenus['writeElFiles']['code']="
        m.push({
            className : 'writeElFiles', 
            text: 'write Elements to files',
            handler: 'this.writeElFiles'
        });
        m.push('-');
";
$gridcontextmenus['writeElFiles']['handler'] = 'this.writeElFiles,this.writeFiles';

$gridfunctions['this.writeElFiles'] = "
writeElFiles: function() {
        this.writeFiles('elements');
    }	
";

$gridcontextmenus['writeSnFiles']['code']="
        m.push({
            className : 'writeSnFiles', 
            text: 'write Snippets to files',
            handler: 'this.writeSnFiles'
        });
        m.push('-');
";
$gridcontextmenus['writeSnFiles']['handler'] = 'this.writeSnFiles,this.writeFiles';

$gridfunctions['this.writeSnFiles'] = "
writeSnFiles: function() {
        this.writeFiles('snippets');
    }	
";

$gridcontextmenus['writeChFiles']['code']="
        m.push({
            className : 'writeChFiles', 
            text: 'write Chunks to files',
            handler: 'this.writeChFiles'
        });
        m.push('-');
";
$gridcontextmenus['writeChFiles']['handler'] = 'this.writeChFiles,this.writeFiles';

$gridfunctions['this.writeChFiles'] = "
writeChFiles: function() {
        this.writeFiles('chunks');
    }	
";

$gridcontextmenus['writePlFiles']['code']="
        m.push({
            className : 'writePlFiles', 
            text: 'write Plugins to files',
            handler: 'this.writePlFiles'
        });
        m.push('-');
";
$gridcontextmenus['writePlFiles']['handler'] = 'this.writePlFiles,this.writeFiles';

$gridfunctions['this.writePlFiles'] = "
writePlFiles: function() {
        this.writeFiles('plugins');
    }	
";

$gridcontextmenus['writeTeFiles']['code']="
        m.push({
            className : 'writeTeFiles', 
            text: 'write Templates to files',
            handler: 'this.writeTeFiles'
        });
        m.push('-');
";
$gridcontextmenus['writeTeFiles']['handler'] = 'this.writeTeFiles,this.writeFiles';

$gridfunctions['this.writeTeFiles'] = "
writeTeFiles: function() {
        this.writeFiles('templates');
    }	
";

$gridfunctions['this.writeFiles'] = "
writeFiles: function(task) {
        MODx.Ajax.request({
            url: this.config.url
            ,params: {
                action: 'mgr/migxdb/process'
				,processaction: 'writetofiles'
                ,task: task
                ,object_id: this.menu.record.id
				,configs: this.config.configs
                ,resource_id: this.config.resource_id
                ,co_id: '[[+config.connected_object_id]]'
                ,reqConfigs: '[[+config.req_configs]]'                
            }
            ,listeners: {
                'success': {fn:this.refresh,scope:this}
            }
        });
    }	
";


$gridcontextmenus['prepareBuild']['code']="
        m.push({
            className : 'prepareBuild', 
            text: 'Prepare Build',
            handler: 'this.prepareBuild'
        });
        m.push('-');
";
$gridcontextmenus['prepareBuild']['handler'] = 'this.prepareBuild';

$gridfunctions['this.prepareBuild'] = "
prepareBuild: function() {
        MODx.Ajax.request({
            url: this.config.url
            ,params: {
                action: 'mgr/migxdb/process'
				,processaction: 'preparebuild'
                ,object_id: this.menu.record.id
				,configs: this.config.configs
                ,resource_id: this.config.resource_id
                ,co_id: '[[+config.connected_object_id]]'
                ,reqConfigs: '[[+config.req_configs]]'                
            }
            ,listeners: {
                'success': {fn:this.refresh,scope:this}
            }
        });
    }	
";

$gridcontextmenus['runBuild']['code']="
        m.push({
            className : 'runBuild', 
            text: 'Build',
            handler: 'this.runBuild'
        });
        m.push('-');
";
$gridcontextmenus['runBuild']['handler'] = 'this.runBuild';

$gridfunctions['this.runBuild'] = "
runBuild: function() {
        MODx.Ajax.request({
            url: this.config.url
            ,params: {
                action: 'mgr/migxdb/process'
				,processaction: 'runbuild'
                ,object_id: this.menu.record.id
				,configs: this.config.configs
                ,resource_id: this.config.resource_id
                ,co_id: '[[+config.connected_object_id]]'
                ,reqConfigs: '[[+config.req_configs]]'                
            }
            ,listeners: {
                'success': {fn:this.refresh,scope:this}
            }
        });
    }	
";
