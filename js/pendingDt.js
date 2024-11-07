$(document).ready(function() {
    $('#pendingTable').DataTable({
        "paging": true, // Enables pagination
        "searching": true, // Enables searching
        "ordering": false, // Disables column sorting
        "info": true, // Displays information about the table
        "select": true
    });
});