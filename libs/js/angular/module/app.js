/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/*global angular*/
var app = angular.module('shellVault', ['ngRoute']);

function check_mm_dd_yyyy(date) {
    //var re = /^\d{4}-\d{1,2}-\d{1,2}$/;
    var re = /^\d{1,2}-\d{1,2}-\d{4}$/;
    //alert("Test result "+re.test(date));
    return re.test(date);

}


function remove_navbar() {
    $("#navigation_bar").addClass("hide");
}

function show_navbar() {
    $("#navigation_bar").removeClass("hide");
}

function hasPermission() {

    var $http = angular.element('html').injector().get('$http');
    
    $http.get("php_scripts/credentials/is_logged_in.php").success(function (data, status) {
        if (status === 200) {
           // alert(data);
            if (data["status_code"] === 1) {
                //stay there
            }else{
                //move to login
               // alert("moving away");
                document.location="index.php";
            }
        }
    });
}