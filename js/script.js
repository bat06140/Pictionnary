/**
 * Created by FG on 12/01/2016.
 */


function calculAge()
{
    actu=new Date();
    var birthDate= new Date(document.getElementById("birthdate").value);
    console.log(birthDate);

    var birthYear = birthDate.getYear();
    var birthMonth = birthDate.getMonth();
    var birthDay = birthDate.getDay();

    if((actu.getMonth()+1)>=birthMonth)
    {
        if((actu.getMonth()+1)==birthMonth)
        {
            if(actu.getDay()>=birthDay)
            {
                mois=(actu.getMonth()+1)-birthMonth;
                ans=actu.getYear()-birthYear;
            }
            else
            {
                mois=(12-birthMonth)+(actu.getMonth()+1);
                ans=actu.getYear()-birthYear-1;
            }
        }
        else
        {
            mois=(actu.getMonth()+1)-birthMonth;
            ans=actu.getYear()-birthYear;
        }
    }
    else
    {
        mois=(12-birthMonth)+(actu.getMonth()+1);
        ans=actu.getYear()-birthYear-1;
    }


    if(actu.getDate()>birthDay)
    {
        jours=actu.getDate()-birthDay;
    }
    else
    {
        jours=(30-birthDay)+(actu.getDay());
    }

    while(jours>30)
    {
        jours-=30;
        mois+=1;
    }
    while(mois>12)
    {
        mois-=12;
        ans+=1;
    }


    document.getElementById("age").value=ans;
}

function refreshTaille()
{
    document.getElementById("inputTailleValue").innerHTML=" "+document.getElementById("taille").value+" m";
}

function loadProfilePic(e) {
    // on récupère le canvas où on affichera l'image
    var canvas = document.getElementById("preview");
    var ctx = canvas.getContext("2d");
    // on réinitialise le canvas: on l'efface, et déclare sa largeur et hauteur à 0
    ctx.setFillColor = "grey";
    ctx.fillRect(0,0, 96, 96);
    canvas.width=0;
    canvas.height=0;
    // on récupérer le fichier: le premier (et seul dans ce cas là) de la liste
    var file = document.getElementById("profilepicfile").files[0];
    // l'élément img va servir à stocker l'image temporairement
    var img = document.createElement("img");
    // l'objet de type FileReader nous permet de lire les données du fichier.
    var reader = new FileReader();
    // on prépare la fonction callback qui sera appelée lorsque l'image sera chargée
    reader.onload = function(e) {
        //on vérifie qu'on a bien téléchargé une image, grâce au mime type
        if (!file.type.match(/image.*/)) {
            // le fichier choisi n'est pas une image: le champs profilepicfile est invalide, et on supprime sa valeur
            document.getElementById("profilepicfile").setCustomValidity("Il faut télécharger une image.");
            document.getElementById("profilepicfile").value = "";
            canvas.width = 96;
            canvas.height = 96;
        }
        else {
            // le callback sera appelé par la méthode getAsDataURL, donc le paramètre de callback e est une url qui contient
            // les données de l'image. On modifie donc la source de l'image pour qu'elle soit égale à cette url
            // on aurait fait différemment si on appelait une autre méthode que getAsDataURL.
            img.src = e.target.result;
            // le champs profilepicfile est valide
            document.getElementById("profilepicfile").setCustomValidity("");
            MAX_WIDTH = 96;
            MAX_HEIGHT = 96;

            // A FAIRE: si on garde les deux lignes suivantes, on rétrécit l'image mais elle sera déformée
            // Vous devez supprimer ces lignes, et modifier width et height pour:
            //    - garder les proportions,
            //    - et que le maximum de width et height soit égal à 96
            var height = 0;
            var width = 0;
            if(img.width >= img.height){
                min = img.width / MAX_WIDTH;
                height = img.height / min;
                width = MAX_WIDTH;
                if(height > MAX_HEIGHT){
                    min = height / MAX_HEIGHT;
                    width = width / min;
                    height = MAX_HEIGHT;
                }
            } else {
                min = img.height / MAX_HEIGHT;
                width = img.width / min;
                height = MAX_HEIGHT;
                if(width > MAX_WIDTH){
                    min = width / MAX_WIDTH;
                    height = height / min;
                    width = MAX_WIDTH;
                }
            }

            canvas.width = 96;
            canvas.height = 96;

            // on dessine l'image dans le canvas à la position 0,0 (en haut à gauche)
            // et avec une largeur de width et une hauteur de height
            ctx.drawImage(img, (MAX_WIDTH - width)/2 , (MAX_HEIGHT - height)/2, width, height);
            // on exporte le contenu du canvas (l'image redimensionnée) sous la forme d'une data url
            dataurl = canvas.toDataURL("image/png");

            // on donne finalement cette dataurl comme valeur au champs profilepic
            document.getElementById("picture").value = dataurl;
        }
    };
    // on charge l'image pour de vrai, lorsque ce sera terminé le callback loadProfilePic sera appelé.
    reader.readAsDataURL(file);
}