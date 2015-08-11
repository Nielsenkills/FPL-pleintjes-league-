'use strict';

angular.module('gretel')
    .controller('SettingsCtrl', ['DataService', function(DataService) {
        var vm = this;
        vm.selectedPlayer = JSON.parse(localStorage.getItem('currentPlayer'));
        vm.showCurrentFixturesMobile = localStorage.getItem('showCurrentFixturesMobile') == 'true';

        DataService.getPlayers().then(function(data) {
            vm.players = data;
        });

        vm.playerChanged = function() {
            console.log(vm.selectedPlayer);
            localStorage.setItem('currentPlayer', JSON.stringify(vm.selectedPlayer));
        };

        vm.currentFixMobileChange = function() {
            localStorage.setItem('showCurrentFixturesMobile', vm.showCurrentFixturesMobile);
        };
    }]);
