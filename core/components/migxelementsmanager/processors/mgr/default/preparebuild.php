<?php

$config = $modx->migx->customconfigs;
$prefix = $config['prefix'];
$packageName = $config['packageName'];
$packagepath = $modx->getOption('core_path') . 'components/' . $packageName . '/';
$modelpath = $packagepath . 'model/';
$modx->addPackage($packageName, $modelpath, $prefix);
$classname = $config['classname'];
$object_id = $modx->getOption('object_id', $scriptProperties, 0);

function copyDir($source, $destination, $dirPermission)
{
    $source = rtrim($source, '/');
    $destination = rtrim($destination, '/');
    //echo "SOURCE: " . $source . "\nDESTINATION: " . $destination . "<br />";
    if (is_dir($source)) {
        if (!is_dir($destination)) {
            mkdir($destination, $dirPermission, true);
        }
        $objects = scandir($source);
        if (sizeof($objects) > 0) {
            foreach ($objects as $file) {
                if ($file == "." || $file == ".." || $file == '.git' || $file == '.svn'|| $file == '_buildsources') {
                    continue;
                }

                if (is_dir($source . '/' . $file)) {
                    copyDir($source . '/' . $file, $destination . '/' . $file, $dirPermission);
                } else {
                    copy($source . '/' . $file, $destination . '/' . $file);
                }
            }
        }
        return true;
    } elseif (is_file($source)) {
        return copy($source, $destination);
    } else {
        return false;
    }
}

function exportFiles($configArray)
{
    global $modx;
    $dirPermission = $modx->getOption('dirPermission', $configArray, 0777);
    $packageNameLower = $modx->getOption('packageNameLower', $configArray, '');
    $targetRoot = $modx->getOption('targetRoot', $configArray, '') ;
    $workingDirs = $modx->getOption('workingDirs', $configArray, array());
    $assetsWorkingDir = $modx->getOption('assets', $workingDirs, '');
    $coreWorkingDir = $modx->getOption('core', $workingDirs, '');
    if (!empty($packageNameLower) && !empty($assetsWorkingDir) && !empty($targetRoot)) {
        $assetsTargetDir = $targetRoot . 'assets/components/' . $packageNameLower . '/';
        copyDir($assetsWorkingDir, $assetsTargetDir, $dirPermission);
    }
    if (!empty($packageNameLower) && !empty($coreWorkingDir) && !empty($targetRoot)) {
        $coreTargetDir = $targetRoot . 'core/components/' . $packageNameLower . '/';
        copyDir($coreWorkingDir, $coreTargetDir, $dirPermission);
    }

}

function exportBuildFiles($configArray)
{
    global $modx;
    $dirPermission = $modx->getOption('dirPermission', $configArray, 0777);
    $packageNameLower = $modx->getOption('packageNameLower', $configArray, '');
    $targetRoot = $modx->getOption('targetRoot', $configArray, '') ;
    $workingDir = $modx->getOption('core_path') . 'components/migxelementsmanager/_buildsources/';
    if (!empty($packageNameLower) && !empty($workingDir) && !empty($targetRoot)) {
        $targetDir = $targetRoot . '_build/';
        copyDir($workingDir, $targetDir, $dirPermission);
    }
}



function writeBuildFile($filename, $content)
{
    if (!$handle = fopen($filename, "w+")) {
        //print "Kann die Datei $filename nicht öffnen";
    }

    if (!fwrite($handle, $content)) {
        //print "Kann in die Datei $filename nicht schreiben";
    }
    fclose($handle);
}

if ($object = $modx->getObject($classname, $object_id)) {
    $configArray = $object->toArray();
    $configArray['packageName'] = $modx->getOption('package', $configArray);
    $configArray['packageNameLower'] = strtolower($modx->getOption('package', $configArray));
    $configArray['targetRoot'] = $modx->getOption('assets_path') . 'mypackages/' . $configArray['packageNameLower'] . '/';
    $configArray['workingDirs'] = array(
        'core' => $modx->getOption('core_path') . 'components/' . $configArray['packageNameLower'] . '/',
        'assets' => $modx->getOption('assets_path') . 'components/' . $configArray['packageNameLower'] . '/',
        );
    exportFiles($configArray);
    exportBuildFiles($configArray);
    
    $filename = $configArray['targetRoot'] . '_build/config/config.json';
    $content = $modx->toJson($object->toArray());
    $content = $modx->migx->indent($content);
    writeBuildFile($filename, $content);
    
    $filename = $configArray['targetRoot'] . '_build/resolvers/tables.resolver.php';
    if (file_exists($filename)){
        $content = file_get_contents($filename);
        $content = str_replace('{packageNameLower}',$configArray['packageNameLower'],$content);
        file_put_contents($filename,$content);
    }
    
    $filename = $configArray['targetRoot'] . '_build/resolvers/resolve.menues.php';
    if (file_exists($filename)){
        $menus = $object->get('menus');
        $content = file_get_contents($filename);
        $content = str_replace('{menus}',$menus,$content);
        file_put_contents($filename,$content);
    }    
}


return $modx->error->success('');
