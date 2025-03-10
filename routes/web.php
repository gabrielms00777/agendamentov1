<?php

use App\Enums\UserRoleEnum;
use Illuminate\Support\Facades\Route;
use App\Livewire\{
    Admin\Dashboard\Index as AdminDashboard,
    Admin\Appointments\Index as AdminAppointments,
    Admin\Services\Index as AdminServices,
    Admin\Professionals\Index as AdminProfessionals,
    Admin\Clients\Index as AdminClients,
    Admin\Products\Index as AdminProducts,
    Admin\Reports\Index as AdminReports,
    Receptionist\Dashboard\Index as ReceptionistDashboard,
    Receptionist\Appointments\Index as ReceptionistAppointments,
    Receptionist\Clients\Index as ReceptionistClients,
    Receptionist\Products\Index as ReceptionistProducts,
    Professional\Dashboard\Index as ProfessionalDashboard,
    Professional\Appointments\Index as ProfessionalAppointments,
    Professional\Reviews\Index as ProfessionalReviews,
    Client\Home\Index as ClientHome,
    Client\Scheduling\Index as ClientScheduling,
    Client\Appointments\Index as ClientAppointments,
    Client\Loyalty\Index as ClientLoyalty
};

auth()->loginUsingId(1);

Route::get('/', ClientHome::class)->name('home');
Route::get('/agendamento', ClientScheduling::class)->name('scheduling');

// Route::middleware('guest')->group(function () {
//     Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
//     Route::post('/login', [LoginController::class, 'login']);
// });

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->name('admin.')->middleware(['role:' . UserRoleEnum::ADMIN->value])->group(function () {
        Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
        Route::get('/agendamentos', AdminAppointments::class)->name('appointments.index');
        Route::get('/servicos', AdminServices::class)->name('services.index');
        Route::get('/profissionais', AdminProfessionals::class)->name('professionals.index');
        Route::get('/clientes', AdminClients::class)->name('clients.index');
        Route::get('/produtos', AdminProducts::class)->name('products.index');
        Route::get('/relatorios', AdminReports::class)->name('reports.index');
    });

    Route::prefix('receptionist')->name('receptionist.')->middleware(['role:' . UserRoleEnum::RECEPTIONIST->value])->group(function () {
        Route::get('/dashboard', ReceptionistDashboard::class)->name('dashboard');
        Route::get('/agendamentos', ReceptionistAppointments::class)->name('appointments.index');
        Route::get('/clientes', ReceptionistClients::class)->name('clients.index');
        Route::get('/produtos', ReceptionistProducts::class)->name('products.index');
    });

    Route::prefix('professional')->name('professional.')->middleware(['role:' . UserRoleEnum::PROFESSIONAL->value])->group(function () {
        Route::get('/dashboard', ProfessionalDashboard::class)->name('dashboard');
        Route::get('/agendamentos', ProfessionalAppointments::class)->name('appointments.index');
        Route::get('/avaliacoes', ProfessionalReviews::class)->name('reviews.index');
    });

    Route::prefix('client')->name('client.')->middleware(['role:' . UserRoleEnum::CLIENT->value])->group(function () {
        Route::get('/agendamentos', ClientAppointments::class)->name('appointments.index');
        Route::get('/fidelidade', ClientLoyalty::class)->name('loyalty.index');
    });
});
