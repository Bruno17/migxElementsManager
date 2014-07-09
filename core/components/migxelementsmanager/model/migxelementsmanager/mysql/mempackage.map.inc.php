<?php
$xpdo_meta_map['memPackage']= array (
  'package' => 'migxelementsmanager',
  'version' => NULL,
  'table' => 'mem_packages',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'package' => '',
    'packageDescription' => '',
    'version' => '',
    'release' => '',
    'menus' => '',
  ),
  'fieldMeta' => 
  array (
    'package' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'packageDescription' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'version' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'release' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'menus' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
  ),
);
