<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfcff95402c7b0ef2e55d24f268b93eee
{
    public static $prefixLengthsPsr4 = array (
        'Z' => 
        array (
            'Zszcq\\Huijupay\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Zszcq\\Huijupay\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Zszcq/Huijupay',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfcff95402c7b0ef2e55d24f268b93eee::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfcff95402c7b0ef2e55d24f268b93eee::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
