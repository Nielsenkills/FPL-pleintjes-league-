'use strict';

angular.module('gretel')
    .controller('LeagueCtrl', ['PlayerService',function(PlayerService) {
        var vm = this;
        
        PlayerService.getPlayers().then(function(data) {
        	vm.players = data;
            console.log(data);
        })
    }]);
