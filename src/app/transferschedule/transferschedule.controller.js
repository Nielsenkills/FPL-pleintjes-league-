'use strict';

angular.module('gretel')
    .controller('TransferScheduleCtrl', ['DataService',function(DataService) {
        var vm = this;
        
        DataService.getAllTransferTimes().then(function(data) {
        	vm.transfertimes = data;
        });
    }]);
