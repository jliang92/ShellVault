/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

app.controller('loginController', function ($scope, $http, $location) {

    $http.get("php_scripts/credentials/is_logged_in.php").success(function (data, status) {
        if (status === 200) {
            // alert(data);
            if (data["status_code"] === 1) {
                console.log(data["status_message"]+", redirecting to home");
                console.log(data);
                document.location = "home.php";
                $location.path("home.php");

            } else {
                console.log(data["status_message"]);
                $('#myModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#myModal').modal('show');
                $scope.pwd = "";
                $scope.uname = "";
            }
        }
    });





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
