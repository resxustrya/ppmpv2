<?php

class PrintController extends BaseController{

    public function __construct()
    {
        $this->beforeFilter('auth');
    }

    public function other_common_used(){

        $table_z = DB::table('table_z')
                        ->where('created_by','=',Auth::user()->section)
                        ->where('division','=',Auth::user()->division)
                        ->get();
        return View::make('section.print.print_table_z',['table_z' => $table_z,'head' => 'Other common used office supplies']);
    }

    public function print_open_list($ppcode){
        $d = DB::table('ppmp_code')->where('id','=',$ppcode)->first();
        Session::put('page',$d->expense_name);

        $items = DB::table('open_list')
                ->where('created_by','=',Auth::user()->section)
                ->where('ppcode','=',$ppcode)
                ->groupBy(array('item','unit'))
                ->orderBy('item','ASC')
                ->where('item','<>','')
                ->get();
        
        $data['items'] = $items;
        $data['ppcode'] = $ppcode;
        $data['head'] = $d->expense_name;
        $data['form_action'] = asset('print/print_openlist.php');
        return View::make('section.print.print_openlist',$data);
    }

    public function print_table_f(){
        $table_f = DB::table('table_f')
                        ->where('created_by','=',Auth::user()->section)
                        ->orWhere('created_by','=','8888')
                        ->groupBy('item')
                        ->get();
                        
        return View::make('section.print.table_f',['table_f' => $table_f,'head' => 'SEMI-EXPANDABLE EQUIPEMENT AND FURNITURE > Per Employee']);
    }

    public function print_table_g()
    {
        $table_g = DB::table('table_g')
                        ->where('created_by','=',Auth::user()->section)
                        ->orWhere('created_by','=','8888')
                        ->groupBy('item')
                        ->get();
                        
        return View::make('section.print.table_g',['table_g' => $table_g,'head' => 'SEMI-EXPANDABLE EQUIPEMENT AND FURNITURE > Per Section / Division']);
    }
    
}


?>