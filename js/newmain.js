$(document).ready(function() {
    // Carica le recensioni all'avvio
    caricaRecensioni();

    // Carica i campi da calcio nel form
    caricaCampiCalcio();

    // Aggiungi gestore di eventi per il form di recensione
    $('#recensioneForm').submit(function(e) {
        e.preventDefault();
        inviaRecensione();
    });
});


function caricaRecensioni() {
    var paginaSelezionata = $('#paginazione').val();

    // Effettua una chiamata AJAX per ottenere tutte le nuove recensioni dal server
    var url = 'api/api2.php?pagina=' +paginaSelezionata;
    if (ultimaDataRecensione) {
        url += '?ultimaData=' + ultimaDataRecensione;
    }

    $.get(url, function(data) {
        // Aggiorna la data dell'ultima recensione ottenuta
        if (data.length > 0) {
            ultimaDataRecensione = data[0].DataRecensione;

            // Segnala visivamente l'arrivo di nuove recensioni
            $('#titolo').css('background-color', '#ffcc00');
            setTimeout(function() {
                $('#titolo').css('background-color', '');
            }, 3000); // Ripristina il colore di sfondo dopo 3 secondi
        }

        // Ordina le nuove recensioni in base all'ordine selezionato
        if (ordineSelezionato === 'data') {
            data.sort(function(a, b) {
                return new Date(b.DataRecensione) - new Date(a.DataRecensione);
            });
        } else if (ordineSelezionato === 'voto') {
            data.sort(function(a, b) {
                return b.Voto - a.Voto;
            });
        }

        // Mostra solo le nuove recensioni
        mostraRecensioni(data);

        //aggiorna i controlli di paginazione
        aggiornaControlliPaginazione(paginaSelezionata);
    });
}

// Aggiungi una funzione per caricare recensioni di una pagina specifica
function caricaRecensioniPagina(pagina) {
    caricaRecensioni(pagina);
}

// Aggiungi un evento per il cambio della pagina selezionata
$('#paginazione').on('click', 'button', function() {
    var paginaSelezionata = $(this).text().replace('Pagina ', '');
    caricaRecensioniPagina(paginaSelezionata);
});

function aggiornaControlliPaginazione(paginaSelezionata){
    var paginazioneContainer =$('#paginazione');

    var numeroTotalePagine = 4;

      // Rimuovi eventuali pulsanti di paginazione esistenti
      paginazioneContainer.empty();

      // Aggiungi pulsanti di paginazione in base al numero totale di pagine
      for (var i = 1; i <= numeroTotalePagine; i++) {
          var pulsantePagina = $('<button></button>').text('Pagina ' + i);
          pulsantePagina.click(function() {
              caricaRecensioni(i);
          });
  
          paginazioneContainer.append(pulsantePagina);
      }
  }

function mostraRecensioni(recensioni) {
    // Mostra le recensioni nella pagina
    var recensioniContainer = $('#recensioni-container');
    recensioniContainer.empty();

recensioni.forEach(function(recensione) {
        var html = '<div class="recensione" data-id="' + recensione.ID + '">';
        html += '<h3>' + recensione.NomeCampo + '</h3>';
        html += '<p>Voto: ' + recensione.Voto + '</p>';
        html += '<p>Utente: ' + recensione.NomeUtente + '</p>';
        html += '<p>Commento: ' + recensione.Commento + '</p>';
        html += '<button class="modifica">Modifica</button>';
        html += '<button class="elimina">Elimina</button>';

        if (recensione.Risposta) {
            html += '<div class="risposta"><strong>Risposta:</strong> ' + recensione.Risposta + '</div>';
        } else {
            html += '<button class="rispondi">Rispondi</button>';
        }

        html += '</div>';
        recensioniContainer.append(html);
    });

    // Aggiungi gestori di eventi per i pulsanti di modifica, eliminazione e risposta
    $('.modifica').click(function() {
        var recensioneID = $(this).closest('.recensione').data('id');
        mostraModuloModifica(recensioneID);
    });

    $('.elimina').click(function() {
        var recensioneID = $(this).closest('.recensione').data('id');
        eliminaRecensione(recensioneID);
    });

    $('.rispondi').click(function() {
        var recensioneID = $(this).closest('.recensione').data('id');
        mostraModuloRisposta(recensioneID);
    });
}

