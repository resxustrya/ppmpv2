<script>
                    
    var container{{ $program->id."_".$venue->id }} = document.getElementById("container{{  $program->id."_".$venue->id }}");
    var hot{{ $program->id."_".$venue->id }};
    
    hot{{ $program->id."_".$venue->id }} = new Handsontable(container{{$program->id."_".$venue->id}}, {
        startRows: 8,
        startCols: 12,
        rowHeaders: true,
        colWidths : [1,280,80,80,120,80,120,80,120,80,120,120,130],
        colHeaders: true,
            contextMenu: true,
        fillHandle: {
            autoInsertRow: false,
        },
        colHeaders: ['Code','Item Description/ General Specification', 'Unit','Q1 Qty.','Q1 Amt.','Q2 Qty.','Q2 Amt.','Q3 Qty.','Q3 Amt.','Q4 Qty.','Q4 Amt.','Total Amt.'],
        cells: function(r,c, prop) {
            var cellProperties = {};
            if (c === 0 || c === 11) cellProperties.readOnly = true;
            return cellProperties;
        },
        
        afterChange : function(change,source){
            if(source == 'edit') {

                var tempdata = this.getData();
                var ok = false;
                var q1_total,q2_total,q3_total,q4_total;

                for(var i = 0; i < tempdata.length; i++)
                {
                    if(tempdata[i][1] != null && tempdata[i][2] != null) {
                        q1_total = 0; q2_total = 0; q3_total = 0; q4_total = 0;
                        try{ //for quarter 1 computation
                            var q1_qty = tempdata[i][3].toString().replace(/,/g, '');
                            var q1_amt = tempdata[i][4].toString().replace(/,/g, '');

                            if(isNaN(q1_qty) == false && isNaN(q1_amt) == false) {
                                ok = true;
                                q1_total = q1_qty * q1_amt;
                                tempdata[i][3] = numberWithCommas(q1_qty);
                                tempdata[i][4] = numberWithCommas(q1_amt);
                            } else {
                                ok = false;
                                tempdata[i][3] = null;
                                tempdata[i][4] = null;
                            }
                        }catch(err) {

                        }
                        try {  //for quarter 2 computation
                            var q2_qty = tempdata[i][5].toString().replace(/,/g, '');
                            var q2_amt = tempdata[i][6].toString().replace(/,/g, '');

                            if(isNaN(q2_qty) == false && isNaN(q2_amt) == false) {
                                ok = true;
                                q2_total = q2_qty * q2_amt;
                                tempdata[i][5] = numberWithCommas(q2_qty);
                                tempdata[i][6] = numberWithCommas(q2_amt);
                            } else {
                                ok = false;
                                tempdata[i][5] = null;
                                tempdata[i][6] = null;
                            }

                        }catch(err){

                        }
                        try {  //for quarter 3 computation
                            var q3_qty = tempdata[i][7].toString().replace(/,/g, '');
                            var q3_amt = tempdata[i][8].toString().replace(/,/g, '');

                            if(isNaN(q3_qty) == false && isNaN(q3_amt) == false) {
                                ok = true;
                                q3_total = q3_qty * q3_amt;
                                tempdata[i][7] = numberWithCommas(q3_qty);
                                tempdata[i][8] = numberWithCommas(q3_amt);
                            } else {
                                ok = false;
                                tempdata[i][7] = null;
                                tempdata[i][8] = null;
                            }

                        }catch(err){

                        }
                        try {  //for quarter 4 computation
                            var q4_qty = tempdata[i][9].toString().replace(/,/g, '');
                            var q4_amt = tempdata[i][10].toString().replace(/,/g, '');

                            if(isNaN(q4_qty) == false && isNaN(q4_amt) == false) {
                                ok = true;
                                q4_total = q4_qty * q4_amt;
                                tempdata[i][9] = numberWithCommas(q4_qty);
                                tempdata[i][10] = numberWithCommas(q4_amt);
                            } else {
                                ok = false;
                                tempdata[i][9] = null;
                                tempdata[i][10] = null;
                            }
                        }catch(err){

                        }
                        var table_a_total = q1_total + q2_total + q3_total + q4_total;
                        if(table_a_total > 0) { tempdata[i][11] = numberWithCommas(table_a_total); }
                    } else {
                        ok = false;
                    }
                }
                this.loadData(tempdata);
                if(ok) {
                    var url = $("#container{{$program->id."_".$venue->id}}").data('save');
                    var program_id = $("#container{{$program->id."_".$venue->id}}").data('program');
                    var venue_id = $("#container{{$program->id."_".$venue->id}}").data('venue');
                    
                    var tabledata = this.getData();
                    for(var i = 0; i < tabledata.length; i++)
                    {
                        try { tabledata[i][3] = tabledata[i][3].toString().replace(/,/g, ''); } catch(err) {   }
                        try { tabledata[i][5] = tabledata[i][5].toString().replace(/,/g, ''); } catch(err) {   }
                        try { tabledata[i][7] = tabledata[i][7].toString().replace(/,/g, ''); } catch(err) {   }
                        try { tabledata[i][9] = tabledata[i][9].toString().replace(/,/g, ''); } catch(err) {   }

                        try { tabledata[i][4] = tabledata[i][4].toString().replace(/,/g, ''); } catch(err) {   }
                        try { tabledata[i][6] = tabledata[i][6].toString().replace(/,/g, ''); } catch(err) {   }
                        try { tabledata[i][8] = tabledata[i][8].toString().replace(/,/g, ''); } catch(err) {   }
                        try { tabledata[i][10] = tabledata[i][10].toString().replace(/,/g, ''); } catch(err) {   }
                    }
                    var postdata = {
                        data: JSON.stringify(tabledata),
                        program_id : program_id,
                        venue_id : venue_id
                    };

                    $.post(url, postdata, function (res) {

                    });
                }
            }
        },
        beforeRemoveRow : function(index,amount) {
            var items = this.getData();
            var url = $("#container{{ $program->id."_".$venue->id }}").data('delete');
            var program_id = $("#container{{ $program->id."_".$venue->id }}").data('program');
            var venue_id = $("#container{{ $program->id."_".$venue->id }}").data('venue');
            var row_item = items[index];
            
            var postdata = {
                data : JSON.stringify(row_item),
                program_id : program_id,
                venue_id : venue_id
            };
            $.post(url, postdata, function (res) {
                console.log(res);
            });

            if(items.length == 1) {
                var item = array('','','','','');
                this.loadData(items);
            }
        }
    });

    var url = $("#container{{$program->id."_".$venue->id}}").data('get');
    var program_id = $("#container{{$program->id."_".$venue->id}}").data('program');
    var venue_id = $("#container{{$program->id."_".$venue->id}}").data('venue');
    var data = {
        program_id : program_id,
        venue_id : venue_id
    };
    $.get(url,data,function(resdata){
        hot{{ $program->id."_".$venue->id }}.loadData(JSON.parse(resdata));
    });
</script>