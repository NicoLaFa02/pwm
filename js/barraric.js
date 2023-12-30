// funzione per eseguire la ricerca

function RicercaRecensioni() {
    const risultati= recensioni.filter(review => review.toLowerCase().include(query.toLowerCase()));
    mostraRisultati(risultati);
}


// funzione per visualizzare i risultati della ricerca

function mostraRisultati(risultati){
    const RisultatiLista= document.getElementById('RicercaRisultati');
    RisultatiLista.innerHTML= '';

    risultati.forEach(risultati => {
        const Lista= document.createElement('li');
        Lista.textContent = risultati;
        RisultatiLista.appendChild(Lista);

    });
}

// ascoltatore di eventi per la barra di ricerca

const RicercaInput = document.getElementById('RicercaInput');
RicercaInput.addEventListener('input', function () {
    const query = this.value;
    RicercaRecensioni(query);
});
