/*
* name:     scripts.js
* author:   Chad Hobbs
* created:  140306
*
* description: This script contains all of the javascript functions needed to implement my home automation website 
*/


var mainApp = angular.module('mainApp', []);

	mainApp.controller('mainController', function($scope) {

			$scope.message = 'Testing';
	});