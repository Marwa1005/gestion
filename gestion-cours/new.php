<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un cours</title>
    <link rel="stylesheet" href="assets/css/style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
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
        <h2>Ajouter un cours</h2>
        <form id="addCourseForm">
            <label>Intitulé : <input type="text" name="intitule" required></label><br>
            <label>Enseignant : <input type="text" name="enseignant" required></label><br>
            <label>Niveau : <input type="text" name="niveau" required></label><br>
            <button type="submit" class="btn add"><i class="fa fa-plus"></i> Ajouter</button>
            <button type="button" class="btn cancel" onclick="window.location.href='index.php'"><i class="fa fa-times"></i> Annuler</button>
        </form>
        <div id="msg"></div>
    </div>
    <script>
    $('#addCourseForm').on('submit', function(e){
        e.preventDefault();
        let data = {
            action: 'add',
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
                    $('#msg').text('Erreur lors de l\'ajout.');
                }
            }
        });
    });
    </script>
</body>
</html>