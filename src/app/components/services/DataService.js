'use strict';

angular.module('gretel')
    .service('DataService', ['$q', '$http', function($q, $http) {
        var svc = this;
        svc.gwTeams = null;
        svc.players = null;
        svc.playerStandings = null;
        svc.currentPlayer = localStorage.getItem('currentPlayer');

        svc.gwTeamPoints = [];

        // with this function we can mock the backend with json files locally, to be improved later
        svc.getAPIUrl = function(methodName) {
            var live = false;

            if (live) {
                return './server/api.php?q=' + methodName;
            } else {
                return './data/' + methodName + '.json';
            }
        }

        svc.getPlayerStandings = function() {
            var deferred = $q.defer();

            if (svc.players) {
                deferred.resolve(svc.playerStandings);
            } else {
                $http.get(svc.getAPIUrl('getTournamentTable')).success(function(data) {
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
                $http.get(svc.getAPIUrl('getPlayers')).success(function(data) {
                    // you can do some processing here
                    console.log(data);
                    svc.players = data;

                    deferred.resolve(svc.players);
                });

            }
            return deferred.promise;
        };


        svc.getCurrentFixtures = function() {
            var deferred = $q.defer();
            $http.get(svc.getAPIUrl('getCurrentFixtures')).success(function(data) {
                deferred.resolve(data);
            });
            return deferred.promise;
        };

        svc.getNextFixtures = function() {
            var deferred = $q.defer();
            $http.get(svc.getAPIUrl('getNextFixtures')).success(function(data) {
                deferred.resolve(data);
            });
            return deferred.promise;
        };

        svc.getAllNextFixtures = function() {
            var deferred = $q.defer();
            $http.get(svc.getAPIUrl('getAllNextFixtures')).success(function(data) {
                deferred.resolve(data);
            });
            return deferred.promise;
        };

        svc.getTeams = function() {
            var deferred = $q.defer();

            if (svc.gwTeams) {
                deferred.resolve(svc.gwTeams);
            } else {
                $http.get(svc.getAPIUrl('getAllGWTeams')).success(function(data) {

                    data.forEach(function(team) {

                        //add to the points array for currentfixtures points
                        svc.gwTeamPoints[team.id] = team.points;

                        //set the total played players for each team

                        var played = 0;

                        team.players.forEach(function(player) {
                            //set the club objects of each player
                            player.details.team = svc.getClubForTeamId(player.club);
                            player.tooltip = svc.getTooltipInfo(player);
                            if (player.details.minutesPlayed > 0) {
                                played++;
                            }

                        });

                        team.playedPlayers = played;
                    });
                    svc.gwTeams = data;

                    deferred.resolve(svc.gwTeams);
                });

            }
            return deferred.promise;
        };

        svc.getGWTeamPoints = function(teamid){
            return svc.gwTeamPoints[teamid];
        }




        svc.refreshTeams = function() {
            console.log('Refreshing Data');
            svc.gwTeams = null;
            svc.getTeams();
        };

        svc.getClubForTeamId = function(id) {
            if (id === null) {
                id = 1;
            }
            return svc.clubs[id];
        };

        svc.getTooltipInfo = function(player) {
            var _CLEAN_SHEETS = ' CS: ',
                _SAVES = ' S: ',
                _GOALS = ' G: ',
                _ASSISTS = ' A: ',
                _YELLOW_CARDS = ' YC: ',
                _RED_CARDS = ' RC: ';

            switch (player.playerType) {
                case 1:
                    return _CLEAN_SHEETS + player.details.cleanSheets + _SAVES + player.details.saves;
                    break;
                case 2:
                    return _CLEAN_SHEETS + player.details.cleanSheets + _GOALS + player.details.goalsScored + _ASSISTS + player.details.assists;
                    break;
                case 3:
                    return _GOALS + player.details.goalsScored + _ASSISTS + player.details.assists;
                    break;
                case 4:
                    return _GOALS + player.details.goalsScored + _ASSISTS + player.details.assists;
                    break;
            }
        };

        svc.clubs = {
            1: {
                'id': 1,
                'name': 'Arsenal',
                'short': 'ARS'
            },
            2: {
                'id': 2,
                'name': 'Aston Villa',
                'short': 'AVL'
            },
            3: {
                'id': 3,
                'name': 'Bournemouth',
                'short': 'BOU'
            },
            4: {
                'id': 4,
                'name': 'Chelsea',
                'short': 'CHE'
            },
            5: {
                'id': 5,
                'name': 'Cystal Palace',
                'short': 'CPY'
            },
            6: {
                'id': 6,
                'name': 'Everton',
                'short': 'EVE'
            },
            7: {
                'id': 7,
                'name': 'Leicester',
                'short': 'LEI'
            },
            8: {
                'id': 8,
                'name': 'Liverpool',
                'short': 'LIV'
            },
            9: {
                'id': 9,
                'name': 'Man City',
                'short': 'MCI'
            },
            10: {
                'id': 10,
                'name': 'Man Utd',
                'short': 'MNU'
            },
            11: {
                'id': 11,
                'name': 'Newcastle',
                'short': 'NWE'
            },
            12: {
                'id': 12,
                'name': 'Norwich',
                'short': 'NOR'
            },
            13: {
                'id': 13,
                'name': 'Southhampton',
                'short': 'SOU'
            },
            14: {
                'id': 14,
                'name': 'Tottenham',
                'short': 'TOT'
            },
            15: {
                'id': 15,
                'name': 'Stoke City',
                'short': 'STO'
            },
            16: {
                'id': 16,
                'name': 'Sunderland',
                'short': 'SUN'
            },
            17: {
                'id': 17,
                'name': 'Swansea',
                'short': 'SWA'
            },
            18: {
                'id': 18,
                'name': 'Watford',
                'short': 'WAT'
            },
            19: {
                'id': 19,
                'name': 'West Brom',
                'short': 'WBA'
            },
            20: {
                'id': 20,
                'name': 'West Ham',
                'short': 'WHA'
            }
        };
    }]);
