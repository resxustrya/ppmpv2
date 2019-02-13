
@extends('section.layout.layout')
@section('content')
<div id="container4" data-save="{{ asset('save/section/table_d') }}" data-get="{{ asset('get/section/table_d') }}" data-delete="{{ asset('delete/section/table_d') }}"></div>
@endsection
@section('js')
    <script>
    var container4 = document.getElementById('container4');
        var hot4;
        var valid = false;
        hot4 = new Handsontable(container4, {
            startRows: 8,
            startCols: 12,
            rowHeaders: true,
            colWidths : [1,480,80,80,120,80,120,80,120,80,120,120],
            stretchH: 'all',
            colHeaders: true,
            contextMenu: true,
            fillHandle: {
                autoInsertRow: false,
            },
            colHeaders: ['Code','Item Description/ General Specification', 'Unit','Q1 Qty.','Q1 Amt.','Q2 Qty.','Q2 Amt.','Q3 Qty.','Q3 Amt.','Q4 Qty.','Q4 Amt.','Total Amt.'],
            cells: function(r,c, prop) {
                var cellProperties = {};
                if (c === 0) cellProperties.readOnly = true;
                return cellProperties;
            },
            beforeRemoveRow : function(index,amount) {
                var items = this.getData();
                var url = $("#container4").data('delete');

                var row_item = items[index];
                var postdata = {
                    data : JSON.stringify(row_item)
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
        $("#save").click(function(){
            document.body.style.cursor = 'wait';
            var tabledata = hot4.getData();
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
            var url = $("#container4").data('save');
            var postdata = {
                data: JSON.stringify(tabledata)
            };

            $.post(url, postdata, function (res) {
                hot4.loadData(JSON.parse(res));
                document.body.style.cursor = 'default';
            });
            
        });

        var url = $("#container4").data('get');
        $.get(url,function(resdata){
            hot4.loadData(JSON.parse(resdata));
        });
//end of container 4

    </script>
@endsection