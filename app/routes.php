<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('seed','SeederController@seed');
Route::get('/',function() {
	if (Auth::check())
	{
		switch(Auth::user()->user_priv)
		{
			case "8888" :
				return Redirect::to('supply');
			break;
			case "1" :
				return Redirect::to('section/table_a');
			break;
			case "0" :
				return Redirect::to('section/table_a');
			break;
			case "1111" :
				return Redirect::to('ppmp/division');
			break;			
		}
	} else {
		return Redirect::to('login');
	}
});


Route::match(['GET','POST'],'assets','AccountController@code');
Route::get('assets/menu','AccountController@asset_menu');
Route::get('view/division','AdminController@view_divisions');
Route::match(['GET','POST'],'add/division','AdminController@add_division');
Route::match(['GET','POST'],'edit/division','AdminController@edit_division');
Route::get('view/sections','AdminController@view_sections');
Route::match(['GET','POST'],'add/section','AdminController@add_section');
Route::match(['GET','POST'],'edit/section','AdminController@edit_section');
Route::get('remove/section','AdminController@remove_section');
Route::get('view/users','AdminController@view_users');
Route::match(['GET','POST'],'edit/user','AdminController@edit_user');
Route::get('remove/user','AdminController@remove_user');
Route::match(['GET','POST'],'add/user','AdminController@add_user');
Route::get('rexus/search/user','AdminController@search_user');
Route::get('rexus/search/section','AdminController@search_section');
Route::match(['GET','POST'],'arrange/pppcode','AdminController@arrange_ppcode');
Route::match(['GET','POST'],'register', 'AccountController@register');
Route::match(['GET','POST'],'reset/password','AccountController@reset_pass');
Route::match(['GET','POST'],'add/expensecodes','AdminController@add_expense_code');
Route::get('view/expensecodes','AdminController@view_expensecodes');
Route::match(['GET','POST'],'edit/uacs','AdminController@edit_uacs');
Route::get('view/years','AdminController@years');
Route::match(['GET','POST'],'add/year','AdminController@add_year');
Route::get('delete/uacs/{ppcode}','AdminController@delete_uacs');
Route::get('home','InventoryController@inventory');
Route::match(['GET','POST'],'login','AccountController@login');
Route::get('logout',function(){
	Session::flush();
	return Redirect::to('login');
});


//SUPPLY CONTROLLERS

//OFFICE SUPPLIES
Route::get('supply','SupplyController@home');
Route::get('office/supplies','SupplyController@all_items');

// PER EMPLOYEE
Route::post('save/table_a','SupplyController@save_table_a');
Route::get('get/table_a','SupplyController@get_table_a');
Route::post('delete/table_a','SupplyController@delete_table_a');

//PER SECTION

Route::post('save/table_b','SupplyController@save_table_b');
Route::get('get/table_b','SupplyController@get_table_b');
Route::post('delete/table_b','SupplyController@delete_table_b');
//TRAINING SUPPLIES

Route::post('save/table_c','SupplyController@save_table_c');
Route::get('get/table_c','SupplyController@get_table_c');
Route::post('delete/table_c','SupplyController@delete_table_c');

//EQUIPMENT CONSUMABLE
Route::post('save/table_d','SupplyController@save_table_d');
Route::get('get/table_d','SupplyController@get_table_d');
Route::post('delete/table_d','SupplyController@delete_table_d');
//NON-CONSUMABLE PER SECTION

Route::post('save/table_e','SupplyController@save_table_e');
Route::get('get/table_e','SupplyController@get_table_e');
Route::post('delete/table_e','SupplyController@delete_table_e');
//SEMI-EXPENDABLE EQUIPMENT AND FURNITURE
//PER EMPLOYEE
Route::get('get/table_f','SupplyController@get_table_f');
Route::post('save/table_f','SupplyController@save_table_f');
Route::post('delete/table_f','SupplyController@delete_table_f');
//PER SECTION DIVISION
Route::post('save/table_g','SupplyController@save_table_g');
Route::get('get/table_g','SupplyController@get_table_g');
Route::post('delete/table_g','SupplyController@delete_table_g');
//OPEN LIST FORMS

Route::post('supply/save/section/open-list','SupplyController@save_open_list');


Route::match(['GET','POST'],'log_pin','AdminController@log_pin');

//PPMP PLANING ROUTE FOR EACH SECTIONS

