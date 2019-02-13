
@extends('section.layout.layout')
@section('content')
<div id="program" data-save="{{ asset('save/section/program') }}" data-get="{{ asset('get/section/program') }}" data-delete="{{ asset('delete/section/program') }}" data-program="{{ $program_items['program_id'] }}" data-venue="{{ $program_items['venue_id'] }}" data-subitem="{{ asset('program-item/subitem') }}"></div>
@endsection
@section('js')
    <script>
        var container = document.getElementById("program");
        var hot;
        var valid = false;
        hot = new Handsontable(container, {
            startRows: 50,
            startCols: 12,
            rowHeaders: true,
            colWidths : [1,480,80,80,120,80,120,80,120,80,120,120],
            stretchH: 'all',
            colHeaders: true,
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
                                var program_id = $("#program").data('program');
                                var venue_id = $("#program").data('venue');
                                window.location.href = $("#program").data('subitem') + "/" + program_id + "/" + venue_id + "/" + id;
                            }
                        }
                    },
                    "row_below": {}, "remove_row": {},"copy" :{},
                }
            },
            
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
                var url = $("#program").data('delete');

                var row_item = items[index];
                var postdata = {
                    data : JSON.stringify(row_item),

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
            var url = $("#program").data('save');
            var program_id = $("#program").data('program');
            var venue_id = $("#program").data('venue');
            
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
            var postdata = {
                data: JSON.stringify(tabledata),
                program_id : program_id,
                venue_id : venue_id
            };

            $.post(url, postdata, function (res) {
                hot.loadData(JSON.parse(res));
                document.body.style.cursor = 'default';
            });
        });

        var url = $("#program").data('get');
        var program_id = $("#program").data('program');
        var venue_id = $("#program").data('venue');
        var data = {
            program_id : program_id,
            venue_id : venue_id
        };
        $.get(url,data,function(resdata){
            hot.loadData(JSON.parse(resdata));
        });
    </script>
@endsection