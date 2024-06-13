<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeWorkingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\KNNController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;





// Route::get('/home', function () {
//     return view('index');
// })->middleware(['auth', 'verified'])->name('home');

// Route::group(['middleware' => 'role:admin', 'auth', 'verified'], function () {
//     Route::get('/home', function () {
//         return view('index');
//     })->name('home');
//     Route::get('/item', [ItemController::class, 'index'])->name('items');
//     Route::get('/item-create', [ItemController::class, 'create'])->name('items.create');
// });
// Route::prefix('employee')->name('employee.')->group(function () {
//     Route::get('/item', [ItemController::class, 'index'])->name('items');
//     Route::get('/employee-home', function () {
//         return view('employee');
//     })->middleware(['auth', 'verified'])->name('employee.home');
// });

/**Admin routes **/
Route::middleware('adminAuth')->prefix('admin')->group(function () {
    Route::get('/home', [HomeController::class, 'admin'])->name('home');

    Route::get('/item', [ItemController::class, 'index'])->name('items');
    Route::prefix('item')->group(function () {
        Route::get('/create', [ItemController::class, 'create'])->name('items.create');
        Route::get('/edit/{id}', [ItemController::class, 'edit'])->name('items.edit');
        Route::get('/knn', [KNNController::class, 'knn'])->name('items.knn');
        Route::get('/knnview', [KNNController::class, 'knnview'])->name('items.knnview');
        // Route::get('/knnresult', [KNNController::class, 'knnresult'])->name('items.knnresult');
        Route::post('/save', [ItemController::class, 'save'])->name('items.save');
        Route::post('/update/{id}', [ItemController::class, 'update'])->name('items.update');
        Route::post('/add/{id}', [ItemController::class, 'addStock'])->name('items.add');
        Route::delete('/delete/{id}', [ItemController::class, 'delete'])->name('items.delete');
    });

    Route::get('/employee', [EmployeeController::class, 'index'])->name('employees');
    Route::prefix('employees')->group(function () {
        Route::get('/phk', [EmployeeController::class, 'phk'])->name('employees.phk');
        Route::get('/create', [EmployeeController::class, 'create'])->name('employees.create');
        Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('employees.edit');
        Route::post('/save', [EmployeeController::class, 'save'])->name('employees.save');
        Route::post('/update/{id}', [EmployeeController::class, 'update'])->name('employees.update');
        Route::post('/account/{id}', [EmployeeController::class, 'account'])->name('employees.account');
        Route::post('/defaultpass/{id}', [EmployeeController::class, 'defaultpassword'])->name('employees.defaultpassword');
        Route::post('/pecat/{id}/{state}', [EmployeeController::class, 'pecat'])->name('employees.pecat');
    });
});

/**Employee routes **/
Route::middleware('employeeAuth')->prefix('employee')->group(function () {
    Route::get('/work', [EmployeeWorkingController::class, 'index'])->name('employee.home');
    Route::prefix('work')->group(function () {
        Route::post('/search', [EmployeeWorkingController::class, 'search'])->name('employee.getsearch');
        Route::get('/search/{search}', [EmployeeWorkingController::class, 'index'])->name('employee.search');
        Route::get('/addStock/{id}', [EmployeeWorkingController::class, 'add'])->name('employee.add');
        Route::get('/minusStock/{id}', [EmployeeWorkingController::class, 'minus'])->name('employee.minus');
        Route::get('/keranjang/{id}', [EmployeeWorkingController::class, 'keranjang'])->name('employee.keranjang');
        Route::post('/bayar', [EmployeeWorkingController::class, 'bayar'])->name('employee.bayar');
        Route::post('/delete/{id}', [EmployeeWorkingController::class, 'delete'])->name('employee.delete');
    });
    // Route::get('/work', [EmployeeWorkingController::class, 'index'])->name('employee.search');
});

Route::get('/admin', function () {
    if (empty(Auth::check())) {
        return redirect()->route('login');
    }
    if (Auth::user()->role === 'employee') {
        return redirect()->route('employee.home');
    }
    if (Auth::user()->role === 'admin') {
        return redirect()->route('home');
    }
});
Route::get('/employee', function () {
    if (empty(Auth::check())) {
        return redirect()->route('login');
    }
    if (Auth::user()->role === 'employee') {
        return redirect()->route('employee.home');
    }
    if (Auth::user()->role === 'admin') {
        return redirect()->route('home');
    }
});

Route::get('/', function () {
    if (empty(Auth::check())) {
        return redirect()->route('login');
    }
    if (Auth::user()->role === 'employee') {
        return redirect()->route('employee.home');
    }
    if (Auth::user()->role === 'admin') {
        return redirect()->route('home');
    }
});


require __DIR__ . '/auth.php';
