
@extends('section.layout.layout')
@section('content')
    <div id="table" data-get="{{ asset('get/section/table_a') }}" data-edit="false" data-page="Office Supplies / Per Employee"></div>
@endsection
@section('js')
    <script>
        var remove_url = null;
        var save_url = null;
        var container = document.getElementById("table");
        var table;
        table = new Handsontable(container, {
            startRows: 50,
            startCols: 12,
            manualColumnResize: true,
            rowHeaders: true,
            colWidths : [1,450,80,80,120,80,120,80,120,80,120,120,130,120],
            colHeaders: true,
            contextMenu: true,
            fillHandle: {
                autoInsertRow: false,
            },
            colHeaders: ['Code','Item Description/ General Specification', 'Unit','Q1 Qty.','Q1 Amt.','Q2 Qty.','Q2 Amt.','Q3 Qty.','Q3 Amt.','Q4 Qty.','Q4 Amt.','Total Amt.'],
        });

        var def = $("#table");
        get_data(def);

        $("#save").click(function () {
            var tabledata = JSON.stringify({ data : table.getData() });
        });
        function get_data(el)
        {
            var url = $(el).data('get');
            save_url = $(el).data('save');
            var edit = $(el).data('edit');
            var page = $(el).data('page');
            if(edit == false){
                table.updateSettings({
                    contextMenu : false,
                    cells: function(r,c, prop) {
                        var cellProperties = {};
                        if (c === 1 || c === 2 || c === 4 || c === 6 || c === 8 || c === 10 || c === 11) cellProperties.readOnly = true;
                        return cellProperties;
                    }
                });
            } else {
                table.updateSettings({
                    contextMenu : true,
                    cells: function(r,c, prop) {
                        var cellProperties = {};
                        cellProperties.readOnly = false;
                        return cellProperties;
                    }
                });
            }
            $.get(url,function (data) {
                table.loadData(JSON.parse(data));
                $("#page").text(page);
            });
        }
    </script>
@endsection