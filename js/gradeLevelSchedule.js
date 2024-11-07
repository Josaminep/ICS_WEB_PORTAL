$(document).ready(function () {
    // Fetch grade levels on page load
    $.ajax({
      url: "../function/fetchGradeLevels.php", // Path to your PHP file for grade levels
      type: "GET",
      dataType: "json",
      success: function (response) {
        console.log("Grade levels fetched successfully:", response); // Debugging line
        $.each(response, function (index, grade) {
          $("#gradeLevelSchedule").append(
            '<option value="' +
              grade.grade_level_id +
              '">' +
              grade.grade_level +
              "</option>"
          );
        });
      },
      error: function (xhr, status, error) {
        console.error("Error fetching grade levels:", xhr.responseText); // Log the error
        alert("Failed to retrieve grade levels.");
      },
    });
  
    // Fetch sections based on selected grade level
    $("#gradeLevelSchedule").change(function () {
      var gradeLevelId = $(this).val();
      console.log("Selected Grade Level ID:", gradeLevelId); // Debugging line
      $.ajax({
        url: "../function/fetchSections.php", // Path to your PHP file for sections
        type: "POST",
        data: { grade_level_id: gradeLevelId },
        dataType: "json",
        success: function (response) {
          console.log("Sections fetched successfully:", response); // Debugging line
          $("#sectionSchedule").empty(); // Clear previous options
          $("#sectionSchedule").append("<option selected>Select</option>");
          $.each(response, function (index, section) {
            // Ensure the correct syntax here
            $("#sectionSchedule").append(
              '<option value="' +
                section.section_id +
                '">' +
                section.section_name +
                "</option>" // Use section_id for value
            );
          });
        },
        error: function (xhr, status, error) {
          console.error("Error fetching sections:", xhr.responseText); // Log the error
          alert("Failed to retrieve sections.");
        },
      });
    });
  });
  