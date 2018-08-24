
'use strict';

var baseModule =  angular.module('baseModule', [])

    .config(function($interpolateProvider){
        $interpolateProvider.startSymbol('[[').endSymbol(']]');
    });


baseModule
    .controller('MainController',['$scope', 'MainService',
        function($scope, MainService){

        $scope.paymentSchedule = null;
            $scope.form = {};

            $scope.submit = function(){

                $scope.loading = true;

                MainService.getSchedule($scope.form).then(function successCallback(response) {
                    $scope.loading = false;
                    $scope.paymentSchedule = response.data;

                }, function errorCallback(response) {
                    $scope.loading = false;
                    $scope.errorSum = response.data.sum;
                    $scope.errorPercent = response.data.percent;
                    $scope.errorDuration = response.data.sum;
                    $scope.errorFirstPayment = response.data.firstPayment;
                });
            };
        }])
    .constant('MainConfig', {
        baseRoute: '/app_dev.php/api/v1.0/',
        routes: {
            getSchedule: 'schedule',
        }

    })
    .factory('MainService', [
        '$http',
        'MainConfig',
        function(
            $http,
            MainConfig
        ) {
            return {

                getSchedule: function (form) {
                    return $http({
                        method: 'GET',
                        params: form,
                        url: MainConfig.baseRoute + MainConfig.routes.getSchedule,
                    });
                },
            }
        }
    ]);