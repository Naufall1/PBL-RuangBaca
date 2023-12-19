var intervalId;
function flashMessageStaff(res) {
    var res = JSON.parse(res);
    flashMessage(
        res['status'],
        res['message'],
        {
            'success': 'Berhasil',
            'failed': 'Gagal',
            'warning': 'Peringatan'
        });
}
function rejectBorrowing(obj) {
    var id = $(obj).attr('id');
    $.ajax({
        type: "POST",
        url: "?function=borrowing/reject",
        data: "id=" + id,
        success: function (response) {
            flashMessageStaff(response);
            // console.log(response);
            $('#modalBuku').modal('hide');
            loadModule('dashboard');
        }
    });
}

function confirmBorrowing(obj) {
    var id = $(obj).attr('id');
    $.ajax({
        type: "POST",
        url: "?function=borrowing/confirm",
        data: "id=" + id,
        success: function (response) {
            flashMessageStaff(response);
            // console.log(response);
            $('#modalBuku').modal('hide');
            loadModule('dashboard');
        }
    });
}


function processBorrowing(obj){
    var action = $(obj).attr('name');
    var id = $(obj).attr('id');
    $.ajax({
        type: "POST",
        url: "?function=borrowing/"+action,
        data: "id=" + id,
        success: function (response) {
            flashMessageStaff(response);
            // console.log(response);
            $('#modalBuku').modal('hide');
            loadModule('dashboard');
        }
    });
}

function changeTableHeading(title) {
    $('.heading-table-page').html(title);
    if (title != 'Dashboard') {
        $('.subtitle-table-page').html('Table ' + title)
    } else {
        $('.subtitle-table-page').html(title)
    }
}

function addBook(cover, title, author, year, rak) {
    html = "\
        <div class='book-ordered-item d-flex' >\
            <img class='book-ordered-image' src = 'uploads\\cover\\"+cover+"' alt = ''>\
                <div class='book-ordered-item-content d-flex flex-column'>\
                <p class='book-ordered-title font-size-1px'>"+title+"</p>\
                <div class='book-orderd-sub-info d-flex'>\
                    <div>\
                        <p class='book-ordered-author'>"+author+"</p>\
                        <p class='book-ordered-year'>"+year+"</p>\
                    </div>\
                    <div>\
                        <p class='book-ordered-author'>Lokasi</p>\
                        <p class='book-ordered-year'>"+rak+"</p>\
                    </div>\
                </div>\
            </div>\
        </div >\
        <div class='hr-divider'></div>";
    $('.modal-confirm-detail-contianer').append(html);
}

function loadModal(id) {
    $('button[name="reject"]').css('display', 'none');
    $('button[name="confirm"]').css('display', 'none');
    $('button[name="pickUp"]').css('display', 'none');
    $('button[name="finish"]').css('display', 'none');
    $.ajax({
        type: "POST",
        url: "?function=borrowing/details",
        data: "id=" + id,
        success: function (response) {
            borrowingDetails = JSON.parse(response);
            console.log(borrowingDetails);
            member = JSON.parse(borrowingDetails['member']);
            readable = borrowingDetails['readable'];
            $('#modalBuku #borrowing_id').html(borrowingDetails['id']);
            $('#modalBuku #member_name').html(member['name']);
            $('#modalBuku .borrowing-status').html('<p>' +  borrowingDetails['status'].charAt(0).toUpperCase() + borrowingDetails['status'].slice(1)  + '<p/>');
            $('#modalBuku #reserve_date').html(borrowingDetails['reserve_date']);
            $('#modalBuku #due_date').html(borrowingDetails['due_date']);
            $('#modalBuku button[name="reject"]').attr('id',borrowingDetails['id']);
            $('#modalBuku button[name="confirm"]').attr('id',borrowingDetails['id']);
            $('#modalBuku button[name="pickUp"]').attr('id',borrowingDetails['id']);
            $('#modalBuku button[name="finish"]').attr('id',borrowingDetails['id']);
            var statusId = '';
            switch (borrowingDetails['status']) {
                case 'Menunggu':
                    statusId = 'waiting';
                    $('button[name="reject"]').css('display', 'flex');
                    $('button[name="confirm"]').css('display', 'flex');
                    break;
                case 'Dikonfirmasi':
                    $('button[name="pickUp"]').css('display', 'flex');
                    statusId = 'confirmed';
                    break;
                case 'Dipinjam':
                    $('button[name="finish"]').css('display', 'flex');
                    statusId = 'borrowed';
                    break;
                case 'Terlambat':
                    $('button[name="finish"]').css('display', 'flex');
                    statusId = 'reject';
                    break;
                case 'Selesai':
                    statusId = 'done';
                    break;
                case 'Ditolak':
                    statusId = 'reject';
                    break;
            }
            $('.borrowing-status[name="status-modal"]').attr('id', statusId);
            $('.modal-confirm-detail-contianer').html('');
            readable.forEach(item => {
                item = JSON.parse(item);
                console.log(item);
                addBook(item['cover'], item['title'], item['author'], item['year'], item['shelf']);
            });
        }
    });
    $('#modalBuku').modal('show');
}

