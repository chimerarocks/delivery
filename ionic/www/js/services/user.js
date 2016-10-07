angular.module('starter.services')

.factory('User', ['$resource', 'appConfig',function($resource, appConfig){
	
	return $resource(appConfig.baseUrl + appConfig.endpoints.users, {}, {
		query: {
			isArray: false
		},
		authenticated: {
			method: 'GET',
			url: appConfig.baseUrl + appConfig.endpoints.users
		}
	});

}])