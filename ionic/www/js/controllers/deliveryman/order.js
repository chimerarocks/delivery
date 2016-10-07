angular.module('starter.controllers')
	
	.controller('DeliverymanOrderController', [
		'$scope', '$state', '$ionicLoading', 'DeliverymanOrder', 
		function($scope, $state, $ionicLoading, DeliverymanOrder) {
		
		$scope.items = [];

		$scope.doRefresh = function() {
			getOrders().then(function(data) {
				$scope.items = data.data;
				$scope.$broadcast('scroll.refreshComplete');
			}, function(error) {
				$scope.$broadcast('scroll.refreshComplete');
				$ionicPopup.alert({
					title: 'Advertência',
					template: 'Não foi possível atualizar'
				});
			});
		};

		$scope.openOrderDetail = function(order) {
			$state.go('deliveryman.order_detail', {id: order.id});
		};

		$ionicLoading.show({
			template: 'Carregando...'
		});

		getOrders().then(function(data) {
			$scope.items = data.data;
			$ionicLoading.hide();
		}, function(error) {
			$ionicLoading.hide();
		});

		function getOrders = function () {
			return DeliverymanOrder.query({
				id: null,
				orderBy: 'created_at',
				sortedBy: 'desc'
			}).$promise;
		};

	}])