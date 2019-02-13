
@extends('section.layout.layout')
@section('content')
<div id="sub_item" data-save="{{ asset('save/subitem')}}" data-get="{{ asset('get/subitem') }}" data-delete="{{ asset('delete/subitem') }}" data-item_code="{{ $data['item_code'] }}" data-ppcode="{{ $data['ppcode'] }}"></div>
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
            colWidths : [100,480,80,80,120,80,120,80,120,80,120,120,100],
            stretchH: 'all',
            colHeaders: true,
            filters :true,
            dropdownMenu: true,
            contextMenu: true,
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
                var item_code = $("#sub_item").data('item_code');
                var postdata = {
                    data : JSON.stringify(row_item),
                    item_code : item_code,
                    ppcode : $("#sub_item").data('ppcode')
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
            var ppcode = $("#sub_item").data('ppcode');
            var item_code = $("#sub_item").data('item_code');    

            var postdata = {
                data: JSON.stringify(tabledata),
                ppcode : ppcode,
                item_code : item_code
            };
            
            $.post(url, postdata, function (res) {
                hot.loadData(JSON.parse(res));
                document.body.style.cursor = 'default';
            });
        });

        var url = $("#sub_item").data('get');
        var ppcode = $("#sub_item").data('ppcode');
        var item_code = $("#sub_item").data('item_code');
        var data = {
            ppcode : ppcode,
            item_code : item_code
        };

        $.get(url,data,function(resdata){
            hot.loadData(JSON.parse(resdata));
        });
    </script>
@endsection