# Kirby Embed

Embed field for Kirby 3. Display embeds from various media sites (Youtube, Vimeo, Souncloud, Instagram, etc.) by only providing the url to the medium.
Built on top of [oscarotero/Embed](https://github.com/oscarotero/Embed).

![embed-screenshot](https://user-images.githubusercontent.com/14079751/64260995-163b3380-cf2c-11e9-85dc-77f0b8a79a1f.jpg)

## Overview

> This plugin is completely free and published under the MIT license. However, if you are using it in a commercial project and want to help me keep up with maintenance, please consider [making a donation of your choice](https://www.paypal.me/sylvainjule) or purchasing your license(s) through [my affiliate link](https://a.paddle.com/v2/click/1129/36369?link=1170).

- [1. Installation](#1-installation)
- [2. Blueprint usage](#2-blueprint-usage)
- [3. Options](#3-options)
- [4. Front-end usage](#4-front-end-usage)
- [5. License](#5-license)
- [6. Credits](#6-credits)

## 1. Installation

Download and copy this repository to ```/site/plugins/kirby-embed```

Alternatively, you can install it with composer: ```composer require sylvainjule/kirby-embed```

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

The field also has all the `url` field's options, except those which wouldn't make much sense for such a plugin (`default` for example), won't fetch anything in the backstage.

<br/>

## 3. Options

```php
// site/config/config.php
return array(
    'sylvainjule.embed.min_image_width'  => 60, // Minimal image width used to choose the main image
    'sylvainjule.embed.min_image_height' => 60, // Minimal image height used to choose the main image
);
```

<br/>

## 4. Front-end usage

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

$info->images();        // List of all images found in the page
$info->image();         // The image choosen as main image
$info->imageWidth();    // The width of the main image
$info->imageHeight();   // The height of the main image

$info->code();          // The code to embed the image, video, etc
$info->width();         // The width of the embed code
$info->height();        // The height of the embed code
$info->aspectRatio();   // The aspect ratio (width / height)

$info->authorName();    // The resource author
$info->authorUrl();     // The author url

$info->providerName();  // The provider name of the page (Youtube, Twitter, Instagram, etc)
$info->providerUrl();   // The provider url
$info->providerIcons(); // All provider icons found in the page
$info->providerIcon();  // The icon choosen as main icon

$info->publishedDate(); // The published date of the resource
$info->license();       // The license url of the resource
$info->linkedData();    // The linked-data info (http://json-ld.org/)
$info->feeds();         // The RSS/Atom feeds
```

<br/>

## 5. License

MIT

<br/>

## 6. Credits

Built on top of [oscarotero/Embed](https://github.com/oscarotero/Embed).

With the help of [@tristantbg](https://github.com/tristantbg). 👨‍💻

Kirby 2 field by [@distantnative](https://github.com/distantnative/embed), from which I've copy-pasted some bits of this readme. 👀
