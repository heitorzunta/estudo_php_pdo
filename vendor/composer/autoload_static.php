<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfb841cc6746c61a46338cc70cbee06e2
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Alura\\Pdo\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Alura\\Pdo\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfb841cc6746c61a46338cc70cbee06e2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfb841cc6746c61a46338cc70cbee06e2::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitfb841cc6746c61a46338cc70cbee06e2::$classMap;

        }, null, ClassLoader::class);
    }
}
