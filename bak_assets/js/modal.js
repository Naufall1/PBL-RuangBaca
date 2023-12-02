function getDesc(book) {
    // console.log($(book).attr('id'));
    var id = $(book).attr('id');
    if (id.match("^BK")) {
        $.ajax({
            type: 'POST',
            url: '?function=getDesc',
            data: 'book_id=' + id,
            success: function(res) {
                console.log(JSON.parse(res));
                var book = JSON.parse(res);
                $('#modalBuku').find('#book_id').html(book['id']);
                $('#modalBuku').find('#book_title').html(book['title']);
                $('#modalBuku').find('#cover').attr('src','uploads/cover/'+ book['cover']);
                $('#modalBuku').find('#author').html(book['author']);
                $('#modalBuku').find('#year_published').html(book['year']);
                $('#modalBuku').find('#shelf').html(book['shelf']);
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
        $.ajax({
            type: 'POST',
            url: '?function=getDesc',
            data: 'thesis_id=' + id,
            success: function(res) {
                console.log(JSON.parse(res));
                var thesis = JSON.parse(res);
                $('#modalSkripsi').find('#thesis_id').html(thesis['id']);
                $('#modalSkripsi').find('#thesis_title').html(thesis['title']);
                $('#modalSkripsi').find('#cover').attr('src','uploads/cover/'+ thesis['cover']);
                $('#modalSkripsi').find('#author').html(thesis['writer_name']);
                $('#modalSkripsi').find('#year').html(thesis['year']);
                $('#modalSkripsi').find('#shelf').html(thesis['shelf']);
                $('#modalSkripsi').find('#dospem').html(thesis['dospem']);
                // $('#modalSkripsi').find('#synopsis').html(thesis['synopsis']);
                var html;
                if (thesis['avail'] < 1) {
                    html = '<img src="assets/icon/ellipse-red.svg" style="padding-right: 5px;"> Tidak Tersedia';
                    $('#modalSkripsi').find('.status').removeClass('avail');
                    $('#modalSkripsi').find('.status').addClass('not-avail');
                } else {
                    html = '<img src="assets/icon/ellipse-green.svg" style="padding-right: 5px;"> Tersedia';
                    $('#modalSkripsi').find('.status').addClass('avail');
                    $('#modalSkripsi').find('.status').removeClass('not-avail');
                }
                $('#modalSkripsi').find('.status').html(html);

            }, error: function(err) {
                console.log(err);
            }
        });
        setTimeout(function() {
            $('#modalSkripsi').modal();
        }, 50);
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