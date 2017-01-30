/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


app.controller('homeController', function ($scope, $http) {
    hasPermission();
    document.title = "Home";

    show_navbar();


});