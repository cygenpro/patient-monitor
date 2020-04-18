<template>
    <span class="cart-sum"
          data-products-sum="<span id=" title="Код PHP: <?= $cart_sum ?>;"><?= $cart_sum ?><span class="bxhtmled-surrogate-inner"><span class="bxhtmled-right-side-item-icon"></span><span class="bxhtmled-comp-lable" unselectable="on" spellcheck="false">Код PHP</span></span></span>"
    &gt;
    <?= $cart_sum_formated ?> ₽

</template>

<script>
    export default {
        name: "DoctorList"
    }
</script>

<style scoped>

</style>
