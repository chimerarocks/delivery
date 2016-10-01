// Ionic Starter App

angular.module('starter.controllers', [])

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
angular.module('starter', ['ionic', 'starter.controllers','angular-oauth2'])

.run(function($ionicPlatform) {
  $ionicPlatform.ready(function() {
    if(window.cordova && window.cordova.plugins.Keyboard) {
      // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
      // for form inputs)
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);

      // Don't remove this line unless you know what you are doing. It stops the viewport
      // from snapping when text inputs are focused. Ionic handles this internally for
      // a much nicer keyboard experience.
      cordova.plugins.Keyboard.disableScroll(true);
    }
    if(window.StatusBar) {
      StatusBar.styleDefault();
    }
  });
})

.config(function($stateProvider, OAuthProvider, OAuthTokenProvider) {
  $stateProvider
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
      url: '/client',
      template: '<ui-view/>'
    })
    .state('client.checkout', {
      url: '/checkout',
      templateUrl: 'templates/client/checkout.html',
      controller: 'ClientCheckoutController'
    })
    .state('client.checkout.detail', {
      url: '/checkout/detail/:index',
      templateUrl: 'templates/client/checkout-detail.html',
      controller: 'ClientCheckoutDetailController'
    })
    .state('client.products', {
      url: '/products',
      templateUrl: 'templates/client/products.html',
      controller: 'ClientProductsController'
    })

  OAuthProvider.configure({
    baseUrl: 'http://localhost:8000',
    clientId: '12',
    clientSecret: 'YwuWROkYQUJmhATKtii2rTQCYGpFrk7qtjN74gvu',
    grantPath: '/oauth/token',
    revokePath: '/oauth/revoke'
  })

  OAuthTokenProvider.configure({
    name: 'token',
    options: {
      secure: true
    }
  })
})