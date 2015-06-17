'use strict';

angular.module('gretel', ['ngAnimate', 'ngCookies', 'ngTouch', 'ngSanitize', 'ui.router', 'ui.bootstrap'])
    .config(function($stateProvider, $urlRouterProvider) {
        $stateProvider
            .state('dashboard', {
                url: '/',
                templateUrl: 'app/dashboard/dashboard.html',
                controller: 'DashboardCtrl',
                controllerAs:'vm'
            })
            .state('league', {
                url: '/league',
                templateUrl: 'app/main/main.html',
                controller: 'MainCtrl'
            })
            .state('GWTeam', {
                url: '/team',
                templateUrl: 'app/main/main.html',
                controller: 'MainCtrl'
            })
            .state('vs', {
                url: '/vs',
                templateUrl: 'app/main/main.html',
                controller: 'MainCtrl'
            });

        $urlRouterProvider.otherwise('/');
    });
