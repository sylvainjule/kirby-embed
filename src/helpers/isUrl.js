export function isUrl(value) {
    const pattern = /^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:/?#[\]@!\$&'\(\)\*\+,;=.]+$/g
    const regex = new RegExp(pattern)
    return !value || value.match(regex)
}
