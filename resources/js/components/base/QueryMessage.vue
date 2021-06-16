<template>
    <transition name="slide-fade">
        <article class="message"
                v-bind:class="{'is-success': success, 'is-danger': fail}"
                v-if="show()">
            <div class="message-body">
                {{message}}
            </div>
        </article>
    </transition>
</template>

<script>
    export default {
        name: "QueryMessage",

        data: function() {
            return {
                fail: false,
                success: false,
                message: ''
            }
        },

        methods: {
            show() {
                return (this.success || this.fail);
            },
            showSuccessMessage(message, autoHideDelay) {
                this.fail = false;
                this.success = true;
                this.message = message;

                if (autoHideDelay) {
                    this.resetMessage(autoHideDelay);
                }
            },
            showErrorMessage(message, autoHideDelay) {
                this.fail = true;
                this.success = false;
                this.message = message;

                if (autoHideDelay) {
                    this.resetMessage(autoHideDelay);
                }
            },
            resetMessage(delay) {
                setTimeout(function() {
                    this.fail = false;
                    this.success = false;
                    this.message = '';
                }.bind(this), delay);
            }
        }
    }
</script>
