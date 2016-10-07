angular.module('starter.services')

.factory('Coupon', ['$resource', 'appConfig',function($resource, appConfig){
	
	return $resource(appConfig.baseUrl + appConfig.endpoints.coupons + '/:code', {code: '@code'}, {
			query: {
				isArray: false
			}
	})
	
}])