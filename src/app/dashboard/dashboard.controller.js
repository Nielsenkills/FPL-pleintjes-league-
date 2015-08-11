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

            //get the current fixtures, do this after we got the teams because we need the points
            DataService.getCurrentFixtures().then(function(fixdata) {
                //add points to the current fixtures

                fixdata.forEach(function(fix) {
                    fix.home.points = vm.getTeamPoints(fix.home.id);
                    fix.away.points = vm.getTeamPoints(fix.away.id);
                });

                vm.currentFixtures = fixdata;

            });


        });

        DataService.getNextFixtures().then(function(data) {
            vm.nextFixtures = data;
        });

        DataService.getTransferTimes().then(function(data) {
            vm.currentTransferTimes = data;
        });


    }]);
