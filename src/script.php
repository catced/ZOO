<?php
$directory = 'C:\xampp\www\ZOO\templates'; 

$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

foreach ($files as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $content = file_get_contents($file->getPathname());
        if (preg_match('/^\s*<\?php/', $content)) {
            echo "Fichier avec espace ou ligne vide avant <?php : " . $file->getPathname() . PHP_EOL;
        }
    }
}