<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit15b4b4f6c06d13a66170930d082a8cbf
{
    public static $files = array (
        '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/..' . '/ralouphie/getallheaders/src/getallheaders.php',
        'a4a119a56e50fbb293281d9a48007e0e' => __DIR__ . '/..' . '/symfony/polyfill-php80/bootstrap.php',
        '09fc349b549513bf7f4291502426f919' => __DIR__ . '/..' . '/embed/embed/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Php80\\' => 23,
            'Slim\\Psr7\\' => 10,
        ),
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
        'F' => 
        array (
            'Fig\\Http\\Message\\' => 17,
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
        'Symfony\\Polyfill\\Php80\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php80',
        ),
        'Slim\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/slim/psr7/src',
        ),
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
        'Fig\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/fig/http-message-util/src',
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
        'Attribute' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Attribute.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'PhpToken' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/PhpToken.php',
        'Stringable' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Stringable.php',
        'UnhandledMatchError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/UnhandledMatchError.php',
        'ValueError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/ValueError.php',
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