//Route::group(array('before' => 'pin_code'),function (){

	Route::get('get/expense','SectionController@get_expenses');
	Route::get('section/table_a','SectionController@table_a');
	Route::get('get/section/table_a','SectionController@get_table_a');
	Route::post('save/section/table_a','SectionController@save_table_a');

	Route::get('section/table_b','SectionController@table_b');
	Route::get('get/section/table_b','SectionController@get_table_b');
	Route::post('save/section/table_b','SectionController@save_table_b');

	Route::get('section/table_c','SectionController@table_c');
	Route::get('get/section/table_c','SectionController@get_table_c');
	Route::post('save/section/table_c','SectionController@save_table_c');

	Route::get('section/table_d','SectionController@table_d');
	Route::get('get/section/table_d','SectionController@get_table_d');
	Route::post('save/section/table_d','SectionController@save_table_d');
	Route::post('delete/section/table_d','SectionController@delete_table_d');

	Route::get('section/table_e','SectionController@table_e');
	Route::get('get/section/table_e','SectionController@get_table_e');
	Route::post('save/section/table_e','SectionController@save_table_e');

	Route::get('section/table_z','SectionController@table_z');
	Route::get('get/section/table_z','SectionController@get_table_z');
	Route::post('save/section/table_z','SectionController@save_table_z');
	Route::post('delete/item/table_z','SectionController@delete_table_z');

	Route::get('section/table_f','SectionController@table_f');
	Route::get('get/section/table_f','SectionController@get_table_f');
	Route::post('save/section/table_f','SectionController@save_table_f');

	Route::get('section/table_g','SectionController@table_g');
	Route::get('get/section/table_g','SectionController@get_table_g');
	Route::post('save/section/table_g','SectionController@save_table_g');


	Route::get('section/open-list/{id}','SectionController@section_openlist');
	Route::get('get/section/open-list','SectionController@get_open_list');
	Route::post('save/section/open-list','SectionController@save_open_list');

	Route::post('delete/item/open-list','SectionController@delete_item_open_list');


	Route::match(['GET','POST'],'section/current/budget','SectionController@current_budget');
	Route::match(['GET','POST'],'section/current/source-fund','SectionController@source_fund');
	Route::get('print-bydate','SectionController@print_bydate');
	//PER PROGRAM

	Route::get('section/program/venue/{program_id}/{venue_id}','SectionController@section_program');
	Route::post('save/section/program','SectionController@save_program_items');
	Route::get('get/section/program','SectionController@get_program_items');
	Route::get('delete/program/{id}','SectionController@delete_program');
	Route::post('delete/section/program','SectionController@delete_program_item');
	//Route::get('openlist/forms','S')

	//ROUTES FOR LOCAL HEALTH PROGRMS

	Route::match(['GET','POST'],'create/program','SectionController@create_program');
	Route::match(['GET','POST'],'print-program','SectionController@print_byprogram');
	Route::get('d/get/program/{ppcode}','SectionController@d_get_program');

	Route::get('item/subitem/{id}/{ppcode}','SectionController@item_subitem');
	Route::get('get/subitem','SectionController@get_subitem');
	Route::post('save/subitem','SectionController@save_subitem');
	Route::post('delete/subitem','SectionController@delete_subitem');
	
	Route::get('program-item/subitem/{program_id}/{venue_id}/{id}','SectionController@program_subitem');
	Route::get('get/program/subitem','SectionController@get_program_subitem');
	Route::post('save/program/subtitem','SectionController@save_program_subitem');
	Route::post('delete/program/subitem','SectionController@delete_program_subitem');
	
//});

//DIVISION ROUTES

Route::get('ppmp/division','DivisionController@index');
Route::get('get/sections','DivisionController@sections');

Route::get('get/division/table_a','DivisionController@get_table_a');
Route::match(['GET','POST'],'division/source_fund','DivisionController@source_fund');

Route::get('division/table_a','DivisionController@table_a');
Route::get('division/table_b','DivisionController@table_b');
Route::get('division/table_c','DivisionController@table_c');
Route::get('division/table_d','DivisionController@table_d');
Route::get('division/table_e','DivisionController@table_e');
Route::get('division/table_z','DivisionController@table_z');
Route::get('division/table_f','DivisionController@table_f');
Route::get('division/table_g','DivisionController@table_g');
Route::get('division/open-list/{id}','DivisionController@open_list_items');
Route::get('division/open-list/expense-amount/{id}','DivisionController@open_list_expense_amt');
Route::get('get/division/open_list_exp/{ppcode}','DivisionController@get_open_list_expense_amt');
Route::post('save/division/open_list_exp','DivisionController@save_open_list_expense_amt');
Route::get('division/delete/open-list/{id}','DivisionController@delete_item');
Route::get('division/delete/{code}','DivisionController@delete_item_code');
Route::get('division/program/venue/{program}/{venue}/{section}','DivisionController@program_venue');


Route::get('units','SupplyController@units');
Route::get('d/unit','SupplyController@d_unit');
Route::match(['GET','POST'],'n/unit', 'SupplyController@n_unit');
Route::match(['GET','POST'],'e/unit','SupplyController@e_unit');

Route::get('user/section',function(){
	$section = DB::table('section')->where('short','=', Input::get('section'))->first();
	$users = DB::table('users')->where('section','=',$section->id)->get(['username']);
	return $users;
});

Route::get('clear',function(){
	Session::flush();
	return Redirect::to('login');
});


//PRINT 

Route::get('table_f/print','PrintController@print_table_f');
Route::get('other_common_used','PrintController@other_common_used');
Route::get('print_openlist/{ppcode}','PrintController@print_open_list');
Route::get('table_g/print','PrintController@print_table_g');


//MIGRATIONS

Route::get('sub_item','MigrationsController@index');

?>


