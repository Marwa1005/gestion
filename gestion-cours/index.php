
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Cours Universitaires</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="assets/js/main.js"></script>
   <style>
body {
  background: linear-gradient(135deg, rgba(45, 52, 54, 0.4) 0%, rgba(0, 0, 0, 0.85) 100%),
                url('assets/img/63794.jpg') no-repeat center center fixed;
    background-size: cover;
}
</style>
</head>
<body>
    <div class="container">
        <h1>Gestion des Cours Universitaires</h1>
        <button class="btn add" onclick="window.location.href='new.php'">Ajouter un cours</button>
        <div class="filters">
            <input type="text" id="filterIntitule" placeholder="Filtrer par intitulé" onkeyup="filterTable()">
            <input type="text" id="filterEnseignant" placeholder="Filtrer par enseignant" onkeyup="filterTable()">
            <input type="text" id="filterNiveau" placeholder="Filtrer par niveau" onkeyup="filterTable()">
        </div>
        <table id="coursesTable">
            <thead>
                <tr>
                    <th>Intitulé</th>
                    <th>Enseignant</th>
                    <th>Niveau</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Les lignes seront insérées ici par JS -->
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            loadCourses();
        });
        function filterTable() {
            window.filterCourses();
        }
    </script>
</body>
</html>