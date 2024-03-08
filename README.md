# Kirby Embed

Embed field for Kirby 3 and 4. Display embeds from various media sites (Youtube, Vimeo, Souncloud, Instagram, etc.) by only providing the url to the medium.
Built on top of [oscarotero/Embed](https://github.com/oscarotero/Embed).

![embed-screenshot](https://user-images.githubusercontent.com/14079751/64260995-163b3380-cf2c-11e9-85dc-77f0b8a79a1f.jpg)

## Overview

> This plugin is completely free and published under the MIT license. However, if you are using it in a commercial project and want to help me keep up with maintenance, please consider [making a donation of your choice](https://www.paypal.me/sylvainjl) or purchasing your license(s) through [my affiliate link](https://a.paddle.com/v2/click/1129/36369?link=1170).

- [1. Installation](#1-installation)
- [2. Blueprint usage](#2-blueprint-usage)
- [3. Front-end usage](#3-front-end-usage)
- [4. License](#4-license)
- [5. Credits](#5-credits)

## 1. Installation

> Kirby 3: up to 1.1.0
> Kirby 4: 1.1.1+

Download and copy this repository to ```/site/plugins/embed```

Alternatively, you can install it with composer: ```composer require sylvainjule/embed```

<br/>

## 2. Blueprint usage

The plugin provides a `embed` field that you can include in any blueprint:

```yaml
fields:
  embed:
    label: Embed
    type: embed
```

You have access to all providers supported by [oscarotero/Embed](https://github.com/oscarotero/Embed). Please note that I won't include any provider unsupported by this library.

You can optionally limit the allowed provider to one within this list : `youtube`, `vimeo`, `flickr`, `instagram`, `twitter`, `soundcloud`. If any other link is pasted, the field won't request the embed.

```yaml
embed:
  type: embed
  provider: youtube
```

If you are using this field in a structure field, it comes with a built-in preview. You can optionally set `icons: true` (default is `false`) to display some providers logos in this preview.

```yaml
embed:
  type: embed
  icons: true
```

![embed-icons](https://github.com/sylvainjule/kirby-embed/assets/14079751/ea26df07-005b-4f70-816d-f0e068da4ba4)

The field also has all the `url` field's options, except those which wouldn't make much sense for such a plugin (`default` for example), won't fetch anything in the backstage.

<br/>

## 3. Front-end usage

The plugin provides a `->toEmbed()` method, which is useful to get all the stored data of the embed (its html code, and a few other informations detailed below).

It also allows you to make sure your embed is successfully synced before trying to access the data:

```php
if($embed = $page->myfield()->toEmbed()) {
    echo $embed->code()
}
```

Once you have access to the structured embed, here are the options you will have access to as if they were fields (this comes handy because depending on the provider, some informations might be empty. You can therefore check them with the usual Kirby field methods, like  `$embed->license()->isEmpty()`).

```php
$embed->title();        // The page title
$embed->description();  // The page description
$embed->url();          // The canonical url
$embed->type();         // The page type (link, video, image, rich)
$embed->tags();         // The page keywords (tags)

$embed->image();         // The main image found in the page

$embed->code();          // The code to embed the image, video, etc
$embed->width();         // The width of the embed code
$embed->height();        // The height of the embed code
$embed->aspectRatio();   // The aspect ratio (width / height)

$embed->authorName();    // The resource author
$embed->authorUrl();     // The author url

$embed->providerName();  // The provider name of the page (Youtube, Twitter, Instagram, etc)
$embed->providerUrl();   // The provider url
$embed->providerIcon();  // The main icon found in the page

$embed->publishedDate(); // The published date of the resource
$embed->license();       // The license url of the resource
$embed->feeds();         // The RSS/Atom feeds
```

A global site method is available to request embed data  `$site->getEmbedData($url)`).

```php
$url = 'https://www.youtube.com/watch?v=XXX';
$site->getEmbedData($url);
```

<br/>

## 4. License

MIT

<br/>

## 5. Credits

Built on top of [oscarotero/Embed](https://github.com/oscarotero/Embed).

With the help of [@tristantbg](https://github.com/tristantbg). 👨‍💻

Kirby 2 field by [@distantnative](https://github.com/distantnative/embed), from which I've copy-pasted some bits of this readme. 👀
