// assets/js/script.js

document.addEventListener('DOMContentLoaded', function() {

    // Debounce function to limit AJAX calls during typing
    function debounce(func, delay) {
        let debounceTimer;
        return function() {
            const context = this;
            const args = arguments;
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => func.apply(context, args), delay);
        };
    }

    // Live search suggestions for students
    const searchBox = document.getElementById('searchBox');
    const suggestionBox = document.getElementById('suggestionBox');
    const searchBtn = document.getElementById('searchBtn');

    function fetchSuggestions() {
        const query = searchBox.value.trim();
        if (query.length === 0) {
            suggestionBox.innerHTML = "";
            return;
        }
        const xhr = new XMLHttpRequest();
        xhr.open("GET", BASE_URL + "api/search_student.php?query=" + encodeURIComponent(query), true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                suggestionBox.innerHTML = xhr.responseText;
                // Attach click events to each suggestion div
                const suggestionItems = suggestionBox.querySelectorAll('div[data-student-id]');
                suggestionItems.forEach(item => {
                    item.style.cursor = 'pointer';
                    item.addEventListener('click', function() {
                        const studentId = this.getAttribute('data-student-id');
                        if (studentId) {
                            loadStudentData(studentId);
                        }
                    });
                });
            } else {
                suggestionBox.innerHTML = "<div style='padding:10px;color:red;'>Error fetching suggestions.</div>";
            }
        };
        xhr.send();
    }

    // Load specific student data into the table
    function loadStudentData(studentId) {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", BASE_URL + "api/get_student.php?student_id=" + studentId, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Replace the student table body with the returned HTML
                document.getElementById('studentData').innerHTML = xhr.responseText;
                suggestionBox.innerHTML = "";
            } else {
                alert("Error loading student data.");
            }
        };
        xhr.send();
    }

    // Attach live search events
    if (searchBox) {
        searchBox.addEventListener('input', debounce(fetchSuggestions, 300));
    }
    if (searchBtn) {
        searchBtn.addEventListener('click', function() {
            const query = searchBox.value.trim();
            if (query.length === 0) {
                alert("Please enter a search term.");
                return;
            }
            const xhr = new XMLHttpRequest();
            xhr.open("GET", BASE_URL + "api/search_student.php?query=" + encodeURIComponent(query), true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById("studentData").innerHTML = xhr.responseText;
                    suggestionBox.innerHTML = "";
                } else {
                    alert("Error fetching search results.");
                }
            };
            xhr.send();
        });
    }
});
