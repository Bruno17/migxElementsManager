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

