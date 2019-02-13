
@extends('section.layout.layout')
@section('content')
    <div id="container8" data-save="{{ asset('save/section/table_g') }}" data-get="{{ asset('get/section/table_g') }}"></div>
@endsection
@section('js')
   <script>
       var container8 = document.getElementById('container8');
       var hot8;
       hot8 = new Handsontable(container8, {
           startRows: 8,
           startCols: 12,
           rowHeaders: true,
           colWidths : [1,480,80,80,120,80,120,80,120,80,120,120],
           stretchH: 'all',
           colHeaders: true,
           fillHandle: {
               autoInsertRow: false,
           },
           colHeaders: ['Code','Item Description/ General Specification', 'Unit','Q1 Qty.','Q1 Amt.','Q2 Qty.','Q2 Amt.','Q3 Qty.','Q3 Amt.','Q4 Qty.','Q4 Amt.','Total Amt.'],
           cells: function(r,c, prop) {
               var cellProperties = {};
               if (c === 1 || c === 2 || c === 4 || c === 6 || c === 8 || c === 10 || c === 11) cellProperties.readOnly = true;
               return cellProperties;
           }
       });
       
       $("#save").click(function(){
            document.body.style.cursor = 'wait';
            var tabledata = hot8.getData();
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
            
            var url = $("#container8").data('save');
            var postdata = {
                data: JSON.stringify(tabledata)
            };
            
            $.post(url, postdata, function (res) {
                hot8.loadData(JSON.parse(res));
                document.body.style.cursor = 'default';
            });
       });

       var url = $("#container8").data('get');
       $.get(url,function(resdata){
           hot8.loadData(JSON.parse(resdata));
       });


   </script>
@endsection