angular.module('uploadimage',[])
    .factory('uploadimageService', ['$http', '$q', function ($http, $q) {
        return {
            post : function (fd) {
                var deferred = $q.defer();
                $http({
                    url: "api/miscellaneous/saveimage/",
                    method: "POST",
                    data: fd,
                    transformRequest: angular.identity,
                    headers: { 'Content-Type': undefined }
                }).then(function successCallback(data) {
                    deferred.resolve(data);
                }, function errorCallback(response) {
                    deferred.reject(response);
                });
                return deferred.promise;
            }
        };

    }]);
