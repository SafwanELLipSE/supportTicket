<?php

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

Route::get('/', function () {
    return redirect('home');
});

Auth::routes();



Route::group(['middleware' => ['auth']], function () {
    Route::get('/logout', ['uses' => 'Auth\LoginController@logout']);
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/profile',['as' =>'profile','uses' =>'ProfileController@profileView']);
    Route::get('edit/{id}',['as' =>'edit','uses' =>'ProfileController@profileEdit' ]);
    Route::post('save-edit',['as' =>'save_edit','uses' =>'ProfileController@profileUpdate']);

    Route::group(['prefix' =>'ticket', 'as'=>'ticket.'], function(){
      Route::get('create',['as' =>'create','uses' =>'TicketController@createTicket' ]);
      Route::post('save-created',['as' =>'save_created','uses' =>'TicketController@saveCreated']);
      Route::get('all-tickets',['as' =>'all_tickets','uses' =>'TicketController@displayAllTickets' ]);
      Route::post('get-tickets',['as' =>'get_tickets','uses' =>'TicketController@getTickets' ]);
      Route::post('get-all-tickets',['as' =>'get_all_tickets','uses' =>'TicketController@getAllTickets' ]);
      Route::get('open-tickets',['as' =>'open_tickets','uses' =>'TicketController@displayOpenTickets' ]);
      Route::get('solved-tickets',['as' =>'solved_tickets','uses' =>'TicketController@getSolvedTickets' ]);
      Route::get('closed-tickets',['as' =>'closed_tickets','uses' =>'TicketController@getClosedTickets' ]);
      Route::get('display/{id}', ['as' => 'display','uses' => 'TicketController@displayTicket']);
      Route::post('save-comments/{id}',['as' =>'save_comments','uses' =>'TicketController@saveCommentsOnTicket']);
      Route::post('assign-ticket',['as' =>'assign_ticket','uses' =>'TicketController@assignTicket']);
      Route::post('staging-ticket-status',['as' =>'staging_ticket_status','uses' =>'TicketController@changeTicketStatus']);
      Route::post('staging-employee-status',['as' =>'staging_employee_status','uses' =>'TicketController@changeEmployeeStatus']);
      Route::get('upload-file/{id}', ['as' => 'upload_file','uses' => 'TicketController@displayUploadedFile']);
      Route::post('download-file',['as' =>'download_file','uses' =>'TicketController@downloadUploadFile']);
    });

    Route::group(['prefix' =>'notification', 'as'=>'notification.'], function(){
      Route::get('/',['as' =>'index','uses' =>'NotificationController@index' ]);
    });

    Route::group(['prefix' =>'agent', 'as'=>'agent.'], function(){
      Route::get('create',['as' =>'create','uses' =>'UserController@createAgent' ]);
      Route::post('save-created',['as' =>'save_created','uses' =>'UserController@saveCreatedAgent' ]);
      Route::get('list',['as' =>'list','uses' =>'UserController@GetAgentList' ]);
      Route::get('profile/{id}',['as' =>'profile','uses' =>'UserController@agentProfile' ]);
      Route::post('assign-department',['as' =>'assign_department','uses' =>'UserController@assignDepartmentToEmployee']);
      Route::post('inactive',['as' =>'inactive','uses' =>'UserController@inactiveAgentDepartment']);
      Route::get('edit/{id}',['as' =>'edit','uses' =>'UserController@editAgent' ]);
      Route::post('save-edit',['as' =>'save_edit','uses' =>'UserController@updateAgent']);
      Route::post('active',['as' =>'active','uses' =>'UserController@activeAgentDepartment']);
    });

    Route::group(['prefix' =>'department', 'as'=>'department.'], function(){
        Route::get('create',['as' =>'create','uses' =>'UserController@createDepartment' ]);
        Route::post('save-created',['as' =>'save_created','uses' =>'UserController@saveCreatedDepartment' ]);
        Route::get('all-departments',['as' =>'all_departments','uses' =>'UserController@getDepartmentList' ]);
        Route::get('details/{id}',['as' =>'details','uses' =>'UserController@detailDepartment' ]);
        Route::post('add-category',['as' =>'add_category','uses' =>'UserController@addCategoryDepartment' ]);
        Route::get('edit/{id}',['as' =>'edit','uses' =>'UserController@editDepartment' ]);
        Route::post('save-edit',['as' =>'save_edit','uses' =>'UserController@updateDepartment']);
      });

    Route::group(['prefix' =>'employee', 'as'=>'employee.'], function(){
        Route::get('create',['as' =>'create','uses' =>'EmployeeController@createEmployee' ]);
        Route::post('save-created',['as' =>'save_created','uses' =>'EmployeeController@saveCreatedEmployee' ]);
        Route::get('all-employees',['as' =>'all_employees','uses' =>'EmployeeController@getEmployeeList' ]);
        Route::get('details/{id}',['as' =>'details','uses' =>'EmployeeController@detailEmployee' ]);
        Route::get('edit/{id}',['as' =>'edit','uses' =>'EmployeeController@editEmployee' ]);
        Route::post('save-edit',['as' =>'save_edit','uses' =>'EmployeeController@updateEmployee']);
      });


  });
