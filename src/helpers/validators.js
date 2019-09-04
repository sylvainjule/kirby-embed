export function isUrl(value) {
    const pattern = /^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:/?#[\]@!\$&'\(\)\*\+,;=.]+$/g
    const regex = new RegExp(pattern)
    return !value || value.match(regex)
}

export function matchProvider(value, provider) {
    const patterns = {
        'youtube': /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/,
        'vimeo': /vimeo\.com\/([0-9]+)/,
        'flickr': /^.*(flickr\.com)\/(.*)/,
        'soundcloud': /^.*(soundcloud\.com|snd\.sc)\/(.*)/,
        'twitter': /^.*(twitter\.com)\/(.*)/,
        'instagram': /^.*(instagram\.com)\/(.*)/
    };

    const patternKeys = Object.keys(patterns)
    if (patternKeys.indexOf(provider) == -1) return false

    return value.match(patterns[provider])
}
