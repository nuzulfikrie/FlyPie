<?php

namespace WyriHaximus\FlyPie\Panel;

use Cake\Core\Configure;
use DebugKit\DebugPanel;
use WyriHaximus\FlyPie\FilesystemRegistry;

class FilesystemPanel extends DebugPanel
{
    const CONFIGURE_KEY = 'WyriHaximus.FlyPie';

    // @codingStandardsIgnoreStart
    public $plugin = 'WyriHaximus/FlyPie';
    // @codingStandardsIgnoreEnd

    /**
     * Return all data with: All configured filesystems.
     *
     * @return array
     */
    public function data()
    {
        $data = [
            'filesystems' => array_keys((array)Configure::read(self::CONFIGURE_KEY)),
            'classes' => [],
        ];

        foreach ($data['filesystems'] as $filesystem) {
            FilesystemRegistry::retrieve($filesystem);
            $data['classes'][$filesystem] = FilesystemRegistry::$adapterClasses[$filesystem];
        }

        return $data;
    }

    /**
     * Gets the initial text for the filesystem summary
     *
     * @return string
     */
    public function summary()
    {
        return strval(count((array)Configure::read(self::CONFIGURE_KEY)));
    }
}
