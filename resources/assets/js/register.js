new Vue({
    el: '#app',
    data: {
        title: '',
    },

    computed: {
        setDomain() {
            return this.title.replace(/([a-z])([A-Z])/g, "$1-$2")
                .replace(/\s+/g, '-')
                .toLowerCase();
        }
    }
});