function getDesc(book) {
    // console.log($(book).attr('id'));
    var id = $(book).attr('id');
    console.log();
    if (id.match("^BK")) {
        $.ajax({
            type: 'POST',
            url: '?function=bookDesc',
            data: 'book_id=' + id,
            success: function(res) {
                // console.log(JSON.parse(res));
                var book = JSON.parse(res);
                $('#modalBuku').find('#book_id').html(book['book_id']);
                $('#modalBuku').find('#book_title').html(book['book_title']);
                $('#modalBuku').find('#cover').attr('src','uploads/cover/'+ book['cover']);
                $('#modalBuku').find('#author').html(book['author_id']);
                $('#modalBuku').find('#year_published').html(book['year_published']);
                $('#modalBuku').find('#shelf').html(book['shelf_id']);
                $('#modalBuku').find('#synopsis').html(book['synopsis']);
                $('#modalBuku').find('#ketersediaan').html(book['avail']+'/'+book['stock']);
                $('#modalBuku').find('#isbn').html(book['isbn']);
                $('#modalBuku').find('#ddc_code').html(book['ddc_code']);
                var html;
                if (book['avail'] < 1) {
                    html = '<img src="assets/icon/ellipse-red.svg" style="padding-right: 5px;"> Tidak Tersedia';
                    $('#modalBuku').find('.status').removeClass('avail');
                    $('#modalBuku').find('.status').addClass('not-avail');
                } else {
                    html = '<img src="assets/icon/ellipse-green.svg" style="padding-right: 5px;"> Tersedia';
                    $('#modalBuku').find('.status').addClass('avail');
                    $('#modalBuku').find('.status').removeClass('not-avail');
                }
                $('#modalBuku').find('.status').html(html);

            }, error: function(err) {
                console.log(err);
            }
        });
        // $('#modalBuku').modal();
        setTimeout(function() {
            $('#modalBuku').modal();
        }, 50);

    } else {

    }


    // $.ajax({
    //   type: "POST",
    //   url: "fungsi/catalog.php?catalog=book",
    //   data: "book="+book_id,
    //   success: function(res) {
    //     // $("#panel-cart").html(res);
    //   },
    //   error: function(response) {
    //     console.log(response.responseText);
    //   }
    // });
}