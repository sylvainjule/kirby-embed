<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit15b4b4f6c06d13a66170930d082a8cbf
{
    public static $files = array (
        '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/..' . '/ralouphie/getallheaders/src/getallheaders.php',
        '09fc349b549513bf7f4291502426f919' => __DIR__ . '/..' . '/embed/embed/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
            'Psr\\Http\\Client\\' => 16,
        ),
        'M' => 
        array (
            'ML\\JsonLD\\' => 10,
        ),
        'K' => 
        array (
            'Kirby\\' => 6,
        ),
        'H' => 
        array (
            'HtmlParser\\' => 11,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
        ),
        'E' => 
        array (
            'Embed\\' => 6,
        ),
        'C' => 
        array (
            'Composer\\CaBundle\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-factory/src',
            1 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Psr\\Http\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-client/src',
        ),
        'ML\\JsonLD\\' => 
        array (
            0 => __DIR__ . '/..' . '/ml/json-ld',
        ),
        'Kirby\\' => 
        array (
            0 => __DIR__ . '/..' . '/getkirby/composer-installer/src',
        ),
        'HtmlParser\\' => 
        array (
            0 => __DIR__ . '/..' . '/oscarotero/html-parser/src',
        ),
        'GuzzleHttp\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src',
        ),
        'Embed\\' => 
        array (
            0 => __DIR__ . '/..' . '/embed/embed/src',
        ),
        'Composer\\CaBundle\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/ca-bundle/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'M' => 
        array (
            'ML\\IRI' => 
            array (
                0 => __DIR__ . '/..' . '/ml/iri',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit15b4b4f6c06d13a66170930d082a8cbf::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit15b4b4f6c06d13a66170930d082a8cbf::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit15b4b4f6c06d13a66170930d082a8cbf::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit15b4b4f6c06d13a66170930d082a8cbf::$classMap;

        }, null, ClassLoader::class);
    }
}
