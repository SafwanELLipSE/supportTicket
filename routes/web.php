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

    Route::group(['prefix' =>'ticket', 'as'=>'ticket.'], function(){
      Route::get('create',['as' =>'create','uses' =>'TicketController@createTicket' ]);
      Route::post('save-created',['as' =>'save_created','uses' =>'TicketController@saveCreated']);
      Route::get('all-tickets',['as' =>'all_tickets','uses' =>'TicketController@displayAllTickets' ]);
      Route::post('get-tickets',['as' =>'get_tickets','uses' =>'TicketController@getTickets' ]);
      Route::post('get-all-tickets',['as' =>'get_all_tickets','uses' =>'TicketController@getAllTickets' ]);
      Route::get('open-tickets',['as' =>'open_tickets','uses' =>'TicketController@displayOpenTickets' ]);
      Route::get('solved-tickets',['as' =>'solved_tickets','uses' =>'TicketController@getSolvedTickets' ]);
      Route::get('closed-tickets',['as' =>'closed_tickets','uses' =>'TicketController@getClosedTickets' ]);


    });

    Route::group(['prefix' =>'notification', 'as'=>'notification.'], function(){
      Route::get('/',['as' =>'index','uses' =>'NotificationController@index' ]);
    });
    Route::group(['prefix' =>'agent', 'as'=>'agent.'], function(){
      Route::get('create',['as' =>'create','uses' =>'UserController@createAgent' ]);
      Route::post('save-created',['as' =>'save_created','uses' =>'UserController@saveCreatedAgent' ]);
      Route::get('list',['as' =>'list','uses' =>'UserController@GetAgentList' ]);
    });
    Route::group(['prefix' =>'department', 'as'=>'department.'], function(){
        Route::get('create',['as' =>'create','uses' =>'UserController@createDepartment' ]);
        Route::post('save-created',['as' =>'save_created','uses' =>'UserController@saveCreatedDepartment' ]);
      });


  });