function mostraModuloModifica(recensioneID) {
    // Recupera il testo della recensione corrente
    var testoRecensione = $('[data-id="' + recensioneID + '"] p:contains("Commento:")').text().replace('Commento: ', '');

    // Sostituisci il testo della recensione con un campo di input per la modifica
    $('[data-id="' + recensioneID + '"] p:contains("Commento:")').html('<textarea id="modificaInput" rows="4">' + testoRecensione + '</textarea>');

    // Aggiungi un pulsante per confermare la modifica
    $('[data-id="' + recensioneID + '"]').append('<button class="conferma-modifica">Conferma Modifica</button>');

// Aggiungi un gestore di eventi per il pulsante di conferma modifica
    $('.conferma-modifica').click(function() {
        var nuovoTesto = $('#modificaInput').val();
        confermaModifica(recensioneID, nuovoTesto);
    });
}

function confermaModifica(recensioneID, nuovoTesto) {
    // Effettua una chiamata AJAX per confermare la modifica della recensione
    $.ajax({
        url: 'api/api2.php',
        type: 'PUT',
        data: JSON.stringify({ recensioneID: recensioneID, nuovoTesto: nuovoTesto }),
        contentType: 'application/json',
        success: function(response) {
            // Aggiorna la pagina per riflettere la modifica
            caricaRecensioni();
        },
        error: function(error) {
            console.error('Errore durante la modifica della recensione:', error);
            // Gestisci l'errore in modo appropriato (ad esempio, mostrando un messaggio all'utente)
        }
    });
}

function eliminaRecensione(recensioneID) {
    // Effettua una chiamata AJAX per eliminare la recensione
    $.ajax({
        url: 'api/api2.php',
        type: 'DELETE',
        data: JSON.stringify({ recensioneID: recensioneID }),
        contentType: 'application/json',
        success: function(response) {
            // Aggiorna la pagina per riflettere l'eliminazione
            caricaRecensioni();
        },
        error: function(error) {
            console.error('Errore durante eliminazione della recensione:', error);
            // Gestisci l'errore in modo appropriato (ad esempio, mostrando un messaggio all'utente)
        }
    });
}

function inviaRisposta(recensioneID) {
    var risposta = $('#rispostaInput').val();

// Effettua una chiamata AJAX per inviare la risposta al server
    $.post('api/api2.php', { recensioneID: recensioneID, risposta: risposta }, function(response) {
        // Aggiorna la pagina per riflettere la nuova risposta
        caricaRecensioni();
    });

    // Rimuovi il modulo di risposta
    $('#modulo-risposta').remove();
}



function caricaCampiCalcio() {
    // Effettua una chiamata AJAX per ottenere l'elenco dei campi da calcio dal server
    $.get('api/api2.php', function(data) {
        // Popola il menu a tendina con i risultati
        var campoSelect = $('#campoSelect');
        campoSelect.empty();

        data.forEach(function(campo) {
            campoSelect.append('<option value="' + campo.ID + '">' + campo.NomeCampo + '</option>');
        });

        // Aggiungi un evento per il cambio del campo da calcio selezionato
        campoSelect.change(function() {
            // Carica e visualizza la media dei voti per il campo selezionato
            caricaMediaVoti(campoSelect.val());
        });

        // Carica e visualizza la media dei voti per il primo campo nella lista (se presente)
        if (data.length > 0) {
            caricaMediaVoti(data[0].ID);
        }
    });
}

function caricaMediaVoti(campoID) {
    // Effettua una chiamata AJAX per ottenere la media dei voti per il campo da calcio dal server
    $.get('api/api2.php?campoID=' + campoID, function(data) {
        $('#mediaVoti').text('Media Voti: ' + (data.media || 'N/A'));
    });
}


function inviaRecensione() {
    // Recupera i dati dal form
    var utenteID = 1; // Sostituisci con l'ID dell'utente corrente (potrebbe essere gestito tramite autenticazione)
    var campoID = $('#campoSelect').val();
    var voto = $('#votoInput').val();
    var commento = $('#commentoInput').val();

     // Ottieni il token dall'utente autenticato (dopo una corretta autenticazione)
     var token = 'il_tuo_token_jwt'; // Sostituisci con la logica di ottenimento del token

     // Effettua una chiamata AJAX includendo il token nell'header Authorization
     $.ajax({
         url: 'api/api2.php',
         type: 'POST',
         headers: {
             'Authorization': 'Bearer ' + token
         },
         data: JSON.stringify({ utenteID: utenteID, campoID: campoID, voto: voto, commento: commento }),
         contentType: 'application/json',
         success: function(response) {
             // Aggiorna la pagina per riflettere la nuova recensione
             caricaRecensioni();
         },
         error: function(error) {
             console.error('Errore durante l\'invio della recensione:', error);
             // Gestisci l'errore in modo appropriato
         }
     });
 }
