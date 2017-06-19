<template>
    <form class="form-horizontal" role="form" method="POST">
        <div class="form-group">
            <label for="name" class="col-md-4 control-label">Tenant Name</label>

            <div class="col-md-6">
                <input id="name" type="text" v-model="title" @keyup="setDomain" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                <span class="help-block">
                    <strong></strong>
                </span>
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                <span class="help-block">
                    <strong></strong>
                </span>
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="col-md-4 control-label">Password</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" required>

                <span class="help-block">
                    <strong></strong>
                </span>
            </div>
        </div>

        <div class="form-group">
            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-offset-2 col-md-8 text-center">
                <span class="control-label">
                    <strong style="line-height: 40px;">Domain name can only have letters, numbers, and dashes.</strong>
                </span>
                <div class="input-group input-group-lg">
                    <input id="domain" type="text" v-model="domain" class="form-control text-right" name="domain" value="{{ old('domain') }}" autofocus>
                    <span class="input-group-addon">.{{ config('app.url') }}</span>
                </div>

                <span class="help-block">
                    <strong></strong>
                </span>
            </div>
        </div>

        <hr>

        <div class="form-group">
            <div class="col-md-8 col-md-offset-2 text-center">
                <button type="submit" class="btn btn-primary btn-lg">Register</button>
                <a href="/sign-in" class="btn btn-default btn-lg">Sign In</a>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                form: new Form({
                    title: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    domain: ''
                })
            }
        },

        methods: {
            onSubmit() {

            }
        },


        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
