angular.module('starter.controllers')
	
	.controller('ClientCheckoutController', [
		'$scope', '$state', '$ionicLoading', '$ionicPopup', 'ClientOrder', 'Coupon', '$cart', '$cordovaBarcodeScanner',
		function(
			//angular services
			$scope, $state, 

			//ionic services
			$ionicLoading, $ionicPopup,

			//resources
			ClientOrder, Coupon, 

			//services
			$cart, $cordovaBarcodeScanner
			) {
			
			initCart();
			
			$scope.removeItem = function($index) {
				$cart.removeItem($index);
				initCart();
			}

			$scope.openProductDetail = function($index) {
				$state.go('client.checkout_detail', {index: $index});
			}

			$scope.openListProducts = function() {
				$state.go('client.products');
			}

			$scope.save = function() {
				var items = {items: angular.copy($scope.items)};
				angular.forEach(items.items, function(item) {
					item.product_id = item.id;
				});
				$ionicLoading.show({
					template: 'Carregando... '
				});
				if ($scope.value) {
					items.coupon.code = $scope.coupon.code;
				}
				ClientOrder.save({id: null}, items, function(data) {
					$ionicLoading.hide();
					$state.go('client.checkout_successful');
				}, function(error) {
					$ionicLoading.hide();
					$ionicPopup.alert({
						title: 'Advertência',
						template: 'Pedido não realizado - tente novamente'
					});
				});
			};

			$scope.readBarCode = function() {
				$cordovaBarcodeScanner
			      .scan()
			      .then(function(barcodeData) {
					getValueCoupon(barcodeData.text);
					initCart();
			      }, function(error) {
			        $ionicPopup.alert({
						title: 'Advertência',
						template: 'Não foi possível ler o código de barras'
					});
			      });
			}

			$scope.removeCoupon = function() {
				$cart.removeCoupon();
				initCart();
			}			

			function getValueCoupon(code) {
				$ionicLoading.show({
					template: 'Carregando... '
				});
				Coupon.get({code: code}, function(data) {
				   	$cart.setCoupon(data.data.code, data.data.value);
				   	initCart();
				}, function(error) {
				   	$ionicLoading.hide();
				   	$ionicPopup.alert({
						title: 'Advertência',
						template: 'Cupom inválido'
					});
				});
			}

			function initCart() {
				var cart = $cart.get();
				$scope.items = cart.items;
				$scope.total = $cart.getTotalFinal();
				$scope.coupon = cart.coupon;
			}
		}
	])