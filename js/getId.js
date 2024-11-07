function setStudentId(studentId) {
  document.getElementById("student_id_lrn").value = studentId;
}

function editAnnouncement(announcementData) {
  // Fetch data from the button's data-* attributes
  var announcementId = announcementData.getAttribute("data-announcement-id");
  var announcementTitle = announcementData.getAttribute(
    "data-announcement-title"
  );
  var announcementText = announcementData.getAttribute(
    "data-announcement-text"
  );

  // Remove \r and \n characters from the announcementText
  announcementText = announcementText.replace(/[\r\n]+/g, " "); // Replace new lines with a space

  // Set the values in the form fields
  document.getElementById("editAnnouncementId").value = announcementId;
  document.getElementById("editAnnouncementTitle").value = announcementTitle;
  document.getElementById("editAnnouncementText").value = announcementText;
}

function cleanTextBeforeSubmit() {
  var announcementTextElement = document.getElementById("editAnnouncementText");
  var announcementText = announcementTextElement.value;

  // Remove \r and \n characters and escape quotes
    announcementText = announcementText.replace(/[\r\n]+/g, ' '); // Replace new lines with a space
    announcementText = announcementText.replace(/\\/g, ''); // Remove existing backslashes
    announcementText = announcementText.replace(/'/g, "\\'"); // Escape single quotes

  // Set the cleaned text back to the textarea
  announcementTextElement.value = announcementText;
}

function deleteAnnouncement(button) {
  // Fetch announcement ID from the button's data-* attribute
  var announcementId = button.getAttribute("data-announcement-id");

  // SweetAlert2 confirmation before deletion
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      // Create AJAX request to delete the announcement
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "../function/deleteAnnouncement.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      // Handle response
      xhr.onload = function () {
        if (xhr.status === 200) {
          // Successfully deleted, now remove the announcement from the DOM
          var announcementRow = button.closest(".row");
          announcementRow.remove();

          // Show success message
          Swal.fire(
            "Deleted!",
            "Your announcement has been deleted.",
            "success"
          );
        } else {
          // Show error message
          Swal.fire(
            "Error!",
            "There was an issue deleting your announcement. Please try again.",
            "error"
          );
        }
      };

      // Send the request with the announcement ID
      xhr.send("announcement_id=" + announcementId);
    }
  });
}
