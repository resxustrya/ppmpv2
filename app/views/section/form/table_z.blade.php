
@extends('section.layout.layout')
@section('content')
<div id="container6" data-save="{{ asset('save/section/table_z') }}" data-get="{{ asset('get/section/table_z') }}" data-delete="{{ asset('delete/item/table_z') }}"></div>

@endsection
@section('js')
    <script>
        var container6 = document.getElementById('container6');
        var hot6;
        var valid = false;
        hot6 = new Handsontable(container6, {
            startRows: 8,
            startCols: 12,
            rowHeaders: true,
            colWidths : [1,480,80,80,120,80,120,80,120,80,120,120],
            stretchH: 'all',
            colHeaders: true,
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
            colHeaders: ['Code','Item Description/ General Specification', 'Unit','Q1 Qty.','Q1 Amt.','Q2 Qty.','Q2 Amt.','Q3 Qty.','Q3 Amt.','Q4 Qty.','Q4 Amt.','Total Amt.'],
            cells: function(r,c, prop) {
                var cellProperties = {};
                if (c ===  0 || c === 11) cellProperties.readOnly = true;
                return cellProperties;
            },
            beforeRemoveRow : function(index,amount) {
                var items = this.getData();
                var url = $("#container6").data('delete');
            
                var row_item = items[index];
                var postdata = {
                    data : JSON.stringify(row_item)
                };
                $.post(url, postdata, function (res) {
                    console.log(res);
                });
                if(items.length == 1) {
                    var item = ['','','','','',''];
                    this.loadData(items);
                }
            }
        });
        $("#save").click(function(){
            document.body.style.cursor = 'wait';
            var tabledata = hot6.getData();
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
            var url = $("#container6").data('save');
            var postdata = {
                data: JSON.stringify(tabledata)
            };
            
            $.post(url, postdata, function (res) {
                hot6.loadData(JSON.parse(res));
                document.body.style.cursor = 'default';
            });
        });
        var url = $("#container6").data('get');
        $.get(url,function(resdata){
            var data = JSON.parse(resdata);
            hot6.loadData(data);
        });
    </script>
@endsection