<?php

function recursive_mkdir($path, $mode = 0777)
{
    $dirs = explode(DIRECTORY_SEPARATOR, $path);
    $count = count($dirs);
    $path = '';
    for ($i = 0; $i < $count; ++$i) {
        $path .= DIRECTORY_SEPARATOR . $dirs[$i];
        if (!is_dir($path) && !mkdir($path, $mode)) {
            return false;
        }
    }
    return true;
}

function writeElFile($filename, $content)
{
    if (!$handle = fopen($filename, "w+")) {
        //print "Kann die Datei $filename nicht öffnen";
    }

    if (!fwrite($handle, $content)) {
        //print "Kann in die Datei $filename nicht schreiben";
    }
    fclose($handle);
}

function writeElFiles($task, $elementsPath, $elementsPackage, $settings, $category_id = 0, $category_name = '')
{
    global $modx;

    $dir = '';
    if (!empty($elementsPath)) {
        $dir = $elementsPath;
    } else
        if (!empty($elementsPackage)) {
            $dir = $modx->getOption('core_path') . 'components/' . $elementsPackage . '/elements/' . $task;
        }

    if (!empty($dir)) {
        if (!recursive_mkdir($dir, 0755)) {
            return 'failure';
        }
        $nameField = $modx->getOption('nameField', $settings, 'name');
        $elementsSuffix = $modx->getOption('elementsSuffix', $settings, '.php');
        $elementsClass = $modx->getOption('elementsClass', $settings, false);
        $contentField = $modx->getOption('contentField', $settings, '');
        $memClass = str_replace('mod', 'mem', $elementClass);

        if ($elementsClass && $collection = $modx->getIterator($elementsClass, array('category' => $category_id))) {
            $elements = array();
            foreach ($collection as $object) {
                $id = $object->get('id');
                $exclude = false;
                if ($memObject = $modx->getObject($memClass, array('element_id' => $id))) {
                    $exclude = $memObject->get('exclude');
                }

                if ($exclude) {
                    continue;
                }

                $element = $object->toArray();
                unset($element[$contentField]);
                unset($element['content']);
                $filename = strtolower($object->get($nameField)) . $elementsSuffix;
                $element['filename'] = $filename;
                $filename = $dir . '/' . $filename;
                $content = $object->getContent();
                if (strstr($elementsSuffix, '.php')) {
                    $content = '<?php' . "\n" . $content;
                }

                writeElFile($filename, $content);

                $element['category'] = 0;
                $element['category_name'] = $category_name;
                $elements[] = $element;
            }
            $content = $modx->toJson($elements);
            $content = $modx->migx->indent($content);
            $filename = $dir . '/' . $task . '.' . $category_id . '.json';
            writeElFile($filename, $content);
        }

    }


}

$config = $modx->migx->customconfigs;
$prefix = isset($config['prefix']) && !empty($config['prefix']) ? $config['prefix'] : null;
$errormsg = '';

if (isset($config['use_custom_prefix']) && !empty($config['use_custom_prefix'])) {
    $prefix = isset($config['prefix']) ? $config['prefix'] : '';
}
$packageName = $config['packageName'];

$packagepath = $modx->getOption('core_path') . 'components/' . $packageName . '/';
$modelpath = $packagepath . 'model/';
$is_container = $modx->getOption('is_container', $config, false);
if (is_dir($modelpath)) {
    $modx->addPackage($packageName, $modelpath, $prefix);
}

$configs = $modx->getOption('configs', $scriptProperties, '');
$task = $modx->getOption('task', $scriptProperties, '');
$object_id = $modx->getOption('object_id', $scriptProperties, '');
$classname = $modx->getOption('classname', $config, '');

$elementSettings = $modx->getOption('elementSettings', $config, '');

if ($classname == 'memCategory') {
    //get elements of Category
    if ($memCategory = $modx->getObject($classname, $object_id)) {
        $category_id = $memCategory->get('element_id');
        $category_name = '';
        if ($category = $memCategory->getOne('Element')) {
            $category_name = $category->get('category');
        }

        $elementsPackage = $memCategory->get('package');
        $elementsPath = $memCategory->get('static_path');

        if ($task == 'elements') {
            foreach ($elementSettings as $task => $settings) {
                writeElFiles($task, $elementsPath, $elementsPackage, $settings, $category_id, $category_name);
            }
        } else {
            $settings = $modx->getOption($task, $elementSettings, array());
            writeElFiles($task, $elementsPath, $elementsPackage, $settings, $category_id, $category_name);
        }

    }

} else {

}

return $modx->error->success();
