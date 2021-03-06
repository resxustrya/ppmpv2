
@extends('section.layout.layout')
@section('content')
<div id="open_list" data-save="{{ asset('save/section/open-list') }}" data-get="{{ asset('get/section/open-list') }}" data-delete="{{ asset('delete/item/open-list') }}" data-expense="{{ $expense['id']  }}" class="status" data-subitem="{{ asset('item/subitem') }}"></div>
@endsection
@section('js')
    <script>
        var container = document.getElementById("open_list");
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
            @if($expense['oneline'] == 0)
                contextMenu: {
                    items: {
                        "": {
                            name: 'Sub Item',
                            callback: function(key, options) {
                                var selection = this.getSelectedRange();
                                var fromRow = Math.min(selection.from.row, selection.to.row);
                                var tempdata = this.getData();
                                var id = tempdata[fromRow][0];
                                if (id) {
                                    var ppcode = $("#open_list").data('expense');
                                    window.location.href = $("#open_list").data('subitem') + "/" + id + "/" + ppcode;
                                }
                            }
                        },
                        "row_below": {}, "remove_row": {},"copy" :{}
                    }
                },
            @endif
            fillHandle: {
                autoInsertRow: false,
            },
            colHeaders: ['Code','Item Description/ General Specification', 'Unit','Q1 Qty.','Q1 Amt.','Q2 Qty.','Q2 Amt.','Q3 Qty.','Q3 Amt.','Q4 Qty.','Q4 Amt.','Total Amt.','Date Added'],
            
            cells: function(r,c, prop) {
                var cellProperties = {};
                if ({{$expense['oneline'] == 1 ? 'c === 1 || c === 2 || c === 3 || c === 4 || c === 5 || c === 6 || c === 7 || c === 8 || c === 9 || c === 10 || ' : ''}} c === 0 || c === 11) cellProperties.readOnly = true;
                return cellProperties;
            },
            beforeRemoveRow : function(index,amount) {
                var items = this.getData();
                var url = $("#open_list").data('delete');

                var row_item = items[index];
                var postdata = {
                    data : JSON.stringify(row_item),
                    expense : $("#open_list").data('expense')
                };
                
                $.post(url, postdata, function (res) {
                    console.log(res);
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
            
            var url = $("#open_list").data('save');
            var postdata = {
                data: JSON.stringify(tabledata),
                expense : $("#open_list").data('expense')
            };
            
            $.post(url, postdata, function (res) {
                hot.loadData(JSON.parse(res));
                document.body.style.cursor = 'default';
            });
        });

        var url = $("#open_list").data('get');
        var ppcode = $("#open_list").data('expense');
        var data = {
            ppcode : ppcode
        };
        $.get(url,data,function(resdata){
            hot.loadData(JSON.parse(resdata));
        });
    </script>
@endsection