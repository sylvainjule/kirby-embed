import oembedField from './components/oembedField.vue'
import oembedInput from './components/oembedInput.vue'

panel.plugin('sylvainjule/oembed', {
    fields: {
        oembed: oembedField,
    },
    components: {
        'k-oembed-input': oembedInput,
    }
});
