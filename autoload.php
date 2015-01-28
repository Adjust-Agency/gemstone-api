<?php
spl_autoload_register(function ($className) {
    $fileParts = explode('\\', ltrim($className, '\\'));
    if (false !== strpos(end($fileParts), '_'))
    array_splice($fileParts, -1, 1, explode('_', current($fileParts)));
    array_shift($fileParts);
    require __DIR__.'/src/'.implode(DIRECTORY_SEPARATOR, $fileParts) . '.php';
}); 