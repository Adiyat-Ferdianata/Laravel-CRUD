<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;

route::get("/produk", [ProdukController::class, 'index'])->name('index.index');
route::get("/produk/create", [ProdukController::class, 'create'])->name('index.create');
route::post('/produk/store', [ProdukController::class, 'store'])->name('index.store');

route::get('/produk/edit/{id}', [ProdukController::class, 'edit'])->name('index.edit');
route::put('/produk/update/{id}', [ProdukController::class, 'update'])->name('index.update');
//patch
route::get('/produk/show/{id}', [ProdukController::class, 'show'])->name('index.show');

route::delete('/produk/delete{id}', [ProdukController::class, 'destroy'])->name('index.destroy');
