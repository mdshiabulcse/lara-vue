import { createRouter, createWebHistory } from 'vue-router';
import {Checkout, Index, ShopPage, SingleProduct} from "@/views/pages/index.js";
import {UserLogin, UserRegister} from "@/views/auth/index.js";
import {MyOrders, MyProfile, MyWishlist} from "@/views/user/index.js";
import {SellerApply, SellerList, SellerStore} from "@/views/pages/seller/index.js";

const routes = [
    { path: '/', name:'index', component: Index ,meta:{title:'Home'}},
    { path: '/auth/login', name:'user.login', component: UserLogin ,meta:{title:'User Login'}},
    { path: '/auth/register', name:'user.register',component: UserRegister ,meta:{title:'User Register'}},
    { path: '/shop', name:'shop.page',component: ShopPage ,meta:{title:'Shop List'}},

    { path: '/user-profile', name:'user.profile',component: MyProfile ,meta:{title:'User Profile'}},
    { path: '/user-orders', name:'user.orders',component: MyOrders ,meta:{title:'User Orders'}},
    { path: '/user-wishlist', name:'user.wishlist',component: MyWishlist ,meta:{title:'User Wishlist'}},

    { path: '/seller-list', name:'seller.list',component: SellerList ,meta:{title:'Seller List'}},
    { path: '/seller-store', name:'seller.store',component: SellerStore ,meta:{title:'Seller Store'}},
    { path: '/seller-apply', name:'seller.apply',component: SellerApply ,meta:{title:'Seller Apply'}},

    { path: '/product-details', name:'single.product',component: SingleProduct ,meta:{title:'Product Details'}},
    { path: '/checkout-page', name:'checkout.page',component: Checkout ,meta:{title:'Checkout Page'}},
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
})
const DEFAULT_TITLE =404;
router.beforeEach((to, from, next) => {
    document.title=to.meta.title || DEFAULT_TITLE;
    next();
})
export default router;