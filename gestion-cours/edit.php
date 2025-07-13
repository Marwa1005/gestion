
<?php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$courses = json_decode(file_get_contents('data.json'), true);
$course = null;
foreach ($courses as $c) {
    if ($c['id'] == $id) {
        $course = $c;
        break;
    }
}
if (!$course) {
    echo "Cours introuvable.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un cours</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">    <button type="submit" class="btn edit"><i class="fa fa-save"></i> Enregistrer</button>
    <button type="button" class="btn cancel" onclick="window.location.href='index.php'"><i class="fa fa-times"></i> Annuler</button>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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
        <h2>Modifier un cours</h2>
        <form id="editCourseForm">
            <input type="hidden" name="id" value="<?= htmlspecialchars($course['id']) ?>">
            <label>Intitulé : <input type="text" name="intitule" value="<?= htmlspecialchars($course['intitule']) ?>" required></label><br>
            <label>Enseignant : <input type="text" name="enseignant" value="<?= htmlspecialchars($course['enseignant']) ?>" required></label><br>
            <label>Niveau : <input type="text" name="niveau" value="<?= htmlspecialchars($course['niveau']) ?>" required></label><br>
            <button type="submit" class="btn edit"><i class="fa fa-save"></i> Enregistrer</button>
<button type="button" class="btn cancel" onclick="window.location.href='index.php'"><i class="fa fa-times"></i> Annuler</button>
        </form>
        <div id="msg"></div>
    </div>
    <script>
    $('#editCourseForm').on('submit', function(e){
        e.preventDefault();
        let data = {
            action: 'edit',
            id: $('input[name=id]').val(),
            intitule: $('input[name=intitule]').val(),
            enseignant: $('input[name=enseignant]').val(),
            niveau: $('input[name=niveau]').val()
        };
        $.ajax({
            url: 'setData.php',
            method: 'POST',
            data: JSON.stringify(data),
            contentType: 'application/json',
            dataType: 'json',
            success: function(res){
                if(res.success){
                    window.location.href = 'index.php';
                } else {
                    $('#msg').text('Erreur lors de la modification.');
                }
            }
        });
    });
    </script>
</body>
</html>