<template>
    <div class="container">
        <div class="columns is-multiline">
            <div class="card column is-half is-offset-one-quarter">
                <header class="card-header">
                    <h1 class="card-header-title">
                        Create new species
                    </h1>
                </header>
                <div class="card-content">
                    <form class="vue-form" @submit.prevent="submit">
                        <div class="field">
                            <label class="label" for="name">Name</label>
                            <div class="control">
                                <input type="text" class="input" name="name" id="name" required="" v-model="form.name">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label" for="description">Description</label>
                            <div class="control">
                                <textarea class="textarea" name="description" id="description" required="" v-model="form.description"></textarea>
                            </div>
                        </div>
                        <div>
                            <input type="submit" class="button is-primary" value="Create">
                        </div>
                    </form>
                    <div class="query-message-container">
                        <query-messages ref="msg"></query-messages>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    let form = new Form({
        'name': '',
        'description': '',
    });

    export default {

        components: {
            'query-messages': QueryMessage
        },

        data: function () {
            return {
                form: form
            };
        },

        methods: {
            // submit form handler
            submit() {
                this.form.post('/species').then((response) => {
                    this.$refs.msg.showSuccessMessage('Species successfully created.', 5000);
                    this.form.name = ''
                    this.form.description = '';
                }).catch(error => {
                    console.log(error),
                    this.$refs.msg.showErrorMessage('Species already exists.', 5000);
                });
            }
        }
    }
</script>
