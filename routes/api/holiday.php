
<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'checkPermession'])->group(
    function () {
        Route::group(['namespace' => 'Holidays'], function () {
            Route::get('/study-years/{studyYear}/holidays', 'IndexHolidayController')->name('holidays.index');
            Route::get('holidays/{holiday}', 'ShowHolidayController')->name('holidays.show');
            Route::post('/study-years/{studyYear}/holidays', 'CreateHolidayController')->name('holidays.add');
            Route::put('/holidays/{holiday}', 'UpdateHolidayController')->name('holidays.update');
            Route::delete('holidays/{holiday}', 'DeleteHolidayController')->name('holidays.delete');
        });
    }
);
