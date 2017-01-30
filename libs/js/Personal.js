/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function check_cred(user,pass){
    if(user==="Jacky"&&pass==="Liang"){
        return true;
    }
    return false;
}

function submit_form(form_id){
    document.getElementById(form_id).submit();
    window.alert("Form Submitted");
}