function loadSearch(moduleName) {
    $('input[name="search"]').keyup(function (e) {
        if (e.keyCode == 13) {
            $.ajax({
                type: "GET",
                url: "?function=search/"+moduleName+"&q=" + $(this).val(),
                success: function (response) {
                    $('main.container-main').html(response);
                    loadSearch(moduleName);
                }
            });
        }
    });
}

function loadModule(moduleName, page=-1) {
    switch (moduleName) {
        case 'book':
            changeTableHeading('Buku');
            break;
        case 'thesis':
            changeTableHeading('Skripsi');
            break;
        case 'member':
            changeTableHeading('Anggota');
            break;
        case 'dashboard':
            changeTableHeading('Dashboard');
            break;
        default:
            break;
    }
    $.ajax({
        type: "GET",
        url: "?page=" + moduleName + (page >= 1 ? "&num=" + page : ""),
        success: function (response) {
            $('main.container-main').html(response);
            loadSearch(moduleName);

            /**
             * Refresh every 5 seconds
             */
            if (moduleName == 'dashboard') {
                intervalId = setInterval(function() {
                    loadBorrowingCards('all');
                }, 5000);
            } else {
                clearInterval(intervalId);
            }

            /**
             * pagigation
             */
            $('a[name="pagination"]').click(function (e) {
                var tmp = parseInt($('a[name="pagination"].active').html());
                // console.log(tmp);
                var page = $(this).attr('id');
                $(this).attr('id')
                if (page == 'next') {
                    page = tmp + 1;
                    console.log(page);
                } else if (page == 'prev') {
                    page = tmp - 1;
                } else {
                    page = $(this).html();
                }
                // console.log(tmp);
                loadModule(moduleName, page);
            });

            /**
             * filter thesis
             */
            $('select[name="prodi"]').change(function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "?function=filter",
                    data: "prodi="+$(this).val(),
                    success: function (response) {
                        if (JSON.parse(response).success) {
                            loadModule(moduleName);
                        } else {
                            alert(response);
                        }
                    }, error : function (e) {
                        alert('Error: ' + e);
                    }
                });
            });

            /**
             * dashboard
             */
            $('.tab-menu .tab-item').click(function () {
                $('.tab-item-active').addClass('tab-item');
                $('.tab-item-active').find('.tab-title-active').addClass('tab-title');
                $('.tab-item-active').find('.tab-title').removeClass('tab-title-active');
                $('.tab-item-active').removeClass('tab-item-active');
                $(this).find('.tab-title').addClass('tab-title-active');
                $(this).find('.tab-title').removeClass('tab-title');
                $(this).removeClass('tab-item');
                $(this).addClass('tab-item-active');
                loadBorrowingCards($(this).attr('id'));
            });
            if (moduleName == 'dashboard') {
                $('.tab-item#all').find('.tab-title').addClass('tab-title-active');
                $('.tab-item#all').find('.tab-title').removeClass('tab-title');
                $('.tab-item#all').addClass('tab-item-active');
                $('.tab-item#all').removeClass('tab-item');
                loadBorrowingCards('all');
            }
        }
    });
}

function loadBorrowingCards(status) {
    $.ajax({
        type: "POST",
        url: "?page=dashboard",
        data: "status=" + status,
        success: function (response) {
            // console.log(response);
            $('.borrowing-cards-container').html(response);
        }
    });
}

$(document).ready(function () {
    loadModule('dashboard');

    $(".filter-header button").click(function () {
        var display = $(this).next(".filter-box").css("display");
        if (display != "none") {
            $(this).next(".filter-box").fadeOut("fast");
        } else {
            $(this).next(".filter-box").fadeIn();
        }
    });

    $(".menu").click(function () {
        if ($(".container-main").hasClass("dashboard") && $(this).prop('id') != 'logout') {
            $(".container-main").removeClass("dashboard");
            $(".container-main").addClass("container-main-table");
        }
    });

    $("#dashboard").click(function () {
        if ($(".container-main").hasClass("container-main-table")) {
            $(".container-main").removeAttr("transition");
            $(".container-main").removeClass("container-main-table");
            $(".container-main").addClass("dashboard");
        }
        // $(".container-main").removeClass("container-main-table");
    });

});