<script>
import { isUrl, matchProvider } from '../helpers/validators.js'

export default {
    extends: 'k-url-input',
    props: {
        provider: String,
    },
    methods: {
        onInput(value) {
            if(!this.isValidUrl(value)) {
                this.media = {}
                this.emitInput(value)
                return false;
            }

            this.$emit('startLoading')
            this.$api
                .get('kirby-embed/get-data', { url: value })
                .then(response => {
                    if(response['status'] == 'success' && response['data']) {
                        this.media = response['data']
                    }
                    else {
                        this.media = {}
                    }

                    this.emitInput(value)
                })
                .catch(error => {
                    this.media = {}
                    this.emitInput(value)
                })
        },
        emitInput(value) {
            this.$emit("input", { input: value, media: this.media });
            this.$emit("setMedia", this.media)
            this.$forceUpdate()
        },
        isValidUrl(value) {
            if(!isUrl(value)) return false
            if(this.provider && !matchProvider(value, this.provider)) return false
            return true
        }
    },
};
</script>
