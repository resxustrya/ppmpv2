
@extends('section.layout.layout')
@section('content')
<div id="sub_item" data-save="{{ asset('save/program/subtitem') }}" data-get="{{ asset('get/program/subitem') }}" data-delete="{{ asset('delete/program/subitem') }}" data-program_id="{{ $data['program_id'] }}" data-venue_id="{{ $data['venue_id'] }}" data-item_code="{{ $data['code'] }}"></div>
@endsection
@section('js')
    <script>
        var container = document.getElementById("sub_item");
        var hot;
        var valid = false;
        hot = new Handsontable(container, {
            startRows: 8,
            startCols: 13,
            rowHeaders: true,
            colWidths : [1,480,80,80,120,80,120,80,120,80,120,120,100],
            stretchH: 'all',
            colHeaders: true,
            filters :true,
            dropdownMenu: true,
            contextMenu: {
                items :{
                    "row_below" :{},
                    "row_above" :{},
                    "copy" : {},
                    "remove_row" :{}
                }
            },
            fillHandle: {
                autoInsertRow: false,
            },
            colHeaders: ['Code','Item Description/ General Specification', 'Unit','Q1 Qty.','Q1 Amt.','Q2 Qty.','Q2 Amt.','Q3 Qty.','Q3 Amt.','Q4 Qty.','Q4 Amt.','Total Amt.','Date Added'],
            cells: function(r,c, prop) {
                var cellProperties = {};
               if (c === 0 || c === 11) cellProperties.readOnly = true;
                return cellProperties;
            },
            beforeRemoveRow : function(index,amount) {
                var items = this.getData();
                var url = $("#sub_item").data('delete');
                var row_item = items[index];
                
                var program_id = $("#sub_item").data('program_id');
                var venue_id = $("#sub_item").data('venue_id');
                var item_code = $("#sub_item").data('item_code');
                
                var postdata = {
                    data : JSON.stringify(row_item),
                    venue_id : venue_id,
                    item_code : item_code,
                    program_id : program_id
                };
                
                $.post(url, postdata, function (res) {
                    
                });
                
                if(items.length == 1) {
                    var item = [['','','','','','','','','','','','']];
                    this.loadData(item);
                }
            }
        });
        $("#save").click(function(){
            document.body.style.cursor = 'wait';
            var tabledata = hot.getData();
            for(var i = 0; i < tabledata.length; i++)
            {
                try { tabledata[i][3] = tabledata[i][3].toString().replace(/,/g, ''); } catch(err) { tabledata[i][3] = null;  }
                try { tabledata[i][5] = tabledata[i][5].toString().replace(/,/g, ''); } catch(err) { tabledata[i][5] = null;  }
                try { tabledata[i][7] = tabledata[i][7].toString().replace(/,/g, ''); } catch(err) { tabledata[i][7] = null;  }
                try { tabledata[i][9] = tabledata[i][9].toString().replace(/,/g, ''); } catch(err) { tabledata[i][9] = null;  }

                try { tabledata[i][4] = tabledata[i][4].toString().replace(/,/g, ''); } catch(err) { tabledata[i][4] = null;  }
                try { tabledata[i][6] = tabledata[i][6].toString().replace(/,/g, ''); } catch(err) { tabledata[i][6] = null;  }
                try { tabledata[i][8] = tabledata[i][8].toString().replace(/,/g, ''); } catch(err) { tabledata[i][8] = null;  }
                try { tabledata[i][10] = tabledata[i][10].toString().replace(/,/g, ''); } catch(err) { tabledata[i][10] = null; }
            }
            
            var url = $("#sub_item").data('save');
            var postdata = {
                data: JSON.stringify(tabledata),
                program_id : $("#sub_item").data('program_id'),
                venue_id : $("#sub_item").data('venue_id'),
                item_code : $("#sub_item").data('item_code')
            };
            
            $.post(url, postdata, function (res) {
                hot.loadData(JSON.parse(res));
                document.body.style.cursor = 'default';
            });
        });
        
        var url = $("#sub_item").data('get');
        var program_id = $("#sub_item").data('program_id');
        var venue_id = $("#sub_item").data('venue_id');
        var item_code = $("#sub_item").data('item_code');
        var data = {
            program_id : program_id,
            venue_id : venue_id,
            item_code : item_code
        };
        $.get(url,data,function(resdata){
            hot.loadData(JSON.parse(resdata));
        });
    </script>
@endsection