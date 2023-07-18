<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Demo\DemoController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;

// Route::get('/', function () {
//     return view('frontend.index');
// });
Route::get('/', [IndexController::class, 'Index']);



Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';


//ADmin Dashboard
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('update.password');
});


Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->middleware(RedirectIfAuthenticated::class);






//Middleware start on admin
Route::middleware(['auth', 'role:admin'])->group(function () {


    // Brand All Route 
    Route::controller(BrandController::class)->group(function () {
        Route::get('/all/brand', 'AllBrand')->name('all.brand');
        Route::get('/add/brand', 'AddBrand')->name('add.brand');
        Route::post('/store/brand', 'StoreBrand')->name('store.brand');
        Route::get('/edit/brand/{id}', 'EditBrand')->name('edit.brand');
        Route::post('/update/brand', 'UpdateBrand')->name('update.brand');
        Route::get('/delete/brand/{id}', 'DeleteBrand')->name('delete.brand');
    });

    //Category All route
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/all/category', 'AllCategory')->name('all.category');
        Route::get('/add/category', 'AddCategory')->name('add.category');
        Route::post('/store/category', 'StoreCategory')->name('store.category');
        Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
        Route::post('/update/category', 'UpdateCategory')->name('update.category');
        Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
    });
    //subcategory route
    Route::controller(SubCategoryController::class)->group(function () {
        Route::get('/all/subcategory', 'AllSubCategory')->name('all.subcategory');
        Route::get('/add/subcategory', 'AddSubCategory')->name('add.subcategory');
        Route::post('/store/subcategory', 'StoreSubCategory')->name('store.subcategory');
        Route::get('/edit/subcategory/{id}', 'EditSubCategory')->name('edit.subcategory');
        Route::post('/update/subcategory', 'UpdateSubCategory')->name('update.subcategory');
        Route::get('/delete/subcategory/{id}', 'DeleteSubCategory')->name('delete.subcategory');

        Route::get('/subcategory/ajax/{category_id}', 'GetSubCategory');
    });

    //product all route
    Route::controller(ProductController::class)->group(function () {
        Route::get('/all/product', 'AllProduct')->name('all.product');
        Route::get('/add/product', 'AddProduct')->name('add.product');
        Route::post('/store/product', 'StoreProduct')->name('store.product');
        Route::get('/edit/product/{id}', 'EditProduct')->name('edit.product');
        Route::post('/update/product', 'UpdateProduct')->name('update.product');
        Route::post('/update/product/thambnail', 'UpdateProductThambnail')->name('update.product.thambnail');
        Route::post('/update/product/multiimage', 'UpdateProductMultiimage')->name('update.product.multiimage');
        Route::get('/product/multiimg/delete/{id}', 'MulitImageDelelte')->name('product.multiimg.delete');

        Route::get('/product/inactive/{id}', 'ProductInactive')->name('product.inactive');
        Route::get('/product/active/{id}', 'ProductActive')->name('product.active');
        Route::get('/delete/product/{id}', 'ProductDelete')->name('delete.product');

        // For Product Stock
        Route::get('/product/stock', 'ProductStock')->name('product.stock');
    });
    //Slider All Route
    Route::controller(SliderController::class)->group(function () {
        Route::get('/all/slider', 'AllSlider')->name('all.slider');
        Route::get('/add/slider', 'AddSlider')->name('add.slider');
        Route::post('/store/slider', 'StoreSlider')->name('store.slider');
        Route::get('/edit/slider/{id}', 'EditSlider')->name('edit.slider');
        Route::post('/update/slider', 'UpdateSlider')->name('update.slider');
        Route::get('/delete/slider/{id}', 'DeleteSlider')->name('delete.slider');
    });

    //banner All Route
    Route::controller(BannerController::class)->group(function () {
        Route::get('/all/banner', 'AllBanner')->name('all.banner');
        Route::get('/add/banner', 'AddBanner')->name('add.banner');
        Route::post('/store/banner', 'StoreBanner')->name('store.banner');
        Route::get('/edit/banner/{id}', 'EditBanner')->name('edit.banner');
        Route::post('/update/banner', 'UpdateBanner')->name('update.banner');
        Route::get('/delete/banner/{id}', 'DeleteBanner')->name('delete.banner');
    });

    //Coupon all route
    Route::controller(CouponController::class)->group(function () {
        Route::get('/all/coupon', 'AllCoupon')->name('all.coupon');
        Route::get('/add/coupon', 'AddCoupon')->name('add.coupon');
        Route::post('/store/coupon', 'StoreCoupon')->name('store.coupon');
        Route::get('/edit/coupon/{id}', 'EditCoupon')->name('edit.coupon');
        Route::post('/update/coupon', 'UpdateCoupon')->name('update.coupon');
        Route::get('/delete/coupon/{id}', 'DeleteCoupon')->name('delete.coupon');
    });
});

