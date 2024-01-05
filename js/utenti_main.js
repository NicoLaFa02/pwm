// Scheletri delle funzioni per la gestione degli utenti

function verLength(inputString){
    if (inputString.length < 200) return true;
    else return false;
    //semplice funzione per evitare che le stringhe superino il limite di caratteri imposto nel db
}


function registra_utente(){
    //registrazione utente nel db

    // Dati da inviare al server
    const userData = {
        username: document.getElementById('username').value,
        email: document.getElementById('email').value,
        password: document.getElementById('password').value
    };

    // se la lunghezza supera il limite consentito allora non si continua con la registrazione
    if (!verLength(userData.username) || !verLength(userData.password) || !verLength(userData.email)) {
        console.error('Errore: superata la lunghezza consentita (MAX 200 caratteri per campo).');
        return;
      }


    const xhr = new XMLHttpRequest();
    const url = '../img/registration.php';

    // Configura la richiesta
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // Funzione che gestisce la risposta del server
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log(xhr.responseText); // Risposta dal server
            } else {
                console.error('Si è verificato un errore.');
            }
        }
    };
    //"impacchetamento" dei dati da inviare
    const dataToSend = `username=${userData.username}&password=${userData.password}&email=${userData.email}`;

    // Invia la richiesta con i dati
    xhr.send(dataToSend);
}

function login(){
    //funzione di accesso

    // controllo con le informazioni presenti nel database, controllo OK quando il server è on
    // e quando il login ha successo, sennò controllo non superato.
    
}

function elimina_utente(){
    //funzione per eliminare l'utente dal db
}

function get_uid(){
    //funzione per mostrare l'uid
}

function modifica_password(){
    // funzione per modificare la password
}