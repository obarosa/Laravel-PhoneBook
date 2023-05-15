<?php

use App\Http\Controllers\ApiRequestController;
use App\Http\Controllers\ConflictController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CsvContactController;
use App\Http\Controllers\ExportDefinicionController;
use Illuminate\Support\Facades\Route;


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

// USER
Route::name('utilizador.dashboard.')->group(function () {
    Route::controller(ContactController::class)->group(function () {
        Route::get('/', 'indexUtilizador')->name('index');
        // Route::get('/dashboard', 'showUtilizador')->name('show');
        // Route::get('/dashboard/search', 'searchBarUtilizador')->name('search');
    });
});

// ADMIN
Route::group(['middleware' => 'auth'], function () {
    Route::prefix('dashboard/admin')->group(function () {
        Route::name('dashboard.')->group(function () {
            Route::controller(ApiRequestController::class)->group(function () {
                // DEFINIÇÕES -WEB SERVICES
                Route::post('/webservices/save', 'store')->name('WebServices.store');
                Route::get('/webservices/edit', 'edit')->name('WebServices.edit');
            });
            Route::controller(ExportDefinicionController::class)->group(function () {
                // DEFINIÇÕES -EXPORTAÇÃO
                Route::post('/exportdefinicion/save',  'store')->name('exportdefinicion.store');
                Route::get('/exportdefinicion/edit', 'edit')->name('exportdefinicion.edit');
            });
            Route::controller(ConflictController::class)->group(function () {
                // CONFLICTS
                Route::get('/conflicts', 'conflicts')->name('conflicts');
                Route::get('/conflicts/teste', 'getDataDuplicados')->name('conflicts.teste');
                Route::post('/conflicts-telefone/{contacto}', 'conflictsUpdateTelefone')->name('conflictsTelefone.update');
                Route::post('/conflicts-telemovel/{contacto}', 'conflictsUpdateTelemovel')->name('conflictsTelemovel.update');
            });
            Route::controller(ContactController::class)->group(function () {
                // CRUD
                Route::get('', 'index')->name('index');
                Route::post('/save', 'store')->name('store');
                // Route::get('/contacts', 'show')->name('show');
                // Route::get('/details/{contacto}', 'showDetalhes')->name('showDetalhes');
                Route::get('/edit/{contacto}', 'edit')->name('edit');
                Route::post('/update/{contacto}', 'update')->name('update');
                Route::post('/delete/{contacto}', 'destroy')->name('destroy');
                // SEARCH ADMIN
                // Route::get('/search', 'searchBar')->name('search');
            });
        });
        Route::controller(CsvContactController::class)->group(function () {
            // IMPORT -CSV
            Route::get('/import-csv', 'importContactsCsv')->name('importContactsCsv');
            Route::post('/upload-csv', 'importCsv')->name('importCsv');
            Route::get('/transfer-csv', 'transferData')->name('transferData');
            Route::post('/import-csv/delete/{csv_contacto}', 'destroy')->name('importContactsCsv.destroy');
        });
        Route::controller(ContactController::class)->group(function () {
            // IMPORT -EXCEL
            Route::get('/import-excel', 'importContactsExcel')->name('importContactsExcel');
            Route::post('/upload-excel', 'importExcel')->name('importExcel');
        });
    });
});

Route::group(['middleware' => 'auth'], function () {
    Route::name('dashboard.')->group(function () {
        Route::controller(ContactController::class)->group(function () {
            // EXPORT SHOW
            Route::get('/yealink-contacts.xml', 'exportYealinkXml')->name('exportYealinkXml');
            Route::get('/microsip-contacts.xml', 'exportMicrosipXml')->name('exportMicrosipXml');
            Route::get('/grandstream-contacts.xml', 'exportGrandstreamXml')->name('exportGrandstreamXml');
            Route::get('/gigaset-contacts.xml', 'exportGigasetXml')->name('exportGigasetXml');
            // XML DOWNLOAD
            Route::get('/download-yealink-xml', 'downloadYealinkXml')->name('downloadYealinkXml');
            Route::get('/download-microsip-xml', 'downloadMicrosipXml')->name('downloadMicrosipXml');
            Route::get('/download-grandstream-xml', 'downloadGrandstreamXml')->name('downloadGrandstreamXml');
            Route::get('/download-gigaset-xml',  'downloadGigasetXml')->name('downloadGigasetXml');
            // PDF DOWNLOAD
            // Route::get('/download-pdf', 'downloadPdf')->name('downloadPdf');
        });
    });
});
require __DIR__ . '/auth.php';
