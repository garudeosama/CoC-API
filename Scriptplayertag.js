$(document).ready(function() {
    $('#research').submit(function(event) {
        event.preventDefault(); // Empêche le formulaire de se soumettre normalement

        var playerTag = $('#playerTag').val(); // Récupère la valeur du champ playerTag

        $.ajax({
            url: 'Researchinapi.php?playerTag=' + playerTag, // Ajoute le tag du joueur à l'URL de la requête
            method: 'GET',  
            success: function(response) {
                var decod = JSON.parse(response);
                console.log(decod);
                //CLAN
                $('#nameclan').text(`Clan : ${decod.clan.name}`);
                var imageUrl = decod.clan.badgeUrls.medium;
                var imageElement = document.getElementById("logoclan");
                imageElement.src = imageUrl;
                $('#tagclan').text(`Clantag : ${decod.clan.tag}`);

                //TROPHÉ
                $('#trofy').text(`${decod.trophies}`);

                //NOM et lvl
                $('#Pname').text(`name : ${decod.name}`);
                $('#level').text(`niveau : ${decod.expLevel}`);
                //HDV
                $('#HDV').text(`Niveau HDV : ${decod.townHallLevel}`);
                var imageUrl = `http://localhost/COCSITE/SICOC/Site%20web%20COC/Site%20web%20COC/image/HDV${decod.townHallLevel}.jpg`;
                var imageElement = document.getElementById("imghdv");
                imageElement.src = imageUrl;

                //LEAGUE
                $('#league').text(`Ligue : ${decod.league.name}`);
                var imageUrl = decod.league.iconUrls.medium;
                var imageElement = document.getElementById("imgleague");
                imageElement.src = imageUrl;
                
                //troops
                $('#barbar').text(`Troupe ${decod.troops.name}`);
            
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }   
        });
    });
});