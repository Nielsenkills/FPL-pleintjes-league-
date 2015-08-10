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
                templateUrl: 'app/league/league.html',
                controller: 'LeagueCtrl',
                controllerAs:'vm'
            })
            .state('GWTeam', {
                url: '/team',
                templateUrl: 'app/main/main.html',
                controller: 'MainCtrl',
                controllerAs:'vm'
            })
            .state('settings', {
                url: '/settings',
                templateUrl: 'app/settings/settings.html',
                controller: 'SettingsCtrl',
                controllerAs:'vm'
            });

        $urlRouterProvider.otherwise('/');
    });