//Frontend Product Detail routes
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);
Route::get('/product/category/{id}/{slug}', [IndexController::class, 'CatWiseProduct']);
Route::get('/product/subcategory/{id}/{slug}', [IndexController::class, 'SubCatWiseProduct']);


//Product View Modal Ajax
Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);

//Add to cart from Data
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);

// Get Data from mini Cart
Route::get('/product/mini/cart', [CartController::class, 'AddMiniCart']);

// Remove Data from mini cart
Route::get('/minicart/product/remove/{rowId}', [CartController::class, 'RemoveMiniCart']);

/// Add to cart store data For Product Details Page 
Route::post('/dcart/data/store/{id}', [CartController::class, 'AddToCartDetails']);

/// Add to Wishlist 
Route::post('/add-to-wishlist/{product_id}', [WishlistController::class, 'AddToWishList']);










// Cart All Route 
Route::controller(CartController::class)->group(function () {
    Route::get('/mycart', 'MyCart')->name('mycart');
    Route::get('/get-cart-product', 'GetCartProduct');
    Route::get('/cart-remove/{rowId}', 'CartRemove');
    Route::get('/cart-decrement/{rowId}', 'CartDecrement');
    Route::get('/cart-increment/{rowId}', 'CartIncrement');
});


/// User All Route
Route::middleware(['auth', 'role:user'])->group(function () {

    // Wishlist All Route 
    Route::controller(WishlistController::class)->group(function () {
        Route::get('/wishlist', 'AllWishlist')->name('wishlist');
        Route::get('/get-wishlist-product', 'GetWishlistProduct');
        Route::get('/wishlist-remove/{id}', 'WishlistRemove');
    });


    // // Compare All Route 
    // Route::controller(CompareController::class)->group(function () {
    //     Route::get('/compare', 'AllCompare')->name('compare');
    //     Route::get('/get-compare-product', 'GetCompareProduct');
    //     Route::get('/compare-remove/{id}', 'CompareRemove');
    // });



    // // Checkout All Route 
    // Route::controller(CheckoutController::class)->group(function () {
    //     Route::get('/district-get/ajax/{division_id}', 'DistrictGetAjax');
    //     Route::get('/state-get/ajax/{district_id}', 'StateGetAjax');

    //     Route::post('/checkout/store', 'CheckoutStore')->name('checkout.store');
    // });


    // // Stripe All Route 
    // Route::controller(StripeController::class)->group(function () {
    //     Route::post('/stripe/order', 'StripeOrder')->name('stripe.order');
    //     Route::post('/cash/order', 'CashOrder')->name('cash.order');
    // });


    // // User Dashboard All Route 
    // Route::controller(AllUserController::class)->group(function () {
    //     Route::get('/user/account/page', 'UserAccount')->name('user.account.page');
    //     Route::get('/user/change/password', 'UserChangePassword')->name('user.change.password');

    //     Route::get('/user/order/page', 'UserOrderPage')->name('user.order.page');

    //     Route::get('/user/order_details/{order_id}', 'UserOrderDetails');
    //     Route::get('/user/invoice_download/{order_id}', 'UserOrderInvoice');

    //     Route::post('/return/order/{order_id}', 'ReturnOrder')->name('return.order');

    //     Route::get('/return/order/page', 'ReturnOrderPage')->name('return.order.page');

    //     // Order Tracking 
    //     Route::get('/user/track/order', 'UserTrackOrder')->name('user.track.order');
    //     Route::post('/order/tracking', 'OrderTracking')->name('order.tracking');
    // });
}); 
// end group User middleware