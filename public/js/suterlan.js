$(document).ready(function(){
    //USERS DATATABLE 
    $("#tbUser").DataTable({
        responsive:true,
        lengthMenu: [
            [10, 20, 50, 100, -1],
            [10, 20, 50, 100, "All"],
        ],
    });
});