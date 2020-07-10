/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function tri() {

    let coque = document.getElementById("typeCoque").value;
    let prix = document.getElementById("prix").value;
    let options_box = document.getElementsByClassName("options_vente");
    let options = new Array();
    
    if(prix === ""){prix = 999999999;}else{prix = parseInt(prix,10);}

    for (let i = 0; i < options_box.length; i++) {
        if (options_box.item(i).checked === true) {
            options.push(options_box.item(i).value);
        }
    }

    if (coque !== "") {
        if(coque === "Rigide"){
            options.push("rigide");
        } else if(coque === "Semi-rigide"){
            options.push("semi");
        } else {
            options.push("prestige");
        }
    }

    let bateaux = document.getElementsByClassName("mosaic_ellement");
    let bateaux_prix = document.getElementsByClassName("mosaic_ellement_name");

    let flag = true;

    for (let i = 0; i < bateaux.length; i++) {

        flag = true;

        for (let j = 0; j < options.length; j++) {
            if (!bateaux.item(i).classList.contains(options[j])) {
                flag = false;
            }
        }

        if (parseInt(bateaux_prix.item(i).textContent.replace(' ', '').replace('€', ''), 10) > prix) {
            flag = false;
        }

        if (flag === true) {
            bateaux.item(i).style.display = "block";
        } else {
            bateaux.item(i).style.display = "none";
        }
    }
}