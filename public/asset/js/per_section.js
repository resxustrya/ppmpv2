
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

$(document).ready(function(){
    
    var container1 = document.getElementById('container1');

    var hot1;

    hot1 = new Handsontable(container1, {
        startRows: 8,
        startCols: 12,
        rowHeaders: true,
        colWidths : [1,280,80,80,120,80,120,80,120,80,120,120,130],
        colHeaders: true,
        fillHandle: {
    		autoInsertRow: false,
        },
        colHeaders: ['Code','Item Description/ General Specification', 'Unit','Q1 Qty.','Q1 Amt.','Q2 Qty.','Q2 Amt.','Q3 Qty.','Q3 Amt.','Q4 Qty.','Q4 Amt.','Total Amt.'],
        cells: function(r,c, prop) {
            var cellProperties = {};
            if (c === 1 || c === 2 || c === 4 || c === 6 || c === 8 || c === 10 || c === 11) cellProperties.readOnly = true;
            return cellProperties;
        },
        afterChange : function(change,source){
            if(source == 'edit') {
                var tempdata = this.getData();
                var ok = false;
                var q1_total,q2_total,q3_total,q4_total;
                for(var i = 0; i < tempdata.length; i++)
                {
                    q1_total = 0; q2_total = 0; q3_total = 0; q4_total = 0;
                    try{ //for quarter 1 computation
                        var q1_qty = tempdata[i][3].toString().replace(/,/g, '');
                        var q1_amt = tempdata[i][4].toString().replace(/,/g, '');
                        
                        if(isNaN(q1_qty) == false && isNaN(q1_amt) == false) {
                            q1_total = q1_qty * q1_amt;
                            tempdata[i][3] = numberWithCommas(q1_qty);
                        } else {
                            tempdata[i][3] = null;
                        }
                    }catch(err) {
                        console.log(err.message);
                        q1_total = 0;
                        tempdata[i][3] = null;
                    }
                   try {  //for quarter 2 computation
                        var q2_qty = tempdata[i][5].toString().replace(/,/g, '');
                        var q2_amt = tempdata[i][6].toString().replace(/,/g, '');
                        
                        if(isNaN(q2_qty) == false && isNaN(q2_amt) == false) {
                            q2_total = q2_qty * q2_amt;
                            tempdata[i][5] = numberWithCommas(q2_qty);
                        } else {
                            tempdata[i][5] = null;
                        }
                        
                    }catch(err){
                        console.log(err.message);
                        q2_total = 0;
                        tempdata[i][5] = null;
                    }
                    try {  //for quarter 3 computation
                        var q3_qty = tempdata[i][7].toString().replace(/,/g, '');
                        var q3_amt = tempdata[i][8].toString().replace(/,/g, '');
                       
                        if(isNaN(q3_qty) == false && isNaN(q3_amt) == false) {
                            q3_total = q3_qty * q3_amt;
                            tempdata[i][7] = numberWithCommas(q3_qty);
                        } else {
                            tempdata[i][7] = null;
                        }
                        
                    }catch(err){
                        console.log(err.message);
                        q3_total = 0;
                        tempdata[i][7] = null;
                    }
                    try {  //for quarter 4 computation
                        var q4_qty = tempdata[i][9].toString().replace(/,/g, '');
                        var q4_amt = tempdata[i][10].toString().replace(/,/g, '');
                        
                        if(isNaN(q4_qty) == false && isNaN(q4_amt) == false) {
                            q4_total = q4_qty * q4_amt;
                            tempdata[i][9] = numberWithCommas(q4_qty);
                        } else {
                            tempdata[i][9] = null;
                        }
                        
                    }catch(err){
                        console.log(err.message);
                        q4_total = 0;
                        tempdata[i][9] = null;
                    }
                    var table_a_total = q1_total + q2_total + q3_total + q4_total;
                    if(table_a_total > 0) { tempdata[i][11] = numberWithCommas(table_a_total); }
                }
                this.loadData(tempdata);
                
                var url = $("#container1").data('save');
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
                console.log(tabledata);
                var postdata = {
                    data : JSON.stringify(tabledata)
                };
                $.post(url,postdata , function (res) {
                    console.log(res);
                });
            }
        }
    });
    var url = $("#container1").data('get');
    $.get(url,function(resdata){
        hot1.loadData(JSON.parse(resdata));
    });

    var container2 = document.getElementById('container2');

    var hot2;

    hot2 = new Handsontable(container2, {
       startRows: 8,
        startCols: 12,
        rowHeaders: true,
        colWidths : [1,280,80,80,120,80,120,80,120,80,120,120,130],
        colHeaders: true,
        fillHandle: {
    		autoInsertRow: false,
        },
        colHeaders: ['Code','Item Description/ General Specification', 'Unit','Q1 Qty.','Q1 Amt.','Q2 Qty.','Q2 Amt.','Q3 Qty.','Q3 Amt.','Q4 Qty.','Q4 Amt.','Total Amt.'],
        cells: function(r,c, prop) {
            var cellProperties = {};
            if (c === 1 || c === 2 || c === 4 || c === 6 || c === 8 || c === 10 || c === 11) cellProperties.readOnly = true;
            return cellProperties;
        },
        afterChange : function(change,source){
            if(source == 'edit') {
                var tempdata = this.getData();
                var ok = false;
                var q1_total,q2_total,q3_total,q4_total;
                for(var i = 0; i < tempdata.length; i++)
                {
                    q1_total = 0; q2_total = 0; q3_total = 0; q4_total = 0;
                    try{ //for quarter 1 computation
                        var q1_qty = tempdata[i][3].toString().replace(/,/g, '');
                        var q1_amt = tempdata[i][4].toString().replace(/,/g, '');
                        
                        if(isNaN(q1_qty) == false && isNaN(q1_amt) == false) {
                            q1_total = q1_qty * q1_amt;
                            tempdata[i][3] = numberWithCommas(q1_qty);
                        } else {
                            tempdata[i][3] = null;
                        }
                    }catch(err) {
                        console.log(err.message);
                        q1_total = 0;
                        tempdata[i][3] = null;
                    }
                   try {  //for quarter 2 computation
                        var q2_qty = tempdata[i][5].toString().replace(/,/g, '');
                        var q2_amt = tempdata[i][6].toString().replace(/,/g, '');
                        
                        if(isNaN(q2_qty) == false && isNaN(q2_amt) == false) {
                            q2_total = q2_qty * q2_amt;
                            tempdata[i][5] = numberWithCommas(q2_qty);
                        } else {
                            tempdata[i][5] = null;
                        }
                        
                    }catch(err){
                        console.log(err.message);
                        q2_total = 0;
                        tempdata[i][5] = null;
                    }
                    try {  //for quarter 3 computation
                        var q3_qty = tempdata[i][7].toString().replace(/,/g, '');
                        var q3_amt = tempdata[i][8].toString().replace(/,/g, '');
                       
                        if(isNaN(q3_qty) == false && isNaN(q3_amt) == false) {
                            q3_total = q3_qty * q3_amt;
                            tempdata[i][7] = numberWithCommas(q3_qty);
                        } else {
                            tempdata[i][7] = null;
                        }
                        
                    }catch(err){
                        console.log(err.message);
                        q3_total = 0;
                        tempdata[i][7] = null;
                    }
                    try {  //for quarter 4 computation
                        var q4_qty = tempdata[i][9].toString().replace(/,/g, '');
                        var q4_amt = tempdata[i][10].toString().replace(/,/g, '');
                        
                        if(isNaN(q4_qty) == false && isNaN(q4_amt) == false) {
                            q4_total = q4_qty * q4_amt;
                            tempdata[i][9] = numberWithCommas(q4_qty);
                        } else {
                            tempdata[i][9] = null;
                        }
                        
                    }catch(err){
                        console.log(err.message);
                        q4_total = 0;
                        tempdata[i][9] = null;
                    }
                    var table_a_total = q1_total + q2_total + q3_total + q4_total;
                    if(table_a_total > 0) { tempdata[i][11] = numberWithCommas(table_a_total); }
                }
                this.loadData(tempdata);

                var url = $("#container2").data('save');
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
                console.log(tabledata);
                var postdata = {
                    data : JSON.stringify(tabledata)
                };
                $.post(url,postdata , function (res) {
                    console.log(res);
                });

            }
        }
    });

    var url = $("#container2").data('get');
    $.get(url,function(resdata){
        var data = JSON.parse(resdata);
        hot2.loadData(data);
    });

    var container3 = document.getElementById('container3');
    var hot3;

    hot3 = new Handsontable(container3, {
        startRows: 8,
        startCols: 12,
        rowHeaders: true,
        colWidths : [1,280,80,80,120,80,120,80,120,80,120,120,130],
        colHeaders: true,
        fillHandle: {
    		autoInsertRow: false,
        },
        colHeaders: ['Code','Item Description/ General Specification', 'Unit','Q1 Qty.','Q1 Amt.','Q2 Qty.','Q2 Amt.','Q3 Qty.','Q3 Amt.','Q4 Qty.','Q4 Amt.','Total Amt.'],
        cells: function(r,c, prop) {
            var cellProperties = {};
            if (c === 1 || c === 2 || c === 4 || c === 6 || c === 8 || c === 10 || c === 11) cellProperties.readOnly = true;
            return cellProperties;
        },
        afterChange : function(change,source){

            if(source == 'edit') {
                var tempdata = this.getData();
                var ok = false;
                var q1_total,q2_total,q3_total,q4_total;
                for(var i = 0; i < tempdata.length; i++)
                {
                    q1_total = 0; q2_total = 0; q3_total = 0; q4_total = 0;
                    try{ //for quarter 1 computation
                        var q1_qty = tempdata[i][3].toString().replace(/,/g, '');
                        var q1_amt = tempdata[i][4].toString().replace(/,/g, '');
                        
                        if(isNaN(q1_qty) == false && isNaN(q1_amt) == false) {
                            q1_total = q1_qty * q1_amt;
                            tempdata[i][3] = numberWithCommas(q1_qty);
                        } else {
                            tempdata[i][3] = null;
                        }
                    }catch(err) {
                        console.log(err.message);
                        q1_total = 0;
                        tempdata[i][3] = null;
                    }
                   try {  //for quarter 2 computation
                        var q2_qty = tempdata[i][5].toString().replace(/,/g, '');
                        var q2_amt = tempdata[i][6].toString().replace(/,/g, '');
                        
                        if(isNaN(q2_qty) == false && isNaN(q2_amt) == false) {
                            q2_total = q2_qty * q2_amt;
                            tempdata[i][5] = numberWithCommas(q2_qty);
                        } else {
                            tempdata[i][5] = null;
                        }
                        
                    }catch(err){
                        console.log(err.message);
                        q2_total = 0;
                        tempdata[i][5] = null;
                    }
                    try {  //for quarter 3 computation
                        var q3_qty = tempdata[i][7].toString().replace(/,/g, '');
                        var q3_amt = tempdata[i][8].toString().replace(/,/g, '');
                       
                        if(isNaN(q3_qty) == false && isNaN(q3_amt) == false) {
                            q3_total = q3_qty * q3_amt;
                            tempdata[i][7] = numberWithCommas(q3_qty);
                        } else {
                            tempdata[i][7] = null;
                        }
                        
                    }catch(err){
                        console.log(err.message);
                        q3_total = 0;
                        tempdata[i][7] = null;
                    }
                    try {  //for quarter 4 computation
                        var q4_qty = tempdata[i][9].toString().replace(/,/g, '');
                        var q4_amt = tempdata[i][10].toString().replace(/,/g, '');
                        
                        if(isNaN(q4_qty) == false && isNaN(q4_amt) == false) {
                            q4_total = q4_qty * q4_amt;
                            tempdata[i][9] = numberWithCommas(q4_qty);
                        } else {
                            tempdata[i][9] = null;
                        }
                        
                    }catch(err){
                        console.log(err.message);
                        q4_total = 0;
                        tempdata[i][9] = null;
                    }
                    var table_a_total = q1_total + q2_total + q3_total + q4_total;
                    if(table_a_total > 0) { tempdata[i][11] = numberWithCommas(table_a_total); }
                }
                this.loadData(tempdata);

                var url = $("#container3").data('save');
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
                console.log(tabledata);
                var postdata = {
                    data : JSON.stringify(tabledata)
                };
                $.post(url,postdata , function (res) {
                        console.log(res);
                });

            }
        }
    });

    var url = $("#container3").data('get');
    $.get(url,function(resdata){
        hot3.loadData(JSON.parse(resdata));
    });

    // container 4

    var container4 = document.getElementById('container4');

    var hot4;

    hot4 = new Handsontable(container4, {
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
            if (c === 0) cellProperties.readOnly = true;
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

                if(ok === true){
                    var url = $("#container4").data('save');
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
                    console.log(tabledata);
                    var postdata = {
                        data : JSON.stringify(tabledata)
                    };
                    $.post(url,postdata , function (res) {
                        console.log(res);
                    });
                }
            }
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

    var url = $("#container4").data('get');
    $.get(url,function(resdata){
        hot4.loadData(JSON.parse(resdata));
    });
    //end of container 4
    

    var container5 = document.getElementById('container5');
    
    var hot5;

    hot5 = new Handsontable(container5, {
        startRows: 8,
        startCols: 12,
        rowHeaders: true,
        colWidths : [1,280,80,80,120,80,120,80,120,80,120,120,130],
        colHeaders: true,
        fillHandle: {
            autoInsertRow: false,
        },
        colHeaders: ['Code','Item Description/ General Specification', 'Unit','Q1 Qty.','Q1 Amt.','Q2 Qty.','Q2 Amt.','Q3 Qty.','Q3 Amt.','Q4 Qty.','Q4 Amt.','Total Amt.'],
        cells: function(r,c, prop) {
            var cellProperties = {};
            if (c === 1 || c === 2 || c === 4 || c === 6 || c === 8 || c === 10 || c === 11) cellProperties.readOnly = true;
            return cellProperties;
        },
        afterChange : function(change,source){

            if(source == 'edit') {
                var tempdata = this.getData();
                var ok = false;
                var q1_total,q2_total,q3_total,q4_total;
                for(var i = 0; i < tempdata.length; i++)
                {
                    q1_total = 0; q2_total = 0; q3_total = 0; q4_total = 0;
                    try{ //for quarter 1 computation
                        var q1_qty = tempdata[i][3].toString().replace(/,/g, '');
                        var q1_amt = tempdata[i][4].toString().replace(/,/g, '');

                        if(isNaN(q1_qty) == false && isNaN(q1_amt) == false) {
                            q1_total = q1_qty * q1_amt;
                            tempdata[i][3] = numberWithCommas(q1_qty);
                        } else {
                            tempdata[i][3] = null;
                        }
                    }catch(err) {
                        console.log(err.message);
                        q1_total = 0;
                        tempdata[i][3] = null;
                    }
                    try {  //for quarter 2 computation
                        var q2_qty = tempdata[i][5].toString().replace(/,/g, '');
                        var q2_amt = tempdata[i][6].toString().replace(/,/g, '');

                        if(isNaN(q2_qty) == false && isNaN(q2_amt) == false) {
                            q2_total = q2_qty * q2_amt;
                            tempdata[i][5] = numberWithCommas(q2_qty);
                        } else {
                            tempdata[i][5] = null;
                        }

                    }catch(err){
                        console.log(err.message);
                        q2_total = 0;
                        tempdata[i][5] = null;
                    }
                    try {  //for quarter 3 computation
                        var q3_qty = tempdata[i][7].toString().replace(/,/g, '');
                        var q3_amt = tempdata[i][8].toString().replace(/,/g, '');

                        if(isNaN(q3_qty) == false && isNaN(q3_amt) == false) {
                            q3_total = q3_qty * q3_amt;
                            tempdata[i][7] = numberWithCommas(q3_qty);
                        } else {
                            tempdata[i][7] = null;
                        }

                    }catch(err){
                        console.log(err.message);
                        q3_total = 0;
                        tempdata[i][7] = null;
                    }
                    try {  //for quarter 4 computation
                        var q4_qty = tempdata[i][9].toString().replace(/,/g, '');
                        var q4_amt = tempdata[i][10].toString().replace(/,/g, '');

                        if(isNaN(q4_qty) == false && isNaN(q4_amt) == false) {
                            q4_total = q4_qty * q4_amt;
                            tempdata[i][9] = numberWithCommas(q4_qty);
                        } else {
                            tempdata[i][9] = null;
                        }

                    }catch(err){
                        console.log(err.message);
                        q4_total = 0;
                        tempdata[i][9] = null;
                    }
                    var table_a_total = q1_total + q2_total + q3_total + q4_total;
                    if(table_a_total > 0) { tempdata[i][11] = numberWithCommas(table_a_total); }
                }
                this.loadData(tempdata);
                var url = $("#container5").data('save');
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
                console.log(tabledata);
                var postdata = {
                    data : JSON.stringify(tabledata)
                };
                $.post(url,postdata , function (res) {
                    console.log(res);
                });
            }
        }
    });

    var url = $("#container5").data('get');
    $.get(url,function(resdata){
        hot5.loadData(JSON.parse(resdata));
    });


    var container6 = document.getElementById('container6');
    var hot6;
    hot6 = new Handsontable(container6, {
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
            if (c ===  0 || c === 11) cellProperties.readOnly = true;
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
                if(ok === true){
                    var url = $("#container6").data('save');
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
                        data : JSON.stringify(tabledata)
                    };

                    $.post(url,postdata , function (res) {

                    });
                }

            }
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

    var url = $("#container6").data('get');
    $.get(url,function(resdata){
        var data = JSON.parse(resdata);
        hot6.loadData(data);
    });

    var container7 = document.getElementById('container7');
    var hot7;
    hot7 = new Handsontable(container7, {
        startRows: 8,
        startCols: 12,
        rowHeaders: true,
        colWidths : [1,280,80,80,120,80,120,80,120,80,120,120,130],
        colHeaders: true,
        fillHandle: {
            autoInsertRow: false,
        },
        colHeaders: ['Code','Item Description/ General Specification', 'Unit','Q1 Qty.','Q1 Amt.','Q2 Qty.','Q2 Amt.','Q3 Qty.','Q3 Amt.','Q4 Qty.','Q4 Amt.','Total Amt.'],
        cells: function(r,c, prop) {
            var cellProperties = {};
            if (c === 1 || c === 2 || c === 4 || c === 6 || c === 8 || c === 10 || c === 11) cellProperties.readOnly = true;
            return cellProperties;
        },
        afterChange : function(change,source){
            if(source == 'edit') {
                var tempdata = this.getData();
                var ok = false;
                var q1_total,q2_total,q3_total,q4_total;
                for(var i = 0; i < tempdata.length; i++)
                {
                    q1_total = 0; q2_total = 0; q3_total = 0; q4_total = 0;
                    try{ //for quarter 1 computation
                        var q1_qty = tempdata[i][3].toString().replace(/,/g, '');
                        var q1_amt = tempdata[i][4].toString().replace(/,/g, '');

                        if(isNaN(q1_qty) == false && isNaN(q1_amt) == false) {
                            q1_total = q1_qty * q1_amt;
                            tempdata[i][3] = numberWithCommas(q1_qty);
                        } else {
                            tempdata[i][3] = null;
                        }
                    }catch(err) {
                        console.log(err.message);
                        q1_total = 0;
                        tempdata[i][3] = null;
                    }
                    try {  //for quarter 2 computation
                        var q2_qty = tempdata[i][5].toString().replace(/,/g, '');
                        var q2_amt = tempdata[i][6].toString().replace(/,/g, '');

                        if(isNaN(q2_qty) == false && isNaN(q2_amt) == false) {
                            q2_total = q2_qty * q2_amt;
                            tempdata[i][5] = numberWithCommas(q2_qty);
                        } else {
                            tempdata[i][5] = null;
                        }

                    }catch(err){
                        console.log(err.message);
                        q2_total = 0;
                        tempdata[i][5] = null;
                    }
                    try {  //for quarter 3 computation
                        var q3_qty = tempdata[i][7].toString().replace(/,/g, '');
                        var q3_amt = tempdata[i][8].toString().replace(/,/g, '');

                        if(isNaN(q3_qty) == false && isNaN(q3_amt) == false) {
                            q3_total = q3_qty * q3_amt;
                            tempdata[i][7] = numberWithCommas(q3_qty);
                        } else {
                            tempdata[i][7] = null;
                        }

                    }catch(err){
                        console.log(err.message);
                        q3_total = 0;
                        tempdata[i][7] = null;
                    }
                    try {  //for quarter 4 computation
                        var q4_qty = tempdata[i][9].toString().replace(/,/g, '');
                        var q4_amt = tempdata[i][10].toString().replace(/,/g, '');

                        if(isNaN(q4_qty) == false && isNaN(q4_amt) == false) {
                            q4_total = q4_qty * q4_amt;
                            tempdata[i][9] = numberWithCommas(q4_qty);
                        } else {
                            tempdata[i][9] = null;
                        }

                    }catch(err){
                        console.log(err.message);
                        q4_total = 0;
                        tempdata[i][9] = null;
                    }
                    var table_a_total = q1_total + q2_total + q3_total + q4_total;
                    if(table_a_total > 0) { tempdata[i][11] = numberWithCommas(table_a_total); }
                }
                this.loadData(tempdata);
                var url = $("#container7").data('save');
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
                    data : JSON.stringify(tabledata)
                };
                $.post(url,postdata , function (res) {
                    console.log(res);
                });
            }
        }
    });

    var url = $("#container7").data('get');
    $.get(url,function(resdata){
        hot7.loadData(JSON.parse(resdata));
    });


    var container8 = document.getElementById('container8');
    var hot8;
    hot8 = new Handsontable(container8, {
        startRows: 8,
        startCols: 12,
        rowHeaders: true,
        colWidths : [1,280,80,80,120,80,120,80,120,80,120,120,130],
        colHeaders: true,
        fillHandle: {
            autoInsertRow: false,
        },
        colHeaders: ['Code','Item Description/ General Specification', 'Unit','Q1 Qty.','Q1 Amt.','Q2 Qty.','Q2 Amt.','Q3 Qty.','Q3 Amt.','Q4 Qty.','Q4 Amt.','Total Amt.'],
        cells: function(r,c, prop) {
            var cellProperties = {};
            if (c === 1 || c === 2 || c === 4 || c === 6 || c === 8 || c === 10 || c === 11) cellProperties.readOnly = true;
            return cellProperties;
        },
        afterChange : function(change,source){
            if(source == 'edit') {
                var tempdata = this.getData();
                var ok = false;
                var q1_total,q2_total,q3_total,q4_total;
                for(var i = 0; i < tempdata.length; i++)
                {
                    q1_total = 0; q2_total = 0; q3_total = 0; q4_total = 0;
                    try{ //for quarter 1 computation
                        var q1_qty = tempdata[i][3].toString().replace(/,/g, '');
                        var q1_amt = tempdata[i][4].toString().replace(/,/g, '');

                        if(isNaN(q1_qty) == false && isNaN(q1_amt) == false) {
                            q1_total = q1_qty * q1_amt;
                            tempdata[i][3] = numberWithCommas(q1_qty);
                        } else {
                            tempdata[i][3] = null;
                        }
                    }catch(err) {
                        console.log(err.message);
                        q1_total = 0;
                        tempdata[i][3] = null;
                    }
                    try {  //for quarter 2 computation
                        var q2_qty = tempdata[i][5].toString().replace(/,/g, '');
                        var q2_amt = tempdata[i][6].toString().replace(/,/g, '');

                        if(isNaN(q2_qty) == false && isNaN(q2_amt) == false) {
                            q2_total = q2_qty * q2_amt;
                            tempdata[i][5] = numberWithCommas(q2_qty);
                        } else {
                            tempdata[i][5] = null;
                        }

                    }catch(err){
                        console.log(err.message);
                        q2_total = 0;
                        tempdata[i][5] = null;
                    }
                    try {  //for quarter 3 computation
                        var q3_qty = tempdata[i][7].toString().replace(/,/g, '');
                        var q3_amt = tempdata[i][8].toString().replace(/,/g, '');

                        if(isNaN(q3_qty) == false && isNaN(q3_amt) == false) {
                            q3_total = q3_qty * q3_amt;
                            tempdata[i][7] = numberWithCommas(q3_qty);
                        } else {
                            tempdata[i][7] = null;
                        }

                    }catch(err){
                        console.log(err.message);
                        q3_total = 0;
                        tempdata[i][7] = null;
                    }
                    try {  //for quarter 4 computation
                        var q4_qty = tempdata[i][9].toString().replace(/,/g, '');
                        var q4_amt = tempdata[i][10].toString().replace(/,/g, '');

                        if(isNaN(q4_qty) == false && isNaN(q4_amt) == false) {
                            q4_total = q4_qty * q4_amt;
                            tempdata[i][9] = numberWithCommas(q4_qty);
                        } else {
                            tempdata[i][9] = null;
                        }

                    }catch(err){
                        console.log(err.message);
                        q4_total = 0;
                        tempdata[i][9] = null;
                    }
                    var table_a_total = q1_total + q2_total + q3_total + q4_total;
                    if(table_a_total > 0) { tempdata[i][11] = numberWithCommas(table_a_total); }
                }
                this.loadData(tempdata);
                var url = $("#container8").data('save');
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
                    data : JSON.stringify(tabledata)
                };
                $.post(url,postdata , function (res) {
                    console.log(res);
                });
            }
        }
    });

    var url = $("#container8").data('get');
    $.get(url,function(resdata){
        hot8.loadData(JSON.parse(resdata));
    });
    
});

function get_current_budget(el) {
    var url = $(el).data('link');
    $("#select_item_modal .modal-dialog").html('');
    $(".side-loading").show();
    $("#select_item_modal").modal("show");
    
    $.get(url,function(data){
        $("#select_item_modal .modal-dialog").html(data);
        $(".side-loading").hide();
    });
    
}


function get_current_source_fund(el) {
    var url = $(el).data('link');
    $("#select_item_modal").modal("show");
    $("#select_item_modal .modal-dialog").html('');
    
    $.get(url,function(data){
        $("#select_item_modal .modal-dialog").html(data);
        $(".side-loading").hide();
    });
    
}

