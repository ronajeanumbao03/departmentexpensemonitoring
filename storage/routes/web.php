<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\{
    ProfileController, UserController, DepartmentController, ExpenseController,
    BudgetController, SettingsController, NotificationExpenseController, ExpenseHistoryController,
    ReportController, HeadDashboardController, AdminDashboardController, UserDashboardController,
    UserBudgetController, NotificationController, SectionController, EventController,
    TreasurerController, HeadTreasurerController, RemittanceController, LoginController
};

// ----------------------------
// Public Routes
// ----------------------------
Route::get('/', function () {
    return view('welcome');
});

// ----------------------------
// Authentication (Custom)
// ----------------------------
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ----------------------------
// Common Authenticated Routes
// ----------------------------
Route::middleware(['auth'])->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
});

// ----------------------------
// Admin Routes
// ----------------------------
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Dashboard
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Users Management
    Route::resource('users', UserController::class);

    // Departments
    Route::get('departments', [DepartmentController::class, 'index'])->name('departments.index');
    Route::get('departments/create', [DepartmentController::class, 'create'])->name('departments.create');
    Route::post('departments', [DepartmentController::class, 'store'])->name('departments.store');
    Route::get('departments/{departmentId}/budget', [DepartmentController::class, 'budget'])->name('departments.budget');
    Route::get('departments/{departmentId}/budget/create', [DepartmentController::class, 'createBudget'])->name('departments.create-budget');
    Route::post('departments/{departmentId}/budget', [DepartmentController::class, 'storeBudget'])->name('departments.budget.store');
    Route::get('departments/{departmentId}/budget/edit', [DepartmentController::class, 'editBudget'])->name('departments.budget.edit');
    Route::put('departments/{departmentId}/budget', [DepartmentController::class, 'updateBudget'])->name('departments.budget.update');
    Route::delete('/departments/{id}/budget', [DepartmentController::class, 'deleteBudget'])->name('departments.budget.delete');

    // Assign Head / User
    Route::get('departments/assign-head', [DepartmentController::class, 'showAssignHeadForm'])->name('departments.show-assign-head');
    Route::post('departments/store-head', [DepartmentController::class, 'storeHead'])->name('departments.store-head');
    Route::get('departments/assign-user', [DepartmentController::class, 'showAssignUserForm'])->name('departments.show-assign-user');
    Route::post('departments/assign-user', [DepartmentController::class, 'storeUserAssignment'])->name('departments.store-user');

    // Settings
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');

    // Remittance
    Route::get('/remittances', [RemittanceController::class, 'index'])->name('remittances.index');
    Route::get('/remittances/pending', [RemittanceController::class, 'showPending'])->name('remittances.pending');
    Route::post('/remittances/{id}/acknowledge', [RemittanceController::class, 'acknowledge'])->name('remittances.acknowledge');

    // Expense Reports
    Route::get('admin/expense-reports', [App\Http\Controllers\AdminExpenseReportController::class, 'index'])->name('admin.expense-reports.index');
});

// ----------------------------
// Head Routes
// ----------------------------
Route::middleware(['auth', 'role:head'])->group(function () {
    // Dashboard
    Route::get('/head/dashboard', [HeadDashboardController::class, 'index'])->name('head.dashboard');

    // Budget Summary
    Route::get('/summary', [BudgetController::class, 'index'])->name('budget.summary');

    // Expense Approvals
    Route::get('/approvals', [ExpenseController::class, 'pendingApprovals'])->name('expenses.approvals');
    Route::post('/approvals/{expense}/approve', [ExpenseController::class, 'approve'])->name('expenses.approve');
    Route::post('/approvals/{expense}/reject', [ExpenseController::class, 'reject'])->name('expenses.reject');

    // Notification Approvals
    Route::post('/notifications/expenses/{expense}/approve', [NotificationExpenseController::class, 'approve'])->name('notifications.expenses.approve');
    Route::post('/notifications/expenses/{expense}/reject', [NotificationExpenseController::class, 'reject'])->name('notifications.expenses.reject');

    // Expense History & Reports
    Route::get('/history', [ExpenseHistoryController::class, 'index'])->name('expenses.history');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::delete('expenses/{expense}', [ExpenseHistoryController::class, 'destroy'])->name('expenses.destroy');
    Route::get('expenses/{id}', [ExpenseController::class, 'see'])->name('expenses.see');

    // Remittance
    Route::get('/remittances/create', [RemittanceController::class, 'create'])->name('remittances.create');
    Route::post('/remittances', [RemittanceController::class, 'store'])->name('remittances.store');
});

// ----------------------------
// User Routes
// ----------------------------
Route::middleware(['auth', 'role:user'])->group(function () {
    // Dashboard
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');

    // Expense Submission
    Route::get('submit-expense', [ExpenseController::class, 'create'])->name('expenses.create');
    Route::post('submit-expense', [ExpenseController::class, 'store'])->name('expenses.store');
    Route::get('my-submissions', [ExpenseController::class, 'mySubmissions'])->name('expenses.my-submissions');
    Route::get('expenses/{id}', [ExpenseController::class, 'show'])->name('expenses.show');

    // Budget Summary
    Route::get('/budget-summary', [UserBudgetController::class, 'index'])->name('budget.user-summary');
});

// ----------------------------
// Common Resources
// ----------------------------
Route::resources([
    'sections' => SectionController::class,
    'events' => EventController::class,
    'treasurers' => TreasurerController::class,
    'remittances' => RemittanceController::class,
]);

// ----------------------------
// Utility
// ----------------------------
Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');
    return 'Cache cleared successfully.';
});
