<?php

use Illuminate\Support\Facades\Route;
use App\Models\Company;
use App\Models\Branch;
use App\Models\Employee;
use App\Http\Controllers\CompanyController;

Route::post('/company-details', [CompanyController::class, 'getCompanyDetails']);
