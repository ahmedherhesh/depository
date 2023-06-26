<?php

use App\Http\Controllers\Admin\DepositoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ReturnItemController;
use App\Http\Controllers\ReportController;
use App\Models\Category;
use App\Models\Company;
use App\Models\Depository;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'login');
    Route::post('login', '_login')->name('login');
    Route::get('logout', 'logout')->name('logout');
    Route::group(['middleware' => 'auth.web'], function () {
        Route::get('change-password', 'changePassword');
        Route::post('change-password', '_changePassword')->name('change_password');
    });
});
Route::group(['middleware' => 'auth.web'], function () {
    view()->composer(['*'], function ($view) {
        $user = session()->get('user');
        $categories = Category::whereParentId(null);
        $depots = Depository::query();
        if ($user && !in_array($user->role, ['super-admin', 'admin'])) {
            $depots->whereId($user->depot_id);
            $categories->whereDepotId($user->depot_id);
        }
        $depots = $depots->get();
        $categories = $categories->get();
        $companies = Company::get();
        $view->with('user', $user);
        $view->with('categories', $categories);
        $view->with('companies', $companies);
        $view->with('depots', $depots);
    });
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::resource('items', ItemController::class);
    Route::post('item-update', [ItemController::class, 'update'])->name('item.update');
    Route::get('items/{id}/delete', [ItemController::class, 'destroy'])->name('item.delete');

    Route::resource('categories', CategoryController::class);
    Route::post('category-update', [CategoryController::class, 'update'])->name('category.update');
    Route::get('sub_categories/{id}', [CategoryController::class, 'subCategories']);
    Route::get('categories/{id}/delete', [CategoryController::class, 'destroy'])->name('category.delete');

    Route::get('deliveries', [DeliveryController::class, 'delivery'])->name('deliveries');
    Route::post('delivery', [DeliveryController::class, '_delivery'])->name('delivery');
    Route::get('delivery-edit/{id}', [DeliveryController::class, 'edit'])->name('delivery.edit');
    Route::put('delivery-update/{id}', [DeliveryController::class, 'update'])->name('delivery.update');
    Route::delete('delivery-delete/{id}', [DeliveryController::class, 'destroy'])->name('delivery.delete');

    Route::get('returned-items', [ReturnItemController::class, 'returnedItems'])->name('returned.items');
    Route::post('return-item', [ReturnItemController::class, 'returnItem'])->name('return.item');
    Route::get('return-to-stock', [ReturnItemController::class, 'returnToStock'])->name('return.to.stock');
    Route::get('returned-item-edit/{id}', [ReturnItemController::class, 'edit'])->name('returned.item.edit');
    Route::put('returned-item-update/{id}', [ReturnItemController::class, 'update'])->name('returned.item.update');
    Route::delete('returned-item-delete/{id}', [ReturnItemController::class, 'destroy'])->name('returned.item.destroy');

    Route::resource('companies', CompanyController::class);
    Route::get('reports', ReportController::class)->name('reports');
});

Route::group(['middleware' => 'admin'], function () {
    Route::resource('users', UserController::class);
    Route::resource('depositories', DepositoryController::class);
});
