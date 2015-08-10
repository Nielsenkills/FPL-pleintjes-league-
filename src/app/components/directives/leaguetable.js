'use strict';

angular.module('gretel')
    .directive('leagueTable', ['DataService', function(DataService) {

        return {
            templateUrl: 'app/components/directives/leaguetable.html',
            restrict: 'E',
            replace: true,
            transclude: false,
            scope: {
                p: '='
            },
            controller: function($scope, $attrs, DataService) {
                $scope.currentPlayer = DataService.currentPlayer;
                DataService.getPlayerStandings().then(function(data) {
                    $scope.players = data;
                    console.log($scope.players);
                });

                console.log($scope.currentPlayer);

            },
            link: function postLink(scope, element, attrs) {

            }
        };
    }]);
