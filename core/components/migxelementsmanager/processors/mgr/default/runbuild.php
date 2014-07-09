<?php

$config = $modx->migx->customconfigs;
$prefix = $config['prefix'];
$packageName = $config['packageName'];
$packagepath = $modx->getOption('core_path') . 'components/' . $packageName . '/';
$modelpath = $packagepath . 'model/';
$modx->addPackage($packageName, $modelpath, $prefix);
$classname = $config['classname'];
$object_id = $modx->getOption('object_id', $scriptProperties, 0);

if ($object = $modx->getObject($classname, $object_id)) {
    $configArray = $object->toArray();
    $configArray['packageName'] = $modx->getOption('package', $configArray);
    $configArray['packageNameLower'] = strtolower($modx->getOption('package', $configArray));
    $configArray['targetRoot'] = $modx->getOption('assets_path') . 'mypackages/' . $configArray['packageNameLower'] . '/';
    
    include ($configArray['targetRoot'] . '_build/build.transport.php');   
    
}


return $modx->error->success('');
