/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

app.controller('loginController', function ($scope, $http, $location) {
    remove_navbar();
    $('#myModal').modal({
        backdrop: 'static',
        keyboard: false
    });
    $('#myModal').modal('show');
    $scope.pwd = "";
    $scope.uname = "";

    function remove_navbar() {
        $("#navigation_bar").addClass("hide");
    }

    function show_navbar() {
        $("#navigation_bar").removeClass("hide");
    }

    $scope.login = function () {
        $http.post("php_scripts/credentials/login.php", {'user': $scope.uname, 'pass': $scope.pwd}).success(function (data, status) {
            if (status === 200) {
                if (data["status"] === 1) {
                    show_navbar();
                    $('#myModal').modal('hide');
                    
                } else {
                    alert(data["response_message"]);
                }
            }
        });
    };
});
