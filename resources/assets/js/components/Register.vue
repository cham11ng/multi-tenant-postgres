<template>
    <form class="form-horizontal" role="form" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
        <div class="form-group">
            <label for="name" class="col-md-4 control-label">Tenant Name</label>

            <div class="col-md-6">
                <input id="name" type="text" v-model="form.name" @keyup="setDomain" class="form-control" name="name" autofocus>

                <span class="help-block" v-if="form.errors.has('name')">
                    <strong class="text-danger">{{ form.errors.get('name') }}</strong>
                </span>
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

            <div class="col-md-6">
                <input id="email" type="email" v-model="form.email" class="form-control" name="email">

                <span class="help-block" v-if="form.errors.has('email')">
                    <strong class="text-danger">{{ form.errors.get('email') }}</strong>
                </span>
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="col-md-4 control-label">Password</label>

            <div class="col-md-6">
                <input id="password" type="password" v-model="form.password" class="form-control" name="password">

                <span class="help-block" v-if="form.errors.has('password')">
                    <strong class="text-danger">{{ form.errors.get('password') }}</strong>
                </span>
            </div>
        </div>

        <div class="form-group">
            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" v-model="form.password_confirmation" class="form-control" name="password_confirmation">
            </div>
        </div>

        <hr>

        <div class="form-group">
            <div class="col-md-offset-2 col-md-8 text-center">
                <div class="input-group input-group-lg">
                    <input id="domain" type="text" v-model="form.domain" class="form-control text-right" name="domain" autofocus>
                    <span class="input-group-addon">{{ url }}</span>
                </div>

                <span class="help-block" v-if="form.errors.has('domain')">
                    <strong class="text-danger">{{ form.errors.get('domain') }}</strong>
                </span>
            </div>
        </div>

        <hr>

        <div class="form-group">
            <div class="col-md-8 col-md-offset-2 text-center">
                <button type="submit" :disabled="form.errors.any()" class="btn btn-primary btn-lg">Register</button>
                <a href="/sign-in" class="btn btn-default btn-lg">Sign In</a>
            </div>
        </div>

        <div class="alert alert-success" v-if="message">{{ message }}</div>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                form: new Form({
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    domain: ''
                }),
                message: '',
                url: '.multi-tenant.dev'
            }
        },

        methods: {
            convert(string) {
                return string.replace(/[^a-zA-Z0-9]+/g, "-").toLowerCase();
            },

            setDomain() {
                this.form.domain = this.convert(this.form.name);
            },

            onSubmit() {
                const vm = this;

                this.form.post('/register')
                    .then(function (response) {
                        vm.message = response.status;
                        setTimeout(function () {
                            window.location.replace(response.url);
                        }, 2000);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
    }


    $(function () {
        $("#domain").keypress(function (event) {
            let ew = event.which;
            return (48 <= ew && ew <= 57) || (97 <= ew && ew <= 122) || (ew === 45);
        });
    });
</script>

<style>
    .alert {
        position: fixed;
        z-index: 500;
        bottom: 0;
        right: 0;
        margin: 20px;
    }
</style>
