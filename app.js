document.addEventListener('DOMContentLoaded', () => {
    // Variables générales
    const btnMessage = document.getElementById('btn-message');
    const btnQuestionnaire = document.getElementById('btn-questionnaire');
    const btnResultat = document.getElementById('btn-resultat');
    const nextBtn = document.getElementById('next-btn');
    const questionContainer = document.getElementById('question-container');
    const errorMessage = document.getElementById('error-message');
    const resultMessage = document.getElementById('result-message');
    const progressBar = document.getElementById('progress-bar');
    const timerDisplay = document.getElementById('timer-display');
    const btnEnvoyer = document.querySelector('#result-section .bd'); // Sélecteur du bouton Envoyer

    let currentQuestionIndex = 0;
    let score = 0;
    let timer;
    const questionTimeLimit = 20;

    const questions = [
        { question: "Quel est le langage utilisé côté serveur ?", options: ["JavaScript", "Python", "PHP", "Ruby"], answer: "PHP" },
        { question: "Que signifie PHP?", options: ["Personal Home Page", "Hypertext Preprocessor", "Pretext Hypertext Processor", "Preprocessor Home Page"], answer: "Personal Home Page" },
        { question: "Les fichiers PHP ont l’extension …. ?", options: [".html", ".xml", ".js", ".php"], answer: ".php" },
        { question: "Lequel des éléments suivants doit être installé pour exécuter des scripts PHP?", options: ["Adobe Dreamweaver", "PHP", "Apach", "ILS"], answer: "Apach" }
    ];

    // Fonction pour afficher la section sélectionnée
    const showSection = (section) => {
        const sections = document.querySelectorAll('.section');
        sections.forEach(sec => sec.classList.remove('active'));
        section.classList.add('active');
    };

    // Afficher la question en fonction de l'index
    const loadQuestion = (index) => {
        if (index < questions.length) {
            const q = questions[index];
            const questionHTML = `<h3>${q.question}</h3>`;
            let optionsHTML = '';
            q.options.forEach(option => {
                optionsHTML += `
                    <label>
                        <input type="radio" name="option" value="${option}">
                        ${option}
                    </label><br>
                `;
            });
            questionContainer.innerHTML = questionHTML + optionsHTML;
            errorMessage.style.display = 'none';
        }
    };

    const checkAnswerAndProceed = () => {
        clearInterval(timer);
        const selectedOption = document.querySelector('input[name="option"]:checked');
        if (selectedOption) {
            const userAnswer = selectedOption.value;
            const correctAnswer = questions[currentQuestionIndex].answer;
            if (userAnswer === correctAnswer) {
                score++;
            }
        }
        currentQuestionIndex++;
        if (currentQuestionIndex < questions.length) {
            loadQuestion(currentQuestionIndex);
            updateProgressBar();
            startTimer();
        } else {
            finishQuiz();
        }
    };

    const updateProgressBar = () => {
        const progressPercentage = (currentQuestionIndex + 1) / questions.length * 100;
        progressBar.style.width = progressPercentage + '%';
    };

    // Chronomètre de 30 secondes
    const startTimer = () => {
        let timeLeft = questionTimeLimit;
        timerDisplay.textContent = `Temps restant : ${timeLeft} secondes`;
        timer = setInterval(() => {
            timeLeft--;
            timerDisplay.textContent = `Temps restant : ${timeLeft} secondes`;
            if (timeLeft <= 0) {
                clearInterval(timer);
                checkAnswerAndProceed();
            }
        }, 1000);
    };

    const finishQuiz = () => {
        resultMessage.textContent = `Votre score est de ${score} sur ${questions.length}.`;
        document.getElementById('final-score').value = score; // Met à jour le score
        showSection(document.getElementById('result-section'));
    };
    

    btnResultat.addEventListener('click', () => {
        showSection(document.getElementById('result-section'));
        resultMessage.textContent = `Votre score est de ${score} sur ${questions.length}.`;
    });

    nextBtn.addEventListener('click', checkAnswerAndProceed);

    btnQuestionnaire.addEventListener('click', () => {
        showSection(document.getElementById('questionnaire-section'));
        loadQuestion(currentQuestionIndex);
        updateProgressBar();
        startTimer();
    });

    btnMessage.addEventListener('click', () => {
        showSection(document.getElementById('message-section'));
    });

    btnEnvoyer.addEventListener('click', () => {
        const formData = new FormData();
        formData.append('score', score);

        fetch('enregistrer_resultat.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data); // Affiche le message de succès ou d'erreur
        })
        .catch(error => {
            console.error('Erreur:', error);
        });
    });
});

