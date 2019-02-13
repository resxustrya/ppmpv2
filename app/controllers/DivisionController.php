<?php

class DivisionController extends BaseController
{
    public function __construct()
    {
        $this->beforeFilter('division');
    }

    public function index()
    {
        return View::make('division.cons2');
    }   

    public function source_fund()
    {
        if(Request::method() == "GET"){
            return View::make('division.source_fund');
        }
        if(Request::method() == "POST") {
            DB::table('division')->where('id','=', Auth::user()->division)->update(['source_fund' => Input::get('source_fund')]);
            return Redirect::to('ppmp/division');
        }
    }
    
    public function table_a()
    {
        return View::make('division.form.table_a');
    }

    public function table_b()
    {
        return View::make('division.form.table_b');
    }
    public function table_c()
    {
        return View::make('division.form.table_c');
    }
    public function table_d()
    {
        return View::make('division.form.table_d');
    }
    public function table_e()
    {
        return View::make('division.form.table_e');
    }

    public function table_z()
    {
        return View::make('division.form.table_z');
    }
    public function table_f()
    {
        return View::make('division.form.table_f');
    }
    public function table_g()
    {
        return View::make('division.form.table_g');
    }
    public function open_list_items($id)
    {
        return View::make('division.form.open_list',['ppcode' => $id]);
    }

    public function delete_item($id)
    {
        $items = DB::table('open_list')
                    ->where('created_by','=',Auth::user()->division)
                    ->where('ppcode','=',$id)
                    ->groupBy('item')
                    ->orderBy('item')
                    ->get();
        return View::make('division.form.delete_items',['items' => $items]);
    }
    
    public function delete_item_code($code)
    {
        DB::table('open_list')->where('created_by','=',Auth::user()->division)->where('code','=',$code)->delete();
    }
    public function open_list_expense_amt($id)
    {
        return View::make('division.form.open_list_exp_amount',['ppcode' => $id]);
    }
    public function get_open_list_expense_amt($ppcode)
    {
        return $this->json_get_open_list_expense_amt($ppcode);
    }
    
