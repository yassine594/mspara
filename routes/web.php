<?php


use Illuminate\Support\Facades\Route;





/************************* fonction de modifier les produit qui on un discount expiree ( fil helpers mawjoudaa ) ***********************************/

function_update_discount();
function_update_discount_marque();

/************************************************************************************************************************/





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Middleware for minifing html */



//Route::middleware(['HtmlMinifier'])->group(static function () {

    /* Middleware for minifing html */



    /* Frontend section */

    Route::get('/', [App\Http\Controllers\Frontend\IndexController::class, 'home'])->name('home');
    Route::get('a-propos', [App\Http\Controllers\Frontend\IndexController::class, 'aboutUs'])->name('about.us');
    Route::get('products/', [App\Http\Controllers\Frontend\IndexController::class, 'tousproducts'])->name('products');
    Route::get('grand-categorie/{slug}/', [App\Http\Controllers\Frontend\IndexController::class, 'grandcategoryDetail'])->name('grandcategorie.detail');
    Route::get('categorie/{slug}/', [App\Http\Controllers\Frontend\IndexController::class, 'categoryDetail'])->name('categorie.detail');
    Route::get('sous-categorie/{slug}/', [App\Http\Controllers\Frontend\IndexController::class, 'souscategoryDetail'])->name('souscategorie.detail');
    Route::get('marque/{slug}/', [App\Http\Controllers\Frontend\IndexController::class, 'marqueDetail'])->name('marque.detail');
    Route::get('product-detail/{slug}/', [App\Http\Controllers\Frontend\IndexController::class, 'productDetail'])->name('product.detail');
    Route::get('articles/', [App\Http\Controllers\Frontend\IndexController::class, 'blogList'])->name('blog.list');
    Route::get('article-detail/{slug}/', [App\Http\Controllers\Frontend\IndexController::class, 'blogDetail'])->name('blog.detail');
    Route::get('contact', [App\Http\Controllers\Frontend\IndexController::class, 'contactUs'])->name('contact.us');
    Route::post('/contact-submit', fn() => event(new RegisterInterest))->middleware(['honey'])->name('contact.submit');
    Route::post('contact-submit', [App\Http\Controllers\Frontend\IndexController::class, 'contactSubmit'])->name('contact.submit');
    Route::post('add-to-news', [App\Http\Controllers\Frontend\NewsLetterController::class, 'addtonews'])->name('addtonews.status');

    Route::post('add-coupon', [App\Http\Controllers\Frontend\CouponController::class, 'addcoupon'])->name('addcoupon.status');

    Route::post('add-points', [App\Http\Controllers\Frontend\PointsController::class, 'addpoints'])->name('addpoints.status');

    Route::post('push-notification', [App\Http\Controllers\Frontend\IndexController::class, 'pushnotification'])->name('push.notification');


    Route::post('add-to-cart', [App\Http\Controllers\Frontend\CartController::class, 'addtocart'])->name('addtocart.status');
    Route::get('load-cart-data', [App\Http\Controllers\Frontend\CartController::class, 'cartloadbyajax'])->name('loadtocart.status');
    Route::get('panier', [App\Http\Controllers\Frontend\CartController::class, 'index'])->name('maselection.status');
    Route::get('delete-from-selection', [App\Http\Controllers\Frontend\CartController::class, 'deletefromselection'])->name('deleteselection.status');
    Route::get('update-to-cart',[App\Http\Controllers\Frontend\CartController::class, 'updatetocart'])->name('update.cart');


    Route::get('merci', [App\Http\Controllers\Frontend\CartController::class, 'merci'])->name('merci');



    Route::get('passer-commande', [App\Http\Controllers\Frontend\CartController::class, 'index_checkout'])->name('checkout.status');
    Route::post('/checkout', [App\Http\Controllers\Frontend\IndexController::class, 'checkout'])->name('checkout');

    Route::get('/user/login', [App\Http\Controllers\Frontend\IndexController::class, 'showLoginForm'])->name('seller.login.form');
    Route::get('/user/forget-password', [App\Http\Controllers\Frontend\IndexController::class, 'showPasswordForm'])->name('seller.password.forget');


    Route::post('/user/log', [App\Http\Controllers\Frontend\IndexController::class, 'login'])->name('seller.login');
    Route::post('/user/password', [App\Http\Controllers\Frontend\IndexController::class, 'password'])->name('seller.password');
    Route::post('/user/reg', [App\Http\Controllers\Frontend\IndexController::class, 'register'])->name('seller.register');
    Route::get('/user/compte', [App\Http\Controllers\Frontend\IndexController::class, 'compte'])->name('seller.compte');
    Route::post('/user/compte-update', [App\Http\Controllers\Frontend\IndexController::class, 'compteUpdate'])->name('seller.compte-update');

    Route::get('/user/commande-detail/{id}/', [App\Http\Controllers\Frontend\IndexController::class, 'commandeDetail'])->name('commande.detail');

    ///*************************** */







    // authentication

    Route::get('user/auth', [App\Http\Controllers\Frontend\IndexController::class, 'userAuth'])->name('user.auth');

    Route::post('user/login', [App\Http\Controllers\Frontend\IndexController::class, 'loginSubmit'])->name('login.submit');

    Route::post('user/register', [App\Http\Controllers\Frontend\IndexController::class, 'registerSubmit'])->name('register.submit');

    Route::get('user/logout', [App\Http\Controllers\Frontend\IndexController::class, 'userLogout'])->name('user.logout');



    /* End Frontend section */
//});


