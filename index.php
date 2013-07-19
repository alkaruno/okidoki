<?php

require_once 'lib/markdown_extended.php';

class OkiDoki
{
    function __construct()
    {
        $config = include('config.php');

        $uri = substr(urldecode($_SERVER['REQUEST_URI']), strlen($config['prefix']));
        list($tree, $content) = $this->getTreeAndContent($uri);

        include 'view.php';
    }

    private function getTreeAndContent($uri)
    {
        $tree = array();
        $content = '';

        foreach (glob('docs/*') as $dir) {
            $pathinfo = pathinfo($dir);
            $dirname = $this->cleanSorting($pathinfo['filename']);
            $data = array(
                'path'     => $dirname,
                'name'     => $this->cleanName($dirname),
                'is_dir'   => is_dir($dir),
                'children' => array()
            );
            foreach (glob($dir . '/*') as $file) {
                $pathinfo = pathinfo($file);
                $filename = $this->cleanSorting($pathinfo['filename']);
                $data['children'][] = array(
                    'path' => $filename,
                    'name' => $this->cleanName($filename)
                );
                if (sprintf('%s/%s', $dirname, $filename) == $uri) {
                    $content = MarkdownExtended(file_get_contents($file));
                }
            }
            if ($dirname == $uri) {
                $content = MarkdownExtended(file_get_contents($dir));
            }
            $tree[] = $data;
        }

        return array($tree, $content);
    }

    private function cleanSorting($name)
    {
        $name = str_replace('.md', '', $name);

        $parts = explode('_', $name);
        if (isset($parts[0]) && is_numeric($parts[0])) {
            unset($parts[0]);
        }
        $name = implode('_', $parts);

        return $name;
    }

    private function cleanName($name)
    {
        return str_replace('_', ' ', $name);
    }
}

new OkiDoki();