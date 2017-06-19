new Vue({
    el: '#app',
    data: {
        title: '',
        domain: ''
    },

    methods: {
        clean(string) {
            return string.replace(/[^a-zA-Z0-9]+/g, "-").toLowerCase();
        },

        setDomain() {
            this.domain = this.clean(this.title);
        },

        checkCharacter() {
            this.domain = this.clean(this.domain);
        },
    },
});