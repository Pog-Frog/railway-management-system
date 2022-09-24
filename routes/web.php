<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController; ## Admin Controller
use App\Http\Controllers\UserController; ## Users Controller
use App\Http\Controllers\EmployeeController; ##Employee Controller
use App\Http\Controllers\CaptainController; ##captain Controller
use App\Http\Controllers\TechnicianController; ##technican Controller


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
##ADMIN
Route::get("admin/register_admin", [CustomAuthController::class, 'admin_register_index'])->name('admin_register_index');
Route::post("admin/register", [CustomAuthController::class, 'admin_register'])->name('register_admin');
Route::get("admin/", [CustomAuthController::class, 'admin_login_index'])->name('admin_login_index')->middleware('alreadyloggedin');
Route::post("admin/login", [CustomAuthController::class, 'admin_login'])->name('login_admin')->middleware('alreadyloggedin');
Route::get("admin/dashboard", [CustomAuthController::class, 'admin_index'])->middleware('isloggedin');
Route::get("admin/logout", [CustomAuthController::class, 'admin_logout'])->name('admin_logout')->middleware('isloggedin');
Route::get("admin/trains", [CustomAuthController::class, 'trains_index'])->name('train_management')->middleware('isloggedin');
Route::post("admin/trains/insert_train", [CustomAuthController::class, 'insert_train'])->name('insert_train')->middleware('isloggedin');
Route::get("admin/trains/edit_train_index/{train_id}", [CustomAuthController::class, 'edit_train_index'])->name('edit_train_index')->middleware('isloggedin');
Route::post("admin/trains/edit_train/{train_id}", [CustomAuthController::class, 'edit_train'])->name('edit_train')->middleware('isloggedin');
Route::post("admin/trains/edit_train/delete_train/{train_id}", [CustomAuthController::class, 'delete_train'])->name('delete_train')->middleware('isloggedin');
Route::get("admin/trains/view_trains", [CustomAuthController::class, 'view_trains'])->name('view_trains')->middleware('isloggedin');
Route::get("admin/trains/view_trains/search_trains", [CustomAuthController::class, 'search_trains'])->name('search_trains')->middleware('isloggedin');
Route::get("admin/stations", [CustomAuthController::class, 'stations_index'])->name('stations_index')->middleware('isloggedin');
Route::post("admin/stations/insert_station", [CustomAuthController::class, 'insert_station'])->name('insert_station')->middleware('isloggedin');
Route::get("admin/stations/edit_station_index/{station_id}", [CustomAuthController::class, 'edit_station_index'])->name('edit_station_index')->middleware('isloggedin');
Route::post("admin/stations/edit_station/{station_id}", [CustomAuthController::class, 'edit_station'])->name('edit_station')->middleware('isloggedin');
Route::post("admin/stations/edit_station/delete_station/{station_id}", [CustomAuthController::class, 'delete_station'])->name('delete_station')->middleware('isloggedin');
Route::get("admin/stations/view_stations", [CustomAuthController::class, 'view_stations'])->name('view_stations')->middleware('isloggedin');
Route::get("admin/stations/view_stations/search_stations", [CustomAuthController::class, 'search_stations'])->name('search_stations')->middleware('isloggedin');
Route::get("admin/stations/{station_id}/view_allowed_trains", [CustomAuthController::class, 'view_allowed_trains'])->name('view_allowed_trains')->middleware('isloggedin');
Route::post("admin/stations/{station_id}/add_allowed_train/{train_id}", [CustomAuthController::class, 'add_allowed_train'])->name('add_allowed_train')->middleware('isloggedin');
Route::post("admin/stations/{station_id}/remove_allowed_train/{train_id}", [CustomAuthController::class, 'remove_allowed_train'])->name('remove_allowed_train')->middleware('isloggedin');
Route::get("admin/stations/{station_id}/view_allowed_trains/search_not_allowed_trains", [CustomAuthController::class, 'search_not_allowed_trains'])->name('search_not_allowed_trains')->middleware('isloggedin');
Route::get("admin/employees", [CustomAuthController::class, 'employees_index'])->name('employee_management')->middleware('isloggedin');
Route::post("admin/employees/insert_employee_index", [CustomAuthController::class, 'insert_employee_index'])->name('insert_employee_index')->middleware('isloggedin');
Route::post("admin/employees/insert_employee/insert_captain", [CustomAuthController::class, 'insert_captain'])->name('insert_captain')->middleware('isloggedin');
Route::post("admin/employees/insert_employee/insert_technician", [CustomAuthController::class, 'insert_technician'])->name('insert_technician')->middleware('isloggedin');
Route::post("admin/employees/insert_employee/insert_reservation_employee", [CustomAuthController::class, 'insert_reservation_employee'])->name('insert_reservation_employee')->middleware('isloggedin');
Route::get("admin/employees/view_employees", [CustomAuthController::class, 'view_employees'])->name('view_employees')->middleware('isloggedin');
Route::get("admin/employees/view_employees/search_employees", [CustomAuthController::class, 'search_employees'])->name('search_employees')->middleware('isloggedin');
Route::get("admin/employees/edit_captain_index/{emp_id}", [CustomAuthController::class, 'edit_captain_index'])->name('edit_captain_index')->middleware('isloggedin');
Route::get("admin/employees/edit_technician_index/{emp_id}", [CustomAuthController::class, 'edit_technician_index'])->name('edit_technician_index')->middleware('isloggedin');
Route::get("admin/employees/edit_reservation_employee_index/{emp_id}", [CustomAuthController::class, 'edit_reservation_employee_index'])->name('edit_reservation_employee_index')->middleware('isloggedin');
Route::post("admin/employees/edit_employee/{profession}/{emp_id}", [CustomAuthController::class, 'edit_employee'])->name('edit_employee')->middleware('isloggedin');
Route::post("admin/employees/edit_employee/send_emp_password/{profession}/{emp_id}", [CustomAuthController::class, 'send_emp_password'])->name('send_emp_password')->middleware('isloggedin');
Route::post("admin/employees/edit_employee/delete_employee/{profession}/{emp_id}", [CustomAuthController::class, 'delete_employee'])->name('delete_employee')->middleware('isloggedin');
Route::get("admin/lines", [CustomAuthController::class, 'lines_index'])->name('lines_index')->middleware('isloggedin');
Route::post("admin/lines/insert_line", [CustomAuthController::class, 'insert_line'])->name('insert_line')->middleware('isloggedin');
Route::get("admin/lines/view_lines", [CustomAuthController::class, 'view_lines'])->name('view_lines')->middleware('isloggedin');
Route::get("admin/lines/{line_id}/view_assigned_trains", [CustomAuthController::class, 'view_assigned_trains'])->name('view_assigned_trains')->middleware('isloggedin');
Route::get("admin/lines/{line_id}/view_assigned_trains/manage_train_schedules/{train_id}", [CustomAuthController::class, 'manage_train_schedules'])->name('manage_train_schedules')->middleware('isloggedin');
Route::post("admin/lines/{line_id}/view_assigned_trains/add_train_schedule/{train_id}", [CustomAuthController::class, 'add_train_schedule'])->name('add_train_schedule')->middleware('isloggedin');
Route::get("admin/lines/{line_id}/view_assigned_trains/edit_train_schedule_index/{train_id}", [CustomAuthController::class, 'edit_train_schedule_index'])->name('edit_train_schedule_index')->middleware('isloggedin');
Route::post("admin/lines/{line_id}/view_assigned_trains/edit_train_schedule/{train_id}", [CustomAuthController::class, 'edit_train_schedule'])->name('edit_train_schedule')->middleware('isloggedin');
Route::post("admin/lines/{line_id}/view_assigned_trains/delete_train_schedule/{train_id}", [CustomAuthController::class, 'delete_train_schedule'])->name('delete_train_schedule')->middleware('isloggedin');
Route::get("admin/lines/edit_line_index/{line_id}", [CustomAuthController::class, 'edit_line_index'])->name('edit_line_index')->middleware('isloggedin');
Route::post("admin/lines/edit_line/{line_id}", [CustomAuthController::class, 'edit_line'])->name('edit_line')->middleware('isloggedin');
Route::post("admin/lines/edit_line/delete_line/{line_id}", [CustomAuthController::class, 'delete_line'])->name('delete_line')->middleware('isloggedin');
Route::get("admin/lines/view_lines/search_lines", [CustomAuthController::class, 'search_lines'])->name('search_lines')->middleware('isloggedin');
Route::get("admin/trips", [CustomAuthController::class, 'trips_index'])->name('trips_index')->middleware('isloggedin');
Route::post("admin/trips/insert_trip", [CustomAuthController::class, 'insert_trip'])->name('insert_trip')->middleware('isloggedin');
Route::get("admin/trips/view_trips", [CustomAuthController::class, 'view_trips'])->name('view_trips')->middleware('isloggedin');
Route::get("admin/trips/view_trips/search_trips", [CustomAuthController::class, 'search_trips'])->name('search_trips')->middleware('isloggedin');
Route::get("admin/trips/edit_trip_index/{trip_id}", [CustomAuthController::class, 'edit_trip_index'])->name('edit_trip_index')->middleware('isloggedin');
Route::post("admin/trips/edit_trip/{trip_id}", [CustomAuthController::class, 'edit_trip'])->name('edit_trip')->middleware('isloggedin');
Route::post("admin/trips/edit_trip/delete_trip/{trip_id}", [CustomAuthController::class, 'delete_trip'])->name('delete_trip')->middleware('isloggedin');
Route::get("admin/customers", [CustomAuthController::class, 'customers_index'])->name('customers_index')->middleware('isloggedin');
Route::get("admin/customers/search_customers", [CustomAuthController::class, 'search_customers'])->name('search_customers')->middleware('isloggedin');
Route::get("admin/customers/delete_customer", [CustomAuthController::class, 'delete_customer'])->name('delete_customer')->middleware('isloggedin');
Route::get("admin/customers/view_booked_tickets", [CustomAuthController::class, 'view_booked_tickets'])->name('view_booked_tickets')->middleware('isloggedin');
Route::get("admin/customers/delete_booked_ticket", [CustomAuthController::class, 'delete_booked_ticket'])->name('delete_booked_ticket')->middleware('isloggedin');

