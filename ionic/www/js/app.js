// Ionic Starter App

angular.module('starter.controllers', []);
angular.module('starter.services', []);
angular.module('starter.filters', []);

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
angular.module('starter', [
  'ionic', 'ionic.service.core', 'starter.controllers', 'starter.services', 'starter.filters',
  'angular-oauth2', 'ngResource', 'ngCordova', 'uiGmapgoogle-maps', 'pusher-angular'
  ])

.run(function($ionicPlatform, $window, appConfig, $localStorage) {
  $window.client = new Pusher(appConfig.pusherKey);

  $ionicPlatform.ready(function() {
    if(window.cordova && window.cordova.plugins.Keyboard) {
      // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
      // for form inputs)
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);

      // Don't remove this line unless you know what you are doing. It stops the viewport
      // from snapping when text inputs are focused. Ionic handles this internally for
      // a much nicer keyboard experience.
      cordova.plugins.Keyboard.disableScroll(true);
      /*Ionic.io();
      var push = new Ionic.Push({
        debug:true,
        onNotification: function(message) {
          alert(message.text);
        },
        pluginConfig: {
          android: {
            iconColor: red
          }
        }
      });
      push.register(function(token) {
        $localStorage.set('device_token', token.token);
      });
      */
    }
    if(window.StatusBar) {
      StatusBar.styleDefault();
    }
  });
})

.constant('appConfig', {
  baseUrl: 'http://localhost:8000',
  endpoints: {
    client: {
      products: '/api/client/products',
      orders: '/api/client/orders'
    },
    deliveryman: {
      orders: '/api/deliveryman/orders'
    },
    coupons: '/api/coupons',
    authenticated: '/api/authenticated',
    device_token: '/api/device_token'
  },
  pusherKey: 'ccf60973ff2e48a102d0'
})

.config(function($stateProvider, OAuthProvider, OAuthTokenProvider, appConfig, $urlRouterProvider, $provide) {
  $stateProvider
    .state('menu', {
      url: '/menu',
      templateUrl: 'templates/menu.html',
      controller: function($scope, $ionicSideMenuDelegate) {
        $scope.abrirEsquerdo = function() {
          $ionicSideMenuDelegate.toogleLeft();
        };
        $scope.abrirDireito = function() {
          $ionicSideMenuDelegate.toogleRight();
        }
      }
    })
    .state('login', {
      url: '/login',
      templateUrl: 'templates/login.html',
      controller: 'LoginController'
    })
    .state('home', {
      url: '/home',
      templateUrl: 'templates/home.html',
      controller: function ($scope) {

      }
    })
    .state('client', {
      abstract: true,
      cache: false,
      url: '/client',
      templateUrl: 'templates/client/menu.html',
      controller: 'ClientMenuController'
    })
    .state('client.checkout', {
      url: '/checkout',
      cache: false,
      templateUrl: 'templates/client/checkout.html',
      controller: 'ClientCheckoutController'
    })
    .state('client.order', {
      url: '/order',
      templateUrl: 'templates/client/orders.html',
      controller: 'ClientOrderController'
    })
    .state('client.order_detail', {
      url: '/order_detail/:id',
      templateUrl: 'templates/client/order_detail.html',
      controller: 'ClientOrderDetailController'
    })
    .state('client.checkout_detail', {
      url: '/checkout-detail/:index',
      templateUrl: 'templates/client/checkout_detail.html',
      controller: 'ClientCheckoutDetailController'
    })
    .state('client.checkout_successful', {
      url: '/checkout_successful',
      templateUrl: 'templates/client/checkout_successful.html',
      controller: 'ClientCheckoutSuccessfulController'
    })
    .state('client.delivery', {
      cache: false,
      url: '/delivery/:id',
      templateUrl: 'templates/client/delivery.html',
      controller: 'ClientDeliveryController'
    })
    .state('client.products', {
      url: '/products',
      templateUrl: 'templates/client/products.html',
      controller: 'ClientProductsController'
    })
    .state('deliveryman', {
      abstract: true,
      cache: false,
      url: '/deliveryman',
      templateUrl: 'templates/deliveryman/menu.html',
      controller: 'DeliverymanMenuController'
    })
    .state('deliveryman.order', {
      url: '/order',
      templateUrl: 'templates/deliveryman/order.html',
      controller: 'DeliverymanOrderController'
    })
    .state('deliveryman.order_detail', {
      cache: false,
      url: '/order_detail/:id',
      templateUrl: 'templates/deliveryman/order_detail.html',
      controller: 'DeliverymanOrderDetailController'
    })

  $urlRouterProvider.otherwise('/login');

  OAuthProvider.configure({
    baseUrl: appConfig.baseUrl,
    clientId: '2',
    clientSecret: '3qpQJOwDrXp6OD0OumGrtCNxCPHcobGqr9m2h641',
    grantPath: '/oauth/token',
    revokePath: '/oauth/revoke'
  })

  OAuthTokenProvider.configure({
    name: 'token',
    options: {
      secure: true
    }
  })

  $provide.decorator('OAuthToken', ['$localStorage', '$delegate', function($localStorage, $delegate) {
    Object.defineProperties($delegate, {
      setToken: {
        value: function(data) {
          return $localStorage.setObject('token', data);
        },
        enumerable: true,
        configurable: true,
        writable: true
      },
      getToken: {
        value: function() {
          return $localStorage.getObject('token');
        },
        enumerable: true,
        configurable: true,
        writable: true
      },
      removeToken: {
        value: function() {
          return $localStorage.setObject('token', null);
        },
        enumerable: true,
        configurable: true,
        writable: true
      }
    });
    return $delegate;
  }]);
})