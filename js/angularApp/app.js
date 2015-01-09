"use strict";
var myAdminApp = angular.module('myAdminApp',['xeditable']);

myAdminApp.run(function(editableOptions) {
  editableOptions.theme = 'default'; // bootstrap3 theme. Can be also 'bs2', 'default'
});
