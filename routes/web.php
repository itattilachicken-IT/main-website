<?php

$flagPath = storage_path('framework/maintenance.flag');

if (file_exists($flagPath) && !str_starts_with(request()->path(), 'admin')) {
    
    Route::get('{any}', function () {
        return response()->view('maintenance');
    })->where('any', '.*');

    return;
}

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MpesaCallbackController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\ProductController as UserProductController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Mail\OrderPendingPaymentMail;
use App\Http\Controllers\StandardsController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\FranchiseController;
use App\Http\Controllers\BlogController;
use App\Models\Order;
use App\Http\Controllers\Admin\MaintenanceController;
use App\Http\Controllers\FoundationController;
use App\Http\Controllers\InvestorController;
use App\Http\Controllers\InvestorLandingController;



use App\Http\Controllers\WithdrawalController;

Route::get('/withdrawal-form', [WithdrawalController::class, 'showForm'])->name('withdrawal.form');
Route::get('/investor/{id_number}', [WithdrawalController::class, 'getInvestorData'])->name('investor.data');
Route::post('/withdrawal-form', [WithdrawalController::class, 'submitForm'])->name('withdrawal.submit');
Route::get('/investor/{id_number}/pending', [App\Http\Controllers\WithdrawalController::class, 'checkPending']);



// Fast-Food Franchise detail page
Route::get('/franchise/fastfood', [FranchiseController::class, 'fastFood'])
    ->name('franchise.fastfood');

// Butchery Franchise detail page
Route::get('/franchise/butchery', [FranchiseController::class, 'butchery'])
    ->name('franchise.butchery');



Route::middleware(['web'])->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/shops', [ShopController::class, 'index'])->name('shop.index');

    Route::get('/investors', [InvestorController::class, 'index'])->name('investors.index');
  

    Route::get('/shop/{product:slug}', [ShopController::class, 'show'])->name('shop.show');
    Route::get('/search', [ShopController::class, 'search'])->name('shop.search');

    Route::get('/product/{product}/variants', [UserProductController::class, 'variants'])
        ->name('products.variants');
        
        Route::post('/cart/clear', [CartController::class, 'clear']);


    
    Route::get('/brand-launch', [LaunchController::class, 'showLaunchPage'])->name('launch.page');
    Route::post('/brand-launch/subscribe', [LaunchController::class, 'subscribe'])->name('launch.subscribe');

    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('add/{product}', [CartController::class, 'add'])->name('cart.add');
        Route::delete('remove/{key}', [CartController::class, 'remove'])->name('cart.remove');
        Route::post('update/{key}', [CartController::class, 'updateQuantity'])->name('cart.update');
    });

    Route::get('/our-blog', [BlogController::class, 'index'])->name('our-blog');
    Route::post('/upcoming-blog/subscribe', [BlogController::class, 'subscribe'])->name('upcoming.blog.subscribe');
    Route::view('/news/press-releases', 'news.press-releases')->name('news.press');
    Route::view('/news/awards', 'news.awards')->name('news.awards');

    Route::prefix('our-farm')->group(function () {
        Route::get('/breeder-operations', [FarmController::class, 'breederOperations'])->name('farm.breederOperations');
        Route::get('/hatchery', [FarmController::class, 'hatchery'])->name('farm.hatchery');
        Route::get('/housing', [FarmController::class, 'housing'])->name('farm.housing');
        Route::get('/feed', [FarmController::class, 'feed'])->name('farm.feed');
        Route::get('/transportation', [FarmController::class, 'transportation'])->name('farm.transportation');
        Route::get('/processing-packaging', [FarmController::class, 'processingPackaging'])->name('farm.processingPackaging');
    });

    Route::prefix('our-standards')->group(function () {
        Route::get('/animal-welfare', [StandardsController::class, 'animalWelfare'])->name('standards.animalWelfare');
        Route::get('/food-safety', [StandardsController::class, 'foodSafety'])->name('standards.foodSafety');
        Route::get('/humane-practices', [StandardsController::class, 'humanePractices'])->name('standards.humanePractices');
        Route::get('/quality-standards', [StandardsController::class, 'qualityStandards'])->name('standards.qualityStandards');
        Route::get('/sustainability', [StandardsController::class, 'sustainability'])->name('standards.sustainability');
        Route::get('/nutrition', [StandardsController::class, 'nutrition'])->name('standards.nutrition');
    });

    Route::prefix('our-chicken')->group(function () {
        Route::get('/', [UserProductController::class, 'index'])->name('products.index');
        Route::get('/{id}', [UserProductController::class, 'show'])->name('products.show');
    });

    Route::get('/about-us', fn() => view('aboutus'))->name('about');
    Route::get('/franchise', fn() => view('franchise'))->name('franchise');
    Route::get('/recipes', fn() => view('recipes'))->name('recipes');
    Route::get('/chicken-blog', fn() => view('chickenblog'))->name('chicken-blog');
    Route::get('/safe-handling', fn() => view('safehandling'))->name('safehandling');
    Route::get('/our-farm', fn() => view('farm'))->name('farm');
    Route::get('/investments', fn() => view('investments'))->name('investments');

    Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
    Route::get('/growth-plan', function () {
    return view('growth-plan');
})->name('growth-plan');


