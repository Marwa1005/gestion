
<?php
header('Content-Type: application/json');
$dataFile = 'data.json';
$courses = json_decode(file_get_contents($dataFile), true);
$input = json_decode(file_get_contents('php://input'), true);

if (!$input || !isset($input['action'])) {
    echo json_encode(['success' => false, 'message' => 'Requête invalide']);
    exit;
}

switch ($input['action']) {
    case 'add':
        $newId = (count($courses) > 0) ? max(array_column($courses, 'id')) + 1 : 1;
        $newCourse = [
            'id' => $newId,
            'intitule' => trim($input['intitule']),
            'enseignant' => trim($input['enseignant']),
            'niveau' => trim($input['niveau'])
        ];
        $courses[] = $newCourse;
        file_put_contents($dataFile, json_encode($courses, JSON_PRETTY_PRINT));
        echo json_encode(['success' => true]);
        break;

    case 'edit':
        foreach ($courses as &$course) {
            if ($course['id'] == $input['id']) {
                $course['intitule'] = trim($input['intitule']);
                $course['enseignant'] = trim($input['enseignant']);
                $course['niveau'] = trim($input['niveau']);
                break;
            }
        }
        file_put_contents($dataFile, json_encode($courses, JSON_PRETTY_PRINT));
        echo json_encode(['success' => true]);
        break;

    case 'delete':
        $courses = array_filter($courses, function($c) use ($input) {
            return $c['id'] != $input['id'];
        });
        file_put_contents($dataFile, json_encode(array_values($courses), JSON_PRETTY_PRINT));
        echo json_encode(['success' => true]);
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Action inconnue']);
}
?>