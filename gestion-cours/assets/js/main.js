let coursesData = [];

function loadCourses() {
    $.ajax({
        url: 'getData.php',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            coursesData = response;
            renderCoursesTable(coursesData);
        },
        error: function() {
            alert('Erreur lors du chargement des données.');
        }
    });
}

function renderCoursesTable(data) {
    let tbody = $('#coursesTable tbody');
    tbody.empty();
    if (data.length === 0) {
        tbody.append('<tr><td colspan="4">Aucun cours trouvé.</td></tr>');
        return;
    }
    data.forEach(function(course) {
        let row = `<tr>
            <td>${escapeHtml(course.intitule)}</td>
            <td>${escapeHtml(course.enseignant)}</td>
            <td>${escapeHtml(course.niveau)}</td>
            <td>
                <button class="btn edit" data-id="${course.id}"><i class="fa fa-edit"></i> Modifier</button>
                <button class="btn delete" data-id="${course.id}"><i class="fa fa-trash"></i> Supprimer</button>
            </td>
        </tr>`;
        tbody.append(row);
    });
}

function filterCourses() {
    let intitule = $('#filterIntitule').val().toLowerCase();
    let enseignant = $('#filterEnseignant').val().toLowerCase();
    let niveau = $('#filterNiveau').val().toLowerCase();

    let filtered = coursesData.filter(function(course) {
        return (
            course.intitule.toLowerCase().includes(intitule) &&
            course.enseignant.toLowerCase().includes(enseignant) &&
            course.niveau.toLowerCase().includes(niveau)
        );
    });
    renderCoursesTable(filtered);
}

function escapeHtml(text) {
    return $('<div>').text(text).html();
}

// Événement pour le bouton Modifier
$(document).on('click', '.btn.edit', function() {
    let id = $(this).data('id');
    window.location.href = 'edit.php?id=' + encodeURIComponent(id);
});

// Événement pour le bouton Supprimer
$(document).on('click', '.btn.delete', function() {
    if (!confirm('Voulez-vous vraiment supprimer ce cours ?')) return;
    let id = $(this).data('id');
    $.ajax({
        url: 'setData.php',
        method: 'POST',
        data: JSON.stringify({ action: 'delete', id: id }),
        contentType: 'application/json',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                loadCourses();
            } else {
                alert('Erreur lors de la suppression.');
            }
        },
        error: function() {
            alert('Erreur serveur lors de la suppression.');
        }
    });
});

window.filterCourses = filterCourses;