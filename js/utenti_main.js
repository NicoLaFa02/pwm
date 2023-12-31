// Scheletri delle funzioni per la gestione degli utenti

function registra_utente(){
    //registrazione utente nel db
    
    //deve esserci un controllo sulla lunghezza dei caratteri, se supera 15 allora l'username
    //è troppo lungo.

    const xhr = new XMLHttpRequest();
    const url = '../img/config.php'; // Sostituisci con il percorso corretto del tuo file PHP

    // Dati da inviare al server
    const datiUtente = {
        username: document.getElementById('username').value,
        email: document.getElementById('email').value,
        password: document.getElementById('password').value
    };

    // Converti i dati in una stringa nel formato "chiave=valore&chiave=valore"
    let datiDaInviare = '';
    for (let key in datiUtente) {
        if (datiUtente.hasOwnProperty(key)) {
            datiDaInviare += encodeURIComponent(key) + '=' + encodeURIComponent(datiUtente[key]) + '&';
        }
    }
    // Rimuovi l'ultimo '&'
    datiDaInviare = datiDaInviare.slice(0, -1);

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

    // Invia la richiesta con i dati
    xhr.send(datiDaInviare);
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