    public function json_get_open_list_expense_amt($ppcode)
    {
        $data = array();
        $items = DB::table('open_list')
            ->where('division','=',Auth::user()->division)
            ->where('created_by','=','0000-'.Auth::user()->division)
            ->where('ppcode','=',$ppcode)
            ->orderBy('item','ASC')
            ->where('item','<>','')
            ->get();
        if($items) {
            foreach($items as $item)
            {
                $total = ( $item->q1_qty * $item->q1_amt) + ($item->q2_qty * $item->q2_amt) + ($item->q3_qty * $item->q3_amt) + ($item->q4_qty * $item->q4_amt);
                $total = $total > 0 ? number_format($total,2) : NULL;
                $item->q1_qty = $item->q1_qty > 0 ? number_format( $item->q1_qty) : NULL;
                $item->q1_amt = $item->q1_amt > 0 ? number_format( $item->q1_amt) : NULL;
                $item->q2_qty = $item->q2_qty > 0 ? number_format( $item->q2_qty) : NULL;
                $item->q2_amt = $item->q2_amt > 0 ? number_format( $item->q2_amt) : NULL;
                $item->q3_qty = $item->q3_qty > 0 ? number_format( $item->q3_qty) : NULL;
                $item->q3_amt = $item->q3_amt > 0 ? number_format( $item->q3_amt) : NULL;
                $item->q4_qty = $item->q4_qty > 0 ? number_format( $item->q4_qty) : NULL;
                $item->q4_amt = $item->q4_amt > 0 ? number_format( $item->q4_amt) : NULL;
                $data[] = array($item->code,$item->item,$item->unit,$item->q1_qty,$item->q1_amt,$item->q2_qty,$item->q2_amt,$item->q3_qty,$item->q3_amt,$item->q4_qty,$item->q4_amt,$total);
            }
        } else {
            $ppcode = DB::table('ppmp_code')->where('id','=',$ppcode)->first();
            $data[] = array(NULL,$ppcode->expense_name,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
        }
        return json_encode($data);
    }

    public function save_open_list_expense_amt()
    {
        $ppcode = Input::get('ppcode');
        //$test = DB::table('open_list')->where('created_by','=',Auth::user()->section)->where('ppcode','=',$ppcode)->delete();
        
        $data = Input::get('data');
        $decoded = json_decode($data);
        
        
        $insert = null;
        $amount = null;
        $q1_qty = NULL;
        $q2_qty = NULL;
        $q3_qty = NULL;
        $q4_qty = NULL;

        $q1_amt = NULL;
        $q2_amt = NULL;
        $q3_amt = NULL;
        $q4_amt = NULL;
        foreach ($decoded as $d):
            if ($d[0]) {
                if ($d[1]) {
                    $item['item'] = $d[1];
                    $item['unit'] = $d[2];
                    $item['q1_amt'] = $d[4] > 0 ? $d[4] : NULL;
                    $item['q2_amt'] = $d[6] > 0 ? $d[6] : NULL;
                    $item['q3_amt'] = $d[8] > 0 ? $d[8] : NULL;
                    $item['q4_amt'] = $d[10] > 0 ? $d[10] : NULL;

                    
                    
                    $item['q1_qty'] = $d[3] > 0 ? $d[3] : NULL;
                    $item['q2_qty'] = $d[5] > 0 ? $d[5] : NULL;
                    $item['q3_qty'] = $d[7] > 0 ? $d[7] : NULL;
                    $item['q4_qty'] = $d[9] > 0 ? $d[9] : NULL;
                    
                    DB::table('open_list')
                            ->where('ppcode','=',$ppcode)
                            ->where('code','=',$d[0])
                            ->where('division','=',Auth::user()->division)
                            ->where('created_by','=','0000-'.Auth::user()->division)
                            ->update($item);
                }
            } else {
                if ($d[1] AND $d[2]) {
                    $code = DB::table('code')->orderBy('code','DESC')->first();
                    DB::table('code')->increment('code');
                    
                    $insert = "code,ppcode,item,unit,q1_qty,q2_qty,q3_qty,q4_qty,q1_amt,q2_amt,q3_amt,q4_amt,created_by,division";
                    $mark = "?,?,?,?,?,?,?,?,?,?,?,?,?,?";

                    $q1_amt = $d[4] > 0 ? $d[4] : NULL;
                    $q2_amt = $d[6] > 0 ? $d[6] : NULL;
                    $q3_amt = $d[8] > 0 ? $d[8] : NULL;
                    $q4_amt = $d[10] > 0 ? $d[10] : NULL;

                    $q1_qty = $d[3] > 0 ? $d[3] : NULL;
                    $q2_qty = $d[5] > 0 ? $d[5] : NULL;
                    $q3_qty = $d[7] > 0 ? $d[7] : NULL;
                    $q4_qty = $d[9] > 0 ? $d[9] : NULL;
                    $input = array($code->code,$ppcode,$d[1],$d[2],$q1_qty,$q2_qty,$q3_qty,$q4_qty,$q1_amt,$q2_amt,$q3_amt,$q4_amt,'0000-'.Auth::user()->division,Auth::user()->division);
                    $query = "INSERT IGNORE INTO open_list($insert) VALUES($mark)";
                    try{
                        DB::insert($query,$input);
                    }catch(SqlException $ex){return $ex->getMessage();}
                }
            }
        endforeach;
        return $this->json_get_open_list_expense_amt($ppcode);
    }
    public function view_expense($id)
    {
        return $id;
    }
    
    public function program_venue($program, $venue,$section)
    {
        $program_items = DB::table('program_items')
                            ->where('program_id','=',$program)
                            ->where('venue_id','=',$venue)
                            ->where('created_by','=',$section)
                            ->get();
        $data['program'] = DB::table('program_name')->where('id','=',$program)->first()->name;
        $data['venue'] = DB::table('training_venue')->where('id','=',$venue)->first()->venue;
        $data['program_items'] = $program_items;
        $data['section'] = DB::table('section')->where('id','=',$section)->first()->description;          
        return View::make('division.form.program_items',['data' => $data]);                         
    }
}
?>