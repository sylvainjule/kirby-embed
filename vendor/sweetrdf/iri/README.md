# IRI (Fork)

> [!NOTE]
> **This is a fork of the
> [Original IRI](https://github.com/lanthaler/IRI)** class
> written by [Markus Lanthaler](https://github.com/lanthaler).
> I maintain it in my spare time to keep it alive and usable on the latest PHP versions.
> Code is more or less maintained but not developed any further.
> If you wanna participate, feel free to open a pull request!

This is a simple PHP class to ease IRI handling.
Currently it just supports parsing of IRIs and relative IRI resolution.

With more than **800 tests**, this class is extensively tested.

## Installation

The easiest way to use IRI is to integrate it as a dependency in your project's [composer.json](http://getcomposer.org/doc/00-intro.md) file:

```json
{
    "require": {
        "sweetrdf/iri": "^1"
    }
}
```

or run:

> composer install sweetrdf/iri

Of course you can also just download an [archive](https://github.com/lanthaler/IRI/downloads) from Github.

### Compatible with original ml/iri

This library is intented to be a drop-in replacement for the original `ml/iri` library.
However, the `IRI` class was adapted to be more type safe:
- Added `declare(strict_types=1);` to the file
- Added explicit type information to each class property
- Added explicit return value types to each class method

:exclamation: `IRI` does not throw an `InvalidArgumentException` anymore if an invalid value was given in the constructor!
In this case PHP itself will complain.

## Credits

Most test cases come either directly from the [URI specification](http://tools.ietf.org/html/rfc3986),
from [Graham Klyne's](http://www.ninebynine.org/Software/HaskellUtils/Network/URITestDescriptions.html),
or [Tim Berners-Lee's](http://dig.csail.mit.edu/2005/ajar/ajaw/test/uri-test-doc.html) test suite.