##USER
Route::get("user/logout", [UserController::class, 'user_logout'])->name('user_logout')->middleware('isloggedin_user');
Route::get("user/", [UserController::class, 'user_login_index'])->name('user_login_index')->middleware('alreadyloggedin_user');
Route::post("user/login", [UserController::class, 'user_login'])->name('login_user')->middleware('alreadyloggedin_user');
Route::get("user/register_user", [UserController::class, 'user_register_index'])->name('user_register_index');
Route::post("user/register", [UserController::class, 'user_register'])->name('register_user')->middleware('alreadyloggedin_user');
Route::get("/", [UserController::class, 'user_index'])->name('user_index');
Route::get("user/contact", [UserController::class, 'user_contact'])->name('user_contact');
Route::get("user/book_index", [UserController::class, 'user_book_index'])->name('user_book_index');
Route::get("user/cancel_trip/{book_id}", [UserController::class, 'user_cancel_trip'])->name('user_cancel_trip');
Route::get("user/reschedule_trip/{book_id}", [UserController::class, 'user_reschedule_trip'])->name('user_reschedule_trip');
Route::post("user/show_available_trips", [UserController::class, 'show_available_trips'])->name('show_available_trips');
Route::get("user/today_trips", [UserController::class, 'today_trips'])->name('today_trips'); ///
Route::get("user/get_stations", [UserController::class, 'user_get_stations'])->name('user_get_stations'); ///

