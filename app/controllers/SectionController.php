<?php

/**
 * Created by PhpStorm.
 * User: hahahehe
 * Date: 9/27/2017
 * Time: 12:29 PM
 */
class SectionController extends BaseController
{
    public function __construct()
    {
        $this->beforeFilter('auth');
    }
    
    public function pin_code(){
        return true;
    }
    public function form_plan()
    {
        return View::make('section.form_plan');
    }
    
    public function get_expenses()
    {
        $count = DB::table('ppmp_code')->where('id','<>','1')->where('id','<>','2')->count();
        return $count;
    }
    
    public function table_a()
    {
        Session::put('page','Office Supplies | Consumable | Per Employee');
        return View::make('section.form.table_a');
    }
    public function get_table_a()
    {

        $data = array();
        $pdo = DB::connection()->getPdo();
        $query = "SELECT code,item,unit,";
        $query.= "q1_qty,q1_amt,q2_qty,q2_amt,q3_qty,q3_amt,q4_qty,q4_amt ";
        $query.= "FROM table_a WHERE created_by = '". Auth::user()->section ."' OR created_by = '8888' GROUP BY item ORDER BY item ASC";
        $st = $pdo->prepare($query);
        $st->execute();
        $row = $st->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($row as $r):
            $total = ( $r['q1_qty'] * $r['q1_amt']) + ($r['q2_qty'] * $r['q2_amt']) + ($r['q3_qty'] * $r['q3_amt']) + ($r['q4_qty'] * $r['q4_amt']);
            $total = $total > 0 ? number_format($total,2) : NULL;
            $r['q1_qty'] = $r['q1_qty'] > 0 ? number_format( $r['q1_qty']) : NULL;
            $r['q1_amt'] = $r['q1_amt'] > 0 ? number_format( $r['q1_amt'],2) : NULL;
            $r['q2_qty'] = $r['q2_qty'] > 0 ? number_format( $r['q2_qty']) : NULL;
            $r['q2_amt'] = $r['q2_amt'] > 0 ? number_format( $r['q2_amt'],2) : NULL;
            $r['q3_qty'] = $r['q3_qty'] > 0 ? number_format( $r['q3_qty']) : NULL;
            $r['q3_amt'] = $r['q3_amt'] > 0 ? number_format( $r['q3_amt'],2) : NULL;
            $r['q4_qty'] = $r['q4_qty'] > 0 ? number_format( $r['q4_qty']) : NULL;
            $r['q4_amt'] = $r['q4_amt'] > 0 ? number_format( $r['q4_amt'],2) : NULL;
            $data[] = array($r['code'],$r['item'],$r['unit'],$r['q1_qty'],$r['q1_amt'],$r['q2_qty'],$r['q2_amt'],$r['q3_qty'],$r['q3_amt'],$r['q4_qty'],$r['q4_amt'],$total);
        endforeach;
        return json_encode($data);
    }

    public function save_table_a()
    {
        DB::table('table_a')->where('created_by','=',Auth::user()->section)->delete();
        $data = Input::get('data');
        $decoded = json_decode($data);
        foreach ($decoded as $d) {
            $insert = "code,ppcode,item,unit,q1_qty,q2_qty,q3_qty,q4_qty,q1_amt,q2_amt,q3_amt,q4_amt,created_by,date_added";
            $mark = "?,?,?,?,?,?,?,?,?,?,?,?,?,?";
            
            $d[3] = $d[3] > 0 ? $d[3] : NULL;
            $d[5] = $d[5] > 0 ? $d[5] : NULL;
            $d[7] = $d[7] > 0 ? $d[7] : NULL;
            $d[9] = $d[9] > 0 ? $d[9] : NULL;
            
            $d[4] = $d[4] > 0 ? $d[4] : NULL;
            $d[6] = $d[6] > 0 ? $d[6] : NULL;
            $d[8] = $d[8] > 0 ? $d[8] : NULL;
            $d[10] = $d[10] > 0 ? $d[10] : NULL;
            $input = array($d[0],1,$d[1],$d[2],$d[3],$d[5],$d[7],$d[9],$d[4],$d[6],$d[8],$d[10],Auth::user()->section,date('Y-m-d'));
            $query = "INSERT IGNORE INTO table_a($insert) VALUES($mark)";
            DB::insert($query,$input);
        }
        return $this->get_table_a();
    }

