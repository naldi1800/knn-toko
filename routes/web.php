<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
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
    Route::get('/home', [HomeController::class, 'employee'])->name('employee.home');
});

Route::get('/admin', function () {
    return redirect()->route('login');
});
Route::get('/employee', function () {
    return redirect()->route('login');
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
