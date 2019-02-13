<?php

class ItemsTableSeeder extends Seeder
{
    public function run()
    {
        //TABLE A

        $code = DB::table('code')->first();
        DB::table('table_a')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Clip - Paper, 32mm, 100\'s/box','unit' => 'box','q1_amt' => 5.50, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');


        $code = DB::table('code')->first();
        DB::table('table_a')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Clip - Paper, 48mm, 100\'s/box','unit' => 'box','q1_amt' => 15.50, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_a')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Clip - Backfold - 1"','unit' => 'pc','q1_amt' => 2.75, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_a')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Clip - Backfold - 2"','unit' => 'pc','q1_amt' => 4.75, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_a')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Eraser - Rubber','unit' => 'pc','q1_amt' => 0.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_a')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Eraser - Correction Tape, Refillable','unit' => 'pc','q1_amt' => 0.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_a')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Eraser - Correction Tape, Refill','unit' => 'pc','q1_amt' => 0.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_a')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Note Pad Stick-on 3" * 4", 100 sheets/pad','unit' => 'pad','q1_amt' => 54.06, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_a')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Pen - Ballpen, Black','unit' => 'pc','q1_amt' => 4.20, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_a')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Pen - Ballpen, Blue','unit' => 'pc','q1_amt' => 4.20, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_a')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Pen - Ballpen, Green','unit' => 'pc','q1_amt' => 4.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_a')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Pen - Ballpen, Red','unit' => 'pc','q1_amt' => 4.20, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_a')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Pen - Highlighter, Neon Yellow','unit' => 'pc','q1_amt' => 18.75, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_a')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Pen - Highlighter, Neon Green','unit' => 'pc','q1_amt' => 17.75, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_a')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Pen - Signpen, 0.5 MM, Black','unit' => 'pc','q1_amt' => 44.01, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_a')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Pen - Signpen, 0.5 MM, Blue','unit' => 'pc','q1_amt' => 44.01, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_a')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Pen - Signpen, 0.7 MM, Black','unit' => 'pc','q1_amt' => 25.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_a')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Pen - Signpen, 0.7 MM, Blue','unit' => 'pc','q1_amt' => 25.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_a')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Pencil, No.2','unit' => 'pc','q1_amt' => 5.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');


        $code = DB::table('code')->first();
        DB::table('table_a')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'USB 16 GB','unit' => 'pc','q1_amt' => 234.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');
        
        $code = DB::table('code')->first();
        DB::table('table_b')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Data File Box - Standard Size, Red','unit' => 'pc','q1_amt' => 150.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_b')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Data File Box - Standard Size, Green','unit' => 'pc','q1_amt' => 150.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_b')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Data file Box - Standard Size, Blue','unit' => 'pc','q1_amt' => 150.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_b')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Envelope - Brown, Long','unit' => 'pc','q1_amt' => 1.50, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_b')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Envelope - Expanding, Long with garter','unit' => 'pc','q1_amt' => 9.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_b')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Envelope - Mailing/Letter, Long, White, 500\'s/box','unit' => 'box','q1_amt' => 185.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_b')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Envelope - Mailing/Letter, Windows, Long, White,500\'s/box','unit' => 'box','q1_amt' => 285.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_b')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Fasterner - Plastic, 50\'s','unit' => 'box','q1_amt' => 20.25, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_b')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Folder - Long, White, 14pts.','unit' => 'pc','q1_amt' => 6.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_b')->insert(['code' => $code->code, 'ppcode' => 1,'ppcode' => 1,'item' => 'Glue - All Purpose, 200g','unit' => 'bottle','q1_amt' => 48.88, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_b')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Ink - Stamp Pad, 50ml, violet','unit' => 'bottle','q1_amt' => 25.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_b')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Paper - Bondpaper, Multi-Purpose, A4,Substance 20','unit' => 'ream','q1_amt' => 124.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_b')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Paper - Bondpaper, Multi-Purpose, Long, Substance 20','unit' => 'ream','q1_amt' => 138.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_b')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Paper - Fax, 216mm * 30mm','unit' => 'roll','q1_amt' => 60.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_b')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Paper - Laid, 8 1/2" * 11", 500\'s/box','unit' => 'box','q1_amt' => 550.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_b')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Pen - Marker, Permanent, Fine, Black','unit' => 'pc','q1_amt' => 23.50, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_b')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Pen - Marker, Permanent, Fine, Blue','unit' => 'pc','q1_amt' => 23.50, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_b')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Pen - Marker, Permanent, Fine, Red','unit' => 'pc','q1_amt' => 23.50, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_b')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Record Book - 150 Leaves, smyth sewn','unit' => 'pc','q1_amt' => 35.25, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_b')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Record Book - 300 Leaves, symth sewn','unit' => 'pc','q1_amt' => 50.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_b')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Record Book - 500 Leaves,','unit' => 'pc','q1_amt' => 70.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_b')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Rubberband ,350 grams','unit' => 'pc','q1_amt' => 195.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_b')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Staple Wire - # 35','unit' => 'box','q1_amt' => 22.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_b')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Staper Wire - # 23 * 10','unit' => 'box','q1_amt' => 50.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_b')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Tape - Masking, 1", 25m','unit' => 'roll','q1_amt' => 28.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_b')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Tape - Packaging, 2", 50m','unit' => 'roll','q1_amt' => 13.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_b')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Tape - Transparent, 1" 50m','unit' => 'roll','q1_amt' => 7.50, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_b')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Tape - Duct Tape, Gray, 2"','unit' => 'roll','q1_amt' => 104.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');
        
        
        $code = DB::table('code')->first();
        DB::table('table_c')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Cartolina, Assorted Color, 78 gsm min','unit' => 'pc','q1_amt' => 4.30, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_c')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Cartolina, White, 99 gsm min','unit' => 'PC','q1_amt' => 3.75, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_c')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Eraser - Whiteboard, Felt','unit' => 'pc','q1_amt' => 10.07, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_c')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'ID Clip','unit' => 'pc','q1_amt' => 12.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_c')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'ID Sling - Garterized With name Tags','unit' => 'pc','q1_amt' => 8.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_c')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Manila Paper, 36" * 48", Pre-cut','unit' => 'pc','q1_amt' => 2.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_c')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Metacards (4 colors)','unit' => 'pack','q1_amt' => 75.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');
    

        $sections = DB::table('section')->orderBy('id','ASC')->get();

        $code = DB::table('code')->orderBy('code','DESC')->first();
        DB::table('code')->increment('code');
        foreach($sections as $section):
            DB::table('table_d')->insert(['ppcode' => 1,'item' => 'Ink - Duplicating Machine (Indicate model of machine)','unit' => '', 'q1_amt' => 0.00,'created_by' => $section->id,'date_added' => date('Y-m-d'),'code' => $code->code,'division' => $section->division]);
        endforeach;

        $code = DB::table('code')->orderBy('code','DESC')->first();
        DB::table('code')->increment('code');
        foreach($sections as $section):
            DB::table('table_d')->insert(['ppcode' => 1,'item' => 'Ink - Master Roll - Duplicating Machine (Indicate model of machine)','unit' => '', 'q1_amt' => 0.00,'created_by' => $section->id ,'date_added' => date('Y-m-d'),'code' => $code->code,'division' => $section->division]);
        endforeach;

        $code = DB::table('code')->orderBy('code','DESC')->first();
        DB::table('code')->increment('code');
        foreach($sections as $section):
            DB::table('table_d')->insert(['ppcode' => 1,'item' => 'Developer Copier (Indicate model of Copier)','unit' => '', 'q1_amt' => 0.00,'created_by' => $section->id,'date_added' => date('Y-m-d'),'code' => $code->code,'division' => $section->division]);
        endforeach;    

        $code = DB::table('code')->orderBy('code','DESC')->first();
        DB::table('code')->increment('code');
        foreach($sections as $section):
            DB::table('table_d')->insert(['ppcode' => 1,'item' => 'Drum-Copier (Indicate model of Copier)','unit' => '', 'q1_amt' => 0.00,'created_by' => $section->id,'date_added' => date('Y-m-d'),'code' => $code->code,'division' => $section->division]);
        endforeach;    

        $code = DB::table('code')->orderBy('code','DESC')->first();
        DB::table('code')->increment('code');
        foreach($sections as $section):
            DB::table('table_d')->insert(['ppcode' => 1,'item' => 'Toner-Copier (Indicate model of Copier)','unit' => '', 'q1_amt' => 0.00,'created_by' => $section->id,'date_added' => date('Y-m-d'),'code' => $code->code,'division' => $section->division]);
        endforeach;

        $code = DB::table('code')->orderBy('code', 'DESC')->first();
        DB::table('code')->increment('code');
        foreach($sections as $section):
            DB::table('table_d')->insert(['ppcode' => 1,'item' => 'Toner-Computer Printer (Indicate model of printer & Ink color)','unit' => '', 'q1_amt' => 0.00,'created_by' => $section->id,'date_added' => date('Y-m-d'),'code' => $code->code,'division' => $section->division]);
        endforeach;



        $code = DB::table('code')->first();
        DB::table('table_e')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Calculator, 12 digits, dual power','unit' => 'pc','q1_amt' => 200.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_e')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Puncher, Heavy Duty, 2 Hole','unit' => 'pc','q1_amt' => 123.43, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_e')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Ruler, 12", Plastic, Transparent','unit' => 'pc','q1_amt' => 10.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_e')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Scissors, 8", Metal Handle','unit' => 'pc','q1_amt' => 55.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_e')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Sharpener, Table Type, Heavy Duty','unit' => 'pc','q1_amt' => 295.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = Db::table('code')->first();
        DB::table('table_e')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Stamp Pad, 3" * 5"','unit' => 'pc','q1_amt' => 29.06, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_e')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Stapler with Staple Remover #35, Heavy Duty','unit' => 'pc','q1_amt' => 220.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');


        $code = DB::table('code')->first();
        DB::table('table_e')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Binder Stapler (24mm)','unit' => 'PC','q1_amt' => 1500.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_e')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Cork Board, With Frame, Without Stand, 60" * 80"','unit' => 'pc','q1_amt' => 2350.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_e')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Document Tray, Metal Type, 3 Layers','unit' => 'pc','q1_amt' => 340.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_e')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Extension Wire, 5 meters, 3 gangs','unit' => 'pc','q1_amt' => 270.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_e')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Wireless Presenter','unit' => 'pc','q1_amt' => 1000.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');
        
        $code = DB::table('code')->first();
        DB::table('table_f')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Computer Desk Top - CPU, Monitor, Keyboard, Mouse, UPS, AVR','unit' => 'unit','q1_amt' => 14990.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_f')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Chair (Monobloc, without arm rest, beige/white)','unit' => 'PC','q1_amt' => 280.80, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_f')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Table','unit' => 'pc','q1_amt' => 0, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_g')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Airconditioner','unit' => '','q1_amt' => 0, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_g')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Cabinet, Steel, 72" * 36" * 18" (4 drawers)','unit' => '','q1_amt' => 0, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_g')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Camera, Digital','unit' => 'unit','q1_amt' => 6800.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_g')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Copier (free use of machine)','unit' => 'pc','q1_amt' => 14500.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_g')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Fax Machine (selected sections only)','unit' => '','q1_amt' => 0, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_g')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Laptop/Netbook','unit' => 'pc','q1_amt' => 14990.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_g')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Printer with Scanner, (free use of machine)','unit' => 'pc','q1_amt' => 14990.00, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        $code = DB::table('code')->first();
        DB::table('table_g')->insert(['code' => $code->code, 'ppcode' => 1,'item' => 'Multi Media Projector','unit' => '','q1_amt' => 0, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');


        $code = DB::table('code')->first();
        DB::table('table_g')->insert(['code' => $code->code, 'code' => $code->code, 'ppcode' => 1,'item' => 'Duplicating Machine(free use of machine)','unit' => '','q1_amt' => 0, 'created_by' => '8888','date_added' => date('Y-m-d')]);
        DB::table('code')->increment('code');

        
        
       
        
        
        
        
        
        

        
        
        
        
        
        
        
        
        
        
        

        

        
        
        
        
        
        
        
        
        
        
        
        
        

        
        
        
        
        
        
        
    }
}
?>