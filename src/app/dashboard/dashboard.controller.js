'use strict';

angular.module('gretel')
    .controller('DashboardCtrl', ['DataService', function(DataService) {
        var vm = this;

        DataService.getTeams().then(function(data) {
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
