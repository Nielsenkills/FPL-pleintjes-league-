'use strict';

angular.module('gretel')
    .controller('TransferScheduleCtrl', ['DataService',function(DataService) {
        var vm = this;
        vm.currentUser = JSON.parse(localStorage.getItem('currentPlayer'));
        
        DataService.getAllTransferTimes().then(function(data) {
        	vm.transfertimes = data;
        });
    }]);
