<?php
// Configurazione API
define('API_URL', 'https://wger.de/api/v2/');
define('TOKEN', '62e95f2d76b4aefd161d1f16cd487a5bb3ad3db0');

function fetchAllExerciseBaseData() {
    $url = API_URL . 'exercisebaseinfo/?language=13';
    $allResults = [];

    while ($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Token ' . TOKEN,
            'Accept: application/json'
        ]);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new Exception('HTTP error: ' . curl_error($ch));
        }
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($statusCode != 200) {
            throw new Exception('HTTP error! status: ' . $statusCode);
        }

        $data = json_decode($response, true);
        $allResults = array_merge($allResults, $data['results']);
        $url = $data['next'];
    }

    return $allResults;
}

function esercizioCorrisponde($ex, $text) {
    return stripos($ex['name'], $text) !== false && $ex['language'] === 13;
}

function esercizioFiltrato($exercise, $text) {
    foreach ($exercise['exercises'] as $ex) {
        if (esercizioCorrisponde($ex, $text)) {
            return true;
        }
    }
    return false;
}

function search($text) {
    $allExercises = fetchAllExerciseBaseData();
    $filteredExercises = [];

    foreach ($allExercises as $exercise) {
        if (esercizioFiltrato($exercise, $text)) {
            $filteredExercises[] = $exercise;
        }
    }

    return $filteredExercises;
}

function processExerciseData($data) {
    foreach ($data as $exercise) {
        if (isset($exercise['exercises']) && count($exercise['exercises']) > 0) {
            $italianExercises = array_filter($exercise['exercises'], function($ex) {
                return $ex['language'] === 13;
            });

            foreach ($italianExercises as $italianExercise) {
                echo '<div>';
                echo '<h2>' . htmlspecialchars($italianExercise['name']) . '</h2>';
                echo '<p>' . htmlspecialchars($italianExercise['description']) . '</p>';
                if (isset($exercise['images']) && count($exercise['images']) > 0) {
                    echo '<img src="' . htmlspecialchars($exercise['images'][0]['image']) . '" alt="' . htmlspecialchars($italianExercise['name']) . '">';
                }
                echo '<button onclick="addToFavorites(' . htmlspecialchars(json_encode($italianExercise)) . ')">Aggiungi ai preferiti</button>';
                echo '</div>';
            }
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['text'])) {
    $text = strtolower($_POST['text']);
    $filteredExercises = search($text);
    processExerciseData($filteredExercises);
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Ricerca Esercizi</title>
</head>
<body>
    <form id="search_content" method="POST">
        <input type="text" id="content" name="text" required>
        <button type="submit">Cerca</button>
    </form>
    <div id="exercise-view"></div>
</body>
</html>

<script>
    function addToFavorites(exercise) {
        fetch('getEsePreferiti.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(exercise)
        })
        .then(response => response.json())
        .then(result => {
            if (result.ok) {
                alert('Esercizio aggiunto ai preferiti!');
            } else {
                alert('Errore: ' + result.errore);
            }
        })
        .catch(error => {
            console.error('Errore durante l\'aggiunta ai preferiti:', error);
        });
    }
</script>
