<script>
import { isUrl } from '../helpers/isUrl.js'

export default {
    extends: 'k-url-input',
    methods: {
        onInput(value) {
            if(!isUrl(value)) {
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
    },
};
</script>
