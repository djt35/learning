//table.js for endoscopy wiki



function makeSearchBox() {

    var length = $('#dataTable').find('th').length - 1;

    console.log(length);

    var x = 0;

    $('#dataTable').find('th').each(function () {

        console.log($(this).attr('data'));

        var name = $(this).attr('data');

        if (name != undefined) {

            $('#searchBox').find('p').append(name + ': <input id="' + name + '" name="' + name + '" class="search" data="' + x + '"></input><br>');

        }

        x++;

    })


}

function makeSearchBoxModal() {

    var length = $('.modal').find('#dataTable').find('th').length - 1;

    console.log(length);

    var x = 0;

    $('.modal').find('#dataTable').find('th').each(function () {

        console.log($(this).attr('data'));

        var name = $(this).attr('data');

        if (name != undefined) {

            $('.modal').find('.modalMessageBox').append(name + ': <input id="' + name + '" name="' + name + '" class="searchModal" data="' + x + '"></input><br>');

        }

        x++;

    })

    $('.modal').find('.modalMessageBox').append("<p>Press enter in above boxes to search</p>");


}

function filterTableVisible(tableid, column, criteria) {

    // Declare variables 
    var table, tr, td, i;
    // var input, filter, table, tr, td, i;
    // input = document.getElementById(inputid);
    // filter = input.value.toUpperCase();
    table = $(tableid);
    //console.log(table);
    tr = table.find("tr:visible");
    //console.log(tr);
    // Loop through all table rows, and hide those who don't match the search query
    for (i = 1; i < tr.length; i++) {

        td = $(tr[i]).find("td:eq(" + column + ")");
        // console.log(td);
        if (td) {
            if ($(td).text().indexOf(criteria) > -1) {
                $(tr[i]).show();
            } else {
                $(tr[i]).hide();;
            }
        }
    }

    //var totalRow = table.find("tr:visible").length;

    //totalRow - 1;

    //table.before(totalRow  + ' Records Found');


    table.animate({
        scrollTop: table.offset().top - 800
    }, 'fast');

    if (table.find("tr:visible").length == 1) {

        table.html('No records remain, please reset the table');

    }

}

function filterTableVisible(tableid, column, criteria) {

    // Declare variables 
    var table, tr, td, i;
    // var input, filter, table, tr, td, i;
    // input = document.getElementById(inputid);
    // filter = input.value.toUpperCase();
    table = $(tableid);
    //console.log(table);
    tr = table.find("tr:visible");
    //console.log(tr);
    // Loop through all table rows, and hide those who don't match the search query
    for (i = 1; i < tr.length; i++) {

        td = $(tr[i]).find("td:eq(" + column + ")");
        // console.log(td);
        if (td) {
            if ($(td).text().indexOf(criteria) > -1) {
                $(tr[i]).show();
            } else {
                $(tr[i]).hide();;
            }
        }
    }

    //var totalRow = table.find("tr:visible").length;

    //totalRow - 1;

    //table.before(totalRow  + ' Records Found');


    table.animate({
        scrollTop: table.offset().top - 800
    }, 'fast');

    if (table.find("tr:visible").length == 1) {

        table.html('No records remain, please reset the table');

    }

}

function filterTableVisibleModal(tableid, column, criteria) {

    // Declare variables 
    var table, tr, td, i;
    // var input, filter, table, tr, td, i;
    // input = document.getElementById(inputid);
    // filter = input.value.toUpperCase();
    table = $('.modal').find(tableid);
    console.log(table);
    tr = table.find("tr:visible");
    //console.log(tr);
    // Loop through all table rows, and hide those who don't match the search query
    for (i = 1; i < tr.length; i++) {

        td = $(tr[i]).find("td:eq(" + column + ")");
        // console.log(td);
        if (td) {
            if ($(td).text().indexOf(criteria) > -1) {
                $(tr[i]).show();
            } else {
                $(tr[i]).hide();;
            }
        }
    }

    //var totalRow = table.find("tr:visible").length;

    //totalRow - 1;

    //table.before(totalRow  + ' Records Found');


    table.animate({
        scrollTop: table.offset().top - 800
    }, 'fast');

    if (table.find("tr:visible").length == 1) {

        table.html('No records remain, please close and reopen the popup');

    }

}


$(document).ready(function () {

    $('#resetTable').on('click', function () {

        location.reload();


    })

    $('#hideSearch').on('click', function () {

        $('#searchBox').parent().hide();

        if ($('#messageBox').find('#showSearchBox').length == 0) {
            $('#messageBox').append('<button id="showSearchBox" type="button">Show Search Box</button>');
        }

    })

    $('.content').on('click', '#showSearchBox', function () {

        if ($('#messageBox').find('#showSearchBox').length > 0) {
            $('#messageBox').find('#showSearchBox').remove();
        }

        $('#searchBox').parent().show();

    })

    $('.search').on('keyup', function (e) {

        var columnid = $(this).attr('data');

        var searchText = $(this).val();

        if (e.keyCode == 13) {
            filterTableVisible('#dataTable', columnid, searchText);
        }
    });

    $('.modal').on('keyup', '.searchModal', function (e) {

        console.log('key up');

        var columnid = $(this).attr('data');

        var searchText = $(this).val();

        if (e.keyCode == 13) {
            filterTableVisibleModal('#dataTable', columnid, searchText);
        }
    });

    

})