function addSubject(){
    if(confirm('Działanie to utworzy pusty temat o nazwie "Nowy temat" i przekieruje Cię do jego edycji.')){
        window.location.href = "tematy/utworz"
    }
}

function removeSubject(id, nazwa){
    if(confirm('Masz zamiar usunąć temat '+nazwa+'! Czy jesteś tego pewien?\nTa operacja jest nieodwracalna.')){
        window.location.href = "/usuntemat/"+id;
    }
}

function restoreSubject(id, nazwa){
    if(confirm('Przywracanie ustawia poprzednią treść tematu '+ nazwa +' jako aktualną. Aktualna treść będzie po tej operacji treścią poprzednią, dlatego ponowne przywrócenie tematu będzie skutkowało cofnięciem operacji. Czy jesteś pewien?')){
        window.location.href = "/przywroctemat/"+id;
    }
}