'use strict';

angular.module('gretel')
    .service('TeamService', ['$q', '$http', function($q, $http) {
        var svc = this;
        svc.gwTeams = null;



        svc.getTeams = function() {
            var deferred = $q.defer();

            if (svc.gwTeams) {
                deferred.resolve(svc.gwTeams);
            } else {
                //$http.get('./data/getGWTeams.json').success(function(data) {
                $http.get('./server/api.php?q=getAllGWTeams').success(function(data) {

                    data.forEach(function(team) {

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
                'name': 'Burnley',
                'short': 'BRN'
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
                'name': 'Hull City',
                'short': 'HUL'
            },
            8: {
                'id': 8,
                'name': 'Leicester',
                'short': 'LEI'
            },
            9: {
                'id': 9,
                'name': 'Liverpool',
                'short': 'LIV'
            },
            10: {
                'id': 10,
                'name': 'Man City',
                'short': 'MCI'
            },
            11: {
                'id': 11,
                'name': 'Man Utd',
                'short': 'MNU'
            },
            12: {
                'id': 12,
                'name': 'Newcastle',
                'short': 'NWE'
            },
            13: {
                'id': 13,
                'name': 'QPR',
                'short': 'QPR'
            },
            14: {
                'id': 14,
                'name': 'Southhampton',
                'short': 'SOU'
            },
            15: {
                'id': 15,
                'name': 'Tottenham',
                'short': 'TOT'
            },
            16: {
                'id': 16,
                'name': 'Stoke City',
                'short': 'STO'
            },
            17: {
                'id': 17,
                'name': 'Sunderland',
                'short': 'SUN'
            },
            18: {
                'id': 18,
                'name': 'Swansea',
                'short': 'SWA'
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
