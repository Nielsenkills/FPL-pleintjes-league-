'use strict';

angular.module('gretel')
    .controller('DashboardCtrl', ['TeamService', function(TeamService) {
        var vm = this;

        TeamService.getTeams().then(function(data) {
            vm.teams = data;
            console.log(data);
        });

        vm.switchDetailsVisibility = function(player) {
            console.log('test');
            if (player.showDetails){
                player.showDetails = false;
            }
            else{
                player.showDetails = true;
            }

        };

    }]);
