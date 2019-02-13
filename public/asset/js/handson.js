
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

$(document).ready(function(){
//PER EMPLOYEE
    var container = document.getElementById('example1');
    var hot;
    hot = new Handsontable(container, {
        startRows: 8,
        startCols: 11,
        rowHeaders: true,
        colWidths : [1,300,90,90,120,90,120,90,120,90,120,120],
        colHeaders: true,
        contextMenu: true,
        search:true,
        colHeaders: ['Code','Item Description/ General Specification', 'Unit','Q1 Qty.','Q1 Amt.','Q2 Qty.','Q2 Amt.','Q3 Qty.','Q3 Amt.','Q4 Qty.','Q4 Amt.'],
        cells: function(r,c, prop) {
            var cellProperties = {};
            if (c === 3 || c === 5 || c === 7 || c === 9) cellProperties.readOnly = true;
            return cellProperties;
        },
        afterChange : function(change,source){

            var url = $("#example1").data('save');
            var tabledata = this.getData();
            for(var i = 0; i < tabledata.length; i++)
            {
                try { tabledata[i][4] = tabledata[i][4].toString().replace(/,/g, ''); } catch(err) {  tabledata[i][4] = null; }
                try { tabledata[i][6] = tabledata[i][6].toString().replace(/,/g, ''); } catch(err) {  tabledata[i][6] = null; }
                try { tabledata[i][8] = tabledata[i][8].toString().replace(/,/g, ''); } catch(err) {  tabledata[i][8] = null; }
                try { tabledata[i][10] = tabledata[i][10].toString().replace(/,/g, ''); } catch(err) {  tabledata[i][10] = null; }
            }
            
            var postdata = {
                data : JSON.stringify(tabledata)
            };
            $.post(url,postdata , function (res) {
                console.log(res);
            });
        },
        beforeRemoveRow : function(index,amount) {
            var items = this.getData();
            var row_item = items[index][1];
            var url = $("#example1").data('delete');
            
            var postdata = {
                item : row_item
            };
            $.post(url, postdata, function (res) {
                console.log(res);
            });
            
            if(items.length == 1) {
                var item = [['','','','','','','','','','','']];
                this.loadData(item);
            }
        }
    });
    
    var url = $("#example1").data('get');

    $.get(url,function(resdata){
        hot.loadData(JSON.parse(resdata));
    });

// PER / SECTION

    var container2 = document.getElementById('example2');
    var hot2;

    hot2 = new Handsontable(container2, {
        startRows: 8,
        startCols: 11,
        rowHeaders: true,
        colWidths : [1,300,90,90,120,90,120,90,120,90,120,120],
        colHeaders: true,
        contextMenu: true,
        search:true,
        colHeaders: ['Code','Item Description/ General Specification', 'Unit','Q1 Qty.','Q1 Amt.','Q2 Qty.','Q2 Amt.','Q3 Qty.','Q3 Amt.','Q4 Qty.','Q4 Amt.'],
        cells: function(r,c, prop) {
            var cellProperties = {};
            if (c === 3 || c === 5 || c === 7 || c === 9) cellProperties.readOnly = true;
            return cellProperties;
        },
        afterChange : function(change,source){
            var url = $("#example2").data('save');
            var tabledata = this.getData();
            for(var i = 0; i < tabledata.length; i++)
            {
                try { tabledata[i][4] = tabledata[i][4].toString().replace(/,/g, ''); } catch(err) {  tabledata[i][4] = null; }
                try { tabledata[i][6] = tabledata[i][6].toString().replace(/,/g, ''); } catch(err) {  tabledata[i][6] = null; }
                try { tabledata[i][8] = tabledata[i][8].toString().replace(/,/g, ''); } catch(err) {  tabledata[i][8] = null; }
                try { tabledata[i][10] = tabledata[i][10].toString().replace(/,/g, ''); } catch(err) {  tabledata[i][10] = null; }
            }
        
            var postdata = {
                data : JSON.stringify(tabledata)
            };
            $.post(url,postdata , function (res) {
                console.log(res);
            });
        },
        beforeRemoveRow : function(index,amount) {
            var items = this.getData();
            var row_item = items[index][1];
            var url = $("#example2").data('delete');
            
            var postdata = {
                item : row_item
            };
            $.post(url, postdata, function (res) {
                console.log(res);
            });

            if(items.length == 1) {
                var item = [['','','','','','','','','','','']];
                this.loadData(item);
            }
        }
    });
    var url = $("#example2").data('get');
    $.get(url,function(resdata){
        hot2.loadData(JSON.parse(resdata));
    });


// TRAINING SUPPLIES


    var container3 = document.getElementById('example3');
    var hot3;

    hot3 = new Handsontable(container3, {
        startRows: 8,
        startCols: 11,
        rowHeaders: true,
        colWidths : [1,300,90,90,120,90,120,90,120,90,120,120],
        colHeaders: true,
        contextMenu: true,
        search:true,
        colHeaders: ['Code','Item Description/ General Specification', 'Unit','Q1 Qty.','Q1 Amt.','Q2 Qty.','Q2 Amt.','Q3 Qty.','Q3 Amt.','Q4 Qty.','Q4 Amt.'],
        cells: function(r,c, prop) {
            var cellProperties = {};
            if (c === 3 || c === 5 || c === 7 || c === 9) cellProperties.readOnly = true;
            return cellProperties;
        },
        afterChange : function(change,source){
            try {
                var url = $("#example3").data('save');
                var tabledata = this.getData();
                for(var i = 0; i < tabledata.length; i++)
                {
                    try { tabledata[i][4] = tabledata[i][4].toString().replace(/,/g, ''); } catch(err) {  tabledata[i][4] = null; }
                    try { tabledata[i][6] = tabledata[i][6].toString().replace(/,/g, ''); } catch(err) {  tabledata[i][6] = null; }
                    try { tabledata[i][8] = tabledata[i][8].toString().replace(/,/g, ''); } catch(err) {  tabledata[i][8] = null; }
                    try { tabledata[i][10] = tabledata[i][10].toString().replace(/,/g, ''); } catch(err) {  tabledata[i][10] = null; }
                }
            
                var postdata = {
                    data : JSON.stringify(tabledata)
                };
                $.post(url,postdata , function (res) {
                        console.log(res);
                });
            } catch (err) {
                console.log(err.message);
            }
        },
        beforeRemoveRow : function(index,amount) {
            var items = this.getData();
            var row_item = items[index][0];
            var url = $("#example3").data('delete');
            
            var postdata = {
                data : row_item
            };
            $.post(url, postdata, function (res) {
                console.log(res);
            });

            if(items.length == 1) {
                var item = [['','','','','','','','','','','']];
                this.loadData(item);
            }
        }
    });

    var url = $("#example3").data('get');
    $.get(url,function(resdata){
        hot3.loadData(JSON.parse(resdata));
    });

    //EQUIPMENT CONSUMABLES
    var container4 = document.getElementById('example4');
    var hot4;

    hot4 = new Handsontable(container4, {

        startRows: 8,
        startCols: 11,
        rowHeaders: true,
        colWidths : [1,300,90,90,120,90,120,90,120,90,120,120],
        colHeaders: true,
        contextMenu: true,
        search:true,
        colHeaders: ['Code','Item Description/ General Specification', 'Unit','Q1 Qty.','Q1 Amt.','Q2 Qty.','Q2 Amt.','Q3 Qty.','Q3 Amt.','Q4 Qty.','Q4 Amt.'],
        cells: function(r,c, prop) {
            var cellProperties = {};
            if (c === 3 || c === 5 || c === 7 || c === 9) cellProperties.readOnly = true;
            return cellProperties;
        },
        afterChange : function(change,source){
                
            var url = $("#example4").data('save');
            var tabledata = this.getData();
            for(var i = 0; i < tabledata.length; i++)
            {
                try { tabledata[i][4] = tabledata[i][4].toString().replace(/,/g, ''); } catch(err) {  tabledata[i][4] = null; }
                try { tabledata[i][6] = tabledata[i][6].toString().replace(/,/g, ''); } catch(err) {  tabledata[i][6] = null; }
                try { tabledata[i][8] = tabledata[i][8].toString().replace(/,/g, ''); } catch(err) {  tabledata[i][8] = null; }
                try { tabledata[i][10] = tabledata[i][10].toString().replace(/,/g, ''); } catch(err) {  tabledata[i][10] = null; }
            }
            
            var postdata = {
                data : JSON.stringify(tabledata)
            };
            $.post(url,postdata , function (res) {
                    console.log(res);
            });
        },
        beforeRemoveRow : function(index,amount) {
            var items = this.getData();
            var row_item = items[index][0];
            var url = $("#example4").data('delete');
            
            var postdata = {
                data : row_item
            };
            $.post(url, postdata, function (res) {
                console.log(res);
            });

            if(items.length == 1) {
                var item = [['','','','','','','','','','','']];
                this.loadData(item);
            }
        }
    });

    var url = $("#example4").data('get');
    $.get(url,function(resdata){
        hot4.loadData(JSON.parse(resdata));
    });

    // NON-CONSUMABLE - PER EMPLOYEE

    var container5 = document.getElementById('example5');
    var hot5;

    hot5 = new Handsontable(container5, {
        startRows: 8,
        startCols: 11,
        rowHeaders: true,
        colWidths : [1,300,90,90,120,90,120,90,120,90,120,120],
        colHeaders: true,
        contextMenu: true,
        search:true,
        colHeaders: ['Code','Item Description/ General Specification', 'Unit','Q1 Qty.','Q1 Amt.','Q2 Qty.','Q2 Amt.','Q3 Qty.','Q3 Amt.','Q4 Qty.','Q4 Amt.'],
        cells: function(r,c, prop) {
            var cellProperties = {};
            if (c === 3 || c === 5 || c === 7 || c === 9) cellProperties.readOnly = true;
            return cellProperties;
        },
        afterChange : function(change,source){

            var url = $("#example5").data('save');
            var tabledata = this.getData();
            for(var i = 0; i < tabledata.length; i++)
            {
                try { tabledata[i][4] = tabledata[i][4].toString().replace(/,/g, ''); } catch(err) {  tabledata[i][4] = null; }
                try { tabledata[i][6] = tabledata[i][6].toString().replace(/,/g, ''); } catch(err) {  tabledata[i][6] = null; }
                try { tabledata[i][8] = tabledata[i][8].toString().replace(/,/g, ''); } catch(err) {  tabledata[i][8] = null; }
                try { tabledata[i][10] = tabledata[i][10].toString().replace(/,/g, ''); } catch(err) {  tabledata[i][10] = null; }
            }
        
            var postdata = {
                data : JSON.stringify(tabledata)
            };
            $.post(url,postdata , function (res) {
                    console.log(res);
            });
        },
        beforeRemoveRow : function(index,amount) {
            var items = this.getData();
            var row_item = items[index][0];
            var url = $("#example5").data('delete');
            
            var postdata = {
                data : row_item
            };
            $.post(url, postdata, function (res) {
                console.log(res);
            });

            if(items.length == 1) {
                var item = [['','','','','','','','','','','']];
                this.loadData(item);
            }
        }
    });

    var url = $("#example5").data('get');
    $.get(url,function(resdata){
        hot5.loadData(JSON.parse(resdata));
    });


    var container6 = document.getElementById('example6');
    var hot6;

    hot6 = new Handsontable(container6, {
        startRows: 8,
        startCols: 11,
        rowHeaders: true,
        colWidths : [1,300,90,90,120,90,120,90,120,90,120,120],
        colHeaders: true,
        contextMenu: true,
        search:true,
        colHeaders: ['Code','Item Description/ General Specification', 'Unit','Q1 Qty.','Q1 Amt.','Q2 Qty.','Q2 Amt.','Q3 Qty.','Q3 Amt.','Q4 Qty.','Q4 Amt.'],
        cells: function(r,c, prop) {
            var cellProperties = {};
            if (c === 3 || c === 5 || c === 7 || c === 9) cellProperties.readOnly = true;
            return cellProperties;
        },
    });


    //II. SEMI-EXPANDABLE EQUIPEMENT AND FURNITURE - PER EMPLOYEE
    var container7 = document.getElementById('example7');
    var hot7;

    hot7 = new Handsontable(container7, {
        startRows: 8,
        startCols: 11,
        rowHeaders: true,
        colWidths : [1,300,90,90,120,90,120,90,120,90,120,120],
        colHeaders: true,
        contextMenu: true,
        search:true,
        colHeaders: ['Code','Item Description/ General Specification', 'Unit','Q1 Qty.','Q1 Amt.','Q2 Qty.','Q2 Amt.','Q3 Qty.','Q3 Amt.','Q4 Qty.','Q4 Amt.'],
        cells: function(r,c, prop) {
            var cellProperties = {};
            if (c === 3 || c === 5 || c === 7 || c === 9) cellProperties.readOnly = true;
            return cellProperties;
        },
        afterChange : function(change,source){
                
            var url = $("#example7").data('save');
            var tabledata = this.getData();
            for(var i = 0; i < tabledata.length; i++)
            {
                try { tabledata[i][4] = tabledata[i][4].toString().replace(/,/g, ''); } catch(err) {  tabledata[i][4] = null; }
                try { tabledata[i][6] = tabledata[i][6].toString().replace(/,/g, ''); } catch(err) {  tabledata[i][6] = null; }
                try { tabledata[i][8] = tabledata[i][8].toString().replace(/,/g, ''); } catch(err) {  tabledata[i][8] = null; }
                try { tabledata[i][10] = tabledata[i][10].toString().replace(/,/g, ''); } catch(err) {  tabledata[i][10] = null; }
            }
            var postdata = {
                data : JSON.stringify(tabledata)
            };
            $.post(url,postdata , function (res) {
                    console.log(res);
            });
        },
        beforeRemoveRow : function(index,amount) {
            var items = this.getData();
            var row_item = items[index][0];
            var url = $("#example7").data('delete');
            
            var postdata = {
                data : row_item
            };
            $.post(url, postdata, function (res) {
                console.log(res);
            });

            if(items.length == 1) {
                var item = [['','','','','','','','','','','']];
                this.loadData(item);
            }
        }
    });

    var url = $("#example7").data('get');
    $.get(url,function(resdata){
        hot7.loadData(JSON.parse(resdata));
    });


    var container8 = document.getElementById('example8');
    var hot8;

    hot8 = new Handsontable(container8, {
        startRows: 8,
        startCols: 11,
        rowHeaders: true,
        colWidths : [1,300,90,90,120,90,120,90,120,90,120,120],
        colHeaders: true,
        contextMenu: true,
        search:true,
        colHeaders: ['Code','Item Description/ General Specification', 'Unit','Q1 Qty.','Q1 Amt.','Q2 Qty.','Q2 Amt.','Q3 Qty.','Q3 Amt.','Q4 Qty.','Q4 Amt.'],
        cells: function(r,c, prop) {
            var cellProperties = {};
            if (c === 3 || c === 5 || c === 7 || c === 9) cellProperties.readOnly = true;
            return cellProperties;
        },
        afterChange : function(change,source){
            try {
                var url = $("#example8").data('save');
                var tabledata = this.getData();
                for(var i = 0; i < tabledata.length; i++)
                {
                    try { tabledata[i][4] = tabledata[i][4].toString().replace(/,/g, ''); } catch(err) {  tabledata[i][4] = null; }
                    try { tabledata[i][6] = tabledata[i][6].toString().replace(/,/g, ''); } catch(err) {  tabledata[i][6] = null; }
                    try { tabledata[i][8] = tabledata[i][8].toString().replace(/,/g, ''); } catch(err) {  tabledata[i][8] = null; }
                    try { tabledata[i][10] = tabledata[i][10].toString().replace(/,/g, ''); } catch(err) {  tabledata[i][10] = null; }
                }
            
                var postdata = {
                    data : JSON.stringify(tabledata)
                };
                $.post(url,postdata , function (res) {
                        console.log(res);
                });
            } catch (err) {
                console.log(err.message);
            }
            
        },
        beforeRemoveRow : function(index,amount) {
            var items = this.getData();
            var row_item = items[index][0];
            var url = $("#example8").data('delete');
            
            var postdata = {
                data : row_item
            };
            $.post(url, postdata, function (res) {
                console.log(res);
            });

            if(items.length == 1) {
                var item = [['','','','','','','','','','','']];
                this.loadData(item);
            }
        }
    });

    var url = $("#example8").data('get');
    $.get(url,function(resdata){
        hot8.loadData(JSON.parse(resdata));
    });
});




