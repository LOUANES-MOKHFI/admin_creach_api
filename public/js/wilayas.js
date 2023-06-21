

$(document).on('change', '#pays', function () {
    pays = this.value;
    if(pays == 62){
        $("#wilayaBlock").css('display','block');
        $("#CommuneBlock").css('display','block');
    }else{
        $("#wilayaBlock").css('display','none');
        $("#CommuneBlock").css('display','none');
    }

});

$(document).on('change', '#wilaya', function () {
    wilaya = this.value;
    $.ajax({
        url: "{{route('admin.get_communes_by_wilaya')}}",
        method:"get",
        dataType:'json',
        data:{
            wilaya:wilaya,
        },
        success: function(result){
            //console.log(result.communes);
            communes = result.communes;
            $('#commune').empty();
            var options = '';
            $.each(communes, function(key, value) {
                options += '<option value='+value.id+'>'+value.name+'</option>';
            });
            $('#commune').append(`<option value="">-- اختر من القائمة --</option>`);
            $('#commune').append(options);
        }
    });
});


