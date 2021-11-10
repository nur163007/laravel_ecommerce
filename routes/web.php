<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
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

Route::get('admin/dashboard', function () {
    return view('admin.dashboard');
});

//  ================ROUTE FOR CATEGORY=================

Route::get('admin/category/add-category',[CategoryController::class,'index'])->name('admin.addCategory');
Route::post('admin/category/store-category',[CategoryController::class,'store'])->name('store.category');
Route::get('admin/category/view-category',[CategoryController::class,'view'])->name('admin.viewCategory');
Route::get('admin/category/edit-category/{id}',[CategoryController::class,'edit'])->name('admin.editCategory');
Route::get('admin/category/delete-category/{id}',[CategoryController::class,'delete'])->name('admin.deleteCategory');
Route::post('admin/category/update-category/{id}',[CategoryController::class,'update'])->name('admin.updateCategory');


// =======================ROUTE FOR SUBCATEGORY-=====================================
Route::get('admin/subcategory/add-subcategory',[SubCategoryController::class,'create'])->name('admin.addSubCategory');
Route::post('admin/subcategory/store-subcategory',[SubCategoryController::class,'store'])->name('admin.store.subcategory');
Route::get('admin/subcategory/view-subcategory',[SubCategoryController::class,'view'])->name('admin.viewSubCategory');
Route::get('admin/subcategory/delete-subcategory/{id}',[SubCategoryController::class,'delete'])->name('admin.deleteSubCategory');
Route::get('admin/subcategory/edit-subcategory/{id}',[SubCategoryController::class,'edit'])->name('admin.editSubCategory');


