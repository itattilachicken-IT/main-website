<?php

use Illuminate\Support\Facades\Route;
use App\Modules\EventInvitations\Controllers\InvitationController;
use App\Modules\EventInvitations\Controllers\RsvpController;
use App\Modules\EventInvitations\Controllers\AdminInvitationController;

Route::prefix('invite')->group(function () {
    
    Route::get('/{token}', [InvitationController::class, 'show'])->name('invite.show');

   
    Route::get('/rsvp/{token}', [RsvpController::class, 'show'])->name('rsvp.show');

    
    Route::post('/rsvp/{token}', [RsvpController::class, 'submit'])->name('rsvp.submit');

    
    Route::get('/rsvp/{token}/result', [RsvpController::class, 'result'])->name('rsvp.result');
});

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::resource('invitations', AdminInvitationController::class);

    // Existing RSVP PDF/PNG download
    Route::get('/invitations/{invite}/rsvp-pdf', [AdminInvitationController::class, 'downloadRsvp'])
        ->name('invitations.downloadRsvp');

    // New reminder PDF (clickable banner)
    Route::get('/invitations/{invite}/reminder-pdf', [AdminInvitationController::class, 'downloadReminderPdf'])
        ->name('invitations.downloadReminderPdf');
});


Route::post('/admin/invitations/upload-rsvp', [InvitationController::class, 'uploadRsvp'])->name('admin.invitations.uploadRsvp');


Route::get('/admin/events/{event}/invitations/export/{format}', [AdminInvitationController::class, 'export'])
    ->name('admin.invitations.export');
    
    // Shortcut export route for single event
Route::get('/admin/invitations/export/{format}', [AdminInvitationController::class, 'exportSingle'])
    ->name('admin.invitations.exportSingle');


