if (document.querySelectorAll('.table_search').length) {
    let searchTable = undefined;
    $('.table_search').keyup(function () {
        const table = this.dataset.table;
        if (table) {
            if (searchTable !== undefined) {
                clearTimeout(searchTable);
            }
            searchTable = setTimeout(function () {
                // $('#' + table).dataTable().fnDraw();
                $('#' + table).dataTable().api().draw();
            }, 500);
        }
    });
}
if (document.querySelectorAll('.date_range').length) {
    console.log('Hello');
    let searchTable = undefined;
    $('.date_range').keyup(function () {
        const table = this.dataset.table;
        if (table) {
            if (searchTable !== undefined) {
                clearTimeout(searchTable);
            }
            searchTable = setTimeout(function () {
                $('#' + table).dataTable().api().draw();
            }, 500);
        }
    });
}
