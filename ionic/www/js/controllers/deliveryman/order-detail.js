angular.module('starter.controllers')
	
	.controller('DeliverymanOrderDetailController', [
		'$scope', '$state', '$stateParams', '$ionicLoading', '$ionicPopup', 'DeliverymanOrder', '$cordovaGeolocation', '$ionicPopup', 
		function($scope, $state, $stateParams, $ionicLoading, $ionicPopup, DeliverymanOrder, $cordovaGeolocation, $ionicPopup) {
		
		var watch, lat, long;

		$scope.order = {};

		$ionicLoading.show({
			template: 'Carregando...'
		});

		DeliverymanOrder.get({id: $stateParams.id, include: "items, coupon"}, function(data) {
			$scope.order = data.data;
			$ionicLoading.hide();
		}, function(error) {
			$ionicLoading.hide();
		});

		$scope.goToDelivery = function() {
			$ionicPopup.alert({
				title: 'Advertência',
				template: 'Para para a localização clique em ok'
			}).then(function() {
				stopWatchPosition();
			});
			DeliverymanOrder.updateStatus({id: $stateParams.id}, {status: 1}, function(){
				var watchOptions = {
					timeout: 3000,
					enableHighAccuracy: false
				};

				watch = $cordovaGeolocation.watchPosition(watchOptions);
				watch.then(null, function(error) {
					//error
				}, function(position){
					if (!lat) {
						lat = position.coords.latitude;
						long = position.coords.longitude;
					} else {
						lat = 0;
					}
					DeliverymanOrder.geo({id: $stateParams.id}, {
						lat: lat,
						long: long
					})
				});
			});
		};

		function stopWatchPosition() {
			if(watch  && typeof watch == 'object' && watch.hasOwnProperty('watchID')) {
				$cordovaGeolocation.clearWatch(watch.watchID);
			}
		};
	}])