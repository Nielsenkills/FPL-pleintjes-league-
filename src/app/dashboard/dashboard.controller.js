'use strict';

angular.module('gretel')
    .controller('DashboardCtrl', ['DataService', function(DataService) {
        var vm = this;
        vm.currentUser = JSON.parse(localStorage.getItem('currentPlayer'));
        vm.showCurrentFixturesMobile = localStorage.getItem('showCurrentFixturesMobile');

        vm.switchDetailsVisibility = function(player) {
            if (player.showDetails) {
                player.showDetails = false;
            } else {
                player.showDetails = true;
            }

        };


        vm.getTeamPoints = function(teamid) {
            return DataService.getGWTeamPoints(teamid);
        };

        //Get the data

        DataService.getTeams().then(function(teamdata) {
            vm.teams = teamdata;
        });
    }]);
