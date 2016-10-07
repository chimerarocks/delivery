angular.module('starter.controllers')
	
	.controller('ClientOrderController', [
		'$scope', '$state', '$ionicLoading', '$ionicPopup', '$ionicActionSheet','ClientOrder', 
		function($scope, $state, $ionicLoading, $ionicPopup, $ionicActionSheet, ClientOrder) {
		
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
			$state.go('client.order_detail', {id: order.id});
		};

		$scope.showActionSheet = function(order) {
			$ionicActionSheet.show({
				buttons: [
					{text: 'Ver detalhes'}, 
					{text: 'Ver entrega'}
				],
				titleText: 'O que fazer?',
				cancelText: 'Cancelar',
				cancel: function() {
					//
				},
				buttonClicked: function(index) {
					switch(index) {
						case 0: 
							$state.go('client.order_detail', {id: order.id});
							break;
						case 1:
							$state.go('client.delivery', {id: order.id});
							break;
					}
				}
			});
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
			return ClientOrder.query({
				id: null,
				orderBy: 'created_at',
				sortedBy: 'desc'
			}).$promise;
		};
	}])