    public function table_b()
    {
        Session::put('page','Office Supplies | Consumable | Per Section');
        return View::make('section.form.table_b');
    }
    public function get_table_b()
    {
        $data = array();
        $pdo = DB::connection()->getPdo();
        $query = "SELECT code,item,unit,";
        $query.= "q1_qty,q1_amt,q2_qty,q2_amt,q3_qty,q3_amt,q4_qty,q4_amt ";
        $query.= "FROM table_b WHERE created_by = '". Auth::user()->section ."' OR created_by = '8888' GROUP BY item ORDER BY item ASC";
        $st = $pdo->prepare($query);
        $st->execute();
        $row = $st->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($row as $r):
            $total = ( $r['q1_qty'] * $r['q1_amt']) + ($r['q2_qty'] * $r['q2_amt']) + ($r['q3_qty'] * $r['q3_amt']) + ($r['q4_qty'] * $r['q4_amt']);
            $total = $total > 0 ? number_format($total,2) : NULL;
            $r['q1_qty'] = $r['q1_qty'] > 0 ? number_format( $r['q1_qty']) : NULL;
            $r['q1_amt'] = $r['q1_amt'] > 0 ? number_format( $r['q1_amt'],2) : NULL;
            $r['q2_qty'] = $r['q2_qty'] > 0 ? number_format( $r['q2_qty']) : NULL;
            $r['q2_amt'] = $r['q2_amt'] > 0 ? number_format( $r['q2_amt'],2) : NULL;
            $r['q3_qty'] = $r['q3_qty'] > 0 ? number_format( $r['q3_qty']) : NULL;
            $r['q3_amt'] = $r['q3_amt'] > 0 ? number_format( $r['q3_amt'],2) : NULL;
            $r['q4_qty'] = $r['q4_qty'] > 0 ? number_format( $r['q4_qty']) : NULL;
            $r['q4_amt'] = $r['q4_amt'] > 0 ? number_format( $r['q4_amt'],2) : NULL;
            $data[] = array($r['code'],$r['item'],$r['unit'],$r['q1_qty'],$r['q1_amt'],$r['q2_qty'],$r['q2_amt'],$r['q3_qty'],$r['q3_amt'],$r['q4_qty'],$r['q4_amt'],$total);
        endforeach;
        return json_encode($data);
    }
    public function save_table_b()
    {
        DB::table('table_b')->where('created_by','=',Auth::user()->section)->delete();
        $data = Input::get('data');
        $decoded = json_decode($data);
        foreach ($decoded as $d) {
            
            $insert = "code,ppcode,item,unit,q1_qty,q2_qty,q3_qty,q4_qty,q1_amt,q2_amt,q3_amt,q4_amt,created_by,date_added";
            $mark = "?,?,?,?,?,?,?,?,?,?,?,?,?,?";
            
            $d[3] = $d[3] > 0 ? $d[3] : NULL;
            $d[5] = $d[5] > 0 ? $d[5] : NULL;
            $d[7] = $d[7] > 0 ? $d[7] : NULL;
            $d[9] = $d[9] > 0 ? $d[9] : NULL;
            
            $d[4] = $d[4] > 0 ? $d[4] : NULL;
            $d[6] = $d[6] > 0 ? $d[6] : NULL;
            $d[8] = $d[8] > 0 ? $d[8] : NULL;
            $d[10] = $d[10] > 0 ? $d[10] : NULL;
            $input = array($d[0],1,$d[1],$d[2],$d[3],$d[5],$d[7],$d[9],$d[4],$d[6],$d[8],$d[10],Auth::user()->section,date('Y-m-d'));
            $query = "INSERT IGNORE INTO table_b($insert) VALUES($mark)";
            DB::insert($query,$input);
        }
        return $this->get_table_b();
    }
    public function table_c()
    {
        Session::put('page','Office Supplies | Consumable | Training Supplies');
        return View::make('section.form.table_c');
    }
    public function get_table_c()
    {
        $data = array();
        $pdo = DB::connection()->getPdo();
        $query = "SELECT code,item,unit,";
        $query.= "q1_qty,q1_amt,q2_qty,q2_amt,q3_qty,q3_amt,q4_qty,q4_amt ";
        $query.= "FROM table_c WHERE created_by = '". Auth::user()->section ."' OR created_by = '8888' GROUP BY item ORDER BY item ASC";
        $st = $pdo->prepare($query);
        $st->execute();
        $row = $st->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($row as $r):
            $total = ( $r['q1_qty'] * $r['q1_amt']) + ($r['q2_qty'] * $r['q2_amt']) + ($r['q3_qty'] * $r['q3_amt']) + ($r['q4_qty'] * $r['q4_amt']);
            $total = $total > 0 ? number_format($total,2) : NULL;
            $r['q1_qty'] = $r['q1_qty'] > 0 ? number_format( $r['q1_qty']) : NULL;
            $r['q1_amt'] = $r['q1_amt'] > 0 ? number_format( $r['q1_amt'],2) : NULL;
            $r['q2_qty'] = $r['q2_qty'] > 0 ? number_format( $r['q2_qty']) : NULL;
            $r['q2_amt'] = $r['q2_amt'] > 0 ? number_format( $r['q2_amt'],2) : NULL;
            $r['q3_qty'] = $r['q3_qty'] > 0 ? number_format( $r['q3_qty']) : NULL;
            $r['q3_amt'] = $r['q3_amt'] > 0 ? number_format( $r['q3_amt'],2) : NULL;
            $r['q4_qty'] = $r['q4_qty'] > 0 ? number_format( $r['q4_qty']) : NULL;
            $r['q4_amt'] = $r['q4_amt'] > 0 ? number_format( $r['q4_amt'],2) : NULL;
            $data[] = array($r['code'],$r['item'],$r['unit'],$r['q1_qty'],$r['q1_amt'],$r['q2_qty'],$r['q2_amt'],$r['q3_qty'],$r['q3_amt'],$r['q4_qty'],$r['q4_amt'],$total);
        endforeach;
        return json_encode($data);
    }
    public function save_table_c()
    {
        DB::table('table_c')->where('created_by','=',Auth::user()->section)->delete();
        $data = Input::get('data');
        $decoded = json_decode($data);
        foreach ($decoded as $d) {
            
            $insert = "code,ppcode,item,unit,q1_qty,q2_qty,q3_qty,q4_qty,q1_amt,q2_amt,q3_amt,q4_amt,created_by,date_added";
            $mark = "?,?,?,?,?,?,?,?,?,?,?,?,?,?";
            
            $d[3] = $d[3] > 0 ? $d[3] : NULL;
            $d[5] = $d[5] > 0 ? $d[5] : NULL;
            $d[7] = $d[7] > 0 ? $d[7] : NULL;
            $d[9] = $d[9] > 0 ? $d[9] : NULL;
            
            $d[4] = $d[4] > 0 ? $d[4] : NULL;
            $d[6] = $d[6] > 0 ? $d[6] : NULL;
            $d[8] = $d[8] > 0 ? $d[8] : NULL;
            $d[10] = $d[10] > 0 ? $d[10] : NULL;
            $input = array($d[0],1,$d[1],$d[2],$d[3],$d[5],$d[7],$d[9],$d[4],$d[6],$d[8],$d[10],Auth::user()->section,date('Y-m-d'));
            $query = "INSERT IGNORE INTO table_c($insert) VALUES($mark)";
            DB::insert($query,$input);
        }
        return $this->get_table_c();
    }

    public function table_d()
    {
        Session::put('page','Office Supplies | Consumable | Equipment Consumable');
        return View::make('section.form.table_d');
    }

