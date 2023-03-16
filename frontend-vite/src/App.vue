<script setup>
  import {HeaderPart,NavBar,CartSideBar,MobileMenu,LoginModal,NewsLetter,FooterPart} from "@/components/index";
</script>
<template>
  <div>
    <div class="backdrop"></div>
    <a class="backtop fas fa-arrow-up" href="#"></a>

    <!--header part start-->
    <HeaderPart/>
    <!--header part end-->
    <!--navbar part start-->
    <NavBar/>
    <!--navbar part end-->
    <!--cart sidebar part start-->
    <CartSideBar/>
    <!--cart sidebar part end-->
    <!--cart mobile menu part start-->
    <MobileMenu/>
    <!--cart mobile menu part end-->
    <!--cart login modal part start-->
    <LoginModal/>
    <!--cart login modal part end-->





<!--   content change part start -->
    <router-view></router-view>
<!--   content change end -->


    <!--cart news letter part start-->
    <NewsLetter/>
    <!--cart news letter part end-->

    <!--cart footer part start-->
    <FooterPart/>
    <!--cart footer part end-->


  </div>
</template>