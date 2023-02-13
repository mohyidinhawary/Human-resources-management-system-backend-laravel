<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\Employee_Archive;
use App\Http\Controllers\Api\DiscountController;
use App\Http\Controllers\Api\IncrementController;
use App\Http\Controllers\Api\FinanceController;
use App\Http\Controllers\Api\WarningController;
use App\Http\Controllers\Api\CompanyBrancheController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\RequestServiceController;
use App\Http\Controllers\Api\PermanenceController;
use App\Http\Controllers\Api\VacationController;
use App\Http\Controllers\Api\HolidayController;
use App\Http\Controllers\Api\AttendanceController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//admin-apis
//employees
//////////////////////////////////////////////////////////////////////
Route::post("Admin_Register",[AdminController::class,"AdminRegister"]);

Route::post("Admin_login",[AdminController::class,"AdminLogin"]);

Route::get("Admin_profile/{id}",[AdminController::class,"AdminProfile"]);

Route::post("add_employee/{id1}/{id2}",[AdminController::class,"AddEmployee"]);

Route::get("employee_profile/{id}",[AdminController::class,"EmployeeProfile"]);

Route::get("employees",[AdminController::class,"GetAllEmployees"]);

Route::put("update_employee/{id}",[AdminController::class,"UpdateEmployee"]);

Route::delete('delete_employee/{id}',[AdminController::class,"DeleteEmployee"]);

Route::get("employee_archive/{id}",[Employee_Archive::class,"EmployeeArchive"]);

Route::get("archives",[Employee_Archive::class,"ShowEmployeesArchived"]);

Route::get("branch_employees/{id}",[AdminController::class,"EmployeesFiltersByBranches"]);

Route::get("department_employees/{id}",[AdminController::class,"EmployeesFiltersByDepartments"]);
/////////////////////////////////////////////////////////////////////////////////////////////////// 
//finances
//////////////////////////////////////////////////////////////////////////
Route::post("add_discount/{id}",[DiscountController::class,"AddDiscount"]);

Route::get("show_discount",[DiscountController::class,"ShowDiscounts"]);

Route::get("show_employee_discounts/{id}",[DiscountController::class,"ShowEmployeeDiscounts"]);

Route::put("update_discount/{id}",[DiscountController::class,"UpdateDiscount"]);

Route::post("add_increment/{id}",[IncrementController::class,"AddIncrement"]);

Route::get("show_increment",[IncrementController::class,"ShowIncrements"]);

Route::put("update_increment/{id}",[IncrementController::class,"UpdateIncrement"]);

Route::post("add_employee_salary/{id}",[FinanceController::class,"AddEmployeeSalary"]);

Route::get("show_employees_salary",[FinanceController::class,"ShowEmployeesSalary"]);

Route::get("show_employee_salary/{id}",[FinanceController::class,"ShowEmployeeSalary"]);

Route::get("show_employee_revealed/{id}",[FinanceController::class,"ShowEmployeeSalaryRevealed"]);

Route::get("employee_total_increments/{id}",[IncrementController::class,"TotalIncrements"]);

Route::get("employee_total_discounts/{id}",[DiscountController::class,"TotalDiscounts"]);
//////////////////////////////////////////////////////////////////////////////////////////
//warnings
////////////////////////////////////////////////////////////////////////
Route::post("add_warning/{id}",[WarningController::class,"AddWarning"]);

Route::get("show_employees_warnings",[WarningController::class,"ShowEmployeesWarnings"]);

Route::put("update_warning/{id}",[WarningController::class,"UpdateWarning"]);

Route::delete("delete_warning/{id}",[WarningController::class,"DeleteWarning"]);

Route::post("add_warning_for_all",[WarningController::class,"AddWarningForAll"]);

Route::get("show_warnings_for_all",[WarningController::class,"ShowWarningsForAll"]);
//branches
///////////////////////////////////////////////////////////////////////
Route::post("add_branch",[CompanyBrancheController::class,"AddBranch"]);

Route::get("show_branches",[CompanyBrancheController::class,"GetAllBranches"]);

Route::put("update_branch/{id}",[CompanyBrancheController::class,"UpdateBranch"]);

Route::delete("delete_branch/{id}",[CompanyBrancheController::class,"DeleteBranch"]);
//departments
///////////////////////////////////////////////////////////////////////////////
Route::post("add_department/{id}",[DepartmentController::class,"AddDepartment"]);

Route::get("show_branches_departments",[DepartmentController::class,"GetAllBranchesDepartments"]);

Route::get("show_branche_departments/{id}",[DepartmentController::class,"GetBrancheDepartments"]);

