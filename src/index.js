import embedField from './components/embedField.vue'
import embedInput from './components/embedInput.vue'

panel.plugin('sylvainjule/embed', {
    fields: {
        embed: embedField,
    },
    components: {
        'k-embed-input': embedInput,
    }
});
