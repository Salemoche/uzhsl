<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit17a82fb40b8c29162b80656e4813fdf8
{
    public static $prefixLengthsPsr4 = array (
        'H' => 
        array (
            'HaselNamespace\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'HaselNamespace\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'HaselNamespace\\classes\\Assets' => __DIR__ . '/../..' . '/inc/classes/Assets.php',
        'HaselNamespace\\classes\\Blocks' => __DIR__ . '/../..' . '/inc/classes/Blocks.php',
        'HaselNamespace\\classes\\Menus' => __DIR__ . '/../..' . '/inc/classes/Menus.php',
        'HaselNamespace\\classes\\Theme' => __DIR__ . '/../..' . '/inc/classes/Theme.php',
        'HaselNamespace\\traits\\Singleton' => __DIR__ . '/../..' . '/inc/traits/Singleton.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit17a82fb40b8c29162b80656e4813fdf8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit17a82fb40b8c29162b80656e4813fdf8::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit17a82fb40b8c29162b80656e4813fdf8::$classMap;

        }, null, ClassLoader::class);
    }
}