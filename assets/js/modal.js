function getDesc(book) {
    // console.log($(book).attr('id'));
    var id = $(book).attr('id');
    if (id.match("^BK")) {
        $.ajax({
            type: 'POST',
            url: '?function=getDesc',
            data: 'book_id=' + id,
            success: function(res) {
                // console.log(JSON.parse(res));
                var book = JSON.parse(res);
                $('#modalBuku').find('#book_id').html(book['id']);
                $('#modalBuku').find('#book_title').html(book['title']);
                $('#modalBuku').find('#cover').attr('src','uploads/cover/'+ book['cover']);
                $('#modalBuku').find('#author').html(book['author']);
                $('#modalBuku').find('#year_published').html(book['year']);
                $('#modalBuku').find('#shelf').html(book['shelf']);
                $('#modalBuku').find('#synopsis > p').html(book['synopsis']);
                $('#modalBuku').find('#ketersediaan').html(book['avail']+'/'+book['stock']);
                $('#modalBuku').find('#isbn').html(book['isbn']);
                $('#modalBuku').find('#ddc_code').html(book['ddc_code']);
                $('#modalBuku').find('button[name="book"]').attr('id', book['id']);
                var html;
                if (book['avail'] < 1) {
                    html = '<p id="not-avail">Tidak Tersedia</p>';
                    $('#modalBuku').find('#status').removeClass('book-status-avail');
                    $('#modalBuku').find('#status').addClass('book-status-not-avail');
                    $('#modalBuku').find('button[name="book"]').prop('disabled', true);

                } else {
                    html = '<p id="avail">Tersedia</p>';
                    $('#modalBuku').find('#status').addClass('book-status-avail');
                    $('#modalBuku').find('#status').removeClass('book-status-not-avail');
                    $('#modalBuku').find('button[name="book"]').prop('disabled', false);
                }
                $('#modalBuku').find('div#status').html(html);

            }, error: function(err) {
                console.log(err);
            }
        });
        // console.log($('#modalBuku').modal('show'));
        // $('#modalBuku').modal();
        setTimeout(function() {
            $('#modalBuku').modal('toggle');
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
                // $('#modalSkripsi').find('#cover').attr('src','uploads/cover/'+ thesis['cover']);
                $('#modalSkripsi').find('#cover').attr('src','uploads/cover/default.png');
                $('#modalSkripsi').find('#author').html(thesis['writer_name']);
                $('#modalSkripsi').find('#year').html(thesis['year']);
                $('#modalSkripsi').find('#shelf').html(thesis['shelf']);
                $('#modalSkripsi').find('#dospem').html(thesis['dospem']);
                $('#modalSkripsi').find('button[name="thesis"]').attr('id', thesis['id']);
                // $('#modalSkripsi').find('#synopsis').html(thesis['synopsis']);
                var html;
                if (thesis['avail'] < 1) {
                    html = '<p id="avail">Tersedia</p>';
                    $('#modalSkripsi').find('#status').removeClass('book-status-avail');
                    $('#modalSkripsi').find('#status').addClass('book-status-not-avail');
                } else {
                    html = '<p id="not-avail">Tidak Tersedia</p>';
                    $('#modalSkripsi').find('#status').addClass('book-status-not-avail');
                    $('#modalSkripsi').find('#status').removeClass('book-status-avail');
                }
                $('#modalSkripsi').find('div#status').html(html);

            }, error: function(err) {
                console.log(err);
            }
        });
        setTimeout(function() {
            $('#modalSkripsi').modal('show');
        }, 50);
    }

}

function closeModal(obj) {
    switch ($(obj).attr('id')) {
        case 'book':
            $('#modalBuku').modal('toggle');
            break;
        case 'thesis':
            $('#modalSkripsi').modal('toggle');
            break;
        default:
            break;
    }
}