/**************************************************************************************************************/
Auth::routes(['register' => false]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




// Admin dashboard

Route::group(
    ['prefix' => 'admin', 'middleware' => ['auth', 'admin']],
    function () {







    // Banner section



    // ******************************** ////


    Route::get('/', [App\Http\Controllers\AdminController::class, 'admin'])->name('admin');

    Route::resource('user', App\Http\Controllers\UserController::class);
    Route::post('user_status', [\App\Http\Controllers\UserController::class, 'userStatus'])->name('user.status');

    Route::resource('banner', App\Http\Controllers\BannerController::class);
    Route::post('banner_status', [\App\Http\Controllers\BannerController::class, 'bannerStatus'])->name('banner.status');

    Route::resource('coupon', App\Http\Controllers\CouponController::class);
    Route::post('coupon_status', [\App\Http\Controllers\CouponController::class, 'couponStatus'])->name('coupon.status');

    Route::resource('product', App\Http\Controllers\ProductController::class);
    Route::post('product_status', [\App\Http\Controllers\ProductController::class, 'productStatus'])->name('product.status');
    Route::post('product_offre', [\App\Http\Controllers\ProductController::class, 'productOffre'])->name('product.offre');
    Route::get('product_in_stock', [\App\Http\Controllers\ProductController::class, 'index_in_stock'])->name('product.in.stock');
    Route::get('product_out_stock', [\App\Http\Controllers\ProductController::class, 'index_out_stock'])->name('product.out.stock');

    Route::resource('vente-flash', App\Http\Controllers\VenteflashController::class);
    Route::post('venteflash_status', [\App\Http\Controllers\VenteflashController::class, 'venteflashStatus'])->name('venteflash.status');

    Route::resource('grand-category', App\Http\Controllers\GrandcategoryController::class);
    Route::post('grandcategory_status', [\App\Http\Controllers\GrandcategoryController::class, 'grandcategoryStatus'])->name('grandcategory.status');
    Route::get('grandcategory_sous/{id}/', [App\Http\Controllers\GrandcategoryController::class, 'Souscategory'])->name('grandcategory.sous');

    Route::resource('category', App\Http\Controllers\CategoryContoller::class);
    Route::post('category_status', [\App\Http\Controllers\CategoryContoller::class, 'categoryStatus'])->name('category.status');
    Route::get('category_sous/{id}/', [App\Http\Controllers\CategoryContoller::class, 'Souscategory'])->name('category.sous');

    Route::resource('souscategory', App\Http\Controllers\SouscategoryController::class);
    Route::post('souscategory_status', [\App\Http\Controllers\SouscategoryController::class, 'souscategoryStatus'])->name('souscategory.status');

    Route::post('souscategory/{id}/child', [\App\Http\Controllers\SouscategoryController::class, 'getChildByParentID']);
    Route::post('soussouscategory/{id}/child', [\App\Http\Controllers\ProductController::class, 'getChildByParentID']);

    Route::resource('actualite', App\Http\Controllers\blogController::class);
    Route::post('actualite_status', [\App\Http\Controllers\blogController::class, 'actualiteStatus'])->name('actualite.status');

    Route::resource('partenaire', App\Http\Controllers\PartenaireController::class);
    Route::post('partenaire_status', [\App\Http\Controllers\PartenaireController::class, 'partenaireStatus'])->name('partenaire.status');

    Route::resource('feedback', App\Http\Controllers\FeedbackController::class);
    Route::post('feedback_status', [\App\Http\Controllers\FeedbackController::class, 'feedbackStatus'])->name('feedback.status');

    Route::get('aboutus', [App\Http\Controllers\AboutusController::class, 'index'])->name('about.index');
    Route::put('aboutus-update', [App\Http\Controllers\AboutusController::class, 'aboutUpdate'])->name('about.update');

    Route::resource('/contacts', App\Http\Controllers\ContactAdminController::class);

    Route::resource('/devis', App\Http\Controllers\devisAdminController::class);

    Route::get('/devis_jour', [\App\Http\Controllers\devisAdminController::class, 'index_jour'])->name('devis.jour');
    Route::get('/devis_encours', [\App\Http\Controllers\devisAdminController::class, 'index_encours'])->name('devis.encours');
    Route::get('/devis_accepte', [\App\Http\Controllers\devisAdminController::class, 'index_accepte'])->name('devis.accepte');
    Route::get('/devis_delivred', [\App\Http\Controllers\devisAdminController::class, 'index_delivred'])->name('devis.delivred');
    Route::get('/devis_refuse', [\App\Http\Controllers\devisAdminController::class, 'index_refuse'])->name('devis.refuse');

    Route::post('devis_remarque/{id}', [\App\Http\Controllers\devisAdminController::class, 'devisRemarque'])->name('devis.remarque');
    Route::get('devis_client/{id}', [\App\Http\Controllers\devisAdminController::class, 'devisClient'])->name('devis.client');
    Route::post('devis_modifier/{id}', [\App\Http\Controllers\devisAdminController::class, 'devisModifier'])->name('devis.modifier');
    Route::post('devis_ajout_product/{id}', [\App\Http\Controllers\devisAdminController::class, 'devisAjoutProduct'])->name('devis.ajoutproduct');

    Route::get('liste-partcipants/{id}/participant_execl', [\App\Http\Controllers\devisAdminController::class, 'listeParticipant'])->name('liste-excel');


    Route::get('tous_execl', [\App\Http\Controllers\devisAdminController::class, 'listeParticipantTous'])->name('tous-liste-excel');


    Route::resource('/newsletter', App\Http\Controllers\newsletterController::class);

    Route::resource('clients', App\Http\Controllers\ClientsController::class);
    Route::post('clients_status', [\App\Http\Controllers\ClientsController::class, 'clientsStatus'])->name('clients.status');

    // ******************************* //////




});
Route::fallback(\CodeZero\LocalizedRoutes\Controller\FallbackController::class)->middleware(\CodeZero\LocalizedRoutes\Middleware\SetLocale::class);
