angular.module('starter.services')

.factory('Product', ['$resource', 'appConfig',function($resource, appConfig){
	
	return $resource(appConfig.baseUrl + appConfig.endpoints.client.products, {}, {
			query: {
				isArray: false
			}
	})
	
}])