Route::get("user/view_booked_trips", [UserController::class, 'user_view_booked_trips'])->name('user_view_booked_trips');
Route::post("user/checkout/{stops_id}", [UserController::class, 'user_checkout'])->name('user_checkout');
Route::get("user/ticket{stops_id}", [UserController::class, 'generate_ticket'])->name('generate_ticket');
Route::get("user/news1", [UserController::class, 'news_1'])->name('news_1');
Route::get("user/news2", [UserController::class, 'news_2'])->name('news_2');
Route::get("user/news3", [UserController::class, 'news_3'])->name('news_3');
Route::get("user/submit", [UserController::class, 'submit'])->name('submit');

##EMPLOYEE
Route::get("employee/", [EmployeeController::class, 'employee_login_index'])->name('employee_login_index')->middleware('alreadyloggedin_employee');
Route::post("employee/login", [EmployeeController::class, 'employee_login'])->name('employee_login')->middleware('alreadyloggedin_employee');
Route::get("employee/dashboard", [EmployeeController::class, 'employee_index'])->middleware('isloggedin_employee');
Route::get("employee/logout", [EmployeeController::class, 'employee_logout'])->name('logout_employee')->middleware('isloggedin_employee');
Route::get("employee/search_trips", [EmployeeController::class, 'search_trips'])->name('search_trips')->middleware('isloggedin_employee');
Route::get("employee/book_trips/{trip_id}", [EmployeeController::class, 'book_trips'])->name('book_trips')->middleware('isloggedin_employee');

##CAPTAIN
Route::get("captain/", [CaptainController::class, 'captain_login_index'])->name('captain_login_index')->middleware('alreadyloggedin_captain');
Route::post("captain/login", [CaptainController::class, 'captain_login'])->name('login_captain')->middleware('alreadyloggedin_captain');
Route::get("captain/home", [CaptainController::class, 'captain_index'])->middleware('isloggedin_captain');
Route::get("captain/logout", [CaptainController::class, 'captain_logout'])->name('logout')->middleware('isloggedin_captain');
//Route::get("captain/Report", [CaptainController::class, 'captain_Report'])->name('Report');
Route::get('captainReport', function () {
    return view('captain/captainReport');
});

##Technician
Route::get("tech/logout", [TechnicianController::class, 'tech_logout'])->name('logout_tech');
Route::get("tech/", [TechnicianController::class, 'tech_login_index'])->name('tech_login_index');
Route::post("tech/login", [TechnicianController::class, 'tech_login'])->name('login_tech');
Route::get("tech/home", [TechnicianController::class, 'tech_index']);
Route::get("tech/home", [TechnicianController::class, 'view_Report'])->name('view_Report');
Route::post("tech/home/open_Report/{report_id}", [TechnicianController::class, 'Report'])->name('Report');
