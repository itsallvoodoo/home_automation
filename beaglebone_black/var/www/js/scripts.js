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
var mainApp = angular.module('mainApp', ['ngRoute']); // ngRoute is specified to control loading of external pages into ng-view via routeProvider

	mainApp.config(function($routeProvider, $locationProvider) {
		// routeProvider gives ng-view the template and controller that is appropriate when a link is clicked. Activetab is for ng-class:active
		$routeProvider

			.when('/home', {
			templateUrl : '../home.php',
			controller  : 'mainController',
			activetab: 'home'
			})

			.when('/access', {
			templateUrl : '../access/access.php',
			controller  : 'accessController',
			activetab: 'access'
			})

			.when('/security', {
			templateUrl : '../security/security.php',
			controller  : 'securityController',
			activetab: 'security'
			})

			.when('/hvac', {
			templateUrl : '../hvac/tempData.php',
			controller  : 'hvacController',
			activetab: 'hvac'
			});

			// .otherwise({redirectTo: '/home'});

		$locationProvider.html5Mode(true); // This, along with base in index.php, allows for pretty urls in angular

	});

	// The following controllers allow for custom functions and parameters when called upon
	mainApp.controller('mainController', function($scope, $location) {
		$scope.message = 'Home';

		$scope.isActive = function(route) {
        	return route === $location.path();
        }

	});

	mainApp.controller('accessController', function($scope, $location) {
		$scope.message = 'Access';

		$scope.isActive = function(route) {
        	return route === $location.path();
        }

	});

	mainApp.controller('securityController', function($scope, $location) {
		$scope.message = 'Security';

		$scope.isActive = function(route) {
        	return route === $location.path();
        }

	});

	mainApp.controller('hvacController', function($scope, $location) {
		$scope.message = 'HVAC';

		$scope.isActive = function(route) {
        	return route === $location.path();
        }

	});

// This is a very rudimentary test function for my HVAC page. Will be replaced eventually
function testFunction() {
        alert("It works");
    }