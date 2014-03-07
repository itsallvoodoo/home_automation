/*
* name:     scripts.js
* author:   Chad Hobbs
* created:  140306
*
* description: This script contains all of the javascript functions needed to implement my home automation website 
*/

function testFunction() {
	alert("It works");
}


/* ----------------------------------------------------------------------------------------
* Module Name: mainApp
* Parameters:    TBD
* Returns:       TBD
* Description:   This is the main module
*  ----------------------------------------------------------------------------------------
*/
var mainApp = angular.module('mainApp', ['ngRoute']);

	mainApp.config(function($routeProvider) {
		$routeProvider

					.when('/home', {
				templateUrl : '/home.php',
				controller  : 'mainController'
			})

					.when('/access', {
				templateUrl : '/access/access.php',
				controller  : 'accessController'
			})

					.when('/security', {
				templateUrl : '/security/security.php',
				controller  : 'securityController'
			})

					.when('/hvac', {
				templateUrl : '/hvac/tempData.php',
				controller  : 'hvacController'
			});
	});

	mainApp.controller('mainController', function($scope) {
			$scope.message = 'Home';
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