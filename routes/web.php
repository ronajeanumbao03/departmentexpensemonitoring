<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\NotificationExpenseController;
use App\Http\Controllers\ExpenseHistoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\HeadDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UserBudgetController;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Route to show the form for creating a department (GET)
    Route::get('departments/create', [DepartmentController::class, 'create'])->name('departments.create');

    // Route to store a new department (POST)
    Route::post('departments', [DepartmentController::class, 'store'])->name('departments.store');

    // Route to show the list of all departments (GET)
    Route::get('departments', [DepartmentController::class, 'index'])->name('departments.index');

    // Route to show the budget of a specific department (GET)
    Route::get('departments/{departmentId}/budget', [DepartmentController::class, 'budget'])->name('departments.budget');

    // Route to show the form to create a budget for a specific department
    Route::get('departments/{departmentId}/budget/create', [DepartmentController::class, 'createBudget'])->name('departments.create-budget');

    // Route to store a new budget for a department
    Route::post('departments/{departmentId}/budget', [DepartmentController::class, 'storeBudget'])->name('departments.budget.store');

    // Show the form to edit an existing budget for a department
    Route::get('departments/{departmentId}/budget/edit', [DepartmentController::class, 'editBudget'])->name('departments.budget.edit');

    // Update the department's budget
    Route::put('departments/{departmentId}/budget', [DepartmentController::class, 'updateBudget'])->name('departments.budget.update');

    Route::delete('/departments/{id}/budget', [DepartmentController::class, 'deleteBudget'])->name('departments.budget.delete');

});

Route::middleware('auth')->group(function () {
    // Show the form to submit an expense (GET)
    Route::middleware('auth')->get('submit-expense', [ExpenseController::class, 'create'])->name('expenses.create');

    // Store the expense submission (POST)
    Route::middleware('auth')->post('submit-expense', [ExpenseController::class, 'store'])->name('expenses.store');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('my-submissions', [ExpenseController::class, 'mySubmissions'])->name('expenses.my-submissions');
    Route::get('expenses/{id}', [ExpenseController::class, 'show'])->name('expenses.show');
});

Route::middleware(['auth', 'role:head'])->group(function () {
    Route::get('/summary', [BudgetController::class, 'index'])->name('budget.summary');
});

// web.php
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Show the form to assign a department head (select department first)
    Route::get('departments/assign-head', [DepartmentController::class, 'showAssignHeadForm'])->name('departments.show-assign-head');

    // Store the assigned department head
    Route::post('departments/store-head', [DepartmentController::class, 'storeHead'])->name('departments.store-head');

    Route::get('departments/assign-user', [DepartmentController::class, 'showAssignUserForm'])->name('departments.show-assign-user');
    Route::post('departments/assign-user', [DepartmentController::class, 'storeUserAssignment'])->name('departments.store-user');
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');

});

Route::middleware(['auth', 'role:head'])->group(function () {
    Route::get('/approvals', [ExpenseController::class, 'pendingApprovals'])->name('expenses.approvals');
    Route::post('/approvals/{expense}/approve', [ExpenseController::class, 'approve'])->name('expenses.approve');
    Route::post('/approvals/{expense}/reject', [ExpenseController::class, 'reject'])->name('expenses.reject');

    Route::post('/notifications/expenses/{expense}/approve', [NotificationExpenseController::class, 'approve'])->name('notifications.expenses.approve');
    Route::post('/notifications/expenses/{expense}/reject', [NotificationExpenseController::class, 'reject'])->name('notifications.expenses.reject');
});

Route::middleware(['auth', 'role:head'])->group(function () {
    Route::get('/history', [ExpenseHistoryController::class, 'index'])->name('expenses.history');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('head/dashboard', [HeadDashboardController::class, 'index'])->name('head.dashboard');
});

// Admin Dashboard
Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

// Department Head Dashboard
Route::middleware(['auth', 'role:head'])->get('/head/dashboard', [HeadDashboardController::class, 'index'])->name('head.dashboard');

// User Dashboard
Route::middleware(['auth', 'role:user'])->get('/user/dashboard', function () {
    return view('user.dashboard');
})->name('user.dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin-dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/expense-reports', [App\Http\Controllers\AdminExpenseReportController::class, 'index'])->name('admin.expense-reports.index');
});

Route::middleware(['auth', 'role:head'])->group(function () {
    Route::delete('expenses/{expense}', [ExpenseHistoryController::class, 'destroy'])->name('expenses.destroy');
    Route::get('expenses/{id}', [ExpenseController::class, 'see'])->name('expenses.see');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/budget-summary', [UserBudgetController::class, 'index'])->name('budget.user-summary');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
});

require __DIR__ . '/auth.php';