Route::put("update_department/{id1}",[DepartmentController::class,"UpdateDepartment"]);

Route::delete("delete_department/{id1}/{id2}",[DepartmentController::class,"DeleteBranch"]);
//jobs
///////////////////////////////////////////////////////////
Route::post("add_job/{id}",[JobController::class,"AddJob"]);

Route::get("show_departments_jobs",[JobController::class,"GetAllDepartmentsjobs"]);

Route::get("show_departments_job/{id}",[JobController::class,"GetDepartmentJobs"]);

Route::put("update_job/{id}",[JobController::class,"UpdateJob"]);

Route::delete("delete_job/{id1}/{id2}",[JobController::class,"DeleteJob"]);
/////////////////////////////////////////////////////////////////////////
//emplyee-api
Route::post("employee_login",[EmployeeController::class,"EmployeeLogin"]);
///////////////////////////////////////////////////////////////////////////
//services
///////////////////////////////////////////////////////////////////////////////
Route::get("show_employees_time",[PermanenceController::class,"EmployeesTime"]);

Route::post("admin_request_accept/{id1}/{id2}",[RequestServiceController::class,"AdminRequestAccept"]);

Route::get("show_admin_requested_services",[RequestServiceController::class,"ShowAdminMailServices"]);
//////////////////////////////////////////////////////////////////////////////////////////////////////
//vacations
/////////////////////////////////////////////////////////////////////////////////////////////////
Route::post("add_vacation_for_employee/{id}",[VacationController::class,"AddVacationForEmployee"]);

Route::get("get_employee_vacation/{id}",[VacationController::class,"GetEmployeeVacation"]);
///////////////////////////////////////////////////////////////////////////////////////////
//holidays
//////////////////////////////////////////////////////////////////
Route::post("add_holiday",[HolidayController::class,"AddHoliday"]);

Route::get("show_holidays",[HolidayController::class,"ShowHolidays"]);

Route::put("update_holiday/{id}",[HolidayController::class,"UpdateHoliday"]);
/////////////////////////////////////////////////////////////////////////////
//attendances
////////////////////////////////////////////////////////////////////////////////
Route::post("add_attendance/{id}",[AttendanceController::class,"AddAttendance"]);

Route::get("show_attendance",[AttendanceController::class,"GetAllAttendance"]);

Route::get("show_employee_attendance/{id}",[AttendanceController::class,"GetEmployeeAttendance"]);
//////////////////////////////////////////////////////////////////////////////////////////////////

Route::group(["middleware" => ["auth:sanctum"]], function(){
    //admin-api
    /////////////////////////////////////////////////////////////////
    Route::get("Admin_logout",[AdminController::class,"AdminLogout"]);
    //////////////////////////////////////////////////////////////////
    //employee-api
    /////////////////////////////////////////////////////////////////////
Route::get("employee_logout",[EmployeeController::class,"EmployeeLogout"]);

Route::get("employee_profile",[EmployeeController::class,"EmployeeProfile"]);
//warnings
//////////////////////////////////////////////////////////////////////////////////////
Route::get("show_employee_warnings",[WarningController::class,"ShowEmployeeWarnings"]);
///////////////////////////////////////////////////////////////////////////////////////
//services
/////////////////////////////////////////////////////////////////////////////////////////////////////
Route::post("create_request_service/{id1}",[RequestServiceController::class,"CraeteRequestService"]);

Route::put("update_requested_service/{id}",[RequestServiceController::class,"UpdateRequestService"]);

Route::delete("delete_requested_service/{id}",[RequestServiceController::class,"DeleteRequstedService"]);

Route::get("show_employee_requested_services",[RequestServiceController::class,"ShowEmployeeRequestedServices"]);

Route::get("show_employee_requested_services_answered",[RequestServiceController::class,"ShowEmployeeRequestedServicesAnswered"]);
//vacations
//////////////////////////////////////////////////////////////////////////////
Route::get("employee_vacation",[VacationController::class,"EmployeeVacation"]);
////////////////////////////////////////////////////////////////////////////////
//attendances
/////////////////////////////////////////////////////////////////////////////////////////////
Route::get("employee_show_attendance",[AttendanceController::class,"EmployeeShowAttendance"]);
//////////////////////////////////////////////////////////////////////////////////////////////
//finances
///////////////////////////////////////////////////////////////////////////////////////////
Route::get("employee_show_revealed",[FinanceController::class,"EmployeeShowSalaryRevealed"]);

Route::get("employee_show_salary",[FinanceController::class,"EmployeeShowSalary"]);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
   
    return $request->user();
});
