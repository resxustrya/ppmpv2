<?php

class SeederController extends BaseController {
    public function seed(){
                $divisions = DB::table('division')->get();
        
                foreach($divisions as $division):
                    $code = DB::table('code')->orderBy('code','DESC')->first();
                    DB::table('code')->increment('code');
                    DB::table('open_list')->insert(['ppcode' => 3 ,'item' => 'FUEL, OIL AND LUBRICANTS EXPENSE','unit' => '', 'q1_qty' => NULL, 'q1_amt' => NULL, 'created_by' => $division->id, 'date_added' => date('Y-m-d'),'code' => $code->code]);

                endforeach;
                
        
                foreach($divisions as $division):
                    $code = DB::table('code')->orderBy('code','DESC')->first();
                    DB::table('code')->increment('code');
                    DB::table('open_list')->insert(['ppcode' => 4 ,'item' => 'POSTAGE AND DELIVERY EXPENSE','unit' => '', 'q1_qty' => NULL, 'q1_amt' => NULL, 'created_by' => $division->id, 'date_added' => date('Y-m-d'),'code' => $code->code]);
                endforeach;
                
                foreach($divisions as $division):
                    $code = DB::table('code')->orderBy('code','DESC')->first();
                    DB::table('code')->increment('code');
                    DB::table('open_list')->insert(['ppcode' => 5 ,'item' => 'INTERNET SUBSCRIPTION EXPENSE','unit' => '', 'q1_qty' => NULL, 'q1_amt' => NULL, 'created_by' => $division->id, 'date_added' => date('Y-m-d'),'code' => $code->code]);
                endforeach;
               
                foreach($divisions as $division):
                    $code = DB::table('code')->orderBy('code','DESC')->first();
                    DB::table('code')->increment('code');
                    DB::table('open_list')->insert(['ppcode' => 6 ,'item' => 'RENT-BUILDING AND STRUCTURE EXPENSE','unit' => '', 'q1_qty' => NULL, 'q1_amt' => NULL, 'created_by' => $division->id, 'date_added' => date('Y-m-d'),'code' => $code->code]);
                endforeach;
                
                foreach($divisions as $division):
                    $code = DB::table('code')->orderBy('code','DESC')->first();
                    DB::table('code')->increment('code');
                    DB::table('open_list')->insert(['ppcode' => 7 ,'item' => 'RENT-LAND EXPENSE','unit' => '', 'q1_qty' => NULL, 'q1_amt' => NULL, 'created_by' => $division->id, 'date_added' => date('Y-m-d'),'code' => $code->code]);
                    
                endforeach;
                
                foreach($divisions as $division):
                    $code = DB::table('code')->orderBy('code','DESC')->first();
                    DB::table('code')->increment('code');
                    DB::table('open_list')->insert(['ppcode' => 8 ,'item' => 'RENT-EQUIPMENT EXPENSE','unit' => '', 'q1_qty' => NULL, 'q1_amt' => NULL, 'created_by' => $division->id, 'date_added' => date('Y-m-d'),'code' => $code->code]);
                    
                endforeach;
                
                foreach($divisions as $division):
                    $code = DB::table('code')->orderBy('code','DESC')->first();
                    DB::table('code')->increment('code');
                    DB::table('open_list')->insert(['ppcode' => 10 ,'item' => 'REPRESENTATION EXPENSE','unit' => '', 'q1_qty' => NULL, 'q1_amt' => NULL, 'created_by' => $division->id, 'date_added' => date('Y-m-d'),'code' => $code->code]);
                    
                endforeach;
                
                foreach($divisions as $division):
                    $code = DB::table('code')->orderBy('code','DESC')->first();
                    DB::table('code')->increment('code');
                    DB::table('open_list')->insert(['ppcode' => 11 ,'item' => 'TRANSPORTATION AND DELIVERY','unit' => '', 'q1_qty' => NULL, 'q1_amt' => NULL, 'created_by' => $division->id, 'date_added' => date('Y-m-d'),'code' => $code->code]);
                    
                endforeach;
               
                foreach($divisions as $division):
                    $code = DB::table('code')->orderBy('code','DESC')->first();
                    DB::table('code')->increment('code');
                    DB::table('open_list')->insert(['ppcode' => 12 ,'item' => 'SUBSCRIPTION EXPENSE','unit' => '', 'q1_qty' => NULL, 'q1_amt' => NULL, 'created_by' => $division->id, 'date_added' => date('Y-m-d'),'code' => $code->code]);
            
                endforeach;
                
                foreach($divisions as $division):
                    $code = DB::table('code')->orderBy('code','DESC')->first();
                    DB::table('code')->increment('code');
                    DB::table('open_list')->insert(['ppcode' => 14 ,'item' => 'JANITORIAL SERVICES EXPENSE','unit' => '', 'q1_qty' => NULL, 'q1_amt' => NULL, 'created_by' => $division->id, 'date_added' => date('Y-m-d'),'code' => $code->code]);
            
                endforeach;
                
                foreach($divisions as $division):
                    $code = DB::table('code')->orderBy('code','DESC')->first();
                    DB::table('code')->increment('code');
                    DB::table('open_list')->insert(['ppcode' => 15 ,'item' => 'SECURITY SERVICES EXPENSE','unit' => '', 'q1_qty' => NULL, 'q1_amt' => NULL, 'created_by' => $division->id, 'date_added' => date('Y-m-d'),'code' => $code->code]);
                endforeach;
        return "ok";
    }
}
?>