angular.module('starter.controllers')
	
	.controller('ClientCheckoutSuccessfulController', [
		'$scope', '$cart', '$state',
		function($scope, $cart, $state) {
			
			initCart();
			
			$cart.clear();

			$scope.openListOrder = function(){
				
			}

			function initCart() {
				var cart = $cart.get();
				$scope.coupon = cart.coupon;
				$scope.items = cart.items;
				$scope.total = cart.getTotalFinal();
			}

			$scope.openListOrder = function() {
				$state.go('client.order');
			}
		}
	])