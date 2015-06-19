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

        vm.getTooltipInfo = function(player) {
        	console.log('test');
            switch (player.type) {
                case 1:
                    return 'Clean Sheets: ' + player.details.cleanSheets + ' Saves: ' + player.details.saves;
                    break;
                case 2:
                    return 'Clean Sheets: ' + player.details.cleanSheets + ' Goals: ' + player.details.goalsScored + ' Assists: ' + player.details.assists;
                    break;
                case 3:
                    return 'Goals: ' + player.details.goalsScored + ' Assists: ' + player.details.assists;
                    break;
                case 4:
                    return 'Goals: ' + player.details.goalsScored + ' Assists: ' + player.details.assists;
                    break;
            }
        };
    }]);
