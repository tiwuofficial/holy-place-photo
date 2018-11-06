<template>
    <transition name="modal">
        <section class="modal" v-if="isShow">
            <a href="javascript:void(0);" class="modal__overlay" @click="close"></a>
            <div class="modal__contents">
                <slot name="contents"></slot>
            </div>
        </section>
    </transition>
</template>

<script>
  export default {
    props: ['is-show'],
    methods: {
      close() {
        this.$emit('close');
      }
    }
  }
</script>

<style scoped>
    .modal {
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        position: fixed;
        display: block;
        z-index: 120;
    }

    .modal.is-hidden {
        display: none;
    }

    .modal-enter-active, .modal-leave-active {
        transition: all 0.5s ease;
    }

    .modal-enter, .modal-leave-to {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
        opacity: 0;
    }

    .modal__overlay {
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: block;
        position: fixed;
        background: #000;
        opacity: 0.6;
        z-index: 130;
    }

    .modal__contents {
        top: 50%;
        left: 50%;
        max-height: 80%;
        width: 70%;
        padding: 20px;
        text-align: center;
        display: block;
        position: fixed;
        z-index: 140;
        transform: translate(-50%, -50%);
        -webkit-transform: translate(-50%, -50%);
        background-color: #fff;
        border-radius: 3px;
        overflow-y: scroll;
    }
</style>