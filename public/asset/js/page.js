$('[data-submenu]').submenupicker();

function create_program(el,id) {
    $(".modal_content").html('');
    $("#view_item").modal('show');
    var url = $(el).data('link') + "?ppcode=" + id;
    setTimeout(function(){
        $.get(url,function(data){
            $(".modal_content").html(data);
        });
    },1000);
}

$("#print_date").click(function(){
    $("#item").find(".modal_content").html('');
    $("#item").modal('show');
    var url = $(this).data('url');
    $.get(url,function(data){
        $("#item").find(".modal_content").html(data);
    });
});

$("#print_program").click(function(){
    $("#item").find(".modal_content").html('');
    $("#item").modal('show');
    var url = $(this).data('url');
    $.get(url,function(data){
        $("#item").find(".modal_content").html(data);
    });
});
function expense_change(el){
   var val = $(el).val();
   var url = $("")
}

