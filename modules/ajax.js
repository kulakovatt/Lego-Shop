function call(){
    let msg = $('#formx').serialize();
    $.ajax({
        type: 'POST',
        url: 'search.php',
        data: msg,
        success: function (data){
            $('#catal').remove();
            $('#results').html(data);},
            error: function(xhr, str){
                alert("Возникла ошибка: "+ xhr.responseCode);
            }
    })
}

function sortirovka(){
    let msg = $('#formx-1').serialize();
    $.ajax({
        type: 'POST',
        url: 'sort.php',
        data: msg,
        success: function (data){
            $('#catal').remove();
            $('#results').html(data);},
        error: function(xhr, str){
            alert("Возникла ошибка: "+ xhr.responseCode);
        }
    })
}

function show_fav(){
    let msg = $('#form').serialize();
    $.ajax({
        type: 'POST',
        url: 'show_favorite.php',
        data: msg,
        success: function (data){
            $('#results').html(data);},
        error: function(xhr, str){
            alert("Возникла ошибка: "+ xhr.responseCode);
        }
    })
}

function filtration(){
    let msg = $('#formx-2').serialize();
    $.ajax({
        type: 'POST',
        url: 'filtr.php',
        data: msg,
        success: function (data){
            $('#catal').remove();
            $('#results').html(data);},
        error: function(xhr, str){
            alert("Возникла ошибка: "+ xhr.responseCode);
        }
    })
}


