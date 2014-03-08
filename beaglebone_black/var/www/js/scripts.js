/*
* name:     scripts.js
* author:   Chad Hobbs
* created:  140306
*
* description: This script contains all of the javascript functions needed to implement my home automation website 
*/

/* ----------------------------------------------------------------------------------------
* Module Name: mainApp
* Parameters:    TBD
* Returns:       TBD
* Description:   This is the main module
*  ----------------------------------------------------------------------------------------
*/
var mainApp = angular.module('mainApp', ['ngRoute']);

	mainApp.config(function($routeProvider, $locationProvider) {
		$routeProvider

			.when('/home', {
			templateUrl : '../home.php',
			controller  : 'mainController'
			activetab: 'home'
			})

			.when('/access', {
			templateUrl : '../access/access.php',
			controller  : 'accessController'
			})

			.when('/security', {
			templateUrl : '../security/security.php',
			controller  : 'securityController'
			})

			.when('/hvac', {
			templateUrl : '../hvac/tempData.php',
			controller  : 'hvacController'
			});

			// .otherwise({redirectTo: '/home'});

		$locationProvider.html5Mode(true);

	});

	mainApp.controller('mainController', function($scope, $route) {
		$scope.message = 'Home';

		$scope.$route = $route;
	});

	mainApp.controller('accessController', function($scope) {
		$scope.message = 'Access';

	});

	mainApp.controller('securityController', function($scope) {
		$scope.message = 'Security';

	});

	mainApp.controller('hvacController', function($scope) {
		$scope.message = 'HVAC';

	});

function testFunction() {
        alert("It works");
    }