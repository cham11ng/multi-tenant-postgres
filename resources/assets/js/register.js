new Vue({
    el: '#app',
    data: {
        title: '',
        domain: '',
        status: false
    },

    methods: {
        convert(string) {
            return string.replace(/[^a-zA-Z0-9]+/g, "-").toLowerCase();
        },

        setDomain() {
            this.domain = this.convert(this.title);
        },
    },
});

$(function () {
    $("#domain").keypress(function (event) {
        let ew = event.which;
        return (48 <= ew && ew <= 57) || (97 <= ew && ew <= 122) || (ew === 45);
    });
});