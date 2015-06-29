'use strict';

angular.module('gretel')
    .service('PlayerService', ['$q', '$http', function($q, $http) {
        var svc = this;
        svc.players = null;
        svc.playerStandings = null;

        svc.getPlayerStandings = function() {
            var deferred = $q.defer();

            if (svc.players) {
                deferred.resolve(svc.playerStandings);
            } else {
                $http.get('./data/getLeagueStandings.json').success(function(data) {
                    // you can do some processing here
                    svc.playerStandings = data;

                    deferred.resolve(svc.playerStandings);
                });

            }
            return deferred.promise;
        };

        svc.getPlayers = function() {
            var deferred = $q.defer();

            if (svc.players) {
                deferred.resolve(svc.players);
            } else {
                $http.get('./data/getPlayers.json').success(function(data) {
                    // you can do some processing here
                    console.log(data);
                    svc.players = data;

                    deferred.resolve(svc.players);
                });

            }
            return deferred.promise;
        };
    }]);
