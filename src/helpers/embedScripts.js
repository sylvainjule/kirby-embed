// Instagram and Twitter embeds must be initialized after their blockquote
// has been inserted into the DOM. Scripts included in a Vue v-html string
// are inert, so we load each provider SDK ourselves (once per Panel visit).
const scripts = new Map()

const providers = {
    instagram: {
        src: 'https://www.instagram.com/embed.js',
        ready: () => typeof window.instgrm?.Embeds?.process === 'function',
        process: () => window.instgrm.Embeds.process(),
    },
    twitter: {
        src: 'https://platform.twitter.com/widgets.js',
        ready: () => typeof window.twttr?.widgets?.load === 'function',
        process: () => window.twttr.widgets.load(),
    },
}

export async function processEmbed(provider) {
    const config = providers[provider]
    if (!config) return false

    if (!config.ready()) {
        let loading = scripts.get(provider)

        if (!loading) {
            loading = new Promise((resolve, reject) => {
                const script = document.createElement('script')
                script.src = config.src
                script.async = true
                script.onload = resolve
                script.onerror = reject
                document.body.appendChild(script)
            }).finally(() => scripts.delete(provider))

            scripts.set(provider, loading)
        }

        try {
            await loading
        } catch {
            // Blockers/CSP/offline: keep the existing fallback HTML in place.
            return false
        }
    }

    if (config.ready()) {
        try {
            config.process()
            return true
        } catch {
            // Third-party SDK errors must not break the Kirby Panel.
            return false
        }
    }

    return false
}
