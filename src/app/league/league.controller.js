'use strict';

angular.module('gretel')
    .controller('LeagueCtrl', ['DataService',function(DataService) {
        var vm = this;
        
        DataService.getPlayerStandings().then(function(data) {
        	vm.players = data;
            console.log(data);
        })
    }]);
