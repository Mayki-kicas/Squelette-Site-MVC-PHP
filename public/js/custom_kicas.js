$( document ).ready(function(){
    $(".dropdown-trigger").dropdown();
});

$('#formAddEmp').submit(function (evt) {
    if($("#selectEntite").val()==null){
        alert("Veuillez choisir une entité");
        evt.preventDefault();
    }else{
        $.ajax({ // make an AJAX request
            type: "POST",
            url: "classes/employe.php", // it's the URL of your component B
            data: {
                matriculeEmploye: $('#matricule').val(),
                prenom: $('#prenom').val(),
                nom:$('#nom').val(),
                entite:$('#selectEntite').val(),
                email:$('#email').val(),
                // passwordEmploye:$('#passwordEmploye').val()

            }, // serializes the form's elements
            success: function(data)
            {
                alert(data.status_message);
                window.location.replace("index.php?controleur=employe");
            }
        });
        evt.preventDefault();
    }
});

$('#formAddEntite').submit(function (evt) { 
        $.ajax({ // make an AJAX request
            type: "POST",
            url: "classes/entite.php", // it's the URL of your component B
            data: {
                nomEntite: $('#nameEntite').val(),
                dossierEntite:$('#dossierEntite').val()

            }, // serializes the form's elements
            success: function(data)
            {
                alert(data.status_message);
                window.location.replace("index.php?controleur=entite");
            }
        });
        evt.preventDefault();
});


$('#formUpdateEmp').submit(function (evt){
    if($("#selectEntite").val()==null){
        alert("Veuillez choisir une entité");
        evt.preventDefault();
    }else{
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const paramId = urlParams.get('id');
        $.ajax({ // make an AJAX request
            type: "PUT",
            url: "classes/employe.php?id="+paramId, // it's the URL of your component B
            data: {
                matriculeEmploye: $('#matricule').val(),
                prenom: $('#prenom').val(),
                nom:$('#nom').val(),
                entite:$('#selectEntite').val(),
                email:$('#email').val()

            }, // serializes the form's elements
            success: function(data)
            {
                alert(data.status_message);
                window.location.replace("index.php?controleur=employe");
            }
        });
        evt.preventDefault();
    }
});

$('#formUpdateEnt').submit(function (evt){
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const paramId = urlParams.get('id');
        $.ajax({ // make an AJAX request
            type: "PUT",
            url: "classes/entite.php?id="+paramId, // it's the URL of your component B
            data: {
                nomEntite: $('#nomEntite').val(),
                dossierEntite: $('#dossierEntite').val()

            }, // serializes the form's elements
            success: function(data)
            {
                alert(data.status_message);
                window.location.replace("index.php?controleur=entite");
            }
        });
        evt.preventDefault();
});

$('.removeEmpButton').click(function(){
    var result = confirm('Vous êtes sur le point de supprimer l\'employé n°'+$(this).val())
    if(result == true){
        $.ajax({
            url: 'classes/employe.php?id='+$(this).val(),
            type: 'DELETE',
            success: function(result) {
                alert("Employe bien supprimé");
                window.location.replace("index.php?controleur=employe");
            }
        });
    }
});

$('.updateEmpButton').click(function(){
    window.location.replace("index.php?controleur=updateEmploye&id="+$(this).val());
});



$('.removeEntButton').click(function(){
    var result = confirm('Vous êtes sur le point de supprimer l\'entite n°'+$(this).val()+' et tout les employes associes. Etes-vous sur?')
    if(result == true){
        $.ajax({
            url: 'classes/entite.php?id='+$(this).val(),
            type: 'DELETE',
            success: function(result) {
                alert("Entite bien supprimé");
                window.location.replace("index.php?controleur=entite");
            }
        });
    }
});

$('.updateEntButton').click(function(){
    window.location.replace("index.php?controleur=updateEntite&id="+$(this).val());
});
