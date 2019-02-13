<?php

/**
 * Created by PhpStorm.
 * User: hahahehe
 * Date: 9/14/2017
 * Time: 11:33 AM
 */
class SupplyController extends BaseController
{
    public function __construct()
    {
        $this->beforeFilter('auth');
    }

    public function home()
    {
        return View::make('supply.items.items');
    }

    public function units()
    {
        $units = DB::table('unit')->paginate('20');
        return View::make('supply.units.units', ['units' => $units]);
    }

    public function d_unit()
    {
        $id = Input::get('id');
        DB::table('unit')->where('id', '=', $id)->delete();
        return Redirect::to('units');
    }

    public function n_unit()
    {
        if (Request::method() == "GET") {
            return View::make('supply.units.new-unit');
        }
        if (Request::method() == "POST") {
            $data['unitcode'] = Input::get('unit-code');
            $data['unit'] = Input::get('unit-desc');
            DB::table('unit')->insert($data);
            return Redirect::to('units');
        }
    }

    public function save_table_a()
    {
        //DB::table('table_a')->where('created_by','=',Auth::user()->section)->delete();
        $data = Input::get('data');
        $decoded = json_decode($data);
        $input = array();
        foreach ($decoded as $d) {
            if($d[0]){
                $d[4] = $d[4] > 0 ? $d[4] : NULL;
                $d[6] = $d[6] > 0 ? $d[6] : NULL;
                $d[8] = $d[8] > 0 ? $d[8] : NULL;
                $d[10] = $d[10] > 0 ? $d[10] : NULL;
                $item['item'] = $d[1];
                $item['unit'] = $d[2];
                $item['q1_amt'] = $d[4];
                $item['q2_amt'] = $d[6];
                $item['q3_amt'] = $d[8];
                $item['q4_amt'] = $d[10];
                DB::table('table_a')->where('item','=', $d[1])->update($item);
            }else{
                if($d[1] AND $d[2]) {
                    $code = DB::table('code')->first();
                    $insert = "code,ppcode,item,unit,q1_amt,q2_amt,q3_amt,q4_amt,created_by,date_added";
                    $mark = "?,?,?,?,?,?,?,?,?,?";
                    
                    $d[4] = $d[4] > 0 ? $d[4] : NULL;
                    $d[6] = $d[6] > 0 ? $d[6] : NULL;
                    $d[8] = $d[8] > 0 ? $d[8] : NULL;
                    $d[10] = $d[10] > 0 ? $d[10] : NULL;
                    $input = array($code->code, 1,$d[1],$d[2],$d[4],$d[6],$d[8],$d[10],Auth::user()->section,date('Y-m-d'));
                    $query = "INSERT IGNORE INTO table_a($insert) VALUES($mark)";
                    DB::insert($query,$input);
                    DB::table('code')->increment('code');
                }
            }
            
        }
        return 1;
    }
    
