$(document).ready(function() {
    $('#studentRecord').DataTable({
        "paging": true, // Enables pagination
        "searching": true, // Enables searching
        "ordering": false, // Enables column sorting
        "info": true, // Displays information about the table
        "select": true,
    });
});