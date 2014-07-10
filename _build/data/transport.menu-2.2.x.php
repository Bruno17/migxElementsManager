<?php

/**
 * menus transport file for MIGX extra
 *
 * Copyright 2013 by Bruno Perner b.perner@gmx.de
 * Created on 04-17-2014
 *
 * @package migx
 * @subpackage build
 */

if (!function_exists('stripPhpTags')) {
    function stripPhpTags($filename)
    {
        $o = file_get_contents($filename);
        $o = str_replace('<' . '?' . 'php', '', $o);
        $o = str_replace('?>', '', $o);
        $o = trim($o);
        return $o;
    }
}
/* @var $modx modX */
/* @var $sources array */
/* @var xPDOObject[] $menus */

$menus = array();

if (is_array($menuprops)) {
    $i = 1;
    foreach ($menuprops as $props) {
        $action = $modx->newObject('modAction');
        $action->fromArray(array(
            'namespace' => !empty($props['action.namespace']) ? $props['action.namespace'] : 'migx',
            'controller' => !empty($props['action.controller']) ? $props['action.controller'] : 'index',
            'haslayout' => !empty($props['action.haslayout']) ? $props['action.haslayout'] : 0,
            'lang_topics' => !empty($props['action.lang_topics']) ? $props['action.lang_topics'] : 'example:default',
            'assets' => !empty($props['action.assets']) ? $props['action.assets'] : '',
            'help_url' => !empty($props['action.help_url']) ? $props['action.help_url'] : '',
            'id' => $i,
            ), '', true, true);


        $menus[$i] = $modx->newObject('modMenu');
        $menus[$i]->fromArray(array(
            'text' => !empty($props['text']) ? $props['text'] : '',
            'parent' => !empty($props['parent']) ? $props['parent'] : '',
            'description' => !empty($props['description']) ? $props['description'] : '',
            'icon' => !empty($props['icon']) ? $props['icon'] : '',
            'menuindex' => !empty($props['menuindex']) ? $props['menuindex'] : 0,
            'params' => !empty($props['params']) ? $props['params'] : '',
            'handler' => !empty($props['handler']) ? $props['handler'] : '',
            'permissions' => !empty($props['permissions']) ? $props['permissions'] : '',
            ), '', true, true);

        $menus[$i]->addOne($action);
        $i++;
    }

}


return $menus;
