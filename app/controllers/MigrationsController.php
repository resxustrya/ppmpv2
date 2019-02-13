<?php

class MigrationsController extends BaseController
{
    public function index()
    {
        $this->sub_item();
        $this->program_subitem();
    }
    
    public function sub_item()
    {
        if(Schema::hasTable('sub_item')) {
            Schema::drop('sub_item');

            Schema::create('sub_item',function($table){
                
                $table->string('code')->nullable();
                $table->string("ppcode")->nullable();
                $table->string('item')->nullable();
                $table->string('unit')->nullable();
    
                $table->integer('q1_qty')->nullable();
                $table->integer('q2_qty')->nullable();
                $table->integer('q3_qty')->nullable();
                $table->integer('q4_qty')->nullable();
    
                $table->double('q1_amt',15,2)->nullable();
                $table->double('q2_amt',15,2)->nullable();
                $table->double('q3_amt',15,2)->nullable();
                $table->double('q4_amt',15,2)->nullable();
                
                $table->string('item_code');
                $table->string('created_by');
                $table->date('date_added');
                $table->string('all')->default('0');
                $table->string('added_by');
                $table->string('division');
                $table->primary(array('item','created_by','ppcode','code'));
            });


        } else {
            Schema::create('sub_item',function($table){
                
                $table->string('code')->nullable();
                $table->string("ppcode")->nullable();
                $table->string('item')->nullable();
                $table->string('unit')->nullable();
    
    
                $table->integer('q1_qty')->nullable();
                $table->integer('q2_qty')->nullable();
                $table->integer('q3_qty')->nullable();
                $table->integer('q4_qty')->nullable();
    
                $table->double('q1_amt',15,2)->nullable();
                $table->double('q2_amt',15,2)->nullable();
                $table->double('q3_amt',15,2)->nullable();
                $table->double('q4_amt',15,2)->nullable();
                
                $table->string('item_code');
                $table->string('created_by');
                $table->date('date_added');
                $table->string('all')->default('0');
                $table->string('added_by');
                $table->string('division');
                $table->primary(array('item','created_by','ppcode','code'));
            });
        }
    }

    public function program_subitem()
    {
        if(Schema::hasTable('program_subitem')) {
            Schema::drop('program_subitem');

            Schema::create('program_subitem',function($table){
                
                $table->string('venue_id');
                $table->string('program_id');
                $table->string('code');
                $table->string('ppcode')->nullable();
                $table->string('item')->nullable();
                $table->string('unit')->nullable();


                $table->integer('q1_qty')->nullable();
                $table->integer('q2_qty')->nullable();
                $table->integer('q3_qty')->nullable();
                $table->integer('q4_qty')->nullable();

                $table->double('q1_amt',15,2)->nullable();
                $table->double('q2_amt',15,2)->nullable();
                $table->double('q3_amt',15,2)->nullable();
                $table->double('q4_amt',15,2)->nullable();
                
                $table->string('item_code');
                $table->timestamp('date_added');
                $table->string('created_by');
                $table->string('added_by');
                $table->string('division');
                $table->primary(array('created_by','venue_id','program_id','code'));
            });


        } else {
            Schema::create('program_subitem',function($table){
                
                $table->string('venue_id');
                $table->string('program_id');
                $table->string('code');
                $table->string('ppcode')->nullable();
                $table->string('item')->nullable();
                $table->string('unit')->nullable();


                $table->integer('q1_qty')->nullable();
                $table->integer('q2_qty')->nullable();
                $table->integer('q3_qty')->nullable();
                $table->integer('q4_qty')->nullable();

                $table->double('q1_amt',15,2)->nullable();
                $table->double('q2_amt',15,2)->nullable();
                $table->double('q3_amt',15,2)->nullable();
                $table->double('q4_amt',15,2)->nullable();

                $table->string('item_code');
                $table->timestamp('date_added');
                $table->string('created_by');
                $table->string('added_by');
                $table->string('division');
                $table->primary(array('created_by','venue_id','program_id','code'));
            });
        }
    }
}


?>