    public function get_table_d()
    {
        $data = array();
        $pdo = DB::connection()->getPdo();
        $query = "SELECT code,item,unit,";
        $query.= "q1_qty,q1_amt,q2_qty,q2_amt,q3_qty,q3_amt,q4_qty,q4_amt ";
        $query.= "FROM table_d WHERE created_by = '". Auth::user()->section ."' GROUP BY item ORDER BY item ASC";
        $st = $pdo->prepare($query);
        $st->execute();
        $row = $st->fetchAll(PDO::FETCH_ASSOC);


        foreach($row as $r):
            $total = ( $r['q1_qty'] * $r['q1_amt']) + ($r['q2_qty'] * $r['q2_amt']) + ($r['q3_qty'] * $r['q3_amt']) + ($r['q4_qty'] * $r['q4_amt']);
            $total = $total > 0 ? number_format($total,2) : NULL;
            $r['q1_qty'] = $r['q1_qty'] > 0 ? number_format( $r['q1_qty']) : NULL;
            $r['q1_amt'] = $r['q1_amt'] > 0 ? number_format( $r['q1_amt'],2) : NULL;
            $r['q2_qty'] = $r['q2_qty'] > 0 ? number_format( $r['q2_qty']) : NULL;
            $r['q2_amt'] = $r['q2_amt'] > 0 ? number_format( $r['q2_amt'],2) : NULL;
            $r['q3_qty'] = $r['q3_qty'] > 0 ? number_format( $r['q3_qty']) : NULL;
            $r['q3_amt'] = $r['q3_amt'] > 0 ? number_format( $r['q3_amt'],2) : NULL;
            $r['q4_qty'] = $r['q4_qty'] > 0 ? number_format( $r['q4_qty']) : NULL;
            $r['q4_amt'] = $r['q4_amt'] > 0 ? number_format( $r['q4_amt'],2) : NULL;
            $data[] = array($r['code'],$r['item'],$r['unit'],$r['q1_qty'],$r['q1_amt'],$r['q2_qty'],$r['q2_amt'],$r['q3_qty'],$r['q3_amt'],$r['q4_qty'],$r['q4_amt'],$total);
        endforeach;
        return json_encode($data);
    }
    public function save_table_d()
    {
        $data = Input::get('data');
        $decoded = json_decode($data);
        $sections = DB::table('section')->where('division','=',Auth::user()->division)->get();
        $q1_qty = NULL;
        $q2_qty = NULL;
        $q3_qty = NULL;
        $q4_qty = NULL;

        $q1_amt = NULL;
        $q2_amt = NULL;
        $q3_amt = NULL;
        $q4_amt = NULL;
        foreach ($decoded as $d) {

            if ($d[0]) {
                if ($d[1] AND $d[2]) {

                    $item['item'] = $d[1];
                    $item['unit'] = $d[2];
                    $item['q1_amt'] = $d[4] > 0 ? $d[4] : NULL;
                    $item['q2_amt'] = $d[6] > 0 ? $d[6] : NULL;
                    $item['q3_amt'] = $d[8] > 0 ? $d[8] : NULL;
                    $item['q4_amt'] = $d[10] > 0 ? $d[10] : NULL;

                    DB::table('table_d')
                            ->where('code','=',$d[0])
                            ->update($item);

                    $qty['q1_qty'] = $d[3] > 0 ? $d[3] : NULL;
                    $qty['q2_qty'] = $d[5] > 0 ? $d[5] : NULL;
                    $qty['q3_qty'] = $d[7] > 0 ? $d[7] : NULL;
                    $qty['q4_qty'] = $d[9] > 0 ? $d[9] : NULL;
                    
                    DB::table('table_d')
                            ->where('code','=',$d[0])
                            ->where('created_by','=',Auth::user()->section)
                            ->update($qty);
                }
            } else {

                if ($d[1] AND $d[2]) {
                    
                    $code = DB::table('code')->orderBy('code','DESC')->first();
                    DB::table('code')->increment('code');
                    foreach($sections as $section):
                        $insert = "code,ppcode,item,unit,q1_qty,q2_qty,q3_qty,q4_qty,q1_amt,q2_amt,q3_amt,q4_amt,created_by,date_added,division";
                        $mark = "?,?,?,?,?,?,?,?,?,?,?,?,?,?,?";

                        $q1_amt = $d[4] > 0 ? $d[4] : NULL;
                        $q2_amt = $d[6] > 0 ? $d[6] : NULL;
                        $q3_amt = $d[8] > 0 ? $d[8] : NULL;
                        $q4_amt = $d[10] > 0 ? $d[10] : NULL;

                        if(Auth::user()->section == $section->id){
                            $q1_qty = $d[3] > 0 ? $d[3] : NULL;
                            $q2_qty = $d[5] > 0 ? $d[5] : NULL;
                            $q3_qty = $d[7] > 0 ? $d[7] : NULL;
                            $q4_qty = $d[9] > 0 ? $d[9] : NULL;
                            $input = array($code->code,1,$d[1],$d[2],$q1_qty,$q2_qty,$q3_qty,$q4_qty,$q1_amt,$q2_amt,$q3_amt,$q4_amt,$section->id,date('Y-m-d'),Auth::user()->division);
                            $query = "INSERT IGNORE INTO table_d($insert) VALUES($mark)";
                            try{
                                DB::insert($query,$input);
                            }catch(SqlException $ex){}
                        } else {
                            $q1_qty = NULL;
                            $q2_qty = NULL;
                            $q3_qty = NULL;
                            $q4_qty = NULL;

                            $input = array($code->code,1,$d[1],$d[2],$q1_qty,$q2_qty,$q3_qty,$q4_qty,$q1_amt,$q2_amt,$q3_amt,$q4_amt,$section->id,date('Y-m-d'),Auth::user()->division);
                            $query = "INSERT IGNORE INTO table_d($insert) VALUES($mark)";
                            try{
                                DB::insert($query,$input);
                            }catch(SqlException $ex){}
                        }
                    endforeach;
                }
            }
        }
        return $this->get_table_d();
    }
    public function table_e()
    {
        Session::put('page','Office Supplies | Non-Consumable | Per Section');
        return View::make('section.form.table_e');
    }
    public function get_table_e()
    {
        $data = array();
        $pdo = DB::connection()->getPdo();
        $query = "SELECT code,item,unit,";
        $query.= "q1_qty,q1_amt,q2_qty,q2_amt,q3_qty,q3_amt,q4_qty,q4_amt ";
        $query.= "FROM table_e WHERE created_by = '". Auth::user()->section ."' OR created_by = '8888' GROUP BY item ORDER BY item ASC";
        $st = $pdo->prepare($query);
        $st->execute();
        $row = $st->fetchAll(PDO::FETCH_ASSOC);

        foreach($row as $r):
            $total = ( $r['q1_qty'] * $r['q1_amt']) + ($r['q2_qty'] * $r['q2_amt']) + ($r['q3_qty'] * $r['q3_amt']) + ($r['q4_qty'] * $r['q4_amt']);
            $total = $total > 0 ? number_format($total,2) : NULL;
            $r['q1_qty'] = $r['q1_qty'] > 0 ? number_format( $r['q1_qty']) : NULL;
            $r['q1_amt'] = $r['q1_amt'] > 0 ? number_format( $r['q1_amt'],2) : NULL;
            $r['q2_qty'] = $r['q2_qty'] > 0 ? number_format( $r['q2_qty']) : NULL;
            $r['q2_amt'] = $r['q2_amt'] > 0 ? number_format( $r['q2_amt'],2) : NULL;
            $r['q3_qty'] = $r['q3_qty'] > 0 ? number_format( $r['q3_qty']) : NULL;
            $r['q3_amt'] = $r['q3_amt'] > 0 ? number_format( $r['q3_amt'],2) : NULL;
            $r['q4_qty'] = $r['q4_qty'] > 0 ? number_format( $r['q4_qty']) : NULL;
            $r['q4_amt'] = $r['q4_amt'] > 0 ? number_format( $r['q4_amt'],2) : NULL;
            $data[] = array($r['code'],$r['item'],$r['unit'],$r['q1_qty'],$r['q1_amt'],$r['q2_qty'],$r['q2_amt'],$r['q3_qty'],$r['q3_amt'],$r['q4_qty'],$r['q4_amt'],$total);
        endforeach;
        return json_encode($data);
    }
    public function save_table_e()
    {
        DB::table('table_e')->where('created_by','=',Auth::user()->section)->delete();
        $data = Input::get('data');
        $decoded = json_decode($data);
        foreach ($decoded as $d) {

            $insert = "code,ppcode,item,unit,q1_qty,q2_qty,q3_qty,q4_qty,q1_amt,q2_amt,q3_amt,q4_amt,created_by,date_added";
            $mark = "?,?,?,?,?,?,?,?,?,?,?,?,?,?";

            $d[3] = $d[3] > 0 ? $d[3] : NULL;
            $d[5] = $d[5] > 0 ? $d[5] : NULL;
            $d[7] = $d[7] > 0 ? $d[7] : NULL;
            $d[9] = $d[9] > 0 ? $d[9] : NULL;
            $d[4] = $d[4] > 0 ? $d[4] : NULL;
            $d[6] = $d[6] > 0 ? $d[6] : NULL;
            $d[8] = $d[8] > 0 ? $d[8] : NULL;
            $d[10] = $d[10] > 0 ? $d[10] : NULL;
            $input = array($d[0],1,$d[1],$d[2],$d[3],$d[5],$d[7],$d[9],$d[4],$d[6],$d[8],$d[10],Auth::user()->section,date('Y-m-d'));
            $query = "INSERT IGNORE INTO table_e($insert) VALUES($mark)";
            DB::insert($query,$input);
        }
        return $this->get_table_e();
    }

    public function table_z()
    {
        Session::put('page','Office Supplies | OTHER COMMON-USE OFFICE SUPPLIES SPECIFICALLY USED ONLY BY CONCERENED SECTION');
        return View::make('section.form.table_z');
    }

