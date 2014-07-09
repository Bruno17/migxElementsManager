<?php

$config = $modx->migx->customconfigs;
$prefix = $config['prefix'];
$packageName = $config['packageName'];
$packagepath = $modx->getOption('core_path') . 'components/' . $packageName . '/';
$modelpath = $packagepath . 'model/';
$modx->addPackage($packageName, $modelpath, $prefix);
$classname = $config['classname'];

$configs = $modx->getOption('configs', $scriptProperties, '');
$task = str_replace ('mem','',$configs);
$task = str_replace (':migxelementsmanager','',$configs);
$elementSettings = $modx->getOption('elementSettings', $config, '');
$settings = $modx->getOption($task, $elementSettings, array());
$packageName = $modx->getOption('package', $scriptProperties, '');
$nameField = $modx->getOption('nameField', $settings, 'name');
$elementClass = $modx->getOption('elementsClass', $settings, '');

if (!empty($packageName)) {
    $packagepath = $modx->getOption('core_path') . 'components/' . $packageName . '/';
    
    
    $elementspath = $packagepath . 'elements/' . $task . '/';
    

    if (is_dir($elementspath)) {
        if ($handle = opendir($elementspath)) {
            while (false !== ($file = readdir($handle))) {
                $exploded = explode('.', $file);
                if (count($exploded) == 3 && $exploded[0] == $task && $exploded[2] == 'json') {
                    $elements = @file_get_contents($elementspath . $file);
                    $elements = $modx->fromJson($elements);
                    if (is_array($elements)){
                        foreach ($elements as $element){
                            $category_name = $modx->getOption('category_name',$element,'');
                            $element_name = $modx->getOption($nameField,$element,'');
                            $filename = $modx->getOption('filename',$element,'');
                            
                            if (!empty($category_name) && $category = $modx->getObject('modCategory',array('category'=>$category_name))){
                                
                            }else{
                                $category = $modx->newObject('modCategory');
                                $category->set('category',$category_name);
                                $category->save();
                            }
                            $element['category'] = $category->get('id');
                            
                            if ($object = $modx->getObject($elementClass,array($nameField=>$element_name))){
                                
                            }else{
                                $object = $modx->newObject($elementClass);
                            }
                            if ($object){
                                $object->fromArray($element);
                                $content = @file_get_contents($elementspath . $filename);
                                $object->setContent($content);
                                $object->save();
                            }
                        }
                    }
                }
            }
            closedir($handle);
        }
    }
    
}

return $modx->error->success('');