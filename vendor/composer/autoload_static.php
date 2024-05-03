<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite69e669401af1d9c60e358e36e6bf714
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'L' => 
        array (
            'Laminas\\Escaper\\' => 16,
        ),
        'H' => 
        array (
            'Hermawan\\DataTables\\' => 20,
        ),
        'C' => 
        array (
            'CodeIgniter\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Laminas\\Escaper\\' => 
        array (
            0 => __DIR__ . '/..' . '/laminas/laminas-escaper/src',
        ),
        'Hermawan\\DataTables\\' => 
        array (
            0 => __DIR__ . '/..' . '/hermawan/codeigniter4-datatables/src',
        ),
        'CodeIgniter\\' => 
        array (
            0 => __DIR__ . '/..' . '/codeigniter4/framework/system',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'PHPSQLParser\\' => 
            array (
                0 => __DIR__ . '/..' . '/greenlion/php-sql-parser/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite69e669401af1d9c60e358e36e6bf714::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite69e669401af1d9c60e358e36e6bf714::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInite69e669401af1d9c60e358e36e6bf714::$prefixesPsr0;
            $loader->classMap = ComposerStaticInite69e669401af1d9c60e358e36e6bf714::$classMap;

        }, null, ClassLoader::class);
    }
}
