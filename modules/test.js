let div = document.getElementsByClassName("elem");

for(let i = 0; i < div.length; i++){
    div[i].setAttribute("id", "_" + i);
}

$('.favor').on('click', function favorite() {
    var messages = $(this).closest('.elem')[0].innerText;
    console.log(messages);
    console.log($(this));
    console.log($(this)[0].defaultValue);

    if($(this)[0].defaultValue == 0){
        $(this)[0].setAttribute('style', "background: url('../img/favorite.png') no-repeat; background-size: cover; width: 29px; height: 29px;");
        $(this)[0].defaultValue = 1;
    } else if ($(this)[0].defaultValue == 1) {
        $(this)[0].setAttribute('style', "background: url('../img/unfavorite.png') no-repeat; background-size: cover; width: 29px; height: 29px;");
        $(this)[0].defaultValue = 0;
    }
    var val = $(this)[0].defaultValue;
    $.ajax({
        type: 'POST',
        url: 'favorite.php',
        data: messages + val,
        success: $.get('favorite.php', {message: messages, val:val}, function(data) {
            // alert('записан: '+data);
        })
    });
});

$('.add_basket').on('click', function add_basket() {
    var messages = $(this).closest('.elem')[0].innerText;
    console.log(messages);
    console.log($(this));
    console.log($(this)[0].defaultValue);

    if($(this)[0].defaultValue == 0){
        $(this)[0].setAttribute('style', "background: url('../img/basket.png') no-repeat; background-size: cover; width: 31px; height: 31px;");
        $(this)[0].defaultValue = 1;
    } else if ($(this)[0].defaultValue == 1) {
        $(this)[0].setAttribute('style', "background: url('../img/add_basket.png') no-repeat; background-size: cover; width: 31px; height: 31px;");
        $(this)[0].defaultValue = 0;
    }
    var val = $(this)[0].defaultValue;
    $.ajax({
        type: 'POST',
        url: 'basket.php',
        data: messages + val,
        success: $.get('basket.php', {message: messages, val:val}, function(data) {
            // alert('записан: '+data);
        })
    });
});