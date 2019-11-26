function removeSubject(id, nazwa){
    if(confirm('Masz zamiar usunąć temat '+nazwa+'! Czy jesteś tego pewien?\nTa operacja jest nieodwracalna.')){
        window.location.href = "/usuntemat/"+id;
    }
}