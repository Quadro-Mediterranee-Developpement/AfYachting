/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function goBack() {
    if(typeof document.referrer !== 'undefined'){
        window.location = document.referrer;
    }
    else {
        window.location = "index";
    }
}