    public function get_table_a()
    {
        $data = array();
        $pdo = DB::connection()->getPdo();
        $query = "SELECT code,item,unit,";
        $query.= "q1_qty,q1_amt,q2_qty,q2_amt,q3_qty,q3_amt,q4_qty,q4_amt ";
        $query.= "FROM table_a WHERE created_by = '" .Auth::user()->section ."' GROUP BY item ORDER BY item ASC";
        $st = $pdo->prepare($query);
        $st->execute();
        $row = $st->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($row as $r):
            $r['q1_qty'] = $r['q1_qty'] > 0 ? number_format( $r['q1_qty']) : NULL;
            $r['q1_amt'] = $r['q1_amt'] > 0 ? number_format( $r['q1_amt'],2) : NULL;
            $r['q2_qty'] = $r['q2_qty'] > 0 ? number_format( $r['q2_qty']) : NULL;
            $r['q2_amt'] = $r['q2_amt'] > 0 ? number_format( $r['q2_amt'],2) : NULL;
            $r['q3_qty'] = $r['q3_qty'] > 0 ? number_format( $r['q3_qty']) : NULL;
            $r['q3_amt'] = $r['q3_amt'] > 0 ? number_format( $r['q3_amt'],2) : NULL;
            $r['q4_qty'] = $r['q4_qty'] > 0 ? number_format( $r['q4_qty']) : NULL;
            $r['q4_amt'] = $r['q4_amt'] > 0 ? number_format( $r['q4_amt'],2) : NULL;
            $data[] = array($r['code'],$r['item'],$r['unit'],$r['q1_qty'],$r['q1_amt'],$r['q2_qty'],$r['q2_amt'],$r['q3_qty'],$r['q3_amt'],$r['q4_qty'],$r['q4_amt']);
        endforeach;
        if(count($data)<= 0){
            $data[] = array(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
        }
        return json_encode($data);
    }
    public function delete_table_a()
    {
        $item = Input::get('item');
        DB::table('table_a')->where('item','=',$item)->delete();
        return 1;
    }
    public function save_table_b()
    {
        //DB::table('table_b')->where('created_by','=',Auth::user()->section)->delete();
        $data = Input::get('data');
        $decoded = json_decode($data);
        $input = array();
        foreach ($decoded as $d) {
            if($d[0]){
                $d[4] = $d[4] > 0 ? $d[4] : NULL;
                $d[6] = $d[6] > 0 ? $d[6] : NULL;
                $d[8] = $d[8] > 0 ? $d[8] : NULL;
                $d[10] = $d[10] > 0 ? $d[10] : NULL;
                $item['item'] = $d[1];
                $item['unit'] = $d[2];
                $item['q1_amt'] = $d[4];
                $item['q2_amt'] = $d[6];
                $item['q3_amt'] = $d[8];
                $item['q4_amt'] = $d[10];
                DB::table('table_b')->where('item','=', $d[1])->update($item);
            }else{
                if($d[1] AND $d[2]) {
                    $code = DB::table('code')->first();
                    $insert = "code,ppcode,item,unit,q1_amt,q2_amt,q3_amt,q4_amt,created_by,date_added";
                    $mark = "?,?,?,?,?,?,?,?,?,?";
                    
                    $d[4] = $d[4] > 0 ? $d[4] : NULL;
                    $d[6] = $d[6] > 0 ? $d[6] : NULL;
                    $d[8] = $d[8] > 0 ? $d[8] : NULL;
                    $d[10] = $d[10] > 0 ? $d[10] : NULL;
                    $input = array($code->code, 1,$d[1],$d[2],$d[4],$d[6],$d[8],$d[10],Auth::user()->section,date('Y-m-d'));
                    $query = "INSERT IGNORE INTO table_b($insert) VALUES($mark)";
                    DB::insert($query,$input);
                    DB::table('code')->increment('code');
                }
            }
        }
        return 1;
    }

    public function get_table_b()
    {
        $data = array();
        $pdo = DB::connection()->getPdo();
        $query = "SELECT code,item,unit,";
        $query.= "q1_qty,q1_amt,q2_qty,q2_amt,q3_qty,q3_amt,q4_qty,q4_amt ";
        $query.= "FROM table_b WHERE created_by = '" .Auth::user()->section ."' GROUP BY item ORDER BY item ASC";
        $st = $pdo->prepare($query);
        $st->execute();
        $row = $st->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($row as $r):
            $r['q1_qty'] = $r['q1_qty'] > 0 ? number_format( $r['q1_qty']) : NULL;
            $r['q1_amt'] = $r['q1_amt'] > 0 ? number_format( $r['q1_amt'],2) : NULL;
            $r['q2_qty'] = $r['q2_qty'] > 0 ? number_format( $r['q2_qty']) : NULL;
            $r['q2_amt'] = $r['q2_amt'] > 0 ? number_format( $r['q2_amt'],2) : NULL;
            $r['q3_qty'] = $r['q3_qty'] > 0 ? number_format( $r['q3_qty']) : NULL;
            $r['q3_amt'] = $r['q3_amt'] > 0 ? number_format( $r['q3_amt'],2) : NULL;
            $r['q4_qty'] = $r['q4_qty'] > 0 ? number_format( $r['q4_qty']) : NULL;
            $r['q4_amt'] = $r['q4_amt'] > 0 ? number_format( $r['q4_amt'],2) : NULL;
            $data[] = array($r['code'],$r['item'],$r['unit'],$r['q1_qty'],$r['q1_amt'],$r['q2_qty'],$r['q2_amt'],$r['q3_qty'],$r['q3_amt'],$r['q4_qty'],$r['q4_amt']);
        endforeach;
        return json_encode($data);
    }
    
    public function delete_table_b()
    {
        $item = Input::get('item');
        DB::table('table_b')->where('item','=',$item)->delete();
        return 1;
    }

    public function save_table_c()
    {
        //DB::table('table_c')->where('created_by','=',Auth::user()->section)->delete();
        $data = Input::get('data');
        $decoded = json_decode($data);
        $input = array();
        foreach ($decoded as $d) {
            if($d[0]){
                $d[4] = $d[4] > 0 ? $d[4] : NULL;
                $d[6] = $d[6] > 0 ? $d[6] : NULL;
                $d[8] = $d[8] > 0 ? $d[8] : NULL;
                $d[10] = $d[10] > 0 ? $d[10] : NULL;
                $item['item'] = $d[1];
                $item['unit'] = $d[2];
                $item['q1_amt'] = $d[4];
                $item['q2_amt'] = $d[6];
                $item['q3_amt'] = $d[8];
                $item['q4_amt'] = $d[10];
                DB::table('table_c')->where('item','=', $d[1])->update($item);
            }else{
                if($d[1] AND $d[2]) {
                    $code = DB::table('code')->first();
                    $insert = "code,ppcode,item,unit,q1_amt,q2_amt,q3_amt,q4_amt,created_by,date_added";
                    $mark = "?,?,?,?,?,?,?,?,?,?";
                    
                    $d[4] = $d[4] > 0 ? $d[4] : NULL;
                    $d[6] = $d[6] > 0 ? $d[6] : NULL;
                    $d[8] = $d[8] > 0 ? $d[8] : NULL;
                    $d[10] = $d[10] > 0 ? $d[10] : NULL;
                    $input = array($code->code, 1,$d[1],$d[2],$d[4],$d[6],$d[8],$d[10],Auth::user()->section,date('Y-m-d'));
                    $query = "INSERT IGNORE INTO table_c($insert) VALUES($mark)";
                    DB::insert($query,$input);
                    DB::table('code')->increment('code');
                }
            }
        }
        return 1;
    }

    public function get_table_c()
    {
        $data = array();
        $pdo = DB::connection()->getPdo();
        $query = "SELECT code,item,unit,";
        $query.= "q1_qty,q1_amt,q2_qty,q2_amt,q3_qty,q3_amt,q4_qty,q4_amt ";
        $query.= "FROM table_c WHERE created_by = '" .Auth::user()->section ."' GROUP BY item ORDER BY item ASC";
        $st = $pdo->prepare($query);
        $st->execute();
        $row = $st->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($row as $r):
            $r['q1_qty'] = $r['q1_qty'] > 0 ? number_format( $r['q1_qty']) : NULL;
            $r['q1_amt'] = $r['q1_amt'] > 0 ? number_format( $r['q1_amt'],2) : NULL;
            $r['q2_qty'] = $r['q2_qty'] > 0 ? number_format( $r['q2_qty']) : NULL;
            $r['q2_amt'] = $r['q2_amt'] > 0 ? number_format( $r['q2_amt'],2) : NULL;
            $r['q3_qty'] = $r['q3_qty'] > 0 ? number_format( $r['q3_qty']) : NULL;
            $r['q3_amt'] = $r['q3_amt'] > 0 ? number_format( $r['q3_amt'],2) : NULL;
            $r['q4_qty'] = $r['q4_qty'] > 0 ? number_format( $r['q4_qty']) : NULL;
            $r['q4_amt'] = $r['q4_amt'] > 0 ? number_format( $r['q4_amt'],2) : NULL;
            $data[] = array($r['code'],$r['item'],$r['unit'],$r['q1_qty'],$r['q1_amt'],$r['q2_qty'],$r['q2_amt'],$r['q3_qty'],$r['q3_amt'],$r['q4_qty'],$r['q4_amt']);
        endforeach;
        return json_encode($data);
    }

    public function delete_table_c()
    {
        $code = Input::get('data');
        DB::table('table_c')->where('code','=',$code)->delete();
        return 1;
    }

    public function save_table_d()
    {
        $data = Input::get('data');
        $decoded = json_decode($data);
        $input = array();
        foreach ($decoded as $d) {
            if($d[0]) {

                $d[4] = $d[4] > 0 ? $d[4] : NULL;
                $d[6] = $d[6] > 0 ? $d[6] : NULL;
                $d[8] = $d[8] > 0 ? $d[8] : NULL;
                $d[10] = $d[10] > 0 ? $d[10] : NULL;
                $item['item'] = $d[1];
                $item['unit'] = $d[2];
                $item['q1_amt'] = $d[4];
                $item['q2_amt'] = $d[6];
                $item['q3_amt'] = $d[8];
                $item['q4_amt'] = $d[10];
                DB::table('table_d')->where('item','=', $d[1])->update($item);
            } else {
                if($d[1] AND $d[2] AND $d[4]) {
                    $code = DB::table('code')->first();
                    $insert = "code,ppcode,item,unit,q1_amt,q2_amt,q3_amt,q4_amt,created_by,date_added";
                    $mark = "?,?,?,?,?,?,?,?,?,?";
                    
                    $d[4] = $d[4] > 0 ? $d[4] : NULL;
                    $d[6] = $d[6] > 0 ? $d[6] : NULL;
                    $d[8] = $d[8] > 0 ? $d[8] : NULL;
                    $d[10] = $d[10] > 0 ? $d[10] : NULL;
                    $input = array($code->code, 1,$d[1],$d[2],$d[4],$d[6],$d[8],$d[10],Auth::user()->section,date('Y-m-d'));
                    $query = "INSERT IGNORE INTO table_d($insert) VALUES($mark)";
                    DB::insert($query,$input);
                    DB::table('code')->increment('code');
                }
            }
        }
        return 1;
    }

    public function get_table_d()
    {
        $data = array();
        $pdo = DB::connection()->getPdo();
        $query = "SELECT code,item,unit,";
        $query.= "q1_qty,q1_amt,q2_qty,q2_amt,q3_qty,q3_amt,q4_qty,q4_amt ";
        $query.= "FROM table_d GROUP BY item ORDER BY item ASC";
        $st = $pdo->prepare($query);
        $st->execute();
        $row = $st->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($row as $r):
            $r['q1_qty'] = $r['q1_qty'] > 0 ? number_format( $r['q1_qty']) : NULL;
            $r['q1_amt'] = $r['q1_amt'] > 0 ? number_format( $r['q1_amt'],2) : NULL;
            $r['q2_qty'] = $r['q2_qty'] > 0 ? number_format( $r['q2_qty']) : NULL;
            $r['q2_amt'] = $r['q2_amt'] > 0 ? number_format( $r['q2_amt'],2) : NULL;
            $r['q3_qty'] = $r['q3_qty'] > 0 ? number_format( $r['q3_qty']) : NULL;
            $r['q3_amt'] = $r['q3_amt'] > 0 ? number_format( $r['q3_amt'],2) : NULL;
            $r['q4_qty'] = $r['q4_qty'] > 0 ? number_format( $r['q4_qty']) : NULL;
            $r['q4_amt'] = $r['q4_amt'] > 0 ? number_format( $r['q4_amt'],2) : NULL;
            $data[] = array($r['code'],$r['item'],$r['unit'],$r['q1_qty'],$r['q1_amt'],$r['q2_qty'],$r['q2_amt'],$r['q3_qty'],$r['q3_amt'],$r['q4_qty'],$r['q4_amt']);
        endforeach;
        return json_encode($data);
    }

    public function delete_table_d()
    {
        $code = Input::get('data');
        DB::table('table_d')->where('code','=',$code)->delete();
        return 1;
    }
    public function save_table_e()
    {
        //DB::table('table_e')->where('created_by','=',Auth::user()->section)->delete();
        $data = Input::get('data');
        $decoded = json_decode($data);
        $input = array();
        foreach ($decoded as $d) {
            if($d[0]){
                $d[4] = $d[4] > 0 ? $d[4] : NULL;
                $d[6] = $d[6] > 0 ? $d[6] : NULL;
                $d[8] = $d[8] > 0 ? $d[8] : NULL;
                $d[10] = $d[10] > 0 ? $d[10] : NULL;
                $item['item'] = $d[1];
                $item['unit'] = $d[2];
                $item['q1_amt'] = $d[4];
                $item['q2_amt'] = $d[6];
                $item['q3_amt'] = $d[8];
                $item['q4_amt'] = $d[10];
                
                DB::table('table_e')->where('item','=', $d[1])->update($item);
            }
            if($d[1] AND $d[2] ) {
                $code = DB::table('code')->first();
                $insert = "code,ppcode,item,unit,q1_amt,q2_amt,q3_amt,q4_amt,created_by,date_added";
                $mark = "?,?,?,?,?,?,?,?,?,?";
                
                $d[4] = $d[4] > 0 ? $d[4] : NULL;
                $d[6] = $d[6] > 0 ? $d[6] : NULL;
                $d[8] = $d[8] > 0 ? $d[8] : NULL;
                $d[10] = $d[10] > 0 ? $d[10] : NULL;
                $input = array($code->code, 1,$d[1],$d[2],$d[4],$d[6],$d[8],$d[10],Auth::user()->section,date('Y-m-d'));
                $query = "INSERT IGNORE INTO table_e($insert) VALUES($mark)";
                DB::insert($query,$input);
                DB::table('code')->increment('code');
            }
        }
        return 1;
    }

    public function get_table_e()
    {
        $data = array();
        $pdo = DB::connection()->getPdo();
        $query = "SELECT code,item,unit,";
        $query.= "q1_qty,q1_amt,q2_qty,q2_amt,q3_qty,q3_amt,q4_qty,q4_amt ";
        $query.= "FROM table_e GROUP BY item ORDER BY item ASC";
        $st = $pdo->prepare($query);
        $st->execute();
        $row = $st->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($row as $r):
            $r['q1_qty'] = $r['q1_qty'] > 0 ? number_format( $r['q1_qty']) : NULL;
            $r['q1_amt'] = $r['q1_amt'] > 0 ? number_format( $r['q1_amt'],2) : NULL;
            $r['q2_qty'] = $r['q2_qty'] > 0 ? number_format( $r['q2_qty']) : NULL;
            $r['q2_amt'] = $r['q2_amt'] > 0 ? number_format( $r['q2_amt'],2) : NULL;
            $r['q3_qty'] = $r['q3_qty'] > 0 ? number_format( $r['q3_qty']) : NULL;
            $r['q3_amt'] = $r['q3_amt'] > 0 ? number_format( $r['q3_amt'],2) : NULL;
            $r['q4_qty'] = $r['q4_qty'] > 0 ? number_format( $r['q4_qty']) : NULL;
            $r['q4_amt'] = $r['q4_amt'] > 0 ? number_format( $r['q4_amt'],2) : NULL;
            $data[] = array($r['code'],$r['item'],$r['unit'],$r['q1_qty'],$r['q1_amt'],$r['q2_qty'],$r['q2_amt'],$r['q3_qty'],$r['q3_amt'],$r['q4_qty'],$r['q4_amt']);
        endforeach;
        return json_encode($data);
    }   

    public function delete_table_e()
    {
        $code = Input::get('data');
        DB::table('table_e')->where('code','=',$code)->delete();
        return 1;
    }
    public function get_table_f()
    {
        $data = array();
        $pdo = DB::connection()->getPdo();
        $query = "SELECT code,item,unit,";
        $query.= "q1_qty,q1_amt,q2_qty,q2_amt,q3_qty,q3_amt,q4_qty,q4_amt ";
        $query.= "FROM table_f GROUP BY item ORDER BY item ASC";
        $st = $pdo->prepare($query);
        $st->execute();
        $row = $st->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($row as $r):
            $r['q1_qty'] = $r['q1_qty'] > 0 ? number_format( $r['q1_qty']) : NULL;
            $r['q1_amt'] = $r['q1_amt'] > 0 ? number_format( $r['q1_amt'],2) : NULL;
            $r['q2_qty'] = $r['q2_qty'] > 0 ? number_format( $r['q2_qty']) : NULL;
            $r['q2_amt'] = $r['q2_amt'] > 0 ? number_format( $r['q2_amt'],2) : NULL;
            $r['q3_qty'] = $r['q3_qty'] > 0 ? number_format( $r['q3_qty']) : NULL;
            $r['q3_amt'] = $r['q3_amt'] > 0 ? number_format( $r['q3_amt'],2) : NULL;
            $r['q4_qty'] = $r['q4_qty'] > 0 ? number_format( $r['q4_qty']) : NULL;
            $r['q4_amt'] = $r['q4_amt'] > 0 ? number_format( $r['q4_amt'],2) : NULL;
            $data[] = array($r['code'],$r['item'],$r['unit'],$r['q1_qty'],$r['q1_amt'],$r['q2_qty'],$r['q2_amt'],$r['q3_qty'],$r['q3_amt'],$r['q4_qty'],$r['q4_amt']);
        endforeach;
        return json_encode($data);
    }

    public function save_table_f()
    {
        //DB::table('table_f')->where('created_by','=',Auth::user()->section)->delete();
        $data = Input::get('data');
        $decoded = json_decode($data);
        $input = array();
        foreach ($decoded as $d) {
            if($d[0]) {
                
                $d[4] = $d[4] > 0 ? $d[4] : NULL;
                $d[6] = $d[6] > 0 ? $d[6] : NULL;
                $d[8] = $d[8] > 0 ? $d[8] : NULL;
                $d[10] = $d[10] > 0 ? $d[10] : NULL;
                $item['item'] = $d[1];
                $item['unit'] = $d[2];
                $item['q1_amt'] = $d[4];
                $item['q2_amt'] = $d[6];
                $item['q3_amt'] = $d[8];
                $item['q4_amt'] = $d[10];
                DB::table('table_f')->where('item','=', $d[1])->update($item);
            } else {
                if($d[1] AND $d[2]) {
                    $code = DB::table('code')->first();
                    $insert = "code,ppcode,item,unit,q1_amt,q2_amt,q3_amt,q4_amt,created_by,date_added";
                    $mark = "?,?,?,?,?,?,?,?,?,?";
                    
                    $d[4] = $d[4] > 0 ? $d[4] : NULL;
                    $d[6] = $d[6] > 0 ? $d[6] : NULL;
                    $d[8] = $d[8] > 0 ? $d[8] : NULL;
                    $d[10] = $d[10] > 0 ? $d[10] : NULL;
                    $input = array($code->code, 1,$d[1],$d[2],$d[4],$d[6],$d[8],$d[10],Auth::user()->section,date('Y-m-d'));
                    $query = "INSERT IGNORE INTO table_f($insert) VALUES($mark)";
                    DB::insert($query,$input);
                    DB::table('code')->increment('code');
                }
            }
        }
        return 1;
    }

    public function delete_table_f()
    {
        $code = Input::get('data');
        DB::table('table_f')->where('code','=',$code)->delete();
        return 1;
    }
    public function get_table_g()
    {
        $data = array();
        $pdo = DB::connection()->getPdo();
        $query = "SELECT code,item,unit,";
        $query.= "q1_qty,q1_amt,q2_qty,q2_amt,q3_qty,q3_amt,q4_qty,q4_amt ";
        $query.= "FROM table_g GROUP BY item ORDER BY item ASC";
        $st = $pdo->prepare($query);
        $st->execute();
        $row = $st->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($row as $r):
            $r['q1_qty'] = $r['q1_qty'] > 0 ? number_format( $r['q1_qty']) : NULL;
            $r['q1_amt'] = $r['q1_amt'] > 0 ? number_format( $r['q1_amt'],2) : NULL;
            $r['q2_qty'] = $r['q2_qty'] > 0 ? number_format( $r['q2_qty']) : NULL;
            $r['q2_amt'] = $r['q2_amt'] > 0 ? number_format( $r['q2_amt'],2) : NULL;
            $r['q3_qty'] = $r['q3_qty'] > 0 ? number_format( $r['q3_qty']) : NULL;
            $r['q3_amt'] = $r['q3_amt'] > 0 ? number_format( $r['q3_amt'],2) : NULL;
            $r['q4_qty'] = $r['q4_qty'] > 0 ? number_format( $r['q4_qty']) : NULL;
            $r['q4_amt'] = $r['q4_amt'] > 0 ? number_format( $r['q4_amt'],2) : NULL;
            $data[] = array($r['code'],$r['item'],$r['unit'],$r['q1_qty'],$r['q1_amt'],$r['q2_qty'],$r['q2_amt'],$r['q3_qty'],$r['q3_amt'],$r['q4_qty'],$r['q4_amt']);
        endforeach;
        return json_encode($data);
    }

    public function save_table_g()
    {
        $data = Input::get('data');
        $decoded = json_decode($data);
        $input = array();
        foreach ($decoded as $d) {
            if($d[0]) {
                
                $d[4] = $d[4] > 0 ? $d[4] : NULL;
                $d[6] = $d[6] > 0 ? $d[6] : NULL;
                $d[8] = $d[8] > 0 ? $d[8] : NULL;
                $d[10] = $d[10] > 0 ? $d[10] : NULL;
                $item['item'] = $d[1];
                $item['unit'] = $d[2];
                $item['q1_amt'] = $d[4];
                $item['q2_amt'] = $d[6];
                $item['q3_amt'] = $d[8];
                $item['q4_amt'] = $d[10];
                DB::table('table_g')->where('item','=', $d[1])->update($item);
            } else {
                if($d[1] AND $d[2]) {
                    $code = DB::table('code')->first();
                    $insert = "code,ppcode,item,unit,q1_amt,q2_amt,q3_amt,q4_amt,created_by,date_added";
                    $mark = "?,?,?,?,?,?,?,?,?,?";
                    
                    $d[4] = $d[4] > 0 ? $d[4] : NULL;
                    $d[6] = $d[6] > 0 ? $d[6] : NULL;
                    $d[8] = $d[8] > 0 ? $d[8] : NULL;
                    $d[10] = $d[10] > 0 ? $d[10] : NULL;
                    $input = array($code->code, 1,$d[1],$d[2],$d[4],$d[6],$d[8],$d[10],Auth::user()->section,date('Y-m-d'));
                    $query = "INSERT IGNORE INTO table_g($insert) VALUES($mark)";
                    DB::insert($query,$input);
                    DB::table('code')->increment('code');
                }
            }
        }
        return 1;
    }
    
    public function save_open_list()
    {

        $ppcode = Input::get('expense');
        //$test = DB::table('open_list')->where('created_by','=',Auth::user()->section)->where('ppcode','=',$ppcode)->delete();
        $data = Input::get('data');
        $decoded = json_decode($data);
        
        foreach($decoded as $d):
            if($d[0]) {
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
                    ->where('created_by','=',Auth::user()->division)
                    ->update($item);
            }

        endforeach;

        return 1;
    }
    public function delete_table_g()
    {
        $code = Input::get('data');
        DB::table('table_g')->where('code','=',$code)->delete();
        return 1;
    }

    public function table_code($table)
    {
        $data = DB::table($table)->groupBy('item')->get();
        foreach($data as $d)
        {
            $code = DB::table('code')->orderBy('code','DESC')->first();
            DB::table('code')->increment('code');
            DB::table($table)->where('item','=',$d->item)->update(['code' => $code]);
        }
        return 'ok';
    }
}
