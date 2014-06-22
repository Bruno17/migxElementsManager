<?php
$xpdo_meta_map['memCategory']= array (
  'package' => 'migxelementsmanager',
  'version' => NULL,
  'table' => 'mem_categories',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'element_id' => 0,
    'package' => '',
    'static_path' => '',
  ),
  'fieldMeta' => 
  array (
    'element_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
      'index' => 'index',
    ),
    'package' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'static_path' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
  ),
  'aggregates' => 
  array (
    'Element' => 
    array (
      'class' => 'modCategory',
      'local' => 'element_id',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
