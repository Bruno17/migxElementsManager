<?php

$elementSettings = '
{
"snippets":{"elementsClass":"modSnippet","elementsSuffix":".snippet.php","nameField":"name","contentField":"snippet"},
"chunks":{"elementsClass":"modChunk","elementsSuffix":".chunk.html","nameField":"name","contentField":"snippet"},
"templates":{"elementsClass":"modTemplate","elementsSuffix":".template.html","nameField":"templatename","contentField":"content"},
"plugins":{"elementsClass":"modPlugin","elementsSuffix":".plugin.php","nameField":"name","contentField":"plugincode"}
}
';

$this->customconfigs['elementSettings'] = $this->modx->fromJson($elementSettings);

