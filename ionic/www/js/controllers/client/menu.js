angular.module('starter.controllers')
	
	.controller('ClientMenuController', [
		'$scope', 'UserData', function($scope, UserData) {
		
		$scope.user = UserData.get();

	}])