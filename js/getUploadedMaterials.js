// Populate section filter dropdown dynamically
document.addEventListener('DOMContentLoaded', function () {
    const sectionFilter = document.getElementById('sectionFilter');
    const uploadedFilesContainer = document.getElementById('uploadedFiles');

    // Fetch materials from PHP
    fetch('../function/getUploadedMaterials.php')
        .then(response => response.json())
        .then(materials => {
            // Get unique sections
            const sections = [...new Set(materials.map(material => material.section_name))];

            // Populate section filter
            sections.forEach(section => {
                const option = document.createElement('option');
                option.value = section;
                option.text = section;
                sectionFilter.appendChild(option);
            });

            // Filtering by section
            sectionFilter.addEventListener('change', function () {
                const selectedSection = this.value;
                uploadedFilesContainer.innerHTML = ''; // Clear previous entries

                materials.filter(material => material.section_name === selectedSection)
                    .forEach(material => {
                        uploadedFilesContainer.innerHTML += `
                            <div class="row column-gap-5 mt-3 mx-1 align-content-center position-relative rounded-3 border border-1" style="height: 40px;">
                                <div class="col-md-8 ms-2">
                                    ${material.school_materials}
                                </div>
                                <div class="col-md-2">
                                    <a href="../function/teacherMaterials.php?download=true&file=${material.school_materials}" class="btn btn-secondary">
                                        <i class="bi bi-download" style="color: black;"></i>
                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <form action="../function/teacherMaterials.php" method="POST">
                                        <input type="hidden" name="file_path" value="${material.school_materials}">
                                        <button type="submit" name="delete_file" class="btn btn-secondary">
                                            <i class="bi bi-trash" style="color: black;"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        `;
                    });
            });
        });
});