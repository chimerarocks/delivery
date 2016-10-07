angular.module('starter.controllers')
	
	.controller('DeliverymanMenuController', [
		'$scope', 'UserData', function($scope, UserData) {
		
		$scope.user = UserData.get();

	}])