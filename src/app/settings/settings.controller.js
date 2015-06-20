'use strict';

angular.module('gretel')
    .controller('SettingsCtrl', ['PlayerService',function(PlayerService) {
        var vm = this;
        
        PlayerService.getPlayers().then(function(data) {
        	vm.players = data;
            console.log(data);
        })
    }]);