Route::get('/checkout', [CheckoutController::class, 'index'])
    ->name('checkout.index');

Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])
    ->name('checkout.placeOrder');

// Processing page (single endpoint)
Route::get('/checkout/processing/{order}/{token}', [CheckoutController::class, 'processing'])
    ->name('checkout.processing');
    
    // Processing page for partial payment retry
Route::get('/checkout/payment/{order}/{token}', [CheckoutController::class, 'showPayment'])
    ->name('checkout.payment.show');
Route::get('/checkout/payment/partial/{order}/{token}', [CheckoutController::class, 'paymentPartial'])
    ->name('checkout.payment.partial');
    Route::get('/checkout/payment/full/{order}/{token}', [CheckoutController::class, 'paymentFull'])
    ->name('checkout.payment.full');
    Route::get('/checkout/success/partial', [CheckoutController::class, 'partialSuccess'])
    ->name('checkout.success.partial');






// Polling status
Route::get('/checkout/status/{order}', [CheckoutController::class, 'checkStatus'])
    ->name('checkout.status');

// Final result pages
Route::get('/checkout/success', [CheckoutController::class, 'success'])
    ->name('checkout.success');

Route::get('/checkout/failed', [CheckoutController::class, 'failed'])
    ->name('checkout.failed');


    
    Route::get('/test-mail', function () {
        $order = new Order([
            'id' => 999,
            'customer_name' => 'Winnie',
            'customer_email' => 'wnnmax@gmail.com',
            'guest_token' => Str::uuid(),
            'total_amount' => 5000,
            'paid_amount' => 1000
        ]);

        $guestLink = route('checkout.payment_guest', $order->guest_token);

        try {
            Mail::to('wnnmax@gmail.com')->send(new OrderPendingPaymentMail($order, $guestLink));
            return '✅ Test email sent!';
        } catch (\Exception $e) {
            return '❌ Failed to send: ' . $e->getMessage();
        }
    });

});

Route::get('/foundation', [FoundationController::class, 'index'])->name('foundation.index');

Route::view('/refund-policy', 'refundpolicy')->name('refund.policy');


Route::get('/shop', function () {
    return redirect()->away(config('shop.external_shop_url')); // temporary 302
})->name('shop');


use App\Http\Controllers\CookieConsentController;

Route::post('/cookie-consent', [CookieConsentController::class, 'store'])
    ->name('cookie.consent');


require base_path('app/Modules/EventInvitations/routes/web.php');

Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.post');

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('admin.dashboard');

        Route::prefix('/products')->name('admin.products.')->group(function () {
            Route::get('/', [AdminProductController::class, 'index'])->name('index');
            Route::get('/create', [AdminProductController::class, 'create'])->name('create');
            Route::post('/', [AdminProductController::class, 'store'])->name('store');
            Route::get('/{product}/edit', [AdminProductController::class, 'edit'])->name('edit');
            Route::put('/{product}', [AdminProductController::class, 'update'])->name('update');
            Route::get('/{product}', [AdminProductController::class, 'show'])->name('show');
            Route::delete('/{product}', [AdminProductController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('/orders')->name('admin.orders.')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('index');
            Route::get('/{order}', [OrderController::class, 'show'])->name('show');
            Route::get('/{order}/edit', [OrderController::class, 'edit'])->name('edit');
            Route::put('/{order}', [OrderController::class, 'update'])->name('update');
            Route::delete('/{order}', [OrderController::class, 'destroy'])->name('destroy');
        });

        Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    });
    Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('admin.maintenance');
    Route::post('/maintenance/toggle', [MaintenanceController::class, 'toggle'])->name('admin.maintenance.toggle');
});
