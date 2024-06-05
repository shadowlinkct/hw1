function esercizioCorrisponde(ex, text) {
	return ex.name.toLowerCase().includes(text.toLowerCase()) && ex.language === 13;
}

function esercizioFiltrato(exercise, text) {
	for (let i = 0; i < exercise.exercises.length; i++) {
		if (esercizioCorrisponde(exercise.exercises[i], text)) {
			return true;
		}
	}
	return false;
}
async function search(event) {
	event.preventDefault();

	const text = document.querySelector('#content').value.toLowerCase();

	if (text) {
		console.log('Eseguo ricerca elementi riguardanti: ' + text);

		try {
			// Ottieni tutti i dati degli esercizi
			const allExercises = await fetchAllExerciseBaseData();

			// Filtra gli esercizi in base al nome
			let filteredExercises = [];
			for (let i = 0; i < allExercises.length; i++) {
				if (esercizioFiltrato(allExercises[i], text)) {
					filteredExercises.push(allExercises[i]);
				}
			}

			// Processa i dati degli esercizi filtrati
			processExerciseData(filteredExercises);
		} catch (error) {
			onError(error);
		}
	}
}

function prevent(event) {
	event.preventDefault();
}

function onInsert(response) {
	console.log('risposta ricevuta');
	return response.text();
}

async function fetchAllExerciseBaseData() {
	const limit = 100;
	let offset = 0;
	let allResults = [];

	try {
		while (true) {
			const response = await fetch(`api_request.php?limit=${limit}&offset=${offset}`);

			if (!response.ok) {
				throw new Error('HTTP error! status: ' + response.status);
			}

			const data = await response.json();

			if (data.results.length === 0) {
				break;
			}

			allResults = allResults.concat(data.results);
			offset += limit;
		}

		return allResults;
	} catch (error) {
		throw new Error('Error fetching exercise data: ' + error.message);
	}
}



  function processExerciseData(data) {
    const resultsDiv = document.querySelector('#exercise-view');
    while (resultsDiv.firstChild) {
        resultsDiv.removeChild(resultsDiv.firstChild);
    }

    const defaultImage = '../img/bodybuilding-fitness.svg'; 

    for (let i = 0; i < data.length; i++) {
        let exercise = data[i];
        if (exercise.exercises && exercise.exercises.length > 0) {
            let italianExercises = [];
            for (let j = 0; j < exercise.exercises.length; j++) {
                if (exercise.exercises[j].language === 13) {
                    italianExercises.push(exercise.exercises[j]);
                }
            }
            for (let k = 0; k < italianExercises.length; k++) {
                let italianExercise = italianExercises[k];

                let exerciseDiv = document.createElement('div');

                let h2 = document.createElement('h2');
                h2.textContent = italianExercise.name;
                exerciseDiv.appendChild(h2);

                let p = document.createElement('p');
                p.textContent = italianExercise.description;
                exerciseDiv.appendChild(p);

                let img = document.createElement('img');
                img.src = (exercise.images && exercise.images.length > 0) ? exercise.images[0].image : defaultImage;
                img.alt = italianExercise.name;
                exerciseDiv.appendChild(img);

                let addButton = document.createElement('button');
                addButton.textContent = 'Aggiungi ai preferiti';
                addButton.onclick = function() {
                    addToFavorites({
                        name: italianExercise.name,
                        description: italianExercise.description,
                        image: (exercise.images && exercise.images.length > 0) ? exercise.images[0].image : defaultImage
                    });
                };
                exerciseDiv.appendChild(addButton);

                resultsDiv.appendChild(exerciseDiv);
            }
        }
    }
}



async function addToFavorites(exercise) {
	try {
		const response = await fetch('getEsePreferiti.php', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json'
			},
			body: JSON.stringify(exercise)
		});

		const result = await response.json();
		if (response.ok) {
			alert('Esercizio aggiunto ai preferiti!');
		} else {
			alert('Errore: ' + result.errore);
		}
	} catch (error) {
		console.error('Errore durante l\'aggiunta ai preferiti:', error);
	}
}



function onError(error) {
	console.log('There was a problem with the fetch operation: ' + error.message);
}

// Aggiungo event listener al form1 per la RICERCA
const form = document.querySelector('#search_content');
form.addEventListener('submit', search)
