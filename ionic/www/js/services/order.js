angular.module('starter.services')

.factory('ClientOrder', ['$resource', 'appConfig',function($resource, appConfig){
	
	return $resource(appConfig.baseUrl + appConfig.endpoints.client.orders + '/:id', {id: '@id'}, {
			query: {
				isArray: false
			}
	})
	
}])

.factory('DeliverymanOrder', ['$resource', 'appConfig',function($resource, appConfig){
	var url = appConfig.baseUrl + appConfig.endpoints.deliveryman.orders + '/:id';
	return $resource(url, {id: '@id'}, {
		query: {
			isArray: false
		},
		updateStatus: {
			method: 'PATCH',
			url: url + '/update-status'
		},
		get: {
			method: 'POST',
			url: url + '/geo'
		}
	})
	
}])

