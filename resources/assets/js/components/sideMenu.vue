<template>
    <transition name="sideMenu">
        <section class="sideMenu" v-if="isShow">
            <a href="javascript:void(0);" class="sideMenu__overlay" @click="close"></a>
            <div class="sideMenu__contents">
                <slot name="contents"></slot>
            </div>
        </section>
    </transition>
</template>

<script>
  export default {
    props: ['is-show'],
    methods: {
      close(){
        this.$emit('close');
      }
    }
  }
</script>

<style>
    .sideMenu {
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        position: absolute;
        display: block;
        z-index: 120;
    }

    .sideMenu.is-hidden {
        display: none;
    }

    .sideMenu-enter-active, .sideMenu-leave-active {
        transition: all 0.5s ease;
    }

    .sideMenu-enter, .sideMenu-leave-to {
        opacity: 0;
    }

    .sideMenu__overlay {
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

    .sideMenu__contents {
        top: 0;
        right: 0;
        height: 100%;
        text-align: center;
        display: block;
        position: fixed;
        z-index: 140;
        background-color: #fff;
        overflow-y: scroll;
    }

</style>