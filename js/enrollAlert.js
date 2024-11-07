function enrollAlert() {
    swal({
        title: "New Student Enrolled!",
        text: "Student's enrollment is pending until the LRN is assigned.",
        icon: "success",
        button: "Ok!",
    }).then(() => {
        location.replace('../pages/guidanceDashboard.php');
    });
}