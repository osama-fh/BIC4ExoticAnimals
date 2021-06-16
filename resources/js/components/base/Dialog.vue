<template>
  <div v-if="show()" class="modal is-active">
    <div class="modal-background"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p v-if="success" class="modal-card-title">
            Success
        </p>
        <p v-if="fail" class="modal-card-title">
            Error    
        </p>
        <p v-if="!fail && !success" class="modal-card-title">
            Information
        </p>
        <button @click="close()" class="delete" aria-label="close"></button>
      </header>
      <section class="modal-card-body">
        {{ message }}
      </section>
      <footer class="modal-card-foot">
        <button v-if="okonly" class="button" @click="emitOk()">Ok</button>
        <button v-if="yesno" class="button is-primary" @click="emitYes()">Yes</button>
        <button v-if="yesno" class="button" @click="emitNo()">No</button>
      </footer>
    </div>
  </div>
</template>

<script>
export default {

  data: function () {
    return {
      fail: false,
      success: false,
      message: "",
      yesno: false,
      okonly: false
    };
  },

  methods: {
    show() {
      return this.message.length > 0;
    },
    emitOk() {
        this.$emit('onOk');
    },
    emitYes() {
        this.$emit('onYes');
    },
    emitNo() {
        this.$emit('onNo');
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
    showYesNo(message) {
        this.okonly = false;
        this.yesno = true;
        this.fail = false;
        this.success = false;
        this.message = message;
    },
    close() {
        this.fail = false;
        this.success = false;
        this.message = "";
    },
    resetMessage(delay) {
      setTimeout(
        function () {
          close();
        }.bind(this),
        delay
      );
    },
  },
};
</script>
