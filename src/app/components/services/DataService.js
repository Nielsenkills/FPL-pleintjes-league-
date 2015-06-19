'use strict';

angular.module('gretel')
    .service('DataService', ['$q', '$http', function($q, $http) {
        var svc = this;
        svc.gwTeams = null;

        svc.getTeams = function() {
            var deferred = $q.defer();

            if (svc.gwTeams) {
                deferred.resolve(svc.gwTeams);
            } else {
                $http.get('./data/getGWTeams.json').success(function(data) {
                    // you can do some processing here
                    console.log(data);
                    svc.gwTeams = data;

                deferred.resolve(svc.gwTeams);
                });

            }
            return deferred.promise;
        };
    }]);
