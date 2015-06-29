'use strict';

angular.module('gretel')
    .controller('NavbarCtrl',[ 'DataService',function(DataService) {
        var vm = this;
        vm.refreshData = function() {
            DataService.refreshTeams();
        }


    }]);
