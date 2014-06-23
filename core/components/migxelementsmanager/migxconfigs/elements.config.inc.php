<?php

$reqconfigs = $this->modx->getOption('reqConfigs', $_REQUEST, '');
$configs = $this->modx->getOption('configs', $_REQUEST, '');
$object_id = $this->modx->getOption('object_id', $_REQUEST, '');
$action = $this->modx->getOption('action', $_REQUEST, '');
$classname = $this->modx->getOption('classname', $this->customconfigs, '');
$packageName = $this->modx->getOption('packageName', $this->customconfigs, '');

if (!empty($packageName)) {
    $packageNames = explode(',', $packageName);
    //all packages must have the same prefix for now!
    foreach ($packageNames as $packageName) {
        $packagepath = $this->modx->getOption('core_path') . 'components/' . $packageName . '/';
        $modelpath = $packagepath . 'model/';
        if (is_dir($modelpath)) {
            $this->modx->addPackage($packageName, $modelpath, $prefix);
        }

    }
}

if ($reqconfigs == 'memcategories') {
    if ($action == 'mgr/migxdb/getList') {
        if ($memCategory = $this->modx->getObject('memCategory', $object_id)) {
            $category = $memCategory->get('element_id');
            $this->customconfigs['getlistwhere'] = '{"Element.category":"' . $category . '"}';
            
        }
    }
}