    public function get_table_z()
    {
        $data = array();
        $pdo = DB::connection()->getPdo();
        $query = "SELECT code,item,unit,";
        $query.= "q1_qty,q1_amt,q2_qty,q2_amt,q3_qty,q3_amt,q4_qty,q4_amt ";
        $query.= "FROM table_z WHERE created_by = '". Auth::user()->section ."' GROUP BY item ORDER BY item ASC";
        $st = $pdo->prepare($query);
        $st->execute();
        $row = $st->fetchAll(PDO::FETCH_ASSOC);

        if(count($row) > 0) {
            foreach($row as $r):
                $total = ( $r['q1_qty'] * $r['q1_amt']) + ($r['q2_qty'] * $r['q2_amt']) + ($r['q3_qty'] * $r['q3_amt']) + ($r['q4_qty'] * $r['q4_amt']);
                $total = $total > 0 ? number_format($total,2) : NULL;
                $r['q1_qty'] = $r['q1_qty'] > 0 ? number_format( $r['q1_qty']) : NULL;
                $r['q1_amt'] = $r['q1_amt'] > 0 ? number_format( $r['q1_amt'],2) : NULL;
                $r['q2_qty'] = $r['q2_qty'] > 0 ? number_format( $r['q2_qty']) : NULL;
                $r['q2_amt'] = $r['q2_amt'] > 0 ? number_format( $r['q2_amt'],2) : NULL;
                $r['q3_qty'] = $r['q3_qty'] > 0 ? number_format( $r['q3_qty']) : NULL;
                $r['q3_amt'] = $r['q3_amt'] > 0 ? number_format( $r['q3_amt'],2) : NULL;
                $r['q4_qty'] = $r['q4_qty'] > 0 ? number_format( $r['q4_qty']) : NULL;
                $r['q4_amt'] = $r['q4_amt'] > 0 ? number_format( $r['q4_amt'],2) : NULL;
                $data[] = array($r['code'],$r['item'],$r['unit'],$r['q1_qty'],$r['q1_amt'],$r['q2_qty'],$r['q2_amt'],$r['q3_qty'],$r['q3_amt'],$r['q4_qty'],$r['q4_amt'],$total);
            endforeach;
        } else {
            $data[] = array(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
        }
        
        return json_encode($data);
    }

    public function save_table_z()
    {
        $data = Input::get('data');
        $decoded = json_decode($data);
        $sections = DB::table('section')->where('division','=',Auth::user()->division)->get();
        $q1_qty = NULL;
        $q2_qty = NULL;
        $q3_qty = NULL;
        $q4_qty = NULL;

        $q1_amt = NULL;
        $q2_amt = NULL;
        $q3_amt = NULL;
        $q4_amt = NULL;
        foreach ($decoded as $d) {
            if ($d[0]) {
                if ($d[1] AND $d[2]) {

                    $item['item'] = $d[1];
                    $item['unit'] = $d[2];
                    $item['q1_amt'] = $d[4] > 0 ? $d[4] : NULL;
                    $item['q2_amt'] = $d[6] > 0 ? $d[6] : NULL;
                    $item['q3_amt'] = $d[8] > 0 ? $d[8] : NULL;
                    $item['q4_amt'] = $d[10] > 0 ? $d[10] : NULL;

                    DB::table('table_z')
                            ->where('code','=',$d[0])
                            ->update($item);

                    $qty['q1_qty'] = $d[3] > 0 ? $d[3] : NULL;
                    $qty['q2_qty'] = $d[5] > 0 ? $d[5] : NULL;
                    $qty['q3_qty'] = $d[7] > 0 ? $d[7] : NULL;
                    $qty['q4_qty'] = $d[9] > 0 ? $d[9] : NULL;
                    
                    DB::table('table_z')
                            ->where('code','=',$d[0])
                            ->where('created_by','=',Auth::user()->section)
                            ->update($qty);
                }
            } else {

                if ($d[1] AND $d[2]) {
                    
                    $code = DB::table('code')->orderBy('code','DESC')->first();
                    DB::table('code')->increment('code');
                    foreach($sections as $section):
                        $insert = "code,ppcode,item,unit,q1_qty,q2_qty,q3_qty,q4_qty,q1_amt,q2_amt,q3_amt,q4_amt,created_by,date_added,division";
                        $mark = "?,?,?,?,?,?,?,?,?,?,?,?,?,?,?";

                        $q1_amt = $d[4] > 0 ? $d[4] : NULL;
                        $q2_amt = $d[6] > 0 ? $d[6] : NULL;
                        $q3_amt = $d[8] > 0 ? $d[8] : NULL;
                        $q4_amt = $d[10] > 0 ? $d[10] : NULL;

                        if(Auth::user()->section == $section->id){
                            $q1_qty = $d[3] > 0 ? $d[3] : NULL;
                            $q2_qty = $d[5] > 0 ? $d[5] : NULL;
                            $q3_qty = $d[7] > 0 ? $d[7] : NULL;
                            $q4_qty = $d[9] > 0 ? $d[9] : NULL;
                            $input = array($code->code,1,$d[1],$d[2],$q1_qty,$q2_qty,$q3_qty,$q4_qty,$q1_amt,$q2_amt,$q3_amt,$q4_amt,$section->id,date('Y-m-d'),Auth::user()->division);
                            $query = "INSERT IGNORE INTO table_z($insert) VALUES($mark)";
                            try{
                                DB::insert($query,$input);
                            }catch(SqlException $ex){}
                        } else {
                            $q1_qty = NULL;
                            $q2_qty = NULL;
                            $q3_qty = NULL;
                            $q4_qty = NULL;

                            $input = array($code->code,1,$d[1],$d[2],$q1_qty,$q2_qty,$q3_qty,$q4_qty,$q1_amt,$q2_amt,$q3_amt,$q4_amt,$section->id,date('Y-m-d'),Auth::user()->division);
                            $query = "INSERT IGNORE INTO table_z($insert) VALUES($mark)";
                            try{
                                DB::insert($query,$input);
                            }catch(SqlException $ex){}
                        }
                    endforeach;
                }
            }
        }
        return $this->get_table_z();
    }

    public function table_f()
    {
        Session::put('page','SEMI-EXPANDABLE EQUIPEMENT AND FURNITURE | Per Employee');
        return View::make('section.form.table_f');
    }
    public function get_table_f()
    {
        $data = array();
        $pdo = DB::connection()->getPdo();
        $query = "SELECT code,item,unit,";
        $query.= "q1_qty,q1_amt,q2_qty,q2_amt,q3_qty,q3_amt,q4_qty,q4_amt ";
        $query.= "FROM table_f WHERE created_by = '". Auth::user()->section ."' OR created_by = '8888' GROUP BY item ORDER BY item ASC";
        $st = $pdo->prepare($query);
        $st->execute();
        $row = $st->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($row as $r):
            $total = ( $r['q1_qty'] * $r['q1_amt']) + ($r['q2_qty'] * $r['q2_amt']) + ($r['q3_qty'] * $r['q3_amt']) + ($r['q4_qty'] * $r['q4_amt']);
            $total = $total > 0 ? number_format($total,2) : NULL;
            $r['q1_qty'] = $r['q1_qty'] > 0 ? number_format( $r['q1_qty']) : NULL;
            $r['q1_amt'] = $r['q1_amt'] > 0 ? number_format( $r['q1_amt'],2) : NULL;
            $r['q2_qty'] = $r['q2_qty'] > 0 ? number_format( $r['q2_qty']) : NULL;
            $r['q2_amt'] = $r['q2_amt'] > 0 ? number_format( $r['q2_amt'],2) : NULL;
            $r['q3_qty'] = $r['q3_qty'] > 0 ? number_format( $r['q3_qty']) : NULL;
            $r['q3_amt'] = $r['q3_amt'] > 0 ? number_format( $r['q3_amt'],2) : NULL;
            $r['q4_qty'] = $r['q4_qty'] > 0 ? number_format( $r['q4_qty']) : NULL;
            $r['q4_amt'] = $r['q4_amt'] > 0 ? number_format( $r['q4_amt'],2) : NULL;
            $data[] = array($r['code'],$r['item'],$r['unit'],$r['q1_qty'],$r['q1_amt'],$r['q2_qty'],$r['q2_amt'],$r['q3_qty'],$r['q3_amt'],$r['q4_qty'],$r['q4_amt'],$total);
        endforeach;
        return json_encode($data);
    }
    public function save_table_f()
    {
        DB::table('table_f')->where('created_by','=',Auth::user()->section)->delete();
        $data = Input::get('data');
        $decoded = json_decode($data);
        foreach ($decoded as $d) {
            
            $insert = "code,ppcode,item,unit,q1_qty,q2_qty,q3_qty,q4_qty,q1_amt,q2_amt,q3_amt,q4_amt,created_by,date_added";
            $mark = "?,?,?,?,?,?,?,?,?,?,?,?,?,?";
            
            $d[3] = $d[3] > 0 ? $d[3] : NULL;
            $d[5] = $d[5] > 0 ? $d[5] : NULL;
            $d[7] = $d[7] > 0 ? $d[7] : NULL;
            $d[9] = $d[9] > 0 ? $d[9] : NULL;
            
            $d[4] = $d[4] > 0 ? $d[4] : NULL;
            $d[6] = $d[6] > 0 ? $d[6] : NULL;
            $d[8] = $d[8] > 0 ? $d[8] : NULL;
            $d[10] = $d[10] > 0 ? $d[10] : NULL;
            $input = array($d[0],1,$d[1],$d[2],$d[3],$d[5],$d[7],$d[9],$d[4],$d[6],$d[8],$d[10],Auth::user()->section,date('Y-m-d'));
            $query = "INSERT IGNORE INTO table_f($insert) VALUES($mark)";
            DB::insert($query,$input);
        }
        return $this->get_table_f();
    }

    public function table_g()
    {
        Session::put('page','SEMI-EXPANDABLE EQUIPEMENT AND FURNITURE | Per Employee');
        return View::make('section.form.table_g');
    }
    public function get_table_g()
    {
        $data = array();
        $pdo = DB::connection()->getPdo();
        $query = "SELECT code,item,unit,";
        $query.= "q1_qty,q1_amt,q2_qty,q2_amt,q3_qty,q3_amt,q4_qty,q4_amt ";
        $query.= "FROM table_g WHERE created_by = '". Auth::user()->section ."' OR created_by = '8888' GROUP BY item ORDER BY item ASC";
        $st = $pdo->prepare($query);
        $st->execute();
        $row = $st->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($row as $r):
            $total = ( $r['q1_qty'] * $r['q1_amt']) + ($r['q2_qty'] * $r['q2_amt']) + ($r['q3_qty'] * $r['q3_amt']) + ($r['q4_qty'] * $r['q4_amt']);
            $total = $total > 0 ? number_format($total,2) : NULL;
            $r['q1_qty'] = $r['q1_qty'] > 0 ? number_format( $r['q1_qty']) : NULL;
            $r['q1_amt'] = $r['q1_amt'] > 0 ? number_format( $r['q1_amt'],2) : NULL;
            $r['q2_qty'] = $r['q2_qty'] > 0 ? number_format( $r['q2_qty']) : NULL;
            $r['q2_amt'] = $r['q2_amt'] > 0 ? number_format( $r['q2_amt'],2) : NULL;
            $r['q3_qty'] = $r['q3_qty'] > 0 ? number_format( $r['q3_qty']) : NULL;
            $r['q3_amt'] = $r['q3_amt'] > 0 ? number_format( $r['q3_amt'],2) : NULL;
            $r['q4_qty'] = $r['q4_qty'] > 0 ? number_format( $r['q4_qty']) : NULL;
            $r['q4_amt'] = $r['q4_amt'] > 0 ? number_format( $r['q4_amt'],2) : NULL;
            $data[] = array($r['code'],$r['item'],$r['unit'],$r['q1_qty'],$r['q1_amt'],$r['q2_qty'],$r['q2_amt'],$r['q3_qty'],$r['q3_amt'],$r['q4_qty'],$r['q4_amt'],$total);
        endforeach;
        return json_encode($data);
    }
    public function save_table_g()
    {
        DB::table('table_g')->where('created_by','=',Auth::user()->section)->delete();
        $data = Input::get('data');
        $decoded = json_decode($data);
        foreach ($decoded as $d) {
            
            $insert = "code,ppcode,item,unit,q1_qty,q2_qty,q3_qty,q4_qty,q1_amt,q2_amt,q3_amt,q4_amt,created_by,date_added";
            $mark = "?,?,?,?,?,?,?,?,?,?,?,?,?,?";
            
            $d[3] = $d[3] > 0 ? $d[3] : NULL;
            $d[5] = $d[5] > 0 ? $d[5] : NULL;
            $d[7] = $d[7] > 0 ? $d[7] : NULL;
            $d[9] = $d[9] > 0 ? $d[9] : NULL;
            
            $d[4] = $d[4] > 0 ? $d[4] : NULL;
            $d[6] = $d[6] > 0 ? $d[6] : NULL;
            $d[8] = $d[8] > 0 ? $d[8] : NULL;
            $d[10] = $d[10] > 0 ? $d[10] : NULL;
            $input = array($d[0],1,$d[1],$d[2],$d[3],$d[5],$d[7],$d[9],$d[4],$d[6],$d[8],$d[10],Auth::user()->section,date('Y-m-d'));
            $query = "INSERT IGNORE INTO table_g($insert) VALUES($mark)";
            DB::insert($query,$input);
        }
        return $this->get_table_g();
    }


    public function section_openlist($id)
    {
        $expense['id'] = $id;
        $d = DB::table('ppmp_code')->where('id','=',$id)->first();
        Session::put('page',$d->expense_name);
        $expense['oneline'] = $d->oneline;
        return View::make('section.form.openlist',['expense' => $expense]);
    }
    
    public function get_open_list()
    {
        $ppcode = Input::get('ppcode');
        return $this->json_return_openlist($ppcode);
    }
    
    public function json_return_openlist($ppcode)
    {
        $data = array();
        $items = DB::table('open_list')
            ->where('created_by','=',Auth::user()->section)
            ->where('ppcode','=',$ppcode)
            ->groupBy(array('item','unit'))
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
                $data[] = array($item->code,$item->item,$item->unit,$item->q1_qty,$item->q1_amt,$item->q2_qty,$item->q2_amt,$item->q3_qty,$item->q3_amt,$item->q4_qty,$item->q4_amt,$total,$item->date_added);
            }
        } else {

            $items = DB::table('open_list')
                ->where('created_by','=',Auth::user()->division)
                ->where('ppcode','=',$ppcode)
                ->groupBy('item')
                ->orderBy('item','ASC')
                ->get();
            if(count($items) > 0) {
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
                    $data[] = array($item->code,$item->item,$item->unit,$item->q1_qty,$item->q1_amt,$item->q2_qty,$item->q2_amt,$item->q3_qty,$item->q3_amt,$item->q4_qty,$item->q4_amt,$total,$item->date_added);
                }
            } else {
                $data[] = array(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
            }
        }
        return json_encode($data);
    }
    
    public function save_open_list()
    {
        $ppcode = Input::get('expense');
        //$test = DB::table('open_list')->where('created_by','=',Auth::user()->section)->where('ppcode','=',$ppcode)->delete();
        $data = Input::get('data');
        $decoded = json_decode($data);
        $sections = DB::table('section')->where('division','=',Auth::user()->division)->orderby('id')->get();

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
                if ($d[1] AND $d[2]) {
                    
                    $item['item'] = $d[1];
                    $item['unit'] = $d[2];
                    $item['q1_amt'] = $d[4] > 0 ? $d[4] : NULL;
                    $item['q2_amt'] = $d[6] > 0 ? $d[6] : NULL;
                    $item['q3_amt'] = $d[8] > 0 ? $d[8] : NULL;
                    $item['q4_amt'] = $d[10] > 0 ? $d[10] : NULL;

                    DB::table('open_list')
                            ->where('ppcode','=',$ppcode)
                            ->where('code','=',$d[0])
                            ->update($item);

                    $qty['q1_qty'] = $d[3] > 0 ? $d[3] : NULL;
                    $qty['q2_qty'] = $d[5] > 0 ? $d[5] : NULL;
                    $qty['q3_qty'] = $d[7] > 0 ? $d[7] : NULL;
                    $qty['q4_qty'] = $d[9] > 0 ? $d[9] : NULL;
                    
                    DB::table('open_list')
                            ->where('ppcode','=',$ppcode)
                            ->where('code','=',$d[0])
                            ->where('created_by','=',Auth::user()->section)
                            ->update($qty);
                }
            } else {

                if ($d[1] AND $d[2]) {
                    
                    $code = DB::table('code')->orderBy('code','DESC')->first();
                    DB::table('code')->increment('code');
                    foreach($sections as $section):
                        $insert = "code,ppcode,item,unit,q1_qty,q2_qty,q3_qty,q4_qty,q1_amt,q2_amt,q3_amt,q4_amt,created_by,date_added,division";
                        $mark = "?,?,?,?,?,?,?,?,?,?,?,?,?,?,?";


                        $q1_amt = $d[4] > 0 ? $d[4] : NULL;
                        $q2_amt = $d[6] > 0 ? $d[6] : NULL;
                        $q3_amt = $d[8] > 0 ? $d[8] : NULL;
                        $q4_amt = $d[10] > 0 ? $d[10] : NULL;

                        if(Auth::user()->section == $section->id){
                            
                            $q1_qty = $d[3] > 0 ? $d[3] : NULL;
                            $q2_qty = $d[5] > 0 ? $d[5] : NULL;
                            $q3_qty = $d[7] > 0 ? $d[7] : NULL;
                            $q4_qty = $d[9] > 0 ? $d[9] : NULL;
                            $input = array($code->code,$ppcode,$d[1],$d[2],$q1_qty,$q2_qty,$q3_qty,$q4_qty,$q1_amt,$q2_amt,$q3_amt,$q4_amt,$section->id,date('Y-m-d'),Auth::user()->division);
                            $query = "INSERT IGNORE INTO open_list($insert) VALUES($mark)";
                            try{
                                DB::insert($query,$input);
                            }catch(SqlException $ex){return $ex->getMessage();}
                        } else {
                            $q1_qty = NULL;
                            $q2_qty = NULL;
                            $q3_qty = NULL;
                            $q4_qty = NULL;
                            
                            $input = array($code->code,$ppcode,$d[1],$d[2],$q1_qty,$q2_qty,$q3_qty,$q4_qty,$q1_amt,$q2_amt,$q3_amt,$q4_amt,$section->id,date('Y-m-d'),Auth::user()->division);
                            $query = "INSERT IGNORE INTO open_list($insert) VALUES($mark)";
                            try{
                                DB::insert($query,$input);
                            }catch(SqlException $ex){}
                        }
                    endforeach;
                }
            }
        endforeach;
        return $this->json_return_openlist($ppcode);
    }
    public function delete_item_open_list()
    {
        $ppcode = Input::get('expense');
        $data = Input::get('data');
        $decoded = json_decode($data);

        DB::table('open_list')
                ->where('code','=',$decoded[0])
                ->where('created_by','=',Auth::user()->section)
                ->delete();
        return 1;
    }
    public function delete_table_z()
    {
        $data = Input::get('data');
        $decoded = json_decode($data);

        $test = DB::table('table_z')
                    ->where('created_by','=',Auth::user()->section)
                    ->where('code','=',$decoded[0])
                    ->delete();
        return 1;
    }

    public function delete_table_d(){
        $data = Input::get('data');
        $decoded = json_decode($data);

        $test = DB::table('table_d')
                        ->where('created_by','=',Auth::user()->section)
                        ->where('code','=',$decoded[0])
                        ->delete();
        return 1;
    }
    public function current_budget()
    {
        if(Request::method() == "GET") {
            $budget = DB::table('section')
                        ->where('id','=', Auth::user()->section)
                        ->where('division','=',Auth::user()->division)
                        ->first();
            return View::make('section.current_budget',['budget' => $budget]);
        }
        if(Request::method() == "POST") {
            $data['current_budget'] = Input::get('budget');
            DB::table('section')
                ->where('id','=', Auth::user()->section)
                ->where('division','=',Auth::user()->division)
                ->update($data);
            return Redirect::to('ppmp/section');
        }
    }

    public function source_fund()
    {
        if(Request::method() == "GET") {
            $source_fund = DB::table('section')
                        ->where('id','=', Auth::user()->section)
                        ->where('division','=',Auth::user()->division)
                        ->first();
            return View::make('section.source_fund',['source_fund' => $source_fund]);
        }
        if(Request::method() == "POST") {
            $data['source_fund'] = Input::get('source_fund');
            DB::table('section')
                ->where('id','=', Auth::user()->section)
                ->where('division','=',Auth::user()->division)
                ->update($data);
            return Redirect::to('ppmp/section');
        }
    }

    
    public function create_program()
    {
        if(Request::method() == "GET") {
            return View::make('section.create_program',['ppcode' => Input::get('ppcode')]);
        }
        if(Request::method() == "POST") {

            $program_name = Input::get('program_name');
            $program_id = DB::table('program_name')->insertGetId(['ppcode' => Input::get('ppcode'),'name' => $program_name, 'section' => Auth::user()->section, 'division' => Auth::user()->division, 'source_fund' => Input::get('source_fund')]);
            if(Input::has('venue')) {
                foreach(Input::get('venue') as $venue):
                    DB::table('program_training_venue')->insert(['program_id' => $program_id, 'venue_id' => $venue]);
                endforeach;
            }
        }
        $venue_id = Input::get('venue')[0];
        return Redirect::to('section/program/venue/'.$program_id.'/'.$venue_id);
    }
    
    public function section_program($program_id,$venue_id)
    {
        $venues = DB::table('program_training_venue')
            ->leftJoin('training_venue','program_training_venue.venue_id','=', 'training_venue.id')
            ->where('program_training_venue.program_id','=',$program_id)
            ->where('program_training_venue.venue_id','=',$venue_id)
            ->orderBy('training_venue.order','ASC')
            ->first();
        $program = DB::table('program_name')
            ->leftJoin('ppmp_code','program_name.ppcode','=','ppmp_code.id')
            ->where('program_name.id','=',$program_id)
            ->first();

        $program_items['program_id'] = $program_id;
        $program_items['venue_id'] = $venue_id;
        $page = $program->expense_name ." | " . $program->name ." | " . $venues->venue;
        Session::put('page',$page);
        return View::make('section.form.program',['program_items' => $program_items]);
    }

    public function section_program_items($program_id,$venue_id)
    {

        $data = array();
        $items = DB::table('program_items')
            ->where('created_by','=',Auth::user()->section)
            ->where('program_id','=',$program_id)
            ->where('venue_id','=',$venue_id)
            ->groupBy('item')
            ->orderBy('item','ASC')
            ->get();
        if(count($items) > 0) {
            foreach($items as $item)
            {
                $total = ( $item->q1_qty * $item->q1_amt) + ($item->q2_qty * $item->q2_amt) + ($item->q3_qty * $item->q3_amt) + ($item->q4_qty * $item->q4_amt);
                $total = $total > 0 ? number_format($total,2) : NULL;
                $item->q1_qty = $item->q1_qty > 0 ? number_format( $item->q1_qty) : NULL;
                $item->q1_amt = $item->q1_amt > 0 ? number_format( $item->q1_amt,2) : NULL;
                $item->q2_qty = $item->q2_qty > 0 ? number_format( $item->q2_qty) : NULL;
                $item->q2_amt = $item->q2_amt > 0 ? number_format( $item->q2_amt,2) : NULL;
                $item->q3_qty = $item->q3_qty > 0 ? number_format( $item->q3_qty) : NULL;
                $item->q3_amt = $item->q3_amt > 0 ? number_format( $item->q3_amt,2) : NULL;
                $item->q4_qty = $item->q4_qty > 0 ? number_format( $item->q4_qty) : NULL;
                $item->q4_amt = $item->q4_amt > 0 ? number_format( $item->q4_amt,2) : NULL;
                $data[] = array($item->code,$item->item,$item->unit,$item->q1_qty,$item->q1_amt,$item->q2_qty,$item->q2_amt,$item->q3_qty,$item->q3_amt,$item->q4_qty,$item->q4_amt,$total);
            }
        } else {
            $data[] = array(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
        }
        return json_encode($data);
    }

    public function get_program_items()
    {
        $program_id = Input::get('program_id');
        $venue_id = Input::get('venue_id');
        return $this->section_program_items($program_id,$venue_id);
    }
    public function save_program_items()
    {

        $data = Input::get('data');
        $decoded = json_decode($data);
        $program_id = Input::get('program_id');
        $venue_id = Input::get('venue_id');
        $insert = null;
        $mark = null;
        $amount = null;
        
        foreach ($decoded as $d):
            if ($d[0]) {
                if ($d[1]) {
                    $item['item'] = $d[1];
                    $item['unit'] = $d[2];
                    $item['q1_amt'] = $d[4] > 0 ? $d[4] : NULL;
                    $item['q2_amt'] = $d[6] > 0 ? $d[6] : NULL;
                    $item['q3_amt'] = $d[8] > 0 ? $d[8] : NULL;
                    $item['q4_amt'] = $d[10] > 0 ? $d[10] : NULL;

                    DB::table('program_items')
                            ->where('program_id','=',$program_id)
                            ->where('venue_id',$venue_id)
                            ->where('code','=',$d[0])
                            ->update($item);

                    $qty['q1_qty'] = $d[3] > 0 ? $d[3] : NULL;
                    $qty['q2_qty'] = $d[5] > 0 ? $d[5] : NULL;
                    $qty['q3_qty'] = $d[7] > 0 ? $d[7] : NULL;
                    $qty['q4_qty'] = $d[9] > 0 ? $d[9] : NULL;
                    
                    DB::table('program_items')
                            ->where('code','=',$d[0])
                            ->where('created_by','=', Auth::user()->section)
                            ->where('program_id','=',$program_id)
                            ->where('venue_id','=',$venue_id)
                            ->update($qty);
                }
            } else {

                if ($d[1]) {
                    
                    $code = DB::table('code')->orderBy('code','DESC')->first();
                    DB::table('code')->increment('code');
                   
                    $insert = "code,item,unit,q1_qty,q2_qty,q3_qty,q4_qty,q1_amt,q2_amt,q3_amt,q4_amt,created_by,date_added,division,venue_id,program_id";
                    $mark = "?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?";
                    
                    $d[3] = $d[3] > 0 ? $d[3] : NULL;
                    $d[5] = $d[5] > 0 ? $d[5] : NULL;
                    $d[7] = $d[7] > 0 ? $d[7] : NULL;
                    $d[9] = $d[9] > 0 ? $d[9] : NULL;
                    
                    $d[4] = $d[4] > 0 ? $d[4] : NULL;
                    $d[6] = $d[6] > 0 ? $d[6] : NULL;
                    $d[8] = $d[8] > 0 ? $d[8] : NULL;
                    $d[10] = $d[10] > 0 ? $d[10] : NULL;
                    
                    $input = array($code->code,$d[1],$d[2],$d[3],$d[5],$d[7],$d[9],$d[4],$d[6],$d[8],$d[10],Auth::user()->section,date('Y-m-d'),Auth::user()->division,$venue_id,$program_id);
                    $query = "INSERT IGNORE INTO program_items($insert) VALUES($mark)";
                    try{
                        DB::insert($query,$input);
                    }catch(SqlException $ex){}
                }
            }
        endforeach;
        return $this->section_program_items($program_id,$venue_id);
    }

    public function delete_program_item()
    {
        $data = Input::get('data');
        $decoded = json_decode($data);
        $program_id = Input::get('program_id');
        $venue_id = Input::get('venue_id');
        $test = DB::table('program_items')
                        ->where('created_by','=',Auth::user()->section)
                        ->where('code','=',$decoded[0])
                        ->delete();
        return $test;
    }
    
    public function delete_program($id)
    {
        DB::table('program_name')->where('id','=',$id)->delete();
        return Redirect::to('section/table_a');
    }
    
    public function handson()
    {
        return View::make('section.handson');
    }
    public function print_bydate()
    {
        return View::make('section.print_bydate');
    }
    public function print_byprogram()
    {
        if(Request::method() == "GET"){
            return View::make('section.print_program');
        }
        if(Request::method() == "POST"){

        }
    }

    public function d_get_program($ppcode)
    {
        $programs = DB::table('program_name')
                    ->where('ppcode','=',$ppcode)
                    ->where('section','=',Auth::user()->section)
                    ->get();
        return $programs;
    }

    public function item_subitem($id,$ppcode)
    {
        $item = DB::table('open_list')
                    ->where('code','=',$id)
                    ->where('ppcode','=',$ppcode)
                    ->where('created_by','=',Auth::user()->section)
                    ->first();
        
        $data['item_code'] = $id;
        $data['ppcode'] = $ppcode;
        Session::put('page',$item->item);
        return View::make('section.form.subitem',['data' => $data]);
    }

    public function get_subitem()
    {
        return $this->get_subitems(Input::get('ppcode'),Input::get('item_code'));
    }

    public function get_subitems($ppcode,$item_code)
    {
        $data = array();
        $items = DB::table('sub_item')
            ->where('created_by','=',Auth::user()->section)
            ->where('ppcode','=',$ppcode)
            ->where('item_code','=',$item_code)
            ->groupBy('item')
            ->orderBy('item','ASC')
            ->get();

        if(count($items) > 0) {
            foreach($items as $item)
            {
                $total = ( $item->q1_qty * $item->q1_amt) + ($item->q2_qty * $item->q2_amt) + ($item->q3_qty * $item->q3_amt) + ($item->q4_qty * $item->q4_amt);
                $total = $total > 0 ? number_format($total,2) : NULL;
                $item->q1_qty = $item->q1_qty > 0 ? number_format( $item->q1_qty) : NULL;
                $item->q1_amt = $item->q1_amt > 0 ? number_format( $item->q1_amt,2) : NULL;
                $item->q2_qty = $item->q2_qty > 0 ? number_format( $item->q2_qty) : NULL;
                $item->q2_amt = $item->q2_amt > 0 ? number_format( $item->q2_amt,2) : NULL;
                $item->q3_qty = $item->q3_qty > 0 ? number_format( $item->q3_qty) : NULL;
                $item->q3_amt = $item->q3_amt > 0 ? number_format( $item->q3_amt,2) : NULL;
                $item->q4_qty = $item->q4_qty > 0 ? number_format( $item->q4_qty) : NULL;
                $item->q4_amt = $item->q4_amt > 0 ? number_format( $item->q4_amt,2) : NULL;
                $data[] = array($item->code,$item->item,$item->unit,$item->q1_qty,$item->q1_amt,$item->q2_qty,$item->q2_amt,$item->q3_qty,$item->q3_amt,$item->q4_qty,$item->q4_amt,$total);
            }
        } else {
            $data[] = array(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
        }
        return json_encode($data);
    }
    public function save_subitem()
    {
        $data = Input::get('data');
        $decoded = json_decode($data);
        $item_code = Input::get('item_code');
        $ppcode = Input::get('ppcode');
        $insert = null;
        $mark = null;
        $amount = null;
        
        foreach ($decoded as $d):
            if ($d[0]) {
                if ($d[1]) {
                    $item['item'] = $d[1];
                    $item['unit'] = $d[2];
                    $item['q1_amt'] = $d[4] > 0 ? $d[4] : NULL;
                    $item['q2_amt'] = $d[6] > 0 ? $d[6] : NULL;
                    $item['q3_amt'] = $d[8] > 0 ? $d[8] : NULL;
                    $item['q4_amt'] = $d[10] > 0 ? $d[10] : NULL;

                    DB::table('sub_item')
                            ->where('ppcode','=',$ppcode)
                            ->where('item_code','=',$item_code)
                            ->where('code','=',$d[0])
                            ->update($item);

                    $qty['q1_qty'] = $d[3] > 0 ? $d[3] : NULL;
                    $qty['q2_qty'] = $d[5] > 0 ? $d[5] : NULL;
                    $qty['q3_qty'] = $d[7] > 0 ? $d[7] : NULL;
                    $qty['q4_qty'] = $d[9] > 0 ? $d[9] : NULL;
                    
                    DB::table('sub_item')
                            ->where('code','=',$d[0])
                            ->where('created_by','=', Auth::user()->section)
                            ->where('ppcode','=',$ppcode)
                            ->where('item_code','=',$item_code)
                            ->update($qty);
                }
            } else {

                if ($d[1]) {
                    
                    $code = DB::table('code')->orderBy('code','DESC')->first();
                    DB::table('code')->increment('code');
                   
                    $insert = "code,item,unit,q1_qty,q2_qty,q3_qty,q4_qty,q1_amt,q2_amt,q3_amt,q4_amt,created_by,date_added,division,item_code,ppcode";
                    $mark = "?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?";
                    
                    $d[3] = $d[3] > 0 ? $d[3] : NULL;
                    $d[5] = $d[5] > 0 ? $d[5] : NULL;
                    $d[7] = $d[7] > 0 ? $d[7] : NULL;
                    $d[9] = $d[9] > 0 ? $d[9] : NULL;
                    
                    $d[4] = $d[4] > 0 ? $d[4] : NULL;
                    $d[6] = $d[6] > 0 ? $d[6] : NULL;
                    $d[8] = $d[8] > 0 ? $d[8] : NULL;
                    $d[10] = $d[10] > 0 ? $d[10] : NULL;
                    
                    $input = array($code->code,$d[1],$d[2],$d[3],$d[5],$d[7],$d[9],$d[4],$d[6],$d[8],$d[10],Auth::user()->section,date('Y-m-d'),Auth::user()->division,$item_code,$ppcode);
                    
                    $query = "INSERT IGNORE INTO sub_item($insert) VALUES($mark)";
                    try{
                        DB::insert($query,$input);
                    }catch(SqlException $ex){
                    }
                }
            }
        endforeach;
        return $this->get_subitems($ppcode,$item_code);
    }
    
    public function delete_subitem()
    {
        $data = Input::get('data');
        $decoded = json_decode($data);
        $ppcode = Input::get('ppcode');
        $item_code = Input::get('item_code');
        
        $test = DB::table('sub_item')
                        ->where('created_by','=',Auth::user()->section)
                        ->where('ppcode','=',$ppcode)
                        ->where('code','=',$decoded[0])
                        ->where('item_code','=',$item_code)
                        ->delete();
                        
        return $test;
    }

    public function program_subitem($program_id,$venue_id,$id)
    {
        $item = DB::table('program_items')
                    ->where('program_id','=',$program_id)
                    ->where('venue_id','=',$venue_id)
                    ->where('code','=',$id)
                    ->first();

        $data['program_id'] = $program_id;
        $data['venue_id'] = $venue_id;
        $data['code'] = $id;
        Session::put('page',$item->item);     
        return View::make('section.form.programsubitem',['data' => $data]);     
    }

    public function save_program_subitem()
    {
        $data = Input::get('data');
        $decoded = json_decode($data);
        $program_id = Input::get('program_id');
        $venue_id = Input::get('venue_id');
        $item_code = Input::get('item_code');
        $insert = null;
        $mark = null;
        $amount = null;
        
        foreach ($decoded as $d):
            if ($d[0]) {
                if ($d[1]) {
                    $item['item'] = $d[1];
                    $item['unit'] = $d[2];
                    $item['q1_amt'] = $d[4] > 0 ? $d[4] : NULL;
                    $item['q2_amt'] = $d[6] > 0 ? $d[6] : NULL;
                    $item['q3_amt'] = $d[8] > 0 ? $d[8] : NULL;
                    $item['q4_amt'] = $d[10] > 0 ? $d[10] : NULL;

                    DB::table('program_subitem')
                            ->where('program_id','=',$program_id)
                            ->where('venue_id',$venue_id)
                            ->where('item_code','=',$item_code)
                            ->where('code','=',$d[0])
                            ->update($item);

                    $qty['q1_qty'] = $d[3] > 0 ? $d[3] : NULL;
                    $qty['q2_qty'] = $d[5] > 0 ? $d[5] : NULL;
                    $qty['q3_qty'] = $d[7] > 0 ? $d[7] : NULL;
                    $qty['q4_qty'] = $d[9] > 0 ? $d[9] : NULL;
                    
                    DB::table('program_subitem')
                            ->where('code','=',$d[0])
                            ->where('created_by','=', Auth::user()->section)
                            ->where('program_id','=',$program_id)
                            ->where('venue_id','=',$venue_id)
                            ->where('item_code','=',$item_code)
                            ->update($qty);
                }
            } else {

                if ($d[1]) {
                    
                    $code = DB::table('code')->orderBy('code','DESC')->first();
                    DB::table('code')->increment('code');
                   
                    $insert = "code,item,unit,q1_qty,q2_qty,q3_qty,q4_qty,q1_amt,q2_amt,q3_amt,q4_amt,created_by,date_added,division,venue_id,program_id,item_code";
                    $mark = "?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?";
                    
                    $d[3] = $d[3] > 0 ? $d[3] : NULL;
                    $d[5] = $d[5] > 0 ? $d[5] : NULL;
                    $d[7] = $d[7] > 0 ? $d[7] : NULL;
                    $d[9] = $d[9] > 0 ? $d[9] : NULL;
                    
                    $d[4] = $d[4] > 0 ? $d[4] : NULL;
                    $d[6] = $d[6] > 0 ? $d[6] : NULL;
                    $d[8] = $d[8] > 0 ? $d[8] : NULL;
                    $d[10] = $d[10] > 0 ? $d[10] : NULL;
                    
                    $input = array($code->code,$d[1],$d[2],$d[3],$d[5],$d[7],$d[9],$d[4],$d[6],$d[8],$d[10],Auth::user()->section,date('Y-m-d'),Auth::user()->division,$venue_id,$program_id,$item_code);
                    
                    $query = "INSERT IGNORE INTO program_subitem($insert) VALUES($mark)";
                    try{
                        DB::insert($query,$input);
                    }catch(SqlException $ex){
                    }
                }
            }
        endforeach;
        return $this->get_program_subitems($program_id,$venue_id,$item_code);
    }

    public function get_program_subitem()
    {
        return $this->get_program_subitems(Input::get('program_id'), Input::get('venue_id'),Input::get('item_code'));
    }
    public function get_program_subitems($program_id,$venue_id,$item_code)
    {
        $data = array();
        $items = DB::table('program_subitem')
            ->where('created_by','=',Auth::user()->section)
            ->where('program_id','=',$program_id)
            ->where('venue_id','=',$venue_id)
            ->where('item_code','=',$item_code)
            ->groupBy('item')
            ->orderBy('item','ASC')
            ->get();

        if(count($items) > 0) {
            foreach($items as $item)
            {
                $total = ( $item->q1_qty * $item->q1_amt) + ($item->q2_qty * $item->q2_amt) + ($item->q3_qty * $item->q3_amt) + ($item->q4_qty * $item->q4_amt);
                $total = $total > 0 ? number_format($total,2) : NULL;
                $item->q1_qty = $item->q1_qty > 0 ? number_format( $item->q1_qty) : NULL;
                $item->q1_amt = $item->q1_amt > 0 ? number_format( $item->q1_amt,2) : NULL;
                $item->q2_qty = $item->q2_qty > 0 ? number_format( $item->q2_qty) : NULL;
                $item->q2_amt = $item->q2_amt > 0 ? number_format( $item->q2_amt,2) : NULL;
                $item->q3_qty = $item->q3_qty > 0 ? number_format( $item->q3_qty) : NULL;
                $item->q3_amt = $item->q3_amt > 0 ? number_format( $item->q3_amt,2) : NULL;
                $item->q4_qty = $item->q4_qty > 0 ? number_format( $item->q4_qty) : NULL;
                $item->q4_amt = $item->q4_amt > 0 ? number_format( $item->q4_amt,2) : NULL;
                $data[] = array($item->code,$item->item,$item->unit,$item->q1_qty,$item->q1_amt,$item->q2_qty,$item->q2_amt,$item->q3_qty,$item->q3_amt,$item->q4_qty,$item->q4_amt,$total);
            }
        } else {
            $data[] = array(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
        }
        return json_encode($data);
    }

    public function delete_program_subitem()
    {
        $data = Input::get('data');
        $decoded = json_decode($data);
        $program_id = Input::get('program_id');
        $venue_id = Input::get('venue_id');
        $item_code = Input::get('item_code');

        $test = DB::table('program_subitem')
                        ->where('created_by','=',Auth::user()->section)
                        ->where('program_id','=',$program_id)
                        ->where('venue_id','=',$venue_id)
                        ->where('code','=',$decoded[0])
                        ->where('item_code','=',$item_code)
                        ->delete();
                        
        return $test;
    }
}
