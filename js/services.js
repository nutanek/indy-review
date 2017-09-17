theme.factory('ratingServices', ['$http', '$q', '$rootScope', function($http, $q, $rootScope) {
    return {        
        get: function(postID) {            
            var deferred = $q.defer();   
            var path = $rootScope.indyConfig.api;
            $http({
                method: 'GET',
                url: path + '/rating/' + postID,
                headers: {
                    'Content-Type': 'application/json'
                }
            }).then(function(res) {
                if (typeof res.data !== "undefined" && res.data.result === 0) {
                    deferred.resolve(res.data);
                } else {
                    deferred.reject(res.data);
                }
            }, function(err) {
                deferred.reject(err);
            });       
            return deferred.promise;        
        },
        getAvg: function(postID) {            
            var deferred = $q.defer();   
            var path = $rootScope.indyConfig.api;
            $http({
                method: 'GET',
                url: path + '/rating/avg/' + postID,
                headers: {
                    'Content-Type': 'application/json'
                }
            }).then(function(res) {
                if (typeof res.data !== "undefined" && res.data.result === 0) {
                    deferred.resolve(res.data);
                } else {
                    deferred.reject(res.data);
                }
            }, function(err) {
                deferred.reject(err);
            });       
            return deferred.promise;        
        },
        push: function(postID, score) {            
            var deferred = $q.defer();   
            var path = $rootScope.indyConfig.api;
            $http({
                method: 'POST',
                url: path + '/rating/' + postID,
                headers: {
                    'Content-Type': 'application/json'
                },
                data: JSON.stringify({
                    postID: postID,
                    score: score
                })
            }).then(function(res) {
                if (typeof res.data !== "undefined" && res.data.result === 0) {
                    deferred.resolve(res.data);
                } else {
                    deferred.reject(res.data);
                }
            }, function(err) {
                deferred.reject(err);
            });       
            return deferred.promise;        
        }
    };
}])
.factory('postsServices', ['$http', '$q', '$rootScope', function($http, $q, $rootScope) {
    return {        
        get: function(options) {            
            var deferred = $q.defer();   
            var path = $rootScope.indyConfig.api;
            console.log({
                catID: options.catID, 
                orderBy: options.orderBy, 
                page: options.page,
                tag: options.tag,
                search: options.search
            })
            $http({
                method: 'POST',
                url: path + '/posts',
                headers: {
                    'Content-Type': 'application/json'
                },
                data: JSON.stringify({
                    catID: options.catID, 
                    orderBy: options.orderBy, 
                    page: options.page,
                    tag: options.tag,
                    search: options.search
                })
            }).then(function(res) {
                if (typeof res.data !== "undefined" && res.data.result === 0) {
                    deferred.resolve(res.data);
                } else {
                    deferred.resolve(res.data);
                }
            }, function(err) {
                deferred.reject(err);
            });       
            return deferred.promise;        
        }
    };
}]);