<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2f3b4416f8b8c071ef8d7fba62c09ec0
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2f3b4416f8b8c071ef8d7fba62c09ec0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2f3b4416f8b8c071ef8d7fba62c09ec0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2f3b4416f8b8c071ef8d7fba62c09ec0::$classMap;

        }, null, ClassLoader::class);
    }
}