angular.module('starter.controllers', [])
	
	.controller('LoginController', ['$scope', 'OAuth', '$ionicPopup',function($scope, OAuth, $ionicPopup) {
		
		$scope.user = {
			username: '',
			password: '',
			scope: ''
		}

		$scope.login = function() {
			OAuth.getAccessToken($scope.user).then(function(data) {

			}, function(responseError) {
				console.log(responseError);
			})
			// query = [
			// 'client_id=3',
   //          'redirect_uri=http://localhost:8100/#/callback',
   //    		'response_type=code',
   //    		'grant_type=password',
   //    		'scope'
   //    		];
   //    		queryString = query.join('&')
			// window.location = 'http://localhost:8000/oauth/authorize?' + queryString;